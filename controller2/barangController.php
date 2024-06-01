<?php
require_once (__DIR__ . '../../config/auth.inc');
include (__DIR__ . '../../config/config.php');

function barang_all() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM barang
                         WHERE id_kasir=:id_kasir AND deleted=0 ORDER BY id DESC");
    $show->bindValue(':id_kasir', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

function barang_show($id){
    global $pdo;
    $find = $pdo->prepare("SELECT * FROM barang WHERE id=:id");
    $find->bindValue(':id', $id);
    $find->execute();
    $result = $find->fetchAll();

    return $result[0];
}

function barang_show_by_kode($kode){
    global $pdo;
    $find = $pdo->prepare("SELECT * FROM barang WHERE id_kasir=:id_kasir AND kode=:kode");
    $find->bindValue(':kode', $kode);
    $find->bindValue(':id_kasir', $_SESSION['id']);
    $find->execute();
    $result = $find->fetchAll();

    return $result[0];
}

function barang_store($kode, $nama, $jenis, $satuan, $modal, $harga, $jumlah) {
    global $pdo;
    $datetime = date('Y-m-d H:i:s', time());
    $add = $pdo->prepare("INSERT INTO barang (id_kasir, kode, nama, jenis, id_satuan, modal, harga, jumlah, sisa, create_at)
                            VALUES (:id_kasir, :kode, :nama, :jenis, :satuan, :modal, :harga, :jumlah, :sisa, :create_at)");
    $add->bindValue(':id_kasir', $_SESSION['id']);
    $add->bindValue(':kode', $kode);
    $add->bindValue(':nama', $nama);
    $add->bindValue(':jenis', $jenis);
    $add->bindValue(':satuan', $satuan);
    $add->bindValue(':modal', $modal);
    $add->bindValue(':harga', $harga);
    $add->bindValue(':jumlah', $jumlah);
    $add->bindValue(':sisa', $jumlah);
    $add->bindValue(':create_at', $datetime);
    $add->execute();

    return $add;
}

function barang_destroy($id){
    global $pdo;
    $soft_del = $pdo->prepare("UPDATE barang SET deleted=:deleted WHERE id=:id AND id_kasir=:id_kasir");
    $soft_del->bindValue(':deleted', 1);
    $soft_del->bindValue(':id', $id);
    $soft_del->bindValue(':id_kasir', $_SESSION['id']);
    $soft_del->execute();
    
    return $soft_del;
}

function barang_update($data) {
    global $pdo;
    $datetime = date('Y-m-d H:i:s', time());
    $id =$data['id'];
    $update = $pdo->prepare("UPDATE barang SET
                            kode=:kode, nama=:nama, jenis=:jenis, id_satuan=:satuan, modal=:modal, harga=:harga, jumlah=:jumlah, sisa=:sisa, update_at=:update_at
                            WHERE id=:id AND id_kasir=:id_kasir");
    $update->bindValue(':id_kasir', $_SESSION['id']);;
    $update->bindValue(':kode', $data['kode']);
    $update->bindValue(':nama', $data['nama']);
    $update->bindValue(':jenis', $data['jenis']);
    $update->bindValue(':satuan', $data['satuan']);
    $update->bindValue(':modal', $data['modal']);
    $update->bindValue(':harga', $data['harga']);
    $update->bindValue(':jumlah', $data['jumlah']);
    $update->bindValue(':sisa', $data['sisa']);
    $update->bindValue(':update_at', $datetime);
    $update->bindValue(':id', $id);
    $update->execute();

    return $update;
}


function barang_update_record($data) {

    $get_stok_and_total = barang_show_by_kode($data['kode']);
    $current_stock = $get_stok_and_total['sisa'];
    $current_total = $get_stok_and_total['jumlah'];

    global $pdo;
    $datetime = date('Y-m-d H:i:s', time());
    // $id =$data['id'];
    $update = $pdo->prepare("UPDATE barang SET
                            nama=:nama, jenis=:jenis, id_satuan=:satuan, modal=:modal, harga=:harga, jumlah=:jumlah, sisa=:sisa, update_at=:update_at
                            WHERE kode=:kode");
    $update->bindValue(':kode', $data['kode']);
    $update->bindValue(':nama', $data['nama']);
    $update->bindValue(':jenis', $data['jenis']);
    $update->bindValue(':satuan', $data['satuan']);
    $update->bindValue(':modal', $data['modal']);
    $update->bindValue(':harga', $data['harga']);
    $update->bindValue(':jumlah', $data['jumlah'] + $current_total);
    $update->bindValue(':sisa', $current_stock + $data['jumlah']);
    $update->bindValue(':update_at', $datetime);
    $update->execute();

    return $update;
}

function satuan_show() {
    global $pdo;
    $show_satuan = $pdo->prepare("SELECT * FROM satuan");
    $show_satuan->execute();
    $result = $show_satuan->fetchAll();

    return $result;
}