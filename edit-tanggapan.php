<?php

include 'koneksi.php';

// Pastikan pengguna sudah login dan parameter 'id' tersedia
if (!isset($_SESSION['nik']) || !isset($_GET['id'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.'); window.location = 'login.php';</script>";
    exit();
}

$id_pengaduan = $_GET['id'];

// Ambil data pengaduan berdasarkan id
$sql = "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan' AND nik = '".$_SESSION['nik']."'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);

// Jika data pengaduan tidak ditemukan
if (!$data) {
    echo "<script>alert('Pengaduan tidak ditemukan.'); window.location = 'masyarakat.php?url=lihat-pengaduan';</script>";
    exit();
}

?>


    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                        <a href="?url=lihat-pengaduan" class="btn-icon-split small">
            <span class="text p-0 small">Kembali</span>
        </a>
            </div>
            <div class="card-body">
                <form method="post" action="proses-edit-tanggapan.php">
                    <input type="hidden" name="id_pengaduan" value="<?= $data['id_pengaduan']; ?>">
                    <div class="form-group">
                        <label class="small">Tanggal Pengaduan</label>
                        <input type="text" name="tgl_pengaduan" class="form-control" value="<?= $data['tgl_pengaduan']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label class="small">Isi Laporan</label>
                        <textarea name="isi_laporan" class="form-control" required><?= $data['isi_laporan']; ?></textarea>
                    </div>
                    
                   
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>

