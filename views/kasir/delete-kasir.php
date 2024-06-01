<?php

include '../../controller/kasirController.php';

$id = base64_decode($_GET['identity']);

kasir_destroy($id);
session_start();
$_SESSION['status'] = 'delete';
header('location:/'.$basename.'/views/kasir/');
