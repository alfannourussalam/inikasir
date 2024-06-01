<?php
include '../../controller/barangController.php';
include '../../controller/barangmasukController.php';

if (isset($_POST['simpan-barangmasuk'])) {
    $status = $_POST['status'];

    if($_POST['exp'] == ''){
        $exp = '0000-00-00';
    } else{
        $exp = $_POST['exp'];
    }

    $data = array(
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'jenis' => $_POST['jenis'],
        'satuan' => $_POST['satuan'],
        'suplier' => $_POST['suplier'],
        'modal' => $_POST['modal'],
        'harga' => $_POST['harga'],
        'jumlah' => $_POST['jumlah'],
        'total_modal' => $_POST['total_modal'],
        'exp' => $exp
    );

    // BARANG BARU
    if ($status == 'insert') {
        barang_store($data['kode'], $data['nama'], $data['jenis'], $data['satuan'], $data['modal'], $data['harga'], $data['jumlah']);
        barangmasuk_store($data);
        session_start();
        $_SESSION['status'] = 'sukses';
    }

    // BARANG LAMA
    if ($status == 'update') {
        barangmasuk_store($data);
        barang_update_record($data);
        session_start();
        $_SESSION['status'] = 'sukses';
    }

    // echo json_encode($data);
    
    // barang_store($kode, $nama, $jenis, $satuan, $suplier, $modal, $harga, $jumlah);
        
    header('location:/'.$basename.'/views/barangmasuk/');
} else {
    header('location:/'.$basename.'/views/barangmasuk');
}