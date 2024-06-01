<?php

include_once (__DIR__ . '../../config/config.php');

function role_all() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM tb_role WHERE id <> 1");
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}