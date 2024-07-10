<!-- Header -->
<header class="bg-primary text-white text-center py-4">
    <h2 class="font-weight-bold d-none d-sm-block">Dashboard Pelayanan Publik</h2>
    <h1 class="font-weight-bold d-block d-sm-none small">Dashboard Pelayanan Publik</h1>
    <p class="d-none d-sm-block">Selamat datang, <?php echo $_SESSION['nama']; ?></p>
    <p class="d-block d-sm-none small">Selamat datang, <?php echo $_SESSION['nama']; ?></p>
</header>



<!-- Main Content -->
<div class="container " style="padding: 20px;">

<?php
    include 'koneksi.php';

    $nik = $_SESSION['nik'];

    function getStatusCount($status) {
        global $koneksi;
        $sql = "SELECT COUNT(*) AS total FROM pengaduan WHERE status = $status";
        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        } else {
            return 0;
        }
    }

    function getTotalCountBySession() {
        global $koneksi;
        $nik = $_SESSION['nik'];
        $sql = "SELECT COUNT(*) AS total FROM pengaduan WHERE nik = '$nik'";
        $result = mysqli_query($koneksi, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        } else {
            return 0;
        }
    }

    function getTotalCountPetugas() {
        global $koneksi;
        $sql = "SELECT COUNT(*) AS total FROM petugas";
        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        } else {
            return 0;
        }
    }

    function getCountByStatus($status) {
        global $koneksi;
        $nik = $_SESSION['nik'];
        $sql = "SELECT COUNT(*) AS total FROM pengaduan WHERE nik = '$nik' AND status = $status";
        $result = mysqli_query($koneksi, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['total'];
        } else {
            return 0;
        }
    }

    function getPengaduanByNik() {
        global $koneksi;
        $nik = $_SESSION['nik'];
        $sql = "SELECT * FROM pengaduan WHERE nik = '$nik' LIMIT 10";
        $result = mysqli_query($koneksi, $sql);
        return $result;
    }

    function getTotalPendingAndInProgress() {
        return getCountByStatus(0) + getCountByStatus(1);
    }

    function getComplaintCountByMonth($year, $month) {
        global $koneksi;
        $sql = "SELECT COUNT(*) AS total FROM pengaduan WHERE YEAR(tgl_pengaduan) = $year AND MONTH(tgl_pengaduan) = '$month'";
        $result = mysqli_query($koneksi, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    }

    $janComplaintCount = getComplaintCountByMonth(2024, '01');
    $febComplaintCount = getComplaintCountByMonth(2024, '02');
    $marComplaintCount = getComplaintCountByMonth(2024, '03');
    $aprComplaintCount = getComplaintCountByMonth(2024, '04');
    $meiComplaintCount = getComplaintCountByMonth(2024, '05');
    $junComplaintCount = getComplaintCountByMonth(2024, '06');
    $julComplaintCount = getComplaintCountByMonth(2024, '07');
    $augComplaintCount = getComplaintCountByMonth(2024, '08');
    $sepComplaintCount = getComplaintCountByMonth(2024, '09');
    $oktComplaintCount = getComplaintCountByMonth(2024, '10');
    $novComplaintCount = getComplaintCountByMonth(2024, '11');
    $desComplaintCount = getComplaintCountByMonth(2024, '12');
?>

<!-- Statistik Utama -->
<div class="row mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Jumlah Laporan</h5>
                <p class="card-text small"><?php echo getTotalCountBySession(); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Menunggu Penanganan</h5>
                <p class="card-text small"><?php echo getTotalPendingAndInProgress(); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Petugas Aktif</h5>
                <p class="card-text small"><?php echo getTotalCountPetugas(); ?></p>
            </div>
        </div>
    </div>
</div>


<!-- Grafik dan Diagram -->
<div class="row">
    <div class="col-md-8 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Grafik Pengaduan Bulanan</h5>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body small">
                <h5 class="card-title">Aktivitas Terkini</h5>
                <ul class="list-group">
                    <?php
                    $sql = "SELECT pengaduan.id_pengaduan, pengaduan.tgl_pengaduan, pengaduan.status, masyarakat.nama
                            FROM pengaduan
                            JOIN masyarakat ON pengaduan.nik = masyarakat.nik
                            ORDER BY pengaduan.tgl_pengaduan DESC LIMIT 5";
                    $query = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($query) > 0) {
                        while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <li class="list-group-item small">
                                <?php
                                switch ($data['status']) {
                                    case 0:
                                        echo "Pengaduan baru dari " . $data['nama'];
                                        break;
                                    case 1:
                                        echo "Status pengaduan " . $data['nama'] . " diperbarui";
                                        break;
                                    case 2:
                                        echo "Pengaduan " . $data['nama'] . " selesai ditangani";
                                        break;
                                    default:
                                        echo "Aktivitas tidak diketahui";
                                }
                                ?>
                            </li>
                            <?php
                        }
                    } else {
                        ?>
                        <li class="list-group-item">Tidak ada aktivitas terbaru</li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pengaduan Terbaru</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped small table-sm">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = getPengaduanByNik();
                            if (mysqli_num_rows($result) > 0) {
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $no . "</td>";
                                    echo "<td>" . $row['tgl_pengaduan'] . "</td>";
                                    echo "<td>";
                                    ?>
                                    <span class="badge text-light <?php echo $row['status'] == 0 ? 'bg-warning' : ($row['status'] == 1 ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo $row['status'] == 0 ? 'Belum diproses' : ($row['status'] == 1 ? 'Sedang diproses' : 'Selesai'); ?>
                                    </span>
                                    <?php
                                    echo "</td>";
                                    echo "<td><a href='?url=lihat-tanggapan&id=" . $row['id_pengaduan'] . "' class='btn btn-primary btn-sm'>Detail Laporan</a></td>";
                                    echo "</tr>";
                                    $no++;
                                }
                                mysqli_free_result($result);
                            } else {
                                echo "<tr><td colspan='4'>Tidak ada pengaduan ditemukan</td></tr>";
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



</div>

<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Script untuk membuat grafik dengan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: [
                    <?php
                    echo json_encode($janComplaintCount) . ', ';
                    echo json_encode($febComplaintCount) . ', ';
                    echo json_encode($marComplaintCount) . ', ';
                    echo json_encode($aprComplaintCount) . ', ';
                    echo json_encode($meiComplaintCount) . ', ';
                    echo json_encode($junComplaintCount) . ', ';
                    echo json_encode($julComplaintCount) . ', ';
                    echo json_encode($augComplaintCount) . ', ';
                    echo json_encode($sepComplaintCount) . ', ';
                    echo json_encode($oktComplaintCount) . ', ';
                    echo json_encode($novComplaintCount) . ', ';
                    echo json_encode($desComplaintCount);
                    ?>
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
