<?php
include 'koneksi.php';

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$telp = $_POST['telp'];
$password = $_POST['password']; // Ambil password dari input form
$foto = 'default.jpg'; // Atau nilai default lainnya jika tidak ada file yang diupload

$query = "INSERT INTO masyarakat (nik, nama, username, telp, password, foto) VALUES ('$nik', '$nama', '$username', '$telp', '$password', '$foto')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Pendaftaran berhasil!'); window.location.assign('index.php'); </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
