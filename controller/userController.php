<?php
require_once (__DIR__ . '../../config/auth.inc');
include_once (__DIR__ . '../../config/config.php');
include_once 'adminController.php';

// $kasir = admin_show(1);

function user_all() {
    global $pdo;
    global $kasir;

    $show = $pdo->prepare("SELECT * FROM pengguna WHERE id_admin=:id_admin AND deleted=:deleted AND id<>:id");
    $show->bindValue(':id', 0);
    $show->bindValue(':deleted', 0);
    $show->bindValue(':id_admin', $_SESSION['id']);
    $show->execute();
    $result = $show->fetchAll();

    return $result;
}

// function user_only() {
//     global $pdo;
//     $show = $pdo->prepare("SELECT * FROM pengguna WHERE deleted=:deleted AND kode_role <> 1");
//     $show->bindValue(':deleted', 0);
//     $show->execute();
//     $result = $show->fetchAll();

//     return $result;
// }

function user_show($id){
    global $pdo;
    $find = $pdo->prepare("SELECT * FROM pengguna WHERE id=:id");
    $find->bindValue(':id', $id);
    $find->execute();
    $result = $find->fetchAll();

    return $result[0];
}

function user_store($data) {
    global $pdo;
    $add = $pdo->prepare("INSERT INTO pengguna (kode_pelanggan, id_admin, nama, email, nohp, alamat, username, pass, kode_role, poin, deleted)
                                        VALUES (:kode_pelanggan, :id_admin, :nama, :email, :nohp, :alamat, :username, :pass, :kode_role, :poin, :deleted)");
    $add->bindValue(':kode_pelanggan', $data['kode_pelanggan']);
    $add->bindValue(':id_admin', $data['id_admin']);
    $add->bindValue(':nama', $data['nama']);
    $add->bindValue(':email', $data['email']);
    $add->bindValue(':nohp', $data['nohp']);
    $add->bindValue(':alamat', $data['alamat']);
    $add->bindValue(':username', $data['username']);
    $add->bindValue(':pass', $data['pass']);
    $add->bindValue(':kode_role', $data['kode_role']);
    $add->bindValue(':poin', $data['poin']);
    $add->bindValue(':deleted', $data['deleted']);
    $add->execute();

    return $add;
}

function user_update($data) {
    global $pdo;
    global $kasir;
    $update = $pdo->prepare("UPDATE pengguna SET 
                            kode_pelanggan=:kode_pelanggan, nama=:nama, email=:email, nohp=:nohp, alamat=:alamat
                            WHERE id=:id AND id_admin=:id_admin");
    $update->bindValue(':kode_pelanggan', $data['kode_pelanggan']);
    $update->bindValue(':id_admin', $data['id_admin']);
    $update->bindValue(':nama', $data['nama']);
    $update->bindValue(':email', $data['email']);
    $update->bindValue(':nohp', $data['nohp']);
    $update->bindValue(':alamat', $data['alamat']);
    $update->bindValue(':id', $data['id']);
    $update->execute();

    return $update;
}

function user_destroy($id){
    global $pdo;
    $soft_del = $pdo->prepare("UPDATE pengguna SET deleted=:deleted WHERE id=:id");
    $soft_del->bindValue(':deleted', 1);
    $soft_del->bindValue(':id', $id);
    $soft_del->execute();
    
    return $soft_del;
}

function account_update($data) {
    global $pdo;
    $account_up = $pdo->prepare("UPDATE pengguna SET username=:username, pass=:pass WHERE id=:id");
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
    $account_up = $pdo->prepare("UPDATE pengguna SET username=:username WHERE id=:id");
    $account_up->bindValue(':username', $u);
    $account_up->bindValue(':id', $id);
    $account_up->execute();

    // return $$account_up;
}

function update_poin($id_user, $poin_earned, $poin_used){
    global $pdo;

    $get_poin = $pdo->prepare("SELECT poin FROM pengguna WHERE id=:id");
    $get_poin->bindValue(':id', $id_user);
    $get_poin->execute();
    $cur_poin = $get_poin->fetchAll();
    $old_poin = $cur_poin[0]['poin'];

    $q = "UPDATE pengguna SET poin=:poin WHERE id=:id";
    $update_poin = $pdo->prepare($q);
    $update_poin->bindValue(':id', $id_user);
    $update_poin->bindValue(':poin', $old_poin + $poin_earned - $poin_used);
    $update_poin->execute();

    return $update_poin;
}

// function password_update($data) {
//     global $pdo;
//     $account_up = $pdo->prepare("UPDATE pengguna SET pass=:pass WHERE id=:id");
//     $account_up->bindValue(':pass', md5($data['pass']));
//     $account_up->bindValue(':id', $data['id']);
//     $account_up->execute();

//     return $$account_up;
// }