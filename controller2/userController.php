<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');
include_once 'adminController.php';

// $kasir = admin_show(1);

function user_all() {
    global $pdo;
    global $kasir;

    $show = $pdo->prepare("SELECT * FROM pengguna WHERE id_kasir=:id_kasir AND deleted=:deleted");
    $show->bindValue(':deleted', 0);
    $show->bindValue(':id_kasir', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

// function user_only() {
//     global $pdo;
//     $show = $pdo->prepare("SELECT * FROM kasir WHERE deleted=:deleted AND kode_role <> 1");
//     $show->bindValue(':deleted', 0);
//     $show->execute();
//     $result = $show->fetchAll();

//     return $result;
// }

function user_show($id){
    global $pdo;
    $find = $pdo->prepare("SELECT * FROM kasir WHERE id=:id");
    $find->bindValue(':id', $id);
    $find->execute();
    $result = $find->fetchAll();

    return $result[0];
}

function user_store($data) {
    global $pdo;
    $add = $pdo->prepare("INSERT INTO kasir (kode_kasir, id_kasir, nama, email, nohp, alamat, username, pass, kode_role, deleted)
                                        VALUES (:kode_kasir, :id_kasir, :nama, :email, :nohp, :alamat, :username, :pass, :kode_role, :deleted)");
    $add->bindValue(':kode_kasir', $data['kode_kasir']);
    $add->bindValue(':id_kasir', $data['id_kasir']);
    $add->bindValue(':nama', $data['nama']);
    $add->bindValue(':email', $data['email']);
    $add->bindValue(':nohp', $data['nohp']);
    $add->bindValue(':alamat', $data['alamat']);
    $add->bindValue(':username', $data['username']);
    $add->bindValue(':pass', $data['pass']);
    $add->bindValue(':kode_role', $data['kode_role']);
    $add->bindValue(':deleted', $data['deleted']);
    $add->execute();

    return $add;
}

function user_update($data) {
    global $pdo;
    global $kasir;
    $update = $pdo->prepare("UPDATE kasir SET 
                            nama=:nama, email=:email, nohp=:nohp, alamat=:alamat, kode_role=:kode_role
                            WHERE id=:id AND id_kasir=:id_kasir");
    $update->bindValue(':id_kasir', $data['id_kasir']);
    $update->bindValue(':nama', $data['nama']);
    $update->bindValue(':email', $data['email']);
    $update->bindValue(':nohp', $data['nohp']);
    $update->bindValue(':alamat', $data['alamat']);
    $update->bindValue(':kode_role', $data['kode_role']);
    $update->bindValue(':id', $data['id']);
    $update->execute();

    return $update;
}

function user_destroy($id){
    global $pdo;
    $soft_del = $pdo->prepare("UPDATE kasir SET deleted=:deleted WHERE id=:id");
    $soft_del->bindValue(':deleted', 1);
    $soft_del->bindValue(':id', $id);
    $soft_del->execute();
    
    return $soft_del;
}

function account_update($data) {
    global $pdo;
    $account_up = $pdo->prepare("UPDATE kasir SET username=:username, pass=:pass WHERE id=:id");
    $account_up->bindValue(':username', $data['username']);
    $account_up->bindValue(':pass', md5($data['pass']));
    $account_up->bindValue(':id', $data['id']);
    $account_up->execute();

    // return $$account_up;
}

function username_update($data) {
    global $pdo;
    $u = $data['username'];
    $id = $data['id'];
    $account_up = $pdo->prepare("UPDATE kasir SET username=:username WHERE id=:id");
    $account_up->bindValue(':username', $u);
    $account_up->bindValue(':id', $id);
    $account_up->execute();

    // return $$account_up;
}

// function password_update($data) {
//     global $pdo;
//     $account_up = $pdo->prepare("UPDATE kasir SET pass=:pass WHERE id=:id");
//     $account_up->bindValue(':pass', md5($data['pass']));
//     $account_up->bindValue(':id', $data['id']);
//     $account_up->execute();

//     return $$account_up;
// }