<?php
require_once ('../../config/auth.inc');
include_once ('../../controller/satuanController.php');

if (isset($_GET['dest'])) {
    $id = base64_decode($_GET['dest']);
    satuan_destroy($id);
    session_start();
    $_SESSION['status'] = 'delete';
    header('Location:/'.$basename.'/views/satuan/');
} else {
    header('Location: /'.$basename.'/views/satuan/');
}