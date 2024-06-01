<?php
require_once '../../config/auth.inc';
include_once '../../controller/adminController.php';
include_once '../../controller/roleController.php';

if (isset($_POST['update-profiltoko'])) {
    $data = array(
        'id_admin' => $_SESSION['id'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'nohp' => $_POST['nohp'],
        'nik' => $_POST['nik'],
        'nama' => $_POST['nama'],
        'nama_toko' => $_POST['nama_toko'],
        'alamat' => $_POST['alamat']

        // 'reward' => $_POST['reward'],
        // 'redeem' => $_POST['redeem']
    );

    // print_r($data);
    update_profil($data);
    session_start();
    $_SESSION['status'] = 'update';
    header('location:/'.$basename.'/views/settings/');
} else {
    header('location:/'.$basename.'/');
}
