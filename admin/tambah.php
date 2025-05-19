<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

include '../DB/koneksi.php';

if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    // Handle upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];
    $folder = "../img/";

    if ($gambar) {
        $upload_path = $folder . basename($gambar);
        if (move_uploaded_file($tmp_name, $upload_path)) {
          
            $sql = "INSERT INTO vila (nama, lokasi, harga, gambar) VALUES ('$nama', '$lokasi', '$harga', '$gambar')";
            if (mysqli_query($koneksi, $sql)) {
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Gagal menambahkan vila: " . mysqli_error($koneksi);
            }
        } else {
            $error = "Gagal upload gambar.";
        }
    } else {
        $error = "Mohon pilih gambar vila.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Vila - Admin JelajahVilla.com</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4">Tambah Vila Baru</h2>

    <?php if (isset($error)) : ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>Nama Vila</label>
        <input type="text" name="nama" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Lokasi</label>
        <input type="text" name="lokasi" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Harga per malam (Rp)</label>
        <input type="number" name="harga" class="form-control" required min="0" />
      </div>
      <div class="form-group">
        <label>Gambar Vila</label>
        <input type="file" name="gambar" class="form-control-file" accept="image/*" required />
      </div>
      <button type="submit" name="submit" class="btn btn-success">Tambah Vila</button>
      <a href="dashboard.php" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</body>
</html>
