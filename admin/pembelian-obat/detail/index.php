<?php
require_once '../../../config/config.php';
include_once '../../../config/auth-cek.php';

$no_pembelian_obat = $_GET['id'];
$data    = $koneksi->query("SELECT * FROM pembelian_obat WHERE no_pembelian_obat = '$no_pembelian_obat'")->fetch_array();
$detail  = $koneksi->query("SELECT * FROM detail_pembelian_obat WHERE no_pembelian_obat = '$no_pembelian_obat'");
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '../../../template/admin/head.php'; ?>

<style>
    table thead tr th {
        vertical-align: middle !important;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include '../../../template/admin/sidebar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../../../template/admin/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php
                    if (isset($_SESSION['alert']) && isset($_SESSION['tipe'])) {
                        echo "<script>toastr." . $_SESSION['tipe'] . "('$_SESSION[alert]')</script>";
                        unset($_SESSION['alert']);
                        unset($_SESSION['tipe']);
                    }
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">Data Detail Pembelian Obat</h1>
                        <a href="../index" class="btn bg-gradient-secondary btn-icon-split">
                            <span class="icon text-white">
                                <i class="fas fa-arrow-alt-circle-left"></i>
                            </span>
                            <span class="text text-white">Kembali</span>
                        </a>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" width="100%">
                                            <tr>
                                                <th>No. Pembelian Obat</th>
                                                <td>:</td>
                                                <td><?= $data['no_pembelian_obat'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Pembelian</th>
                                                <td>:</td>
                                                <td><?= tgl_indo($data['tanggal_pembelian']) ?></td>
                                            </tr>
                                            <tr>
                                                <th>Kode Supplier</th>
                                                <td>:</td>
                                                <td><?= $data['kode_supplier'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama Supplier</th>
                                                <td>:</td>
                                                <td><?= $data['nama_supplier'] ?></td>
                                            </tr>
                                            <tr>
                                                <th>Total Pembelian</th>
                                                <td>:</td>
                                                <td><?= rupiah($data['total_pembelian']) ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4">
                                <div class="card-header">
                                    Tabel Data Item Obat
                                    <a href="../nota?id=<?= $data['no_pembelian_obat'] ?>" target="_blank" class="btn bg-gradient-secondary btn-icon-split float-right ml-2">
                                        <span class="icon text-white">
                                            <i class="fas fa-print"></i>
                                        </span>
                                        <span class="text text-white">Cetak Nota</span>
                                    </a>
                                    <button type="button" data-toggle="modal" data-target="#modal-tambah" class="btn bg-gradient-primary btn-icon-split float-right">
                                        <span class="icon text-white">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text text-white">Tambah Item Obat</span>
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-light text-center">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode Obat</th>
                                                    <th>Nama Obat</th>
                                                    <th>Harga Pembelian</th>
                                                    <th>Jumlah</th>
                                                    <th>Sub Total</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($detail as $row) {
                                                ?>
                                                    <tr align="center">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['kode_obat']; ?></td>
                                                        <td align="left"><?= $row['nama_obat']; ?></td>
                                                        <td align="right"><?= rupiah($row['harga_pembelian']); ?></td>
                                                        <td><?= $row['jumlah']; ?></td>
                                                        <td align="right"><?= rupiah($row['harga_pembelian'] * $row['jumlah']); ?></td>
                                                        <td>
                                                            <button type="button" class="btn bg-gradient-success btn-sm btn-icon-split edit" data-id="<?= $row['id_detail'] ?>">
                                                                <span class="icon text-white">
                                                                    <i class="fas fa-edit"></i>
                                                                </span>
                                                                <span class="text text-white">Edit</span>
                                                            </button>
                                                            <button type="button" class="btn bg-gradient-danger btn-sm btn-icon-split delete" data-link="proses?id=<?= $row['id_detail'] ?>" data-name="<?= $row['nama_obat'] ?>">
                                                                <span class="icon text-white">
                                                                    <i class="fas fa-trash"></i>
                                                                </span>
                                                                <span class="text text-white">Hapus</span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- /.container-fluid -->

                <?php include 'tambah.php'; ?>
                <?php include 'edit.php'; ?>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../../../template/admin/footer.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include_once '../../../template/admin/script.php'; ?>

    <script>
        // ambil data stok
        $("#kode_obat").change(function() {
            var kode = $(this).val();
            $.ajax({
                url: "ajax-data.php",
                type: "post",
                data: {
                    id: kode
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#nama_obat").val(data.nama_obat);
                    $("#harga_pembelian").val(data.harga_pembelian);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });


        // edit data
        $(".edit").click(function() {
            var id_detail = $(this).data('id');
            $.ajax({
                url: "ajax-edit.php",
                type: "post",
                data: {
                    id: id_detail
                },
                success: function(response) {
                    var data = JSON.parse(response);
                    $("#edit_id_detail").val(data.id_detail);
                    $("#edit_no_pembelian_obat").val(data.no_pembelian_obat);
                    $("#edit_kode_obat").val(data.kode_obat);
                    $("#edit_nama_obat").val(data.nama_obat);
                    $("#edit_harga_pembelian").val(data.harga_pembelian);
                    $("#edit_jumlah").val(data.jumlah);
                    $("#edit_sub_total").val(data.sub_total);
                    $("#modal-edit").modal("show");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        // perkalian jumlah dan harga jual
        $("#jumlah, #edit_jumlah").keyup(function() {
            var jumlah = $("#jumlah").val();
            var harga = $("#harga_pembelian").val().replaceAll('.', '');

            var jumlah1 = $("#edit_jumlah").val();
            var harga1 = $("#edit_harga_pembelian").val().replaceAll('.', '');

            if (jumlah && harga) {
                var total = parseInt(harga) * parseInt(jumlah);
                var result = formatRupiah(total);
                $("#sub_total").val(result);
            } else {
                $("#sub_total").val('');
            }

            if (jumlah1 && harga1) {
                var total = parseInt(harga1) * parseInt(jumlah1);
                var result = formatRupiah(total);
                $("#edit_sub_total").val(result);
            } else {
                $("#edit_sub_total").val('');
            }
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