<?php
require_once(__DIR__ . '../../config/auth.inc');
include(__DIR__ . '../../config/config.php');

// KODE TRANSAKSI
// INFO PENGGUNA
function info()
{
    global $pdo;
    $info = $pdo->prepare("SELECT * FROM pengguna WHERE id = :id");
    $info->bindValue(':id', 3);
    $info->execute();
    $result = $info->fetchAll();

    return $result[0];
}

function nourut($numb)
{
    if ($numb >= 0) {
        $nourut = '00000' . $numb;
    }
    if ($numb >= 10) {
        $nourut = '0000' . $numb;
    }
    if ($numb >= 100) {
        $nourut = '000' . $numb;
    }
    if ($numb >= 1000) {
        $nourut = '00' . $numb;
    }
    if ($numb >= 10000) {
        $nourut = '0' . $numb;
    }
    if ($numb >= 100000) {
        $nourut = $numb;
    }
    return $nourut;
}
function kode_transaksi()
{
    global $pdo;
    global $md;
    global $y;
    global $m;

    // INC PENGGUNA
    $kodePengguna = info();

    // KODE TRANSAKSI
    $getNext = $pdo->prepare("SELECT MAX(nourut) AS nomor FROM transaksi WHERE YEAR(create_at)=:y");
    $getNext->bindValue(':y', $y);
    $getNext->execute();
    $currentNumb = $getNext->fetchColumn();


    if ($currentNumb == "" || $md == '01-01') {
        $nextNumb = 0;
    } else {
        $nextNumb = $currentNumb;
    }
    $myNumb = $nextNumb + 1;

    $nourut = nourut($myNumb);

    $myKode = $kodePengguna['kode'] . $m . '' . $y[-2] . '' . $y[-1] . '' . $nourut;

    return $myKode;
}




// UTILITIES

function cart_all()
{
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM cart WHERE id_kasir = :id_kasir ORDER BY id DESC");
    $show->bindValue(':id_kasir', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

function cart_store($data)
{
    global $pdo;
    $kode_transaksi = kode_transaksi();

    $ins = $pdo->prepare("INSERT INTO cart (id_kasir, kode_barang, nama, harga, qty, subtotal)
                            VALUES (:id_kasir, :kode, :nama, :harga, :qty, :subtotal)");
    $ins->bindValue(':id_kasir', $data['id_kasir']);
    $ins->bindValue(':kode', $data['kode_barang']);
    $ins->bindValue(':nama', $data['nama']);
    $ins->bindValue(':harga', $data['harga']);
    $ins->bindValue(':qty', $data['qty']);
    $ins->bindValue(':subtotal', $data['subtotal']);
    $ins->execute();
}

function cart_check($kode_barang) {
    global $pdo;
    $cek = $pdo->prepare("SELECT kode_barang, qty FROM cart WHERE kode_barang = :kode_barang AND id_kasir = :id_kasir");
    $cek->bindValue('id_kasir', $_SESSION['id']);
    $cek->bindValue('kode_barang', $kode_barang);
    $cek->execute();
    $result = $cek->fetchAll();

    return $result;
}

function cart_update($data)
{
    global $pdo;
    $update = $pdo->prepare("UPDATE cart SET qty=:qty, subtotal=:subtotal WHERE kode_barang=:kode_barang AND id_kasir = :id_kasir");
    $update->bindValue(':id_kasir', $_SESSION['id']);
    $update->bindValue(':kode_barang', $data['kode_barang']);
    $update->bindValue(':qty', $data['qty']);
    $update->bindValue(':subtotal', $data['subtotal']);
    $update->execute();

    return $update;
}

function cart_destroy($id)
{
    global $pdo;
    $del = $pdo->prepare("DELETE FROM cart where id=:id");
    $del->bindValue(':id', $id);
    $del->execute();
}

function cart_reset()
{
    global $pdo;
    $reset = $pdo->prepare("DELETE FROM cart WHERE id_kasir = :id_kasir");
    $reset->bindValue(':id_kasir', $_SESSION['id']);
    $reset->execute();

    // $truncate = $pdo->prepare("TRUNCATE TABLE cart");
    // $truncate->execute();
}

function payment(){
    global $pdo;
    $pay = $pdo->prepare("SELECT SUM(subtotal) AS total FROM cart WHERE id_kasir = :id_kasir");
    $pay->bindValue(':id_kasir', $_SESSION['id']);
    $pay->execute();
    $result = $pay->fetchAll();

    return $result[0];
}