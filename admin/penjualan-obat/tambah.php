<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$query1 = $koneksi->query("SELECT max(no_nota) AS kode FROM transaksi_penjualan");
$data   = $query1->fetch_array();
$kode     = $data['kode'];

$nourut = (int) substr($kode, 18, 3);
$nourut++;

$kodeotomatis = "N-" . date('Ymd') . '-' . date('His') . '-' . sprintf('%03s', $nourut);

// data pelanggan
$pelanggan = $koneksi->query("SELECT kode_pelanggan, nama_pelanggan FROM pelanggan");
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
                        <h1 class="h3 mb-0 text-gray-900">Tambah Data Penjualan Obat</h1>
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
                                            <label for="no_nota" class="col-sm-3 col-form-label">No. Nota</label>
                                            <div class="col-sm-9">
                                                <input autocomplete="off" type="text" class="form-control" name="no_nota" id="no_nota" value="<?= $kodeotomatis; ?>" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tanggal_transaksi" class="col-sm-3 col-form-label">Tanggal Transaksi</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tanggal_transaksi" id="tanggal_transaksi" value="<?= date('Y-m-d') ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kode_pelanggan" class="col-sm-3 col-form-label">Pelanggan</label>
                                            <div class="col-sm-9">
                                                <select name="kode_pelanggan" id="kode_pelanggan" class="form-control select2" required data-placeholder="Pilih">
                                                    <option value=""></option>
                                                    <?php foreach ($pelanggan as $value) { ?>
                                                        <option value="<?= $value['kode_pelanggan'] ?>"><?= $value['kode_pelanggan'] . ' - ' . $value['nama_pelanggan'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="no_hp" class="col-sm-3 col-form-label">No. Hp</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_hp" id="no_hp" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="alamat" id="alamat" required readonly>
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

    <script>
        $("#kode_pelanggan").change(function() {
            var kode = $(this).val();
            $.ajax({
                url: "ajax-pelanggan.php",
                type: "post",
                data: {
                    id: kode
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#nama_pelanggan").val(data.nama_pelanggan);
                    $("#no_hp").val(data.no_hp);
                    $("#alamat").val(data.alamat);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    </script>

</body>

</html>