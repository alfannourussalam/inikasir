<?php
require_once(__DIR__ . '../../config/auth.inc');
include_once(__DIR__ . '../../config/config.php');

function barangmasuk_all($fdate, $ldate)
{
    global $pdo;
    $current_year = date('Y');

    if ($fdate == "" || $ldate == "") {
        $show = $pdo->prepare("SELECT barang_masuk.id, barang_masuk.kode_barang, barang_masuk.harga, barang_masuk.total_modal, barang_masuk.jumlah, barang_masuk.create_at, barang_masuk.expired, barang.nama
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang AND barang.id_admin = barang_masuk.id_admin
                            
                            WHERE barang_masuk.id_admin = :id_admin AND YEAR(barang_masuk.create_at) = :current_year
                            GROUP BY barang_masuk.id
                            ORDER BY barang_masuk.id DESC");
        $show->bindValue(':id_admin', $_SESSION['id']);
        $show->bindValue(':current_year', $current_year);
        $show->execute();
        $result = $show->fetchAll();
    } else {
        $show = $pdo->prepare("SELECT barang_masuk.id, barang_masuk.kode_barang, barang_masuk.harga, barang_masuk.total_modal, barang_masuk.jumlah, barang_masuk.create_at, barang.nama
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang AND barang.id_admin = barang_masuk.id_admin
                            
                            WHERE barang_masuk.id_admin = :id_admin AND DATE(barang_masuk.create_at) BETWEEN :fdate AND :ldate
                            GROUP BY barang_masuk.id
                            ORDER BY barang_masuk.id DESC");
        $show->bindValue(':id_admin', $_SESSION['id']);
        $show->bindValue(':fdate', $fdate);
        $show->bindValue(':ldate', $ldate);
        $show->execute();
        $result = $show->fetchAll();
    }

    return $result;
}

function barangmasuk_show($id)
{
    global $pdo;
    $find = $pdo->prepare("SELECT barang_masuk.*, barang.nama, barang.jenis
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang
                            WHERE barang_masuk.id=:id AND barang_masuk.id_admin = :id_admin");
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
    $add = $pdo->prepare("INSERT INTO barang_masuk (id_admin, kode_barang, suplier, satuan, modal, harga, jumlah, total_modal, create_at, expired)
                            VALUES (:id_admin, :kode_barang, :suplier, :satuan, :modal, :harga, :jumlah, :total_modal, :create_at, :exp)");
    $add->bindValue(':id_admin', $_SESSION['id']);
    $add->bindValue(':kode_barang', $data['kode']);
    $add->bindValue(':suplier', $data['suplier']);
    $add->bindValue(':satuan', $data['satuan']);
    $add->bindValue(':modal', $data['modal']);
    $add->bindValue(':harga', $data['harga']);
    $add->bindValue(':jumlah', $data['jumlah']);
    $add->bindValue(':total_modal', $data['total_modal']);
    $add->bindValue(':create_at', $datetime);
    $add->bindValue(':exp', $data['exp']);
    $add->execute();

    return $add;
}

function barangmasuk_update($data)
{
    global $pdo;
    $q = "UPDATE barang_masuk SET kode_barang=:kode_barang, suplier=:suplier, satuan=:satuan, modal=:modal, harga=:harga, jumlah=:jumlah, total_modal=:total_modal, expired=:exp
            WHERE id=:id";
    $up = $pdo->prepare($q);
    $up->bindValue(':id', $data['id']);
    $up->bindValue(':kode_barang', $data['kode']);
    $up->bindValue(':suplier', $data['suplier']);
    $up->bindValue(':satuan', $data['satuan']);
    $up->bindValue(':modal', $data['modal']);
    $up->bindValue(':harga', $data['harga']);
    $up->bindValue(':jumlah', $data['jumlah']);
    $up->bindValue(':total_modal', $data['total_modal']);
    $up->bindValue(':exp', $data['exp']);
    $up->execute();

    return $up;
}



function barangmasuk_destroy($id)
{
    global $pdo;
    $del = $pdo->prepare("DELETE FROM barang_masuk WHERE id=:id");
    $del->bindValue(':id', $id);
    $del->execute();

    return $del;
}

// print_r(barangmasuk_all('',''));