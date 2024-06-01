<?php
require_once(__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');


function transaksi_all($fdate, $ldate)
{
    global $pdo;
    $current_year = date('Y');

    if ($fdate == '' || $ldate == '') {
        $q = "SELECT * FROM transaksi WHERE id_admin=:id_admin AND YEAR(create_at) = :current_year";
        $show = $pdo->prepare($q);
        $show->bindValue(':id_admin', $_SESSION['id']);
        $show->bindValue(':current_year', $current_year);
        $show->execute();
        $result = $show->fetchAll();
    } else {
        $q = "SELECT * FROM transaksi WHERE id_admin=:id_admin AND DATE(create_at) BETWEEN :fdate AND :ldate";
        $show = $pdo->prepare($q);
        $show->bindValue(':id_admin', $_SESSION['id']);
        $show->bindValue(':fdate', $fdate);
        $show->bindValue(':ldate', $ldate);
        $show->execute();
        $result = $show->fetchAll();
    }

    return $result;
}


function transaksi_kasir($id_kasir, $id_admin)
{
    global $pdo;
    $q = "SELECT * FROM transaksi WHERE id_admin=:id_admin AND id_kasir=:id_kasir";
    $show = $pdo->prepare($q);
    $show->bindValue(':id_admin', $id_admin);
    $show->bindValue(':id_kasir', $id_kasir);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}


function transaksi_user($id_user, $id_admin)
{
    global $pdo;
    $q = "SELECT transaksi.*, kasir.nama AS nama_kasir FROM transaksi
            JOIN kasir ON kasir.id = transaksi.id_kasir
            WHERE transaksi.id_admin=:id_admin AND transaksi.id_pengguna=:id_pengguna";
    $show = $pdo->prepare($q);
    $show->bindValue(':id_admin', $id_admin);
    $show->bindValue(':id_pengguna', $id_user);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}


function transaksi_store($data)
{
    global $pdo;
    $quey = "INSERT INTO transaksi (id_admin, id_kasir, nourut, kode_transaksi, id_pengguna, subtotal, potongan, total, bayar, kembalian, create_at)
            VALUES (:id_admin, :id_kasir, :nourut, :kode_transaksi, :id_pengguna, :subtotal, :potongan, :total, :bayar, :kembalian, :create_at)";
    $insert_transaksi = $pdo->prepare($quey);
    $insert_transaksi->bindValue(':id_admin', $data['id_admin']);
    $insert_transaksi->bindValue(':id_kasir', $data['id_kasir']);
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

function detailtransaksi_store($data)
{
    global $pdo;
    $query = "INSERT INTO detail_transaksi (id_admin, kode_transaksi, kode_barang, subharga, qty, diskon, harga)
            VALUES (:id_admin, :kode_transaksi, :kode_barang, :subharga, :qty, :diskon, :harga)";
    $insert_detailtransaksi = $pdo->prepare($query);
    $insert_detailtransaksi->bindValue(':id_admin', $data['id_admin']);
    $insert_detailtransaksi->bindValue(':kode_transaksi', $data['kode_transaksi']);
    $insert_detailtransaksi->bindValue(':kode_barang', $data['kode_barang']);
    $insert_detailtransaksi->bindValue(':subharga', $data['subharga']);
    $insert_detailtransaksi->bindValue(':qty', $data['qty']);
    $insert_detailtransaksi->bindValue(':diskon', $data['diskon']);
    $insert_detailtransaksi->bindValue(':harga', $data['harga']);
    $insert_detailtransaksi->execute();

    return $insert_detailtransaksi;
}

function transaksi_show($kode_transaksi)
{
    global $pdo;
    $query = "SELECT transaksi.*, tb_admin.email, tb_admin.nama_toko FROM transaksi
                JOIN tb_admin ON tb_admin.id = transaksi.id_admin
                WHERE kode_transaksi=:kode_transaksi";
    $show = $pdo->prepare($query);
    $show->bindValue(':kode_transaksi', $kode_transaksi);
    $show->execute();

    $result = $show->fetchAll();
    return $result[0];
}

function detail_transaksi_show($kode_transaksi)
{
    global $pdo;
    $query = "SELECT detail_transaksi.*, detail_transaksi.subharga as subhrg, barang.nama, barang.id_satuan FROM detail_transaksi
                LEFT JOIN barang ON barang.kode = detail_transaksi.kode_barang AND barang.id_admin = detail_transaksi.id_admin
                WHERE kode_transaksi=:kode_transaksi
                GROUP BY detail_transaksi.id";
    $show = $pdo->prepare($query);
    $show->bindValue(':kode_transaksi', $kode_transaksi);
    $show->execute();

    $result = $show->fetchAll();
    return $result;
}

