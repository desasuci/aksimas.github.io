<?php
// Koneksi ke database
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];

    // Direktori penyimpanan foto
    $target_dir = "img/profil/";

    // Mendapatkan informasi file yang diunggah
    $imageFileType = strtolower(pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . "m" . $nik . ".jpg"; // Format file disetel menjadi .jpg

    $uploadOk = 1;

    // Periksa apakah file gambar adalah gambar asli atau gambar palsu
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "<script>alert('File bukan gambar.'); window.location.href = 'masyarakat.php?url=profil';</script>";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["foto"]["size"] > 500000) { // 500KB ukuran file maksimal
        echo "<script>alert('File Terlalu besar.'); window.location.href = 'masyarakat.php?url=profil';</script>";
        $uploadOk = 0;
    }

    // Perbolehkan hanya format file tertentu
    if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
        echo "<script>alert('Maaf, hanya format JPG, JPEG, PNG yang diperbolehkan.'); window.location.href = 'masyarakat.php?url=profil';</script>";
        $uploadOk = 0;
    }

    // Jika semuanya ok, coba upload file
    if ($uploadOk == 1) {
        // Hapus foto lama jika ada
        if (file_exists($target_file)) {
            unlink($target_file); // Hapus file lama
        }
        
        // Pindahkan file baru ke direktori target
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            $filename = basename($target_file);
            // Perbarui database dengan foto profil baru
            $sql = "UPDATE masyarakat SET foto='$filename' WHERE nik='$nik'";
            if (mysqli_query($koneksi, $sql)) {
                header("Location: masyarakat.php?url=profil");
                exit(); // Pastikan untuk keluar setelah redirect header
            } else {
                echo "<script>alert('Terjadi kesalahan saat memperbarui database.'); window.location.href = 'masyarakat.php?url=profil';</script>";
            }
        } else {
            echo "<script>alert('Maaf, terjadi kesalahan saat mengupload file Anda.'); window.location.href = 'masyarakat.php?url=profil';</script>";
        }
    } else {
        echo "<script>alert('Maaf, file Anda tidak terupload.'); window.location.href = 'masyarakat.php?url=profil';</script>";
    }
}

// Menutup koneksi
mysqli_close($koneksi);
?>
