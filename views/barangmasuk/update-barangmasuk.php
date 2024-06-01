<?php
include '../../controller/barangController.php';
include '../../controller/barangmasukController.php';

if (isset($_POST['simpan-barangmasuk'])) {

    if($_POST['suplier'] == ''){
        $suplier ='Tidak Ada';
    } else{
        $suplier = $_POST['suplier'];
    }

    $data = array(
        'id' => $_POST['id'],
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'satuan' => $_POST['satuan'],
        'suplier' => $suplier,
        'modal' => $_POST['modal'],
        'harga' => $_POST['harga'],
        'jumlah_old' => true,
        'jumlah_old' => $_POST['jumlah_old'],
        'jumlah' => $_POST['jumlah'],
        'total_modal' => $_POST['total_modal'],
        'exp' => $_POST['exp']
    );

    
    barangmasuk_update($data);
    barang_update_record($data);
    session_start();
    $_SESSION['status'] = 'update';


    // echo json_encode($data);

    // barang_store($kode, $nama, $jenis, $satuan, $suplier, $modal, $harga, $jumlah);

    header('location:/' . $basename . '/views/barangmasuk/');
} else {
    header('location:/' . $basename . '/views/barangmasuk');
}
