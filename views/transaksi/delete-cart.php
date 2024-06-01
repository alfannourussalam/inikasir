<?php

include '../../controller/cartController.php';

$id = base64_decode($_GET['item']);

cart_destroy($id);

header('location:/'.$basename.'/views/transaksi/');