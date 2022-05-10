<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';

if ($_GET['id']) {
    $no_perhitungan = $_GET['id'];
    $data = $koneksi->query("SELECT * FROM perhitungan_laba_rugi where no_perhitungan = '$no_perhitungan'")->fetch_array();
} else {
    echo '<meta http-equiv="refresh" content="0; url=../perhitungan-laba-rugi">';
}

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
                    if (isset($_SESSION['alert'])) {
                        echo "<script>toastr.error('$_SESSION[alert]')</script>";
                        unset($_SESSION['alert']);
                    }
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">Edit Data Pehitungan Laba Rugi</h1>
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
                                            <label for="no_perhitungan" class="col-sm-3 col-form-label">No. Perhitungan</label>
                                            <div class="col-sm-9">
                                                <input autocomplete="off" type="text" class="form-control" name="no_perhitungan" id="no_perhitungan" value="<?= $data['no_perhitungan']; ?>" required readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="tgl_perhitungan" class="col-sm-3 col-form-label">Tanggal Perhitungan</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="tgl_perhitungan" id="tgl_perhitungan" required value="<?= $data['tgl_perhitungan']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="keuntungan_penjualan" class="col-sm-3 col-form-label">Keuntungan Penjualan</label>
                                            <div class="col-sm">
                                                <select name="bulan" class="form-control" id="bulan_keuntungan_penjualan" required autofocus>
                                                    <option value="" disabled selected>-Pilih Bulan-</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <input type="text" class="form-control rupiah" name="keuntungan_penjualan" id="keuntungan_penjualan" required readonly value="<?= $data['keuntungan_penjualan'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="total_pembelian" class="col-sm-3 col-form-label">Total Pembelian</label>
                                            <div class="col-sm">
                                                <select name="bulan" class="form-control" id="bulan_total_pembelian" required autofocus>
                                                    <option value="" disabled selected>-Pilih Bulan-</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                            <div class="col-sm">
                                                <input type="text" class="form-control rupiah" name="total_pembelian" id="total_pembelian" required readonly value="<?= $data['total_pembelian'] ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="gajih_karyawan" class="col-sm-3 col-form-label">Gajih Karyawan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rupiah" name="gajih_karyawan" id="gajih_karyawan" required value="<?= $data['gajih_karyawan']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="biaya_listrik" class="col-sm-3 col-form-label">Biaya Listrik</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rupiah" name="biaya_listrik" id="biaya_listrik" required value="<?= $data['biaya_listrik']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="biaya_pdam" class="col-sm-3 col-form-label">Biaya PDAM</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rupiah" name="biaya_pdam" id="biaya_pdam" required value="<?= $data['biaya_pdam']; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="total_keuntungan_bersih" class="col-sm-3 col-form-label">Total Keuntungan Bersih</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control rupiah" name="total_keuntungan_bersih" id="total_keuntungan_bersih" required readonly value="<?= $data['total_keuntungan_bersih']; ?>">
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
        $("#gajih_karyawan, biaya_listrik, #biaya_pdam").keyup(function() {
            var keuntungan_penjualan = $("#keuntungan_penjualan").val().replaceAll('.', '');
            var total_pembelian = $("#total_pembelian").val().replaceAll('.', '');
            var gajih_karyawan = $("#gajih_karyawan").val().replaceAll('.', '');
            var biaya_listrik = $("#biaya_listrik").val().replaceAll('.', '');
            var biaya_pdam = $("#biaya_pdam").val().replaceAll('.', '');

            if (keuntungan_penjualan && total_pembelian && gajih_karyawan && biaya_listrik && biaya_pdam) {
                var total = parseInt(keuntungan_penjualan) - (parseInt(total_pembelian) + parseInt(gajih_karyawan) + parseInt(biaya_listrik) + parseInt(biaya_pdam));
                var result = formatRupiah(total);
                $("#total_keuntungan_bersih").val(result);
            } else {
                $("#total_keuntungan_bersih").val(0);
            }


        });

        // BERI FORMAT RUPIAH DI TEXT FIELD
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