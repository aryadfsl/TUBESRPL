<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

include '../DB/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM vila");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - JelajahVilla.com</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="index.php" class="navbar-brand" href="#">JelajahVilla.com - Dashboard Admin</a>
      <div>
        <a href="../logout.php" class="btn btn-danger">Logout</a>
      </div>
    </div>
  </nav>

  <div class="container my-5">
    <h2 class="text-center mb-4">Daftar Vila</h2>
    <div class="text-center mb-4">
      <a href="tambah.php" class="btn btn-danger">+ Tambah Vila</a>
    </div>

    <div class="row">
      <?php while ($vila = mysqli_fetch_assoc($query)) : ?>
        <div class="col-md-4">
          <div class="card mb-4">
            <img src="../img/<?= htmlspecialchars($vila['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($vila['nama']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($vila['nama']) ?></h5>
              <p class="card-text">Lokasi: <?= htmlspecialchars($vila['lokasi']) ?></p>
              <p class="card-text"><strong>Rp <?= number_format($vila['harga'], 0, ',', '.') ?> / malam</strong></p>
              <a href="edit.php?id=<?= $vila['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="hapus.php?id=<?= $vila['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus vila ini?')">Hapus</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
