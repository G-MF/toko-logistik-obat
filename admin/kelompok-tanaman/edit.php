<?php require_once '../../config/config.php';
include_once '../../config/auth-cek.php'; ?>

<?php
$id   = $_GET['id'];
$data = $koneksi->query("SELECT * FROM kelompok_tanaman WHERE id_kelompok = '$id'")->fetch_array();
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
                        <h1 class="h3 mb-0 text-gray-900">Edit Data Kelompok Tanaman</h1>
                        <a href="../kelompok-tanaman" class="btn bg-gradient-secondary btn-icon-split">
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

                                        <input type="hidden" name="id_kelompok" value="<?= $data['id_kelompok'] ?>">

                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-3 col-form-label">Nama Kelompok Tanaman</label>
                                            <div class="col-sm-9">
                                                <input autocomplete="off" type="text" class="form-control" name="nama" id="nama" required value="<?= $data['nama'] ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" name="edit" class="btn bg-gradient-primary btn-md btn-icon-split" style="float: right;">
                                            <span class="icon text-white">
                                                <i class="fas fa-save"></i>
                                            </span>
                                            <span class="text text-white">Simpan</span>
                                        </button>
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