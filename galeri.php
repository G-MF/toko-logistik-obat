<?php
require_once 'config/config.php';

$batas         = 8;
$halaman       = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal  = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous      = $halaman - 1;
$next          = $halaman + 1;

if (isset($_GET['jenis'])) {
    $nama = $_GET['jenis'];
    $data = $koneksi->query("SELECT * FROM tanaman_obat WHERE kelompok = '$nama'");
    $foto_tanaman  = $koneksi->query("SELECT * FROM tanaman_obat WHERE kelompok = '$nama' LIMIT $halaman_awal, $batas");
} else {
    $data = $koneksi->query("SELECT * FROM tanaman_obat");
    $foto_tanaman  = $koneksi->query("SELECT * FROM tanaman_obat LIMIT $halaman_awal, $batas");
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
                            <h1 class="m-0 text-dark">Galeri Tanaman Obat</h1>
                        </div>
                    </div>
                    <?php include_once 'template/public/menu.php'; ?>
                    <hr>
                    <div class="row mb-2">
                        <?php
                        $jenis = $koneksi->query("SELECT * FROM kelompok_tanaman ORDER BY nama ASC");
                        foreach ($jenis as $item) {
                        ?>
                            <div class="col-lg-4 mb-1">
                                <form action="" method="GET">
                                    <input type="hidden" name="jenis" value="<?= $item['nama'] ?>">
                                    <button type="submit" class="btn bg-gradient-danger btn-block btn-xs font-weight-bold">
                                        <?= $item['nama'] ?>
                                    </button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">

                    <?php if (isset($_GET['jenis'])) { ?>
                        <h5>Jenis Tanaman : <?= "<u><i>" . $_GET['jenis'] . "</i></u>"; ?></h5>
                    <?php } ?>

                    <div class="row">
                        <?php
                        foreach ($foto_tanaman as $item) :
                        ?>
                            <div class="col-sm-3 col-xl-3 mb-4 ahover">
                                <a href="#" id="detail-tanaman" data-id="<?= $item['id_tanaman'] ?>">
                                    <div class="card">
                                        <img class="card-img-top" src="<?= base_url('assets/gambar-tanaman/' . $item['gambar_tanaman']) ?>" style="height: 180px;">
                                        <div class="card-body">
                                            <h5 class="card-title text-gray-900"><?= $item['nama_tanaman'] ?></h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>

                        <div class="col-sm-12">
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
    <div class="modal fade" id="modal-detail-tanaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-gray-900 text-bold" id="exampleModalLabel">Detail Tanaman Obat</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="gambar mb-3 text-center"></div>
                        <dl class="row">
                            <dt class="col-md-4">Nama Tanaman</dt>
                            <dd class="col-md-8" id="nama_tanaman"></dd>
                            <dt class="col-md-4">Deskripsi</dt>
                            <dd class="col-md-8" id="deskripsi"></dd>
                            <dt class="col-md-4">Indikasi</dt>
                            <dd class="col-md-8" id="indikasi"></dd>
                            <dt class="col-md-4">Kelompok</dt>
                            <dd class="col-md-8" id="kelompok"></dd>
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
        $(document).on('click', '#detail-tanaman', function(e) {
            e.preventDefault();
            $("#modal-detail-tanaman").modal('show');
            $.post('detail.php', {
                    id: $(this).attr('data-id')
                },
                function(data) {
                    let item = JSON.parse(data);
                    $('#nama_tanaman').html(item.nama_tanaman);
                    $('#deskripsi').html(item.deskripsi);
                    $('#indikasi').html(item.indikasi);
                    $('#kelompok').html(item.kelompok);
                    $('.gambar').empty();
                    $('.gambar').append('<img src="<?= base_url() ?>/assets/gambar-tanaman/' + item.gambar_tanaman + '" style="width: 70%; height: 70%; text-align: center; justify-content: center; border-radius: 25px;">');
                });
        });
    </script>

</body>

</html>