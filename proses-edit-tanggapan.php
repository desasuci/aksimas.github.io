<?php
session_start();
include 'koneksi.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['nik'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location = 'login.php';</script>";
    exit();
}

// Ambil data dari formulir
$id_pengaduan = $_POST['id_pengaduan'];
$isi_laporan = $_POST['isi_laporan'];

// Update data pengaduan di database
$sql = "UPDATE pengaduan SET isi_laporan='$isi_laporan' WHERE id_pengaduan='$id_pengaduan' AND nik='".$_SESSION['nik']."'";
$query = mysqli_query($koneksi, $sql);

if ($query) {
    echo "<script>alert('Pengaduan berhasil diperbarui.'); window.location = 'masyarakat.php?url=lihat-pengaduan';</script>";
} else {
    echo "<script>alert('Pengaduan gagal diperbarui.'); window.location = 'masyarakat.php?url=edit-tanggapan&id=$id_pengaduan';</script>";
}
?>
