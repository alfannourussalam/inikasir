<?php
include '../../controller/barangController.php';

// if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $satuan = $_POST['satuan'];
    $modal = $_POST['modal'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    
    barang_store($kode, $nama, $jenis, $satuan, $modal, $harga, $jumlah);
        
    header('location:/inikasir/views/barang/index.php?msg=success');
// }