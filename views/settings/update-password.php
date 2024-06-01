<?php
require_once '../../config/auth.inc';
include_once '../../controller/adminController.php';
$admin = admin_show($_SESSION['id']);

if (isset($_POST['update-password'])) {
    $data = array(
        'old' => md5($_POST['oldPassword']),
        'new' => $_POST['newPassword'],
        'confirm' => $_POST['confirmPassword']
    );

    if ($data['old'] == $admin['pass']) {
        $new = $data['new'];
        $confirm = $data['confirm'];

        if ($new == $confirm) {
            // session_start();
            // $_SESSION['status'] = 'update';
            // header('location:/' . $basename . '/');
        } else {
            session_start();
            $_SESSION['status'] = 'diff';
            header('location:/' . $basename . '/views/settings/change-password.php');
        }
    } else {
        session_start();
        $_SESSION['status'] = 'error';
        header('location:/' . $basename . '/views/settings/');
    }
} else {
    header('location:/' . $basename . '/');
}
