<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');
include_once 'adminController.php';

// $kasir = admin_show(1);

function kasir_all() {
    global $pdo;
    
    $show = $pdo->prepare("SELECT * FROM kasir WHERE id_admin=:id_admin");
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

function kasir_only($id) {
    global $pdo;
    $show = $pdo->prepare("SELECT * FROM kasir WHERE id=:id AND id_admin=:id_admin");
    $show->bindValue(':id', $id);
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

function kasir_show($username){
    global $pdo;
    $find = $pdo->prepare("SELECT * FROM kasir WHERE username=:username");
    $find->bindValue(':username', $username);
    $find->execute();
    $result = $find->fetchAll();

    return $result[0];
}

function kasir_store($data) {
    global $pdo;
    $add = $pdo->prepare("INSERT INTO kasir (id_admin, nama, nohp, username, pass)
                                        VALUES (:id_admin, :nama, :nohp, :username, :pass)");
    $add->bindValue(':id_admin', $data['id_admin']);
    $add->bindValue(':nama', $data['nama']);
    $add->bindValue(':nohp', $data['nohp']);
    $add->bindValue(':username', $data['username']);
    $add->bindValue(':pass', $data['pass']);
    $add->execute();

    return $add;
}

function kasir_update($data) {
    global $pdo;
    global $kasir;

    $update = $pdo->prepare("UPDATE kasir SET 
                            nama=:nama, nohp=:nohp
                            WHERE id=:id AND id_admin=:id_admin");
    $update->bindValue(':id_admin', $_SESSION['id']);
    $update->bindValue(':nama', $data['nama']);
    $update->bindValue(':nohp', $data['nohp']);
    $update->bindValue(':id', $data['id']);
    $update->execute();

    return $update;
}

function kasir_destroy($id){
    global $pdo;
    $del = $pdo->prepare("DELETE FROM kasir WHERE id=:id");
    $del->bindValue(':id', $id);
    $del->execute();
    
    return $del;
}

function kasir_account_update($data) {
    global $pdo;
    $account_up = $pdo->prepare("UPDATE kasir SET username=:username, pass=:pass WHERE id=:id");
    $account_up->bindValue(':username', $data['username']);
    $account_up->bindValue(':pass', md5($data['pass']));
    $account_up->bindValue(':id', $data['id']);
    $account_up->execute();

    return $account_up;
}

function kasir_username_update($data) {
    global $pdo;
    $u = $data['username'];
    $id = $data['id'];
    $account_up = $pdo->prepare("UPDATE kasir SET username=:username WHERE id=:id");
    $account_up->bindValue(':username', $u);
    $account_up->bindValue(':id', $id);
    $account_up->execute();

    return $account_up;
}

function kasir_printer_update($data) {
    global $pdo;
    $printer = $data['printer'];
    $id = $data['id'];
    $account_up = $pdo->prepare("UPDATE kasir SET printer=:printer WHERE id=:id");
    $account_up->bindValue(':printer', $printer);
    $account_up->bindValue(':id', $id);
    $account_up->execute();

    return $account_up;
}



// function password_update($data) {
//     global $pdo;
//     $account_up = $pdo->prepare("UPDATE pengguna SET pass=:pass WHERE id=:id");
//     $account_up->bindValue(':pass', md5($data['pass']));
//     $account_up->bindValue(':id', $data['id']);
//     $account_up->execute();

//     return $$account_up;
// }