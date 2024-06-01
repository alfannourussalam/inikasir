<?php

require_once "../../config/auth.inc";
include_once "../../controller/satuanController.php";

if (isset($_POST['update-satuan'])) {
    $id = base64_decode($_POST['id_satuan']);

    $data = array (
        'id'        => $id,
        'ket_satuan'=> $_POST['satuan']
    );
   
    satuan_edit($data);
    session_start();
    $_SESSION['status'] = 'update';
    header("Location:/".$basename."/views/satuan/");
}
else {
    header("Location:/".$basename."/views/satuan/");
}

?>