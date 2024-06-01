<?php
include '../../controller/suplierController.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    
    for ($i=0; $i < sizeof($nama); $i++) { 
        suplier_store($nama[$i]);
    }
    
    header('location:/'.$basename.'/views/supliers/index.php?msg=success');
}