<?php
require_once 'config/config.php';

$batas         = 10;
$halaman       = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal  = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous      = $halaman - 1;
$next          = $halaman + 1;

if (isset($_GET['obat'])) {
    $nama = $_GET['obat'];
    $data = $koneksi->query("SELECT * FROM obat WHERE nama_obat LIKE '%$nama%'");
    $dataobat  = $koneksi->query("SELECT * FROM obat WHERE nama_obat LIKE '%$nama%' LIMIT $halaman_awal, $batas");
} else {
    $data = $koneksi->query("SELECT * FROM obat");
    $dataobat  = $koneksi->query("SELECT * FROM obat LIMIT $halaman_awal, $batas");
}

$jumlah_data   = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$nomor         = $halaman_awal + 1;

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'template/public/head.php'; ?>

<style>
    .ahover:hover .card {
        /*box-shadow: 8px 8px 15px black;*/
        box-shadow: 0 2px 30px 0 rgba(1, 7, 49);
        border-style: none;
        -webkit-transform: scale(1.08);
        transform: scale(1.08);
    }
</style>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once 'template/public/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-cover">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <h1 class="m-0 text-dark">Obat Tradisional</h1>
                        </div>
                    </div>
                    <?php include_once 'template/public/menu.php'; ?>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">

                    <nav class="navbar justify-content-between pl-0 pr-0">
                        <a class="navbar-brand">
                            <?php if (isset($_GET['obat'])) { ?>
                                Menampilkan Nama Obat : <u><i><?= $_GET['obat'] ?></i></u>
                            <?php } ?>
                        </a>
                        <form class="form-inline" action="" method="GET">
                            <input class="form-control mr-sm-2" type="search" name="obat" placeholder="Cari Nama Obat" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                        </form>
                    </nav>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            foreach ($dataobat as $item) :
                            ?>
                                <div class="list-group mb-1">
                                    <a href="#" id="detail-obat" data-id="<?= $item['id_obat'] ?>" class="list-group-item list-group-item-action list-group-item-success">
                                        <?= $item['nama_obat'] ?>
                                    </a>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <div class="col-sm-12 mt-3">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <li class="page-item <?= $halaman < $total_halaman ? 'disabled' : '' ?>">
                                        <a class="page-link" <?php if ($halaman > 1) {
                                                                    echo "href='?halaman=$previous'";
                                                                } ?>>Previous</a>
                                    </li>
                                    <?php
                                    $url = explode('=', $_SERVER['REQUEST_URI']);
                                    $get_url = end($url);

                                    for ($x = 1; $x <= $total_halaman; $x++) {
                                    ?>
                                        <li class="page-item <?= $x == $get_url ? 'active' : '' ?>">
                                            <a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                    <li class="page-item <?= $halaman > 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                                    echo "href='?halaman=$next'";
                                                                } ?>>Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include_once 'template/public/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <!-- Detail Modal-->
    <div class="modal fade" id="modal-detail-obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900 text-bold" id="exampleModalLabel">Detail Obat Tradisional</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="gambar mb-3"></div>
                        <dl class="row">
                            <dt class="col-md-4">Nama Obat</dt>
                            <dd class="col-md-8" id="nama_obat"></dd>
                            <dt class="col-md-4">Deskripsi</dt>
                            <dd class="col-md-8" id="deskripsi"></dd>
                            <dt class="col-md-4">Indikasi</dt>
                            <dd class="col-md-8" id="indikasi"></dd>
                            <dt class="col-md-4">Aturan Pakai</dt>
                            <dd class="col-md-8" id="aturan_pakai"></dd>
                            <dt class="col-md-4">Dari Tanaman</dt>
                            <dd class="col-md-8" id="nama_tanaman"></dd>
                            <dt class="col-md-4">Komposisi</dt>
                            <dd class="col-md-8" id="komposisi"></dd>
                        </dl>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        <i class="fa fa-times"> Tutup</i>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- REQUIRED SCRIPTS -->
    <?php include_once 'template/public/script.php'; ?>

    <script>
        $(document).on('click', '#detail-obat', function(e) {
            e.preventDefault();
            $("#modal-detail-obat").modal('show');
            $.post('template/public/modal-detail-obat.php', {
                    id: $(this).attr('data-id')
                },
                function(data) {
                    let item = JSON.parse(data);
                    $('#nama_obat').html(item.nama_obat);
                    $('#deskripsi').html(item.deskripsi);
                    $('#indikasi').html(item.indikasi);
                    $('#aturan_pakai').html(item.aturan_pakai);
                    $('#nama_tanaman').html(item.nama_tanaman);
                    $('#komposisi').html(item.komposisi);
                });
        });
    </script>

</body>

</html>