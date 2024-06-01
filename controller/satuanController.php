<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');

function satuan_all() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM satuan WHERE id_admin=:id_admin");
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

function satuan_show($id){
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM satuan WHERE id=:id");
    $show->bindValue(':id', $id);
    $show->execute();
    $result = $show->fetchAll();

    return $result[0];
}


function satuan_selectbox() {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM satuan WHERE id_admin=:id_admin");
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    foreach ($result as $satuan) {
        $output ='<option value="'. $satuan["id"] .'">'. $satuan["ket_satuan"] .'</option>';
    }

    return $output;
}



function satuan_store($data) {
    global $pdo;
    $insert = $pdo->prepare("INSERT INTO satuan (id_admin, ket_satuan) VALUES (:id_admin, :ket_satuan)");
    $insert->bindValue(':id_admin', $_SESSION['id']);
    $insert->bindValue(':ket_satuan', $data);
    $insert->execute();

    return $insert;
}

function satuan_edit($data){
    global $pdo;
    $q = "UPDATE satuan SET ket_satuan=:ket_satuan WHERE id=:id";
    $up = $pdo->prepare($q);
    $up->bindValue(':id', $data['id']);
    $up->bindValue(':ket_satuan', $data['ket_satuan']);
    $up->execute();
    return $up;
    
}

function satuan_destroy($id){
    global $pdo;
    $query = "DELETE FROM satuan WHERE id=:id AND id_admin=:id_admin";
    $del = $pdo->prepare($query);
    $del->bindValue(':id', $id);
    $del->bindValue(':id_admin', $_SESSION['id']);
    $del->execute();

    return $del;
}