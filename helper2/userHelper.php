<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once '../library/library.php';
include '../controller/userController.php';

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['query'])) {
    $json = array();  
    $id =  $_POST['query'];
    $query = "SELECT * FROM pengguna WHERE id = :id AND kode_kasir=:kode_kasir";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id', $id);
    $statement->bindValue(':kode_kasir', $_SESSION['id']);
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
    $query = "SELECT * FROM pengguna WHERE kode_pelanggan = :kode";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':kode', $kode);
    $statement->execute();
    $result = $statement->fetchAll();

    echo count($result);
}
