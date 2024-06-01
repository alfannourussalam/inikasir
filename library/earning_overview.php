<?php
header('Content-Type: application/json');

require_once(__DIR__ . '../../config/auth.inc');
include_once(__DIR__ . '../../config/config.php');

$year = date('Y');
$data = array();
$q = "SELECT create_at, SUM(total) AS income FROM transaksi WHERE id_admin=:id_admin AND YEAR(create_at)=:tahun GROUP BY MONTH(create_at)";
$income = $pdo->prepare($q);
$income->bindValue(':id_admin', $_SESSION['id']);
$income->bindValue(':tahun', $year);
$income->execute();
$income_result = $income->fetchAll();

echo json_encode($income_result);