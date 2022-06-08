<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

$query1 = $koneksi->query("SELECT max(no_pembelian_obat) AS kode FROM pembelian_obat");
$data   = $query1->fetch_array();
$kode     = $data['kode'];

$nourut = (int) substr($kode, 3, 3);
$nourut++;

$kodeotomatis = "PO" . sprintf('%03s', $nourut);

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
                        <h1 class="h3 mb-0 text-gray-900">Tambah Data Pembelian Obat</h1>
                        <a href="../pembelian-obat/" class="btn bg-gradient-secondary btn-icon-split">
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
                                                <input autocomplete="off" type="text" class="form-control" name="no_pembelian_obat" id="no_pembelian_obat" value="<?= $kodeotomatis; ?>" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tanggal_pembelian" class="col-sm-3 col-form-label">Tanggal Pembelian</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tanggal_pembelian" id="tanggal_pembelian" value="<?= date('Y-m-d') ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kode_supplier" class="col-sm-3 col-form-label">Supplier</label>
                                            <div class="col-sm-9">
                                                <select name="kode_supplier" id="kode_supplier" class="form-control select2" required data-placeholder="Pilih">
                                                    <option value=""></option>
                                                    <?php foreach ($supplier as $value) { ?>
                                                        <option value="<?= $value['kode_supplier'] ?>"><?= $value['kode_supplier'] . ' - ' . $value['nama_supplier'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_supplier" class="col-sm-3 col-form-label">Nama Supplier</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" required readonly>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row">
                                            <label for="kode_obat" class="col-sm-3 col-form-label">Obat</label>
                                            <div class="col-sm-9">
                                                <select name="kode_obat" id="kode_obat" class="form-control select2" required data-placeholder="Pilih">
                                                    <option value=""></option>
                                                    <?php foreach ($obat as $value) { ?>
                                                        <option value="<?= $value['kode_obat'] ?>"><?= $value['kode_obat'] . ' - ' . $value['nama_obat'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="nama_obat" class="col-sm-3 col-form-label">Nama Obat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama_obat" id="nama_obat" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="harga_pembelian" class="col-sm-3 col-form-label">Harga Pembelian</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rupiah" name="harga_pembelian" id="harga_pembelian" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="jumlah_obat" class="col-sm-3 col-form-label">Jumlah Obat</label>
                                            <div class="col-sm-9">
                                                <input type="number" class="form-control" name="jumlah_obat" id="jumlah_obat" required>
                                            </div>
                                        </div> -->

                                    </div>

                                    <div class="card-footer">
                                        <div style="text-align: center;">
                                            <button type="submit" name="tambah" class="btn bg-gradient-primary btn-md btn-icon-split">
                                                <span class="icon text-white">
                                                    <i class="fas fa-save"></i>
                                                </span>
                                                <span class="text text-white">Simpan</span>
                                            </button>
                                            <a href="../pembelian-obat/" class="btn bg-gradient-warning btn-icon-split">
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

        // $("#kode_obat").change(function() {
        //     var kode = $(this).val();
        //     $.ajax({
        //         url: "ajax-obat.php",
        //         type: "post",
        //         data: {
        //             id: kode
        //         },
        //         success: function(response) {
        //             var data = JSON.parse(response);
        //             $("#nama_obat").val(data.nama_obat);
        //             $("#harga_pembelian").val(formatRupiah(data.harga_pembelian));
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {
        //             console.log(textStatus, errorThrown);
        //         }
        //     });
        // });

        // /* Fungsi formatRupiah */
        // var formatRupiah = function(num) {
        //     var str = num.toString().replace("", ""),
        //         parts = false,
        //         output = [],
        //         i = 1,
        //         formatted = null;
        //     if (str.indexOf(".") > 0) {
        //         parts = str.split(".");
        //         str = parts[0];
        //     }
        //     str = str.split("").reverse();
        //     for (var j = 0, len = str.length; j < len; j++) {
        //         if (str[j] != ".") {
        //             output.push(str[j]);
        //             if (i % 3 == 0 && j < (len - 1)) {
        //                 output.push(".");
        //             }
        //             i++;
        //         }
        //     }
        //     formatted = output.reverse().join("");
        //     return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
        // };
    </script>

</body>

</html>