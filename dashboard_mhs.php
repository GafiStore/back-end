<?php
session_start();
include "config.php"; 

if ($_SESSION['status'] != "login") {
    header("location:index.php?pesan=belum_login");
    exit(); 
}

if (isset($_POST['logout'])) {
    session_destroy(); 
    header("Location: index.php"); 
    exit();
}

$username = $_SESSION['username'];
$query = "SELECT fullname, id, nilai FROM users WHERE username='$username'";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);
$fullname = $user['fullname'] ?? '';
$firstName = strtok($fullname, " ");
$userId = $user['id'] ?? '';
$nilai = $user['nilai'] ?? 0; // Default nilai to 0 if not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }
        .dashboard-header {
            background-color: #007bff;
            color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .welcome-message {
            font-size: 1.5rem;
        }
        footer {
            font-size: 0.9rem;
            color: #6c757d;
        }
        .btn-danger {
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        <div class="dashboard-header text-center">
            <h2>Selamat Datang!</h2>
            <p class="welcome-message">Hallo <?= htmlspecialchars($firstName) ?>, kamu sudah berhasil login.</p>
            <form method="POST" class="mt-3">
                <button type="submit" name="logout" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <div class="mt-4">
            <h4 class="mb-3">Data Pengguna</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>USER ID</th>
                        <th>USERNAME</th>
                        <th>NAMA LENGKAP</th>
                        <th>NILAI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= htmlspecialchars($userId) ?></td>
                        <td><?= htmlspecialchars($username) ?></td>
                        <td><?= htmlspecialchars($fullname) ?></td>
                        <td><?= htmlspecialchars($nilai) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <footer class="text-center mt-4">
            <p>&copy; <?= date('Y') ?> Dashboard 23.01.4969</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>