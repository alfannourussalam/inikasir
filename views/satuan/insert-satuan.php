<?php
include '../../controller/satuanController.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    
    for ($i=0; $i < sizeof($nama); $i++) { 
        satuan_store($nama[$i]);
    }
    
    session_start();
    $_SESSION['status'] = 'sukses';
    header('location:/'.$basename.'/views/satuan/');
}