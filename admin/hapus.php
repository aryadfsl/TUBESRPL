<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../vilago/login.php");
    exit;
}

include '../DB/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Cek apakah vila ada
    $cek = mysqli_query($koneksi, "SELECT * FROM vila WHERE id = $id");
    if (mysqli_num_rows($cek) > 0) {
        $vila = mysqli_fetch_assoc($cek);

        // Hapus file gambar dari folder jika ada
        $gambarPath = "../img/" . $vila['gambar'];
        if (file_exists($gambarPath)) {
            unlink($gambarPath);
        }

        // Hapus data dari database
        $hapus = mysqli_query($koneksi, "DELETE FROM vila WHERE id = $id");

        if ($hapus) {
            echo "<script>alert('Vila berhasil dihapus.'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Gagal menghapus vila.'); window.location='dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('Data vila tidak ditemukan.'); window.location='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid.'); window.location='dashboard.php';</script>";
}
?>
