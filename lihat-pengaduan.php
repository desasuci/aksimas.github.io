<div class=" m-4">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 ">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h4 class="m-0 font-weight-bold  text-primary">Data Pengaduan</h4>
        </div>
        <div class="card-body" >
            <div class="table-responsive">
                <table class="table table-striped table-bordered small" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Isi Laporan</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';
                        
                        // Assume session is started and nik is set
                        $nik = $_SESSION['nik'];

                        // Modify SQL query to filter by session's nik
                        $sql = "SELECT * FROM pengaduan WHERE nik = '$nik' ORDER BY id_pengaduan DESC";
                        $query = mysqli_query($koneksi, $sql);
                        $no = 1;
                        while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['tgl_pengaduan']; ?></td>
                            <td><?= $data['isi_laporan']; ?></td>
                            <td class="col-2">
                                <a href="#" data-toggle="modal" data-target="#modalFoto<?= $data['id_pengaduan']; ?>">
                                    <img class="img-thumbnail" src="img/doc/<?= $data['foto']?>" width="100">
                                </a>
                            </td>
                            <td>
                                <?php
                                switch ($data['status']) {
                                    case 0:
                                        echo "Belum diproses";
                                        break;
                                    case 1:
                                        echo "Sedang diproses";
                                        break;
                                    case 2:
                                        echo "Selesai";
                                        break;
                                    default:
                                        echo "Status tidak valid";
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($data['status'] == 0) { ?>
                                    <!-- Tombol Edit Tanggapan -->
                                    <a href="?url=edit-tanggapan&id=<?= $data['id_pengaduan'] ?>" class="btn btn-warning btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Edit Pengaduan</span>
                                    </a>
                                <?php } ?>
                                <?php if ($data['status'] == 1 || $data['status'] == 2) { ?>
                                    <!-- Tombol Tanggapan -->
                                    <a href="?url=lihat-tanggapan&id=<?= $data['id_pengaduan'] ?>" class="btn btn-primary btn-icon-split btn-sm">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-comments"></i>
                                        </span>
                                        <span class="text">Tanggapan</span>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>

                        <!-- Modal Foto -->
                        <div class="modal fade" id="modalFoto<?= $data['id_pengaduan']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalFotoLabel<?= $data['id_pengaduan']; ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalFotoLabel<?= $data['id_pengaduan']; ?>">Preview Foto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="img/doc/<?= $data['foto']; ?>" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Foto -->

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
