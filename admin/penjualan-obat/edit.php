<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

if ($_GET['id']) {
    $kode = $_GET['id'];
    $data = $koneksi->query("SELECT * FROM pembelian_obat where no_pembelian_obat = '$kode'")->fetch_array();
} else {
    header("location: ../stok", true, 301);
}
// data suppluer
$supplier = $koneksi->query("SELECT * FROM supplier");
$obat     = $koneksi->query("SELECT * FROM stok_obat");

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
                        <h1 class="h3 mb-0 text-gray-900">Edit Data Pembelian Obat</h1>
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
                                            <label for="no_pembelian_obat" class="col-sm-3 col-form-label">No. Pembelian Obat</label>
                                            <div class="col-sm-9">
                                                <input autocomplete="off" type="text" class="form-control" name="no_pembelian_obat" id="no_pembelian_obat" value="<?= $data['no_pembelian_obat']; ?>" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal Pembelian</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian" value="<?= $data['tanggal_pembelian']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kode_supplier" class="col-sm-3 col-form-label">Supplier</label>
                                            <div class="col-sm-9">
                                                <select name="kode_supplier" id="kode_supplier" class="form-control select2" required data-placeholder="Pilih">
                                                    <option value=""></option>
                                                    <?php foreach ($supplier as $value) { ?>
                                                        <option value="<?= $value['kode_supplier'] ?>" <?= $value['kode_supplier'] == $data['kode_supplier'] ? 'selected' : '' ?>><?= $value['kode_supplier'] . ' - ' . $value['nama_supplier'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_supplier" class="col-sm-3 col-form-label">Nama Supplier</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" required readonly value="<?= $data['nama_supplier']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kode_obat" class="col-sm-3 col-form-label">Obat</label>
                                            <div class="col-sm-9">
                                                <select name="kode_obat" id="kode_obat" class="form-control select2" required data-placeholder="Pilih">
                                                    <option value=""></option>
                                                    <?php foreach ($obat as $value) { ?>
                                                        <option value="<?= $value['kode_obat'] ?>" <?= $value['kode_obat'] == $data['kode_obat'] ? 'selected' : '' ?>><?= $value['kode_obat'] . ' - ' . $value['nama_obat'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_obat" class="col-sm-3 col-form-label">Nama Obat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_obat" id="nama_obat" required readonly value="<?= $data['nama_obat']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="harga_pembelian" class="col-sm-3 col-form-label">Harga Pembelian</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="harga_pembelian" id="harga_pembelian" required readonly value="<?= $data['harga_pembelian']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jumlah_obat" class="col-sm-3 col-form-label">Jumlah Obat</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" name="jumlah_obat" id="jumlah_obat" required value="<?= $data['jumlah_obat']; ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <div style="text-align: center;">
                                            <button type="submit" name="edit" class="btn bg-gradient-primary btn-md btn-icon-split">
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
        $("#kode_supplier").change(function() {
            var kode = $(this).val();
            $.ajax({
                url: "ajax-supplier.php",
                type: "post",
                data: {
                    id: kode
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#nama_supplier").val(data.nama_supplier);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $("#kode_obat").change(function() {
            var kode = $(this).val();
            $.ajax({
                url: "ajax-obat.php",
                type: "post",
                data: {
                    id: kode
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#nama_obat").val(data.nama_obat);
                    $("#harga_pembelian").val(format_rupiah(data.harga_pembelian));
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    </script>

</body>

</html>