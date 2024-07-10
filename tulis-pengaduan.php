<div class="">
    <div class="card shadow m-4">
        <div class="card-header">
            <a href="masyarakat.php"   class="btn-icon-split small">
   
   <span class="text p-0 small">Kembali</span>
                        
   </a>
        </div>
        <div class="card-body">

        <form method="post" action="proses-pengaduan.php" enctype="multipart/form-data">

            <div class="form-group">
                <label style="font-size: 14px">Tgl Pengaduan</label>
                <input type="text" name="tgl_pengaduan" class="form-control" readonly value="<?= date('Y-m-d'); ?>">
            </div>

            <div class="form-group">
                <label style="font-size: 14px">Isi Laporan</label>
                <textarea name="isi_laporan" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label style="font-size: 14px">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success"> SIMPAN </button>
            </div>

        </form>

        </div>
    </div>
    </div>