<?php
include(__DIR__ . '../../config/config.php');

function admin_show($id) {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM tb_admin WHERE id = :id");
    $show->bindValue(':id', $id);
    $show->execute();
    $result=$show->fetchAll();

    return $result[0];
}

function update_profil($data){
    global $pdo;
    $q = "UPDATE tb_admin SET nama=:nama, nohp=:nohp, email=:email, nama_toko=:nama_toko WHERE id=:id";
    $up = $pdo->prepare($q);
    $up->bindValue(':nama', $data['nama']);
    $up->bindValue(':nohp', $data['nohp']);
    $up->bindValue(':email', $data['email']);
    $up->bindValue(':nama_toko', $data['nama_toko']);
    $up->bindValue(':id', $data['id_kasir']);
    $up->execute();

    return $up;
}