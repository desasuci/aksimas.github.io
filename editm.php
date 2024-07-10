<?php

// Koneksi ke database
include 'koneksi.php';

// Ambil nik dari sesi
if (!isset($_SESSION['nik'])) {
    echo "Anda belum login. Silakan login terlebih dahulu.";
    exit();
}

$nik = $_SESSION['nik'];

// Query untuk mengambil data petugas berdasarkan nik dari sesi
$sql = "SELECT * FROM masyarakat WHERE nik = '$nik'";
$result = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama = htmlspecialchars($row['nama']);
    $username = htmlspecialchars($row['username']);
    $telp = htmlspecialchars($row['telp']);
    
} else {
    echo "Data petugas tidak ditemukan.";
    exit();
}

// Menutup koneksi
mysqli_close($koneksi);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card small">
                <div class="card-header  text-center">
                <div class="d-flex justify-content-between align-items-center">
                <div class="col-3 p-0">
                    <div class="d-flex justify-content-start">
                        <a href="?url=profil"  class="btn-icon-split small">
   
   <span class="text p-0 ">Kembali</span>
                        
   </a>
                        </div>
                    </div>

                    <h4 class="m-0 font-weight-bold text-primary mx-auto h5">Edit Profil</h4>
                    <div class="col-3"></div> <!-- Placeholder untuk menjaga space -->
                </div>
                </div>
                <div class="card-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="nik" value="<?= $nik; ?>">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $username; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Petugas</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">Telepon</label>
                            <input type="text" class="form-control" id="telp" name="telp" value="<?= $telp; ?>" required>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
