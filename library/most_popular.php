<?php
header('Content-Type: application/json');
require_once(__DIR__ . '../../config/auth.inc');
include_once(__DIR__ . '../../config/config.php');
$this_year = DATE('Y');
$query = "SELECT detail_transaksi.kode_barang, barang.nama, SUM(qty) AS total_barang FROM detail_transaksi
                JOIN barang ON barang.kode = detail_transaksi.kode_barang AND barang.id_admin = detail_transaksi.id_admin
                JOIN transaksi ON transaksi.kode_transaksi = detail_transaksi.kode_transaksi
                WHERE detail_transaksi.id_admin = :id_admin AND YEAR(transaksi.create_at)=:this_year
                GROUP BY detail_transaksi.kode_barang
                LIMIT 3";
$show_detail = $pdo->prepare($query);
$show_detail->bindValue(':id_admin', $_SESSION['id']);
$show_detail->bindValue(':this_year', $this_year);
$show_detail->execute();

$result = $show_detail->fetchAll();

echo json_encode($result);
