<?php
include '../../controller/userController.php';
include '../../controller/roleController.php';

if (isset($_POST['update-user'])) {
    $data = array(
        'id' => $_POST['id'],
        'kode_pelanggan' => $_POST['kode_pelanggan'],
        'nama' => $_POST['nama'],
        'email' => $_POST['email'],
        'nohp' => $_POST['nohp'],
        'alamat' => $_POST['alamat']
    );
    $data['id_admin'] = $_SESSION['id'];

    // print_r($data);
    user_update($data);
    session_start();
    $_SESSION['status'] = 'update';
    header('location:/'.$basename.'/views/users/index.php');
} else {
    header('location:/'.$basename.'/views/users/');
}
