<?php

require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');

function pendapatan(){
    global $pdo;
    $year = date('Y');
    $q = "SELECT SUM(total) AS income FROM transaksi WHERE id_admin=:id_admin AND YEAR(create_at)=:tahun";
    $income = $pdo->prepare($q);
    $income->bindValue(':id_admin', $_SESSION['id']);
    $income->bindValue(':tahun', $year);
    $income->execute();
    $income_result = $income->fetchAll();

    $pendapatan = $income_result[0]['income'];

    $q2 = "SELECT SUM(total_modal) AS outcome FROM barang_masuk WHERE id_admin=:id_admin AND YEAR(create_at)=:tahun";
    $outcome = $pdo->prepare($q2);
    $outcome->bindValue(':id_admin', $_SESSION['id']);
    $outcome->bindValue(':tahun', $year);
    $outcome->execute();
    $outcome_result = $outcome->fetchAll();

    $pengeluaran = $outcome_result[0]['outcome'];

    $data = array(
        'income' => $pendapatan,
        'outcome' => $pengeluaran,
        'netincome' => $pendapatan-$pengeluaran
    );

    return $data;

}

function pendapatan_range($fdate, $ldate){
    global $pdo;
    $year = date('Y');
    $q = "SELECT SUM(total) AS income FROM transaksi WHERE id_admin=:id_admin AND DATE(create_at) BETWEEN :fdate AND :ldate";
    $income = $pdo->prepare($q);
    $income->bindValue(':id_admin', $_SESSION['id']);
    $income->bindValue(':fdate', $fdate);
    $income->bindValue(':ldate', $ldate);
    $income->execute();
    $income_result = $income->fetchAll();

    $pendapatan = $income_result[0]['income'];

    $q2 = "SELECT SUM(total_modal) AS outcome FROM barang_masuk WHERE id_admin=:id_admin AND DATE(create_at) BETWEEN :fdate AND :ldate";
    $outcome = $pdo->prepare($q2);
    $outcome->bindValue(':id_admin', $_SESSION['id']);
    $outcome->bindValue(':fdate', $fdate);
    $outcome->bindValue(':ldate', $ldate);
    $outcome->execute();
    $outcome_result = $outcome->fetchAll();

    $pengeluaran = $outcome_result[0]['outcome'];

    $data = array(
        'income' => $pendapatan,
        'outcome' => $pengeluaran,
        'netincome' => $pendapatan-$pengeluaran
    );

    return $data;

}

function barangmasuk(){
    global $pdo;
    $show = $pdo->prepare("SELECT barang_masuk.kode_barang, barang_masuk.harga, barang_masuk.jumlah, barang_masuk.create_at, barang.nama, suplier.nama_suplier
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang AND barang_masuk.id_admin = barang.id_admin
                            JOIN suplier ON suplier.id = barang_masuk.suplier
                            WHERE barang_masuk.id_admin = :id_admin
                            GROUP BY barang_masuk.id
                            ORDER BY barang_masuk.create_at ASC");
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    // echo json_encode($result);
    return $result;
}

function barangmasuk_range($fdate, $ldate){
    global $pdo;
    $show = $pdo->prepare("SELECT barang_masuk.kode_barang, barang_masuk.harga, barang_masuk.jumlah, barang_masuk.create_at, barang.nama, suplier.nama_suplier
                            FROM barang_masuk
                            JOIN barang ON barang.kode = barang_masuk.kode_barang AND barang_masuk.id_admin = barang.id_admin
                            JOIN suplier ON suplier.id = barang_masuk.suplier
                            WHERE barang_masuk.id_admin = :id_admin AND DATE(barang_masuk.create_at) BETWEEN :fdate AND :ldate
                            GROUP BY barang_masuk.id
                            ORDER BY barang_masuk.create_at ASC");
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->bindValue(':fdate', $fdate);
    $show->bindValue(':ldate', $ldate);
    $show->execute();
    $result = $show->fetchAll();

    // echo json_encode($result);
    return $result;
}


