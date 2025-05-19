<?php
include '../DB/koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM vila ORDER BY id DESC");
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JelajahVilla - Booking</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand text-danger font-weight-bold" href="#">
      <img src="../img/logo.png" alt="JelajahVilla" width="30" class="d-inline-block align-top">
      JelajahVilla
    </a>
    <div class="ml-auto d-flex">
      <a href="login.php" class="btn btn-outline-danger mr-2">Daftarkan Vila Anda</a>
      <a href="#cari-vila" class="btn btn-dark">Cari Vila</a>
    </div>
  </div>
</nav>

<!-- Hero section -->
<section class="hero">
  <div class="container hero-content text-white">
    <div class="row">
      <div class="col-md-6">
        <h1 class="font-weight-bold">Sewa Vila,<br>atau Cobain Nginep Seru di <span class="highlight">JelajahVilla</span></h1>
      </div>
      <div class="col-md-5 offset-md-1" id="cari-vila">
        <div class="search-box">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Mau nginep di mana?">
          </div>
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Cari Harga yuk!!">
            </div>
            <div class="col">
              <input type="number" class="form-control" placeholder="1 orang" min="1">
            </div>
          </div>
          <button class="btn btn-primary btn-block mt-3">Ayo Cari</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Kategori -->
<section class="bg-light py-4">
  <div class="container d-flex justify-content-around flex-wrap">

    <a href="kategori.php?k=alam" class="text-center text-decoration-none text-dark">
      <div class="category-icon">
        <img src="../img/alam.png" alt="Rekomendasi">
        <p class="nav-item"><a class="nav-link" href="#kontak">Rekomendasi</a></p>
      </div>
    </a>

    <a href="kategori.php?k=top-picks" class="text-center text-decoration-none text-dark">
      <div class="category-icon">
        <img src="../img/api.png" alt="Promo">
          <p class="nav-item"><a class="nav-link" href="#kontak">Promo</a></p>
      </div>
    </a>

    <a href="kategori.php?k=ramean" class="text-center text-decoration-none text-dark">
      <div class="category-icon">
        <img src="../img/nginep.png" alt="Pantai">
        <p class="nav-item"><a class="nav-link" href="#kontak">Pantai</a></p>
      </div>
    </a>

    <a href="kategori.php?k=kolam" class="text-center text-decoration-none text-dark">
      <div class="category-icon">
        <img src="../img/kolam.png" alt="Pegunungan">
        <p class="nav-item"><a class="nav-link" href="#kontak">Pegunungan</a></p>
      </div>
    </a>

    <a href="kategori.php?k=view" class="text-center text-decoration-none text-dark">
      <div class="category-icon">
        <img src="../img/view.png" alt="Tengah Kota">
        <p class="nav-item"><a class="nav-link" href="#kontak">Tengah Kota</a></p>
      </div>
    </a>

  </div>
</section>

<!-- Daftar Vila Section -->
<section class="container py-5">
  <h3 class="mb-4">Rekomendasi Vila Untukmu</h3>
  <!-- Tempatkan logic PHP untuk daftar vila dari database di sini -->
  <!-- Contoh: -->
  <!--
  <?php
  include '../DB/koneksi.php';
  $result = mysqli_query($koneksi, "SELECT * FROM vila");
  while($vila = mysqli_fetch_assoc($result)) :
  ?>
    <div class="card mb-3">
      <img src="../img/<?= $vila['gambar'] ?>" class="card-img-top" alt="<?= $vila['nama'] ?>">
      <div class="card-body">
        <h5 class="card-title"><?= $vila['nama'] ?></h5>
        <p class="card-text"><?= $vila['lokasi'] ?></p>
        <a href="detail.php?id=<?= $vila['id'] ?>" class="btn btn-primary">Lihat Detail</a>
      </div>
    </div>
  <?php endwhile; ?>
  -->
</section>

  <!-- Daftar Vila -->
  <section class="container my-5">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($query)) : ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="../img/<?= htmlspecialchars($row['gambar']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['nama']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['nama']) ?></h5>
              <p class="card-text">Lokasi: <?= htmlspecialchars($row['lokasi']) ?></p>
              <a href="detail.php?id=<?= $row['id'] ?>" class="btn btn-primary">Lihat Detail</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

  </section>
  <section class="container my-5 text-center">
    <h3 class="mb-3 font-weight-bold">Yuk, Sewakan Akomodasi & Penginapanmu di JelajahVilla</h3>
    <p class="lead">
      Lebarkan potensi dan peluang dengan menjadi partner <strong>JelajahVilla</strong>! Daftarkan properti kamu dan dapatkan pemasaran luas serta pertumbuhan bisnis penginapan yang maksimal.
      Akomodasi kamu akan menjangkau pencari dari seluruh dunia. Selain itu, kamu bisa menganalisis statistik properti secara berkala dan mengatur allotment untuk memaksimalkan pendapatan.
      Tunggu apalagi? Yuk, sewakan penginapanmu sekarang juga dan jadilah bagian dari jaringan partner kami! <a href="login.php" class="btn">Daftarkan Sekarang</a>
    </p>
  </section>
  <section id="kontak" class="py-5 bg-light">
    <div class="container">
      <h2 class="text-center mb-4">Hubungi Kami</h2>
      <form class="w-75 mx-auto">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" placeholder="Nama kamu...">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Alamat Email</label>
          <input type="email" class="form-control" id="email" placeholder="nama@email.com">
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label">Pesan / Pertanyaan</label>
          <textarea class="form-control" id="pesan" rows="4" placeholder="Tulis pesan kamu di sini..."></textarea>
        </div>
        <button type="submit" class="btn btn-dark">Kirim</button>
      </form>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-4">
    &copy; 2025 JelajahVilla
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
