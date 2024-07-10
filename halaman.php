<?php

if(isset($_GET['url'])){
    switch ($_GET['url']) {

        case 'tulis-pengaduan':
        include 'tulis-pengaduan.php';
        break;
       
        case 'dashboard':
        include 'dashboard.php';
        break;
        
        case 'profil':
        include 'profilm.php';
        break;
        
        case 'skck':
        include 'pelayanan/form-skck.php';
        break;
        
        case 'sp':
        include 'pelayanan/form-sp.php';
        break;
        
        case 'edit-tanggapan':
        include 'edit-tanggapan.php';
        break;
        
        case 'proses-edit-tanggapan':
        include 'proses-edit-tanggapan.php';
        break;
        
        case 'edit':
        include 'editm.php';
        break;

        case 'lihat-pengaduan';
        include 'lihat-pengaduan.php';
        break;

        case 'pelayanan-masyarakat';
        include 'pelayanan-masyarakat.php';
        break;

        case 'form-aktekel';
        include 'form-aktekel.php';
        break;

        case 'detail-pengaduan';
        include 'detail-pengaduan.php';
        break;

        case 'lihat-tanggapan';
        include 'lihat-tanggapan.php';
        break;

        default:
        echo "Halaman Tidak Ditemukan";
        break;
    }
}else{
    include 'dasboard.php';
}