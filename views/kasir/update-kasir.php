<?php
include '../../controller/kasirController.php';
include '../../controller/roleController.php';

if (isset($_POST['update-kasir'])) {
    $data = array(
        'id' => $_POST['id'],
        'nama' => $_POST['nama'],        
        'nohp' => $_POST['nohp']
    );

    // print_r($data);
    kasir_update($data);
    session_start();
    $_SESSION['status'] = 'update';
    header('location:/'.$basename.'/views/kasir/');
} else {
    header('location:/'.$basename.'/views/kasir/');
}
