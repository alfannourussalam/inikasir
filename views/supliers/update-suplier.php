<?php

require_once "../../config/auth.inc";
include_once "../../controller/suplierController.php";

if (isset($_POST['update-suplier'])) {
    $id = base64_decode($_POST['id_suplier']);

    $data = array (
        'id'        => $id,
        'suplier'=> $_POST['suplier']
    );
   
    suplier_edit($data);
    session_start();
    $_SESSION['status'] = 'update';
    header("Location:/".$basename."/views/supliers/");
}
else {
    header("Location:/".$basename."/views/supliers/");
}

?>