<?php
require_once (__DIR__ . '../../config/auth.inc');
include(__DIR__ . '../../config/config.php');

function suplier_all() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM suplier WHERE id_kasir=:id_kasir");
    $show->bindValue(':id_kasir', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}


function suplier_selectbox() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM suplier");
    $show->execute();
    $result = $show->fetchAll();

    foreach ($result as $sup) {
        $output ='<option value="'. $sup["id"] .'">'. $sup["nama_suplier"] .'</option>';
    }

    return $output;
}



function suplier_store($data) {
    global $pdo;
    $insert = $pdo->prepare("INSERT INTO suplier (id_kasir, nama_suplier) VALUES (:id_kasir, :nama_suplier)");
    $insert->bindValue(':id_kasir', $_SESSION['id']);
    $insert->bindValue(':nama_suplier', $data);
    $insert->execute();

    return $insert;
}

function suplier_destroy($id){
    global $pdo;
    $query = "DELETE FROM suplier WHERE id=:id AND id_kasir=:id_kasir";
    $del = $pdo->prepare($query);
    $del->bindValue(':id', $id);
    $del->bindValue(':id_kasir', $_SESSION['id']);
    $del->execute();

    return $del;
}