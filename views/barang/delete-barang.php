<?php

include '../../controller/barangController.php';

$id = base64_decode($_GET['item']);

barang_destroy($id);

header('location:/'.$basename.'/views/barang/index.php?msg=deleted');