<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');

$currentDatetime = date('Y-m-d H:i:s');
$md = ('m-d');
$y = date('Y');
$m = date('m');
$d = date('d');

// INFO PENGGUNA
function admin_info() {
    global $pdo;
    $info = $pdo->prepare("SELECT * FROM tb_admin WHERE id = :id");
    $info->bindValue(':id', $_SESSION['id']);
    $info->execute();
    $result = $info->fetchAll();

    return $result[0];
}

function set_nourut($numb)
{
    if ($numb >= 0) {
        $nourut = '000000' . $numb;
    }
    if ($numb >= 10) {
        $nourut = '00000' . $numb;
    }
    if ($numb >= 100) {
        $nourut = '0000' . $numb;
    }
    if ($numb >= 1000) {
        $nourut = '000' . $numb;
    }
    if ($numb >= 10000) {
        $nourut = '00' . $numb;
    }
    if ($numb >= 100000) {
        $nourut = '0' . $numb;
    }
    if ($numb >= 1000000) {
        $nourut = $numb;
    }
    return $nourut;
}
function set_kode_transaksi()
{
    global $pdo;
    global $md;
    global $y;
    global $m;
    
    // INC PENGGUNA
    $kodePengguna = admin_info();

    // KODE TRANSAKSI
    $getNext = $pdo->prepare("SELECT MAX(nourut) AS nomor FROM transaksi WHERE id_admin=:id_admin AND YEAR(create_at)=:y");
    $getNext->bindValue(':id_admin', $_SESSION['id']);
    $getNext->bindValue(':y', $y);
    $getNext->execute();
    $currentNumb = $getNext->fetchColumn();


    if ($currentNumb == "" || $md == '01-01') {
        $nextNumb = 0;
    } else {
        $nextNumb = $currentNumb;
    }
    $myNumb = $nextNumb + 1;

    $nourut = set_nourut($myNumb);

    $myKode = $kodePengguna['kode'].$m.''.$y[-2].''.$y[-1].''.$nourut;
    
    return $myKode;
}

function pointomoney($poin) {
    // 1 poin = Rp. (n)
    $admin = admin_info();
    
    $money = $poin * (int)$admin['redeem'];
    return $money;
}

function moneytopoin($money) {
    // Rp. (n) = 1 poin
    $admin = admin_info();

    $poin = $money / (int)$admin['reward']; //min belanja Rp. 100,000,-
    return floor($poin);
}


function get_printer(){
    global $pdo;
    if ($_SESSION['role']=='admin') {
        $q = "SELECT printer FROM tb_admin WHERE id=:id";
        $id = $_SESSION['id'];
    } else{
        $q = "SELECT printer FROM kasir WHERE id=:id";
        $id = $_SESSION['myid'];
    }

    $printer = $pdo->prepare($q);
    $printer->bindValue(':id', $id);
    $printer->execute();
    $result = $printer->fetchAll();
    return $result[0];
}

function dashboard(){
    global $pdo;
    $month = date('m');

    // INCOME
    $q = "SELECT SUM(total) AS income FROM transaksi WHERE id_admin=:id_admin AND MONTH(create_at)=:month";
    $income = $pdo->prepare($q);
    $income->bindValue(':id_admin', $_SESSION['id']);
    $income->bindValue(':month', $month);
    $income->execute();
    $income_result = $income->fetchAll();
    $pendapatan = $income_result[0]['income'];

    // OUTCOME
    $q2 = "SELECT SUM(total_modal) AS outcome FROM barang_masuk WHERE id_admin=:id_admin AND MONTH(create_at)=:month";
    $outcome = $pdo->prepare($q2);
    $outcome->bindValue(':id_admin', $_SESSION['id']);
    $outcome->bindValue(':month', $month);
    $outcome->execute();
    $outcome_result = $outcome->fetchAll();
    $pengeluaran = $outcome_result[0]['outcome'];

    // CUSTOMERS
    $q2 = "SELECT count(username) AS customer FROM pengguna WHERE id_admin=:id_admin AND deleted=:deleted";
    $user = $pdo->prepare($q2);
    $user->bindValue(':id_admin', $_SESSION['id']);
    $user->bindValue(':deleted', 0);
    $user->execute();
    $user_result = $user->fetchAll();
    $customers = $user_result[0]['customer'];

    // CASHER
    $q2 = "SELECT count(username) AS kasir FROM kasir WHERE id_admin=:id_admin";
    $kasir = $pdo->prepare($q2);
    $kasir->bindValue(':id_admin', $_SESSION['id']);
    $kasir->execute();
    $kasir_result = $kasir->fetchAll();
    $casher = $kasir_result[0]['kasir'];

    $data = array(
        'income' => $pendapatan,
        'outcome' => $pengeluaran,
        'customers' => $customers,
        'kasir' => $casher,
    );

    return $data;
}

