<?php

include '../../controller/userController.php';

$id = base64_decode($_GET['identity']);

user_destroy($id);
session_start();
$_SESSION['status'] = 'delete';
header('location:/'.$basename.'/views/users/index.php');
