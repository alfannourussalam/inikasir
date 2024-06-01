<?php
require_once '../../config/auth.inc';
include_once '../../controller/kasirController.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $nohp = $_POST['nohp'];
    $username = $_POST['username'];
    $pass = md5($_POST['pass']);
    
    $data = array(
        'nama' => $nama,
        'nohp' => $nohp,
        'username' => $username,
        'pass' => $pass
    );

    $data['id_admin'] = $_SESSION['id'];

    if ($data) {
        kasir_store($data);
        session_start();
        $_SESSION['status'] = 'sukses';
        header('location:/'.$basename.'/views/kasir/');
    } else {
        echo "Data Error";
    }

} else {
    echo "No data to insert";
}