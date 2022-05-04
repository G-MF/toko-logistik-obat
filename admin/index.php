<?php
require_once '../config/config.php';
include_once '../config/auth-cek.php';

// hitung jumlah data
function hitung_data($table, $koneksi)
{
    $query  = $koneksi->query("SELECT COUNT(*) as jumlah FROM $table")->fetch_array();
    $jumlah = $query['jumlah'];
    return $jumlah;
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '../template/admin/head.php'; ?>

<style>
    .ahover:hover .card {
        /*box-shadow: 8px 8px 15px black;*/
        box-shadow: 0 2px 30px 0 rgba(1, 7, 49);
        border-style: none;
        -webkit-transform: scale(1.08);
        transform: scale(1.08);
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../template/admin/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../template/admin/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Karyawan
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= hitung_data('karyawan', $koneksi) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Pelanggan
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= hitung_data('pelanggan', $koneksi) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Supplier
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= hitung_data('supplier', $koneksi) ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Stok Obat
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= hitung_data('stok_obat', $koneksi) ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-pills fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->

                    <!-- Content Row -->
                    <div class="row">

                        <?php
                        $batas         = 8;
                        $halaman       = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                        $halaman_awal  = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                        $previous      = $halaman - 1;
                        $next          = $halaman + 1;

                        $data          = $koneksi->query("SELECT * FROM stok_obat");
                        $jumlah_data   = mysqli_num_rows($data);
                        $total_halaman = ceil($jumlah_data / $batas);

                        $foto_tanaman  = $koneksi->query("SELECT * FROM stok_obat LIMIT $halaman_awal, $batas");
                        $nomor         = $halaman_awal + 1;
                        foreach ($foto_tanaman as $item) :
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

                    </div>

                    <nav aria-label="Page navigation example">
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
                <!-- /.container-fluid -->

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
                                            <td>Harga Pembelian</td>
                                            <td align="center" width="2px;">:</td>
                                            <td id="harga_pembelian"></td>
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
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../template/admin/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include_once '../template/admin/script.php'; ?>

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
                    $('#harga_pembelian').html(format_rupiah(item.harga_pembelian));
                    $('#harga_jual').html(format_rupiah(item.harga_jual));
                    $('#jenis_obat').html(item.jenis_obat);
                    $('#jumlah_stok').html(item.jumlah_stok);
                    $('#dosis_obat').html(item.dosis_obat);
                    $('#keterangan').html(item.keterangan);
                    $('.gambar').empty();
                    $('.gambar').append('<img src="<?= base_url() ?>/assets/gambar-obat/' + item.gambar_obat + '" style="width: 70%; height: 70%; text-align: center; justify-content: center; border-radius: 25px;">');
                });
        });
    </script>

</body>

</html>