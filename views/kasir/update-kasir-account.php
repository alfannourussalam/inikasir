<?php

include_once '../../controller/kasirController.php';

if (isset($_POST['save-account'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $data = array(
            'username' => $_POST['username'],
            'pass' => $_POST['password'],
            'id' => $_POST['id'],
        );

        kasir_account_update($data);
        session_start();
        $_SESSION['status'] = 'update';
        header('location:/'.$basename.'/views/kasir/index.php');
        // print(json_encode($data));

    } elseif (!empty($_POST['username']) && empty($_POST['password'])) {
        $data = array(
            'username' => $_POST['username'],
            'id' => $_POST['id']
        );

        kasir_username_update($data);
        session_start();
        $_SESSION['status'] = 'update';
        header('location:/'.$basename.'/views/kasir/index.php');
        // print(json_encode($data));

    }
     else {
        echo 'Something wrong!!';
    }
} else {
    echo 'Something wrong!!';
}
