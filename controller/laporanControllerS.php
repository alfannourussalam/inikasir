<?php

require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');

function barangmasuk(){
    global $pdo;
    $show = $pdo->prepare("SELECT barang_masuk.kode_barang, barang_masuk.harga, barang_masuk.jumlah, barang.nama, suplier.nama_suplier
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang
                            JOIN suplier ON suplier.id = barang_masuk.suplier
                            WHERE barang_masuk.id_kasir = :id_kasir
                            GROUP BY barang_masuk.id
                            ORDER BY barang_masuk.create_at ASC");
    $show->bindValue(':id_kasir', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    // echo json_encode($result);
    return $result;
}

function barangmasuk_range($fdate, $ldate){
    global $pdo;
    $show = $pdo->prepare("SELECT barang_masuk.kode_barang, barang_masuk.harga, barang_masuk.jumlah, barang.nama, suplier.nama_suplier
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang
                            JOIN suplier ON suplier.id = barang_masuk.suplier
                            WHERE barang_masuk.id_kasir = :id_kasir AND (DATE(barang_masuk.create_at) BETWEEN :fdate AND :ldate)
                            GROUP BY barang_masuk.id
                            ORDER BY barang_masuk.create_at ASC");
    $show->bindValue(':id_kasir', $_SESSION['id']);
    $show->bindValue(':fdate', $fdate);
    $show->bindValue(':ldate', $ldate);
    $show->execute();
    $result = $show->fetchAll();

    // echo json_encode($result);
    return $result;
}

$a = "2023-03-16";
$b = "2023-03-21";
// barangmasuk($a, $b);
