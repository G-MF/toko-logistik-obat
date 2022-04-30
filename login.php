<?php
require_once 'config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Toko Logistik Obat</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/img/drugstore-icon.png">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/sweetalert2/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/toastr/toastr.min.css">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-10">

                <div class="card o-hidden border-0 shadow-lg" style="margin-top: 20%; margin-bottom: 20%;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                                    </div>
                                    <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Username" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Password" name="password" required>
                                        </div>

                                        <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>


    <!-- SweetAlert2 -->
    <script src="<?= base_url() ?>/assets/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url() ?>/assets/toastr/toastr.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>/assets/js/sb-admin-2.min.js"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
        });
    </script>

</body>

</html>

<?php
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $pass     = md5($password);

    $query = $koneksi->query("SELECT * FROM admin WHERE username = '$username'");

    // CEK USERNAME
    if (mysqli_num_rows($query) === 1) {

        // CEK PASSWORD
        $data = mysqli_fetch_array($query);
        if ($pass == $data['password']) {

            $id_admin             = $data['id_admin'];
            $username             = $data['username'];
            $level                = $data['level'];
            $_SESSION['id_admin'] = $id_admin;
            $_SESSION['username'] = $username;
            $_SESSION['level']    = $level;

            if ($level == 'admin') {
                echo '<meta http-equiv="refresh" content="0; url=admin">';
            }
        } else {
            echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'error',
                title: 'Username atau Password Tidak Ditemukan',
            })
            </script>";
        }
    } else {
        echo "
            <script type='text/javascript'>
            Toast.fire({
                type: 'error',
                title: 'Username atau Password Tidak Ditemukan'
            }) 
            </script>";
    }
}
?>