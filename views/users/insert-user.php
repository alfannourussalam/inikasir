<?php
require_once '../../config/auth.inc';
include_once '../../controller/userController.php';

if (isset($_POST['simpan'])) {
    $kode_pelanggan = $_POST['kode_pelanggan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nohp = $_POST['nohp'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $pass = md5($_POST['pass']);
    $kode_role = $_POST['kode_role'];
    $poin = 0; //default poin
    
    $data = array(
        'kode_pelanggan' => $kode_pelanggan,
        'nama' => $nama,
        'email' => $email,
        'nohp' => $nohp,
        'alamat' => $alamat,
        'username' => $username,
        'pass' => $pass,
        'kode_role' => $kode_role,
        'poin' => $poin,
        'deleted' => 0
    );

    $data['id_admin'] = $_SESSION['id'];

    if ($data) {
        user_store($data);
        session_start();
        $_SESSION['status'] = 'sukses';
        header('location:/'.$basename.'/views/users/index.php');
        // header('location:/'.$basename.'/views/users/index.php?msg=success');
    } else {
        echo "Data Error";
    }

} else {
    echo "No data to insert";
}

// $data['kode_kasir'] = $kasir['id'];
//     $data['poin'] = 0;
//     $data['deleted'] = 0;