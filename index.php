<?php
session_start();
include "config.php"; 

// Ambil input
$username = $_POST["username"] ?? ''; 
$password = $_POST["password"] ?? ''; 

// Debugging: Cek input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($username) || empty($password)) { 
        $_SESSION["error"] = "Tidak boleh ada yang kosong!"; 
        header("Location: index.php?app=gagal");
        exit();
    }

    // Cek apakah username dan password adalah "root"
    if ($username === 'root' && $password === 'root') {
        $_SESSION["username"] = $username; 
        $_SESSION["status"] = "login"; 
        header("Location: dashboard_root.php"); 
        exit(); 
    }

    // Query untuk mengecek user
    $query = "SELECT * FROM users WHERE username='$username'"; 
    $result = mysqli_query($connect, $query); 

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION["username"] = $username; 
            $_SESSION["status"] = "login"; 
            header("Location: dashboard.php"); 
            exit(); 
        } else {
            $_SESSION["error"] = "Username atau Password anda salah!"; 
            header("Location: index.php?app=akun tidak valid");
            exit();
        }
    } else {
        $_SESSION["error"] = "Username atau Password anda salah!"; 
        header("Location: index.php?app=akun tidak valid");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-image {
            background-image: url('img/Growtopia.jpg');
            background-size: cover;
            background-position: center;
            height: 100%;
        }
    </style>
</head>
<body>

<div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="row w-100 border rounded overflow-hidden" style="max-width: 800px; height: 500px;">
        <div class="col-md-6 d-none d-md-flex bg-image"></div>
        <div class="col-md-6 p-4 form-container">
            <h4 class="text-center d-flex align-items-center justify-content-center mt-4 mb-5">
                <img src="img/bgl.webp" alt="Logo" class="me-2" style="max-width: 30px;"> 
                Sign into your account
            </h4>
            <?php if (isset($_SESSION["error"])): ?>
                <div class="alert alert-danger text-center">
                    <?= $_SESSION["error"]; unset($_SESSION["error"]); ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-2">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required>
                </div>
                <div class="mb-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="#" class="text-decoration-none">Lupa Password?</a>
            </div>
            <div class="text-center mt-2">
                <p class="mb-0">Belum punya akun? <a href="register.php" class="text-primary">Daftar disini!</a></p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>