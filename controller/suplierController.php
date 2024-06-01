<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');

function suplier_all() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM suplier WHERE id_admin=:id_admin");
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

function suplier_show($id){
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM suplier WHERE id=:id");
    $show->bindValue(':id', $id);
    $show->execute();
    $result = $show->fetchAll();

    return $result[0];
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
    $insert = $pdo->prepare("INSERT INTO suplier (id_admin, nama_suplier) VALUES (:id_admin, :nama_suplier)");
    $insert->bindValue(':id_admin', $_SESSION['id']);
    $insert->bindValue(':nama_suplier', $data);
    $insert->execute();

    return $insert;
}

function suplier_edit($data){
    global $pdo;
    $q = "UPDATE suplier SET nama_suplier=:nama_suplier WHERE id=:id";
    $up = $pdo->prepare($q);
    $up->bindValue(':id', $data['id']);
    $up->bindValue(':nama_suplier', $data['suplier']);
    $up->execute();
    return $up;
    
}

function suplier_destroy($id){
    global $pdo;
    $query = "DELETE FROM suplier WHERE id=:id AND id_admin=:id_admin";
    $del = $pdo->prepare($query);
    $del->bindValue(':id', $id);
    $del->bindValue(':id_admin', $_SESSION['id']);
    $del->execute();

    return $del;
}