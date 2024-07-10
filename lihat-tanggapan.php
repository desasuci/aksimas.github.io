<?php

$id = $_GET['id'];
if (empty($id)) {
    header("Location: masyarakat.php");
    exit; // Pastikan keluar dari skrip setelah redirect
}

include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM pengaduan, tanggapan WHERE tanggapan.id_pengaduan='$id' AND tanggapan.id_pengaduan=pengaduan.id_pengaduan");

?>
<div class="card shadow m-4">
    <div class="card-header">
        <a href="?url=lihat-pengaduan" class="btn-icon-split small">
            <span class="text p-0 small">Kembali</span>
        </a>
    </div>
    <div class="card-body">
        <?php
        if (mysqli_num_rows($query) == 0) {
            echo "<div class='alert alert-danger'>Maaf, tanggapan Anda belum ditanggapi.</div>";
        } else {
            $data = mysqli_fetch_array($query); ?>

            <form method="post" action="proses-pengaduan.php" enctype="multipart/form-data">

                <div class="form-group">
                    <label style="font-size: 14px">Tgl Tanggapan</label>
                    <input type="text" name="tgl_tanggapan" class="form-control" readonly
                           value="<?= $data['tgl_tanggapan']; ?>">
                </div>

                <div class="form-group">
                    <label style="font-size: 14px">Tanggapan</label>
                    <textarea name="tanggapan" class="form-control" readonly><?= $data['tanggapan']; ?></textarea>
                </div>

                <div class="form-group">
                    <label style="font-size: 14px">Isi Laporan</label>
                    <textarea name="isi_laporan" class="form-control" readonly><?= $data['isi_laporan']; ?></textarea>
                </div>

                <div class="form-group">
                    <label style="font-size: 14px">Foto</label><br>
                    <?php if (!empty($data['foto'])): ?>
                        <img src="img/doc/<?= $data['foto']; ?>" class="img-fluid" alt="Foto Pengaduan">
                    <?php else: ?>
                        <p class="text-muted">Foto tidak tersedia</p>
                    <?php endif; ?>
                </div>

            </form>
        <?php } ?>
    </div>
</div>
