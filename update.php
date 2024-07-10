<?php

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $telp = $_POST['telp'];
    
    // Query update data masyarakat
    $sql = "UPDATE masyarakat SET nama='$nama', telp='$telp' WHERE nik='$nik'";

    if (mysqli_query($koneksi, $sql)) {
        // Update $_SESSION['nama'] setelah berhasil diupdate di database
        $_SESSION['nama'] = $nama;

        // Redirect ke halaman profil dengan pesan sukses
        mysqli_close($koneksi);
        header("Location: masyarakat.php?url=profil");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}

// Menutup koneksi
mysqli_close($koneksi);
?>
