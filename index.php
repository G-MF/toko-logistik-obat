<?php
require_once 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once 'template/public/head.php'; ?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include_once 'template/public/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-cover">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                            <h1 class="m-0 text-dark">Beranda</h1>
                        </div>
                    </div>
                    <?php include_once 'template/public/menu.php'; ?>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card card-olive">
                                <div class="card-header">
                                    <h5 class="card-title m-0 font-weight-bold">Selamat Datang</h5>
                                </div>
                                <div class="card-body" style="background-color: #B3F0C1;">
                                    <p class="card-text">
                                        Sistem Informasi Pembuatan Obat Tradisional ini merupakan sistem informasi yang menyediakan berbagai macam tanaman-tanaman obat dan bagaimana cara mengolah tanaman tersebut menjadi obat-obatan tradisional.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card card-olive">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Mengapa menggunakan obat tradisional?</h5>
                                </div>
                                <div class="card-body" style="background-color: #B3F0C1;">
                                    <p class="card-text">
                                        Obat-obatan tradisional tidak Memiliki efek samping dibandingkan dengan obat-obatan kimiawi banyak efek sampingnya.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card card-olive">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Contoh resep obat tradisional</h5>
                                </div>
                                <div class="card-body" style="background-color: #B3F0C1;">
                                    <ul>
                                        <li>Mengolah ramuan daun jambu biji untuk mengatasi diare</li>
                                        <li>Pembersih ginjal alami dengan seledri</li>
                                        <li>Daun jambu biji sebagai obat penyakit jantung</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <?php include_once 'template/public/footer.php'; ?>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php include_once 'template/public/script.php'; ?>
</body>

</html>