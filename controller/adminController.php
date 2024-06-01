<?php
include_once (__DIR__ . '../../config/config.php');

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
    $q = "UPDATE tb_admin SET
        username=:username, email=:email, nohp=:nohp, nik=:nik, nama=:nama, nama_toko=:nama_toko, alamat=:alamat
        WHERE id=:id";
    $up = $pdo->prepare($q);
    $up->bindValue(':id', $data['id_admin']);
    $up->bindValue(':username', $data['username']);
    $up->bindValue(':email', $data['email']);
    $up->bindValue(':nohp', $data['nohp']);
    $up->bindValue(':nik', $data['nik']);
    $up->bindValue(':nama', $data['nama']);
    $up->bindValue(':nama_toko', $data['nama_toko']);
    $up->bindValue(':alamat', $data['alamat']);
    // $up->bindValue(':reward', $data['reward']);
    // $up->bindValue(':redeem', $data['redeem']);
    $up->execute();

    return $up;
}

function update_printer($data){
    global $pdo;
    $q = "UPDATE tb_admin SET printer=:printer WHERE id=:id";
    $up = $pdo->prepare($q);
    $up->bindValue(':printer', $data['printer']);
    $up->bindValue(':id', $data['id']);
    $up->execute();

    return $up;
}

function change_password($data){

}
