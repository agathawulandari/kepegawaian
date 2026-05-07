<?php
ob_start();
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "
        SELECT * FROM users 
        WHERE username = '$username'
        LIMIT 1
    ");

    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        // cek password md5
        if (md5($password) == $user['password']) {

            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php?page=dashboard");
            exit;
        } else {

            $error = "Username/password salah!";
        }
    } else {

        $error = "Username/password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Sistem</title>

    <!-- Font -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- SB Admin -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">

                    <div class="card-body p-0">

                        <div class="row">

                            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center mt-3 mt-lg-0">
                                <img
                                    src="Logo imipas.png"
                                    alt="Logo"
                                    class="img-fluid"
                                    style="max-width: 220px; width: 100%; height: auto;">
                            </div>

                            <div class="col-lg-6">

                                <div class="p-5">

                                    <div class="text-center mb-4">
                                        <h1>Sistem Kepegawaian</h1>
                                    </div>

                                    <?php if (isset($error)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $error ?>
                                        </div>
                                    <?php endif; ?>

                                    <form method="POST" class="user">

                                        <div class="form-group">
                                            <input
                                                type="text"
                                                name="username"
                                                class="form-control form-control-user"
                                                placeholder="Masukkan Username"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <input
                                                type="password"
                                                name="password"
                                                class="form-control form-control-user"
                                                placeholder="Masukkan Password"
                                                required>
                                        </div>

                                        <button
                                            type="submit"
                                            name="login"
                                            class="btn btn-primary btn-user btn-block">

                                            <i class="fas fa-sign-in-alt"></i>
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>