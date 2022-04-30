<?php
require_once '../../config/config.php';
include_once '../../config/auth-cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once '../../template/admin/head.php'; ?>

<style>
    table thead tr th {
        vertical-align: middle !important;
    }
</style>

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
                        echo "<script>toastr.success('$_SESSION[alert]')</script>";
                        unset($_SESSION['alert']);
                    }
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">Data Penjualan Obat</h1>
                        <a href="tambah" class="btn bg-gradient-primary btn-icon-split">
                            <span class="icon text-white">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text text-white">Tambah Data</span>
                        </a>
                    </div>

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-light text-center">
                                                <tr>
                                                    <th>No. Nota</th>
                                                    <th>Tanggal Transaksi</th>
                                                    <th>Kode Pelanggan</th>
                                                    <th>Nama Pelanggan</th>
                                                    <th>No. Hp</th>
                                                    <th>Alamat</th>
                                                    <th>Total Bayar</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data = $koneksi->query("SELECT * FROM transaksi_penjualan ORDER BY no_nota DESC");
                                                foreach ($data as $row) {
                                                ?>
                                                    <tr align="center">
                                                        <td><?= $row['no_nota']; ?></td>
                                                        <td><?= tgl_indo($row['tanggal_transaksi']); ?></td>
                                                        <td><?= $row['kode_pelanggan']; ?></td>
                                                        <td align="left"><?= $row['nama_pelanggan']; ?></td>
                                                        <td><?= $row['no_hp']; ?></td>
                                                        <td align="left"><?= $row['alamat']; ?></td>
                                                        <td align="right"><?= number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                                                        <td>
                                                            <a href="detail/index?id=<?= $row['no_nota'] ?>" class="btn bg-gradient-info btn-sm btn-icon-split">
                                                                <span class="icon text-white">
                                                                    <i class="fas fa-info-circle"></i>
                                                                </span>
                                                                <span class="text text-white">Detail</span>
                                                            </a>
                                                            <!-- <a href="edit?id=<?= $row['no_nota'] ?>" class="btn bg-gradient-success btn-sm btn-icon-split">
                                                                <span class="icon text-white">
                                                                    <i class="fas fa-edit"></i>
                                                                </span>
                                                                <span class="text text-white">Edit</span>
                                                            </a> -->
                                                            <button type="button" class="btn bg-gradient-danger btn-sm btn-icon-split delete" data-link="proses?id=<?= $row['no_nota'] ?>" data-name="<?= $row['no_nota'] ?>">
                                                                <span class="icon text-white">
                                                                    <i class="fas fa-trash"></i>
                                                                </span>
                                                                <span class="text text-white">Hapus</span>
                                                            </button>
                                                        </td>
                                                    <?php } ?>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

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