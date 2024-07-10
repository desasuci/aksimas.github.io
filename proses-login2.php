<?php
$username = $_POST['username'];
$password = $_POST['password'];

include 'koneksi.php';

// Prepared statement untuk mengamankan query SQL
$sql = "SELECT * FROM petugas WHERE username = ? AND password = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    session_start();
    $data = mysqli_fetch_array($result);
    
    // Set session variables
    $_SESSION['id_petugas'] = $data['id_petugas'];
    $_SESSION['nama_petugas'] = $data['nama_petugas'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['level'] = $data['level'];

    // Redirect sesuai dengan level pengguna
    if ($data['level'] == "admin") {
        header("Location: admin/admin.php");
    } elseif ($data['level'] == "petugas") {
        header("Location: petugas/petugas.php");
    }
    exit(); // Pastikan untuk keluar dari skrip setelah melakukan redirect
} else {
    echo "<script>alert('Maaf Anda Gagal Login'); window.location.assign('index2.php');</script>";
}
?>
