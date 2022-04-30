<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$query1 = $koneksi->query("SELECT max(kode_obat) AS kode FROM stok_obat");
$data   = $query1->fetch_array();
$kode     = $data['kode'];

$nourut = (int) substr($kode, 3, 3);
$nourut++;

$kodeotomatis = "Ob" . sprintf('%03s', $nourut);

?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '../../template/admin/head.php'; ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../../template/admin/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../../template/admin/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php
                    if (isset($_SESSION['alert_input'])) {
                        echo "<script>toastr.error('$_SESSION[alert_input]')</script>";
                        unset($_SESSION['alert_input']);
                    }
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">Tambah Data Stok Obat</h1>
                        <a href="javascript:history.back();" class="btn bg-gradient-secondary btn-icon-split">
                            <span class="icon text-white">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text text-white">Kembali</span>
                        </a>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            <form action="proses" method="POST" enctype="multipart/form-data">
                                <div class="card shadow mb-4">
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="kode_obat" class="col-sm-3 col-form-label">Kode Obat</label>
                                            <div class="col-sm-9">
                                                <input autocomplete="off" type="text" class="form-control" name="kode_obat" id="kode_obat" value="<?= $kodeotomatis; ?>" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_obat" class="col-sm-3 col-form-label">Nama Obat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_obat" id="nama_obat" required autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="harga_pembelian" class="col-sm-3 col-form-label">Harga Pembelian</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rupiah" name="harga_pembelian" id="harga_pembelian" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="harga_jual" class="col-sm-3 col-form-label">Harga Jual</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rupiah" name="harga_jual" id="harga_jual" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jenis_obat" class="col-sm-3 col-form-label">Jenis Obat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="jenis_obat" id="jenis_obat" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gambar_obat" class="col-sm-3 col-form-label">Gambar Obat</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="form-control" name="gambar_obat" id="gambar_obat" required>
                                                <span style="font-style: italic; color: red; font-size: 10px;">*(JPG, JPEG, PNG)</span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jumlah_stok" class="col-sm-3 col-form-label">Jumlah Stok</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" name="jumlah_stok" id="jumlah_stok" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="dosis_obat" class="col-sm-3 col-form-label">Dosis Obat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="dosis_obat" id="dosis_obat" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="ket_obat" class="col-sm-3 col-form-label">Keterangan</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" name="ket_obat" id="ket_obat" rows="3" required></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <div style="text-align: center;">
                                            <button type="submit" name="tambah" class="btn bg-gradient-primary btn-md btn-icon-split">
                                                <span class="icon text-white">
                                                    <i class="fas fa-save"></i>
                                                </span>
                                                <span class="text text-white">Simpan</span>
                                            </button>
                                            <a href="javascript:history.back();" class="btn bg-gradient-warning btn-icon-split">
                                                <span class="icon text-white">
                                                    <i class="fas fa-times"></i>
                                                </span>
                                                <span class="text text-white">Batal</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../../template/admin/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include_once '../../template/admin/script.php'; ?>

</body>

</html>