<?php

require_once (__DIR__ . '../../config/auth.inc');
include '../controller/barangController.php';

header('Content-type: application/json; charset=utf-8');

if (isset($_POST['query'])) {
    $json = array();
    // $kode =  trim($_POST['item']);
    $kode =  $_POST['query'];
    $query = "SELECT * FROM barang WHERE kode = :kode AND id_kasir=:id_kasir";
    $statement = $pdo->prepare($query);
    $statement->bindValue(':id_kasir', $_SESSION['id']);
    $statement->bindValue(':kode', $kode);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $value) {
        $item = array(
            'kode' => $value['kode'],
            'nama' => $value['nama'],
            'jenis' => $value['jenis'],
            'modal' => $value['modal'],
            'id_satuan' => $value['id_satuan'],
            'harga' => $value['harga'],
            'sisa' => $value['sisa']
        );

        array_push($json, $item);
    }
    echo json_encode($json, true);
}
