<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once '../library/library.php';
include '../controller/userController.php';

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['query'])) {
    $json = array();  
    $id =  $_POST['query'];
    $query = "SELECT * FROM pengguna WHERE id = :id AND id_admin=:id_admin";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':id_admin', $_SESSION['id']);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $value) {
        $item = array(
            'id_cust' => $value['kode_pelanggan'],
            'nama_cust' => $value['nama'],
            'poin' => $value['poin'],
            'potongan' => pointomoney($value['poin'])
        );

        array_push($json, $item);
    }
    echo json_encode($json, true);
}

if (isset($_POST['kode_pelanggan'])) {
    $json = array();  
    $kode =  $_POST['kode_pelanggan'];
    $query = "SELECT * FROM pengguna WHERE kode_pelanggan = :kode  AND id_admin=:id_admin";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':kode', $kode);
    $statement->bindValue(':id_admin', $_SESSION['id']);
    $statement->execute();
    $result = $statement->fetchAll();

    echo count($result);
}

if (isset($_POST['username'])) {
    $json = array();
    $username =  $_POST['username'];
    $query = "SELECT * FROM pengguna WHERE username = :uname";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':uname', $username);
    $statement->execute();
    $result = $statement->fetchAll();

    echo count($result);
}
