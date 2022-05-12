<?php
require_once 'config/config.php';

$batas         = 8;
$halaman       = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal  = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous      = $halaman - 1;
$next          = $halaman + 1;

$data          = $koneksi->query("SELECT * FROM stok_obat");
$jumlah_data   = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$foto_obat  = $koneksi->query("SELECT * FROM stok_obat LIMIT $halaman_awal, $batas");
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
                            <h1 class="m-0 text-dark">Keterangan Data Obat-obatan</h1>
                        </div>
                    </div>
                    <!-- <?php include_once 'template/public/menu.php'; ?> -->
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">

                        <?php foreach ($foto_obat as $item) :
                        ?>
                            <div class="col-sm-3 col-xl-3 mb-4 ahover">
                                <a href="#" id="detail-obat" data-id="<?= $item['kode_obat'] ?>">
                                    <div class="card">
                                        <img class="card-img-top" src="<?= base_url('assets/gambar-obat/' . $item['gambar_obat']) ?>" style="height: 180px;">
                                        <div class="card-body">
                                            <h5 class="card-title text-gray-900"><?= $item['nama_obat'] ?></h5>
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
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

                <!-- Detail Modal-->
                <div class="modal fade" id="modal-detail-obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-gray-900 text-bold" id="exampleModalLabel">Detail Obat</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <div class="gambar mb-3 justify-content-center text-center"></div>
                                    <!-- <dl class="row">
                                        <dt class="col-md-4">Kode Obat</dt>
                                        <dd class="col-md-8" id="kode_obat"></dd>
                                        <dt class="col-md-4">Nama Obat</dt>
                                        <dd class="col-md-8" id="nama_obat"></dd>
                                        <dt class="col-md-4">Harga Pembelian</dt>
                                        <dd class="col-md-8" id="harga_pembelian"></dd>
                                        <dt class="col-md-4">Harga Jual</dt>
                                        <dd class="col-md-8" id="harga_jual"></dd>
                                        <dt class="col-md-4">Jenis Obat</dt>
                                        <dd class="col-md-8" id="jenis_obat"></dd>
                                        <dt class="col-md-4">Jumlah Stok</dt>
                                        <dd class="col-md-8" id="jumlah_stok"></dd>
                                        <dt class="col-md-4">Dosis Obat</dt>
                                        <dd class="col-md-8" id="dosis_obat"></dd>
                                        <dt class="col-md-4">Keterangan</dt>
                                        <dd class="col-md-8" id="keterangan"></dd>
                                    </dl> -->
                                    <table class="table table-striped" width="100%">
                                        <tr>
                                            <td width="20%">Kode Obat</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="kode_obat"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Obat</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="nama_obat"></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Jual</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="harga_jual"></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Obat</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="jenis_obat"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Stok</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="jumlah_stok"></td>
                                        </tr>
                                        <tr>
                                            <td>Dosis Obat</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="dosis_obat"></td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="keterangan"></td>
                                        </tr>
                                    </table>
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

    <!-- REQUIRED SCRIPTS -->
    <?php include_once 'template/public/script.php'; ?>

    <script>
        $(document).on('click', '#detail-obat', function(e) {
            e.preventDefault();
            $("#modal-detail-obat").modal('show');
            $.post('detail.php', {
                    id: $(this).attr('data-id')
                },
                function(data) {
                    let item = JSON.parse(data);
                    $('#kode_obat').html(item.kode_obat);
                    $('#nama_obat').html(item.nama_obat);
                    $('#harga_jual').html(formatRupiah(item.harga_jual));
                    $('#jenis_obat').html(item.jenis_obat);
                    $('#jumlah_stok').html(item.jumlah_stok);
                    $('#dosis_obat').html(item.dosis_obat);
                    $('#keterangan').html(item.ket_obat);
                    $('.gambar').empty();
                    $('.gambar').append('<img src="<?= base_url() ?>/assets/gambar-obat/' + item.gambar_obat + '" style="width: 70%; height: 70%; text-align: center; justify-content: center; border-radius: 25px;">');
                });
        });

        /* Fungsi formatRupiah */
        var formatRupiah = function(num) {
            var str = num.toString().replace("", ""),
                parts = false,
                output = [],
                i = 1,
                formatted = null;
            if (str.indexOf(".") > 0) {
                parts = str.split(".");
                str = parts[0];
            }
            str = str.split("").reverse();
            for (var j = 0, len = str.length; j < len; j++) {
                if (str[j] != ".") {
                    output.push(str[j]);
                    if (i % 3 == 0 && j < (len - 1)) {
                        output.push(".");
                    }
                    i++;
                }
            }
            formatted = output.reverse().join("");
            return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        };
    </script>

</body>

</html>