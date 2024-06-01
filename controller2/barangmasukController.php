<?php
require_once(__DIR__ . '../../config/auth.inc');
include(__DIR__ . '../../config/config.php');

function barangmasuk_all()
{
    global $pdo;
    $show = $pdo->prepare("SELECT barang_masuk.kode_barang, barang_masuk.harga, barang_masuk.jumlah, barang.nama, suplier.nama_suplier
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang
                            JOIN suplier ON suplier.id = barang_masuk.suplier
                            WHERE barang_masuk.id_admin = :id_admin
                            GROUP BY barang_masuk.id
                            ORDER BY barang_masuk.id DESC");
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

function barangmasuk_show($id)
{
    global $pdo;
    $find = $pdo->prepare("SELECT barang_masuk.*, barang.nama
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang
                            WHERE id=:id AND id_admin = :id_admin");
    $find->bindValue(':id', $id);
    $find->bindValue(':id_admin', $_SESSION['id']);
    $find->execute();
    $result = $find->fetchAll();

    return $result[0];
}

function barangmasuk_show_by_kode($kode)
{
    global $pdo;
    $find = $pdo->prepare("SELECT * FROM barang_masuk WHERE kode=:kode");
    $find->bindValue(':kode', $kode);
    $find->execute();
    $result = $find->fetchAll();

    return $result[0];
}

function barangmasuk_store($data)
{
    global $pdo;
    $datetime = date('Y-m-d H:i:s', time());
    print_r($data);
    // $add = $pdo->prepare("INSERT INTO barang_masuk (id_admin, id_kasir, kode_barang, suplier, modal, harga, jumlah, total_modal, create_at)
    //                         VALUES (:id_admin, :id_kasir, :kode_barang, :suplier, :modal, :harga, :jumlah, :total_modal, :create_at)");
    // $add->bindValue(':id_admin', $_SESSION['id']);
    // $add->bindValue(':id_kasir', $_SESSION['userid']);
    // $add->bindValue(':kode_barang', $data['kode']);
    // $add->bindValue(':suplier', $data['suplier']);
    // $add->bindValue(':modal', $data['modal']);
    // $add->bindValue(':harga', $data['harga']);
    // $add->bindValue(':jumlah', $data['jumlah']);    
    // $add->bindValue(':total_modal', $data['total_modal']);
    // $add->bindValue(':create_at', $datetime);
    // $add->execute();

    // return $add;
}

function barangmasuk_destroy($id)
{
    global $pdo;
    $del = $pdo->prepare("DELETE FROM barang_masuk WHERE id=:id");
    $del->bindValue(':id', $id);
    $del->execute();

    return $del;
}
