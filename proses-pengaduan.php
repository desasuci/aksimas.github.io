<?php
session_start();
include 'koneksi.php';

$tgl_pengaduan = $_POST['tgl_pengaduan'];
$nik           = $_SESSION['nik'];
$isi_laporan   = $_POST['isi_laporan'];
$lokasi_foto   = $_FILES['foto']['tmp_name'];
$nama_foto     = $_FILES['foto']['name'];
$status        = 0;

// Simpan data pengaduan ke database tanpa nama file
$sql = "INSERT INTO pengaduan(tgl_pengaduan,nik,isi_laporan,foto,status) VALUES('$tgl_pengaduan','$nik','$isi_laporan','','$status')";
if (mysqli_query($koneksi, $sql)) {
    // Ambil ID pengaduan yang baru saja dimasukkan
    $id_pengaduan = mysqli_insert_id($koneksi);

    // Buat nama file baru berdasarkan ID pengaduan
        $nama_foto_baru = 'd' . $id_pengaduan . '.jpg';

    // Pindahkan file yang diunggah ke folder tujuan dengan nama baru
    if (move_uploaded_file($lokasi_foto, 'img/doc/' . $nama_foto_baru)) {
        // Perbarui nama file di database
        $sql_update = "UPDATE pengaduan SET foto='$nama_foto_baru' WHERE id_pengaduan='$id_pengaduan'";
        mysqli_query($koneksi, $sql_update);

        echo "<script>alert('Pengaduan Sudah Tersimpan'); window.location.assign('masyarakat.php?url=lihat-pengaduan');</script>";
    } else {
        echo "<script>alert('Upload foto gagal'); window.location.assign('masyarakat.php?url=tulis-pengaduan');</script>";
    }
} else {
    echo "<script>alert('Pengaduan Gagal Tersimpan'); window.location.assign('masyarakat.php?url=tulis-pengaduan');</script>";
}
?>
