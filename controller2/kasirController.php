<?php
require_once(__DIR__ . '../../config/auth.inc');
include(__DIR__ . '../../config/config.php');

function kasir_info($id){
    global $pdo;
    $q = "SELECT * FROM kasir WHERE id=:id";
    $show = $pdo->prepare($q);
    $show->bindValue(':id', $id);
    $show->execute();
    $result = $show->fetchAll();

    return $result[0];
}

function transaksi_all($fdate, $ldate){
    global $pdo;

    if ($fdate == '' || $ldate == '') {
        $q = "SELECT * FROM transaksi WHERE id_kasir=:id_kasir ORDER BY create_at DESC";
        $show = $pdo->prepare($q);
        $show->bindValue(':id_kasir', $_SESSION['id']);
        $show->execute();
        $result=$show->fetchAll();
    } else{
        $q = "SELECT * FROM transaksi WHERE id_kasir=:id_kasir AND (DATE(create_at BETWEEN :fdate AND :sdate)) ORDER BY create_at DESC";
        $show = $pdo->prepare($q);
        $show->bindValue(':id_kasir', $_SESSION['id']);
        $show->bindValue(':fdate', $fdate);
        $show->bindValue(':sdate', $ldate);
        $show->execute();
        $result=$show->fetchAll();
    }

    return $result;

}


function transaksi_store($data) {
    global $pdo;
    $quey = "INSERT INTO transaksi (id_kasir, nourut, kode_transaksi, id_pengguna, subtotal, potongan, total, bayar, kembalian, create_at)
            VALUES (:id_kasir, :nourut, :kode_transaksi, :id_pengguna, :subtotal, :potongan, :total, :bayar, :kembalian, :create_at)";
    $insert_transaksi = $pdo->prepare($quey);
    $insert_transaksi->bindValue(':id_kasir', $data['kasir']);
    $insert_transaksi->bindValue(':nourut', $data['nourut']);
    $insert_transaksi->bindValue(':kode_transaksi', $data['kode_transaksi']);
    $insert_transaksi->bindValue(':id_pengguna', $data['id_pengguna']);
    $insert_transaksi->bindValue(':subtotal', $data['subtotal']);
    $insert_transaksi->bindValue(':potongan', $data['potongan']);
    $insert_transaksi->bindValue(':total', $data['total']);
    $insert_transaksi->bindValue(':bayar', $data['bayar']);
    $insert_transaksi->bindValue(':kembalian', $data['kembalian']);
    $insert_transaksi->bindValue(':create_at', $data['create_at']);
    $insert_transaksi->execute();

    return $insert_transaksi;
}

function detailtransaksi_store($data){
    global $pdo;
    $query = "INSERT INTO detail_transaksi (kode_transaksi, kode_barang, qty, harga)
            VALUES (:kode_transaksi, :kode_barang, :qty, :harga)";
    $insert_detailtransaksi = $pdo->prepare($query);
    $insert_detailtransaksi->bindValue(':kode_transaksi', $data['kode_transaksi']);
    $insert_detailtransaksi->bindValue(':kode_barang', $data['kode_barang']);
    $insert_detailtransaksi->bindValue(':qty', $data['qty']);
    $insert_detailtransaksi->bindValue(':harga', $data['harga']);
    $insert_detailtransaksi->execute();

    return $insert_detailtransaksi;
}

function transaksi_show($kode_transaksi){
    global $pdo;
    $query = "SELECT transaksi.*, tb_admin.email, tb_admin.nama_toko FROM transaksi
                JOIN tb_admin ON tb_admin.id = transaksi.id_kasir
                WHERE kode_transaksi=:kode_transaksi";
    $show = $pdo->prepare($query);
    $show->bindValue(':kode_transaksi', $kode_transaksi);
    $show->execute();

    $result = $show->fetchAll();
    return $result[0];
}

function detail_transaksi_show($kode_transaksi){
    global $pdo;
    $query = "SELECT detail_transaksi.*, barang.nama FROM detail_transaksi
                LEFT JOIN barang ON barang.kode = detail_transaksi.kode_barang
                WHERE kode_transaksi=:kode_transaksi
                GROUP BY detail_transaksi.id";
    $show = $pdo->prepare($query);
    $show->bindValue(':kode_transaksi', $kode_transaksi);
    $show->execute();

    $result = $show->fetchAll();
    return $result;
}