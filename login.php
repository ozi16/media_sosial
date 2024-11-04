<!-- <?php
        // session_start();
        // include 'koneksi.php';

        // // untuk mengatur login sebelum masuk kedalam dashboard
        // if (isset($_POST['login'])) {
        //     $email = $_POST['email']; // untuk mengambil nilai dari input
        //     $password = $_POST['password'];

        //     $queryLogin = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email'");
        //     // mysqli_num_row() : untuk melihat total data didalam table
        //     if (mysqli_num_rows($queryLogin) > 0) {
        //         $rowLogin = mysqli_fetch_assoc($queryLogin);
        //         if ($password == $rowLogin['password']) {
        //             $_SESSION['id'] = $rowLogin['id'];
        //             $_SESSION['nama'] = $rowLogin['nama_lengkap'];
        //             header("location:index.php");
        //         } else {
        //             header("location:login.php?login=gagal");
        //         }
        //     } else {
        //         header("location:login.php?login=gagal");
        //     }
        // }

        ?> -->



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>

    <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 mx-auto mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>Selamat Datang di Perpus App</h5>
                                <p>Silahkan Login Dengan Akun Anda</p>
                            </div>
                            <?php if (isset($_GET['registrasi'])): ?>
                                <div class="alert alert-success">Registrasi pengguna berhasil</div>
                            <?php endif; ?>
                            <form action="actionLogin.php" method="post">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Email : </label>
                                    <input type="email" name="email" placeholder="Masukkan Email Anda" class="form-control">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Password : </label>
                                    <input type="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" class="form-control">
                                </div>
                                <div class="form-group mb-3 d-grid">
                                    <button name="login" type="submit" class="btn btn-primary">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-3 ">
                        <div class="card-body">
                            <p>Sudah punya akun ? <a href="register.php" class="text-secondary">Buat Akun</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>