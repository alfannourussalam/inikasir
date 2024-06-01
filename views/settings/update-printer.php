<?php
require_once '../../config/auth.inc';
include_once '../../controller/adminController.php';
include_once '../../controller/roleController.php';
include_once '../../controller/kasirController.php';

if (isset($_POST['setup-printer'])) {
    $data = array(
        'printer' => $_POST['printer']
    );

    if ($_SESSION['role'] == 'admin') {
        $data['id'] = $_SESSION['id'];
        update_printer($data);
    }
    if ($_SESSION['role'] == 'kasir') {
        $data['id'] = $_SESSION['myid'];
        kasir_printer_update($data)        ;
    }
    
    session_start();
    $_SESSION['status'] = 'update';
    if ($_SESSION['role'] == 'kasir') {
        header('location:/'.$basename.'/views/transaksi/');
    } else {
        header('location:/'.$basename.'/');
    }
} else {
    header('location:/'.$basename.'/settings/setup-printer.php');
}
