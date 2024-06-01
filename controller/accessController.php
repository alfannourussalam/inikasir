<?php
include_once (__DIR__ . '../../config/config.php');

function permission_show() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM access_permission");
    $show->execute();
    $result=$show->fetchAll();

    return $result;
}