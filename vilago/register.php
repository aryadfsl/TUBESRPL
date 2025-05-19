<?php
include '../DB/koneksi.php';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Validasi: password dan konfirmasi harus sama
    if ($password !== $konfirmasi) {
        $error = "Konfirmasi password tidak sesuai!";
    } else {
        // Cek apakah username sudah dipakai
        $cek = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Insert ke database
            $insert = mysqli_query($koneksi, "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')");
            if ($insert) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Registrasi gagal: " . mysqli_error($koneksi);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - JelajahVilla</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5" style="max-width: 400px;">
    <h2 class="mb-4">Daftar Akun JelajahVilla</h2>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required autofocus>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="konfirmasi" class="form-control" required>
        </div>
        <button type="submit" name="register" class="btn btn-primary btn-block">Daftar</button>
    </form>
    <p class="mt-3">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>
</body>
</html>
