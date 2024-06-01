<?php
include '../../controller/barangController.php';

if (isset($_POST['update'])) {
    $data = array(
        'id'        => $_POST['id'],
        'kode'      => $_POST['kode'],
        'nama'      => $_POST['nama'],
        'jenis'     => $_POST['jenis'],
        'satuan'    => $_POST['satuan'],
        'modal'     => $_POST['modal'],
        'harga'     => $_POST['harga'],
        // 'jumlah'    => $_POST['jumlah'],
        'sisa'      => $_POST['sisa']
    );

    // print_r($data);
    barang_update($data);
    header('location:/'.$basename.'/views/barang/index.php?msg=updated');
} else {
    header('location:/'.$basename.'/views/barang/');
}
