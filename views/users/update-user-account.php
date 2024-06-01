<?php

include_once '../../controller/userController.php';

if (isset($_POST['save-account'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $data = array(
            'username' => $_POST['username'],
            'pass' => $_POST['password'],
            'id' => $_POST['id'],
        );

        account_update($data);
        session_start();
        $_SESSION['status'] = 'update';
        header('location:/'.$basename.'/views/users/index.php');
        // print(json_encode($data));

    } elseif (!empty($_POST['username']) && empty($_POST['password'])) {
        $data = array(
            'username' => $_POST['username'],
            'id' => $_POST['id']
        );

        username_update($data);
        session_start();
        $_SESSION['status'] = 'update';
        header('location:/'.$basename.'/views/users/index.php');
        // print(json_encode($data));

    }
     else {
        echo 'Something wrong!!';
    }
} else {
    echo 'Something wrong!!';
}
