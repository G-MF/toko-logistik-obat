<?php require_once '../../config/config.php';
include_once '../../config/auth-cek.php'; ?>

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
                        echo "<script>toastr.success('$_SESSION[alert]')</script>";
                        unset($_SESSION['alert']);
                    }
                    ?>

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">Data Stok Obat</h1>
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
                                                    <th>No</th>
                                                    <th>Kode Obat</th>
                                                    <th>Nama Obat</th>
                                                    <th>Harga Pembelian</th>
                                                    <th>Harga Jual</th>
                                                    <th>Jenis Obat</th>
                                                    <th>Gambar</th>
                                                    <th>Jumlah Stok</th>
                                                    <th>Dosis</th>
                                                    <th>Keterangan</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $data = $koneksi->query("SELECT * FROM stok_obat ORDER BY kode_obat DESC");
                                                foreach ($data as $row) {
                                                ?>
                                                    <tr align="center">
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row['kode_obat']; ?></td>
                                                        <td align="left"><?= $row['nama_obat']; ?></td>
                                                        <td align="right"><?= number_format($row['harga_pembelian'], 0, ',', '.'); ?></td>
                                                        <td align="right"><?= number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                                                        <td><?= $row['jenis_obat']; ?></td>
                                                        <td>
                                                            <a href="<?= base_url('assets/gambar-obat/' . $row['gambar_obat']) ?>" data-lightbox="roadtrip" data-title="<?= $row['gambar_obat'] ?>">
                                                                <img src="<?= base_url('assets/gambar-obat/' . $row['gambar_obat']) ?>" style="width: 70px; height: 70px;">
                                                            </a>
                                                        </td>
                                                        <td><?= $row['jumlah_stok']; ?></td>
                                                        <td><?= $row['dosis_obat']; ?></td>
                                                        <td><?= $row['ket_obat']; ?></td>
                                                        <td>
                                                            <a href="edit?id=<?= $row['kode_obat'] ?>" class="btn bg-gradient-success btn-sm btn-icon-split">
                                                                <span class="icon text-white">
                                                                    <i class="fas fa-edit"></i>
                                                                </span>
                                                                <span class="text text-white">Edit</span>
                                                            </a>
                                                            <button type="button" class="btn bg-gradient-danger btn-sm btn-icon-split delete" data-link="proses?id=<?= $row['kode_obat'] ?>" data-name="<?= $row['nama_obat'] ?>">
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