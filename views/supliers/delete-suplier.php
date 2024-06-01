<?php
require_once ('../../config/auth.inc');
include_once ('../../controller/suplierController.php');

if (isset($_GET['dest'])) {
    $id = base64_decode($_GET['dest']);
    suplier_destroy($id);
    header('Location:/'.$basename.'/views/supliers/');
} else {
    header('Location: /'.$basename.'/views/supliers/');
}