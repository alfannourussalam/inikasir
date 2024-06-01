<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once '../library/library.php';
include_once '../controller/kasirController.php';

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['username'])) {
    $json = array();
    $username =  $_POST['username'];
    $query = "SELECT * FROM kasir WHERE username = :uname";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':uname', $username);
    $statement->execute();
    $result = $statement->fetchAll();

    echo count($result);
}
