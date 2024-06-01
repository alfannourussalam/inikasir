<?php
// require_once 'auth.inc';
include_once '../controller/userController.php';
include_once '../controller/kasirController.php';

if (isset($_POST['signup'])) {
    include_once 'config.php';

    $register = array(
        'nama' => $_POST['fullname'],
        'nohp' => $_POST['nohp'],
        'email' => $_POST['email'],
        'password' => md5($_POST['password']),
        'status' => 'nonaktif'
    );
    
    $ins_reg = $pdo->prepare("INSERT INTO tb_admin (nama, pass, email, nohp, status)
                                VALUES (:nama, :password, :email, :nohp, :status)");
    $ins_reg->bindValue(":nama", $register['nama']);
    $ins_reg->bindValue(":password", $register['password']);
    $ins_reg->bindValue(":email", $register['email']);
    $ins_reg->bindValue(":nohp", $register['nohp']);
    $ins_reg->bindValue(":status", $register['status']);
    $ins_reg->execute();


    
    // CREATE DEFAULT USER AND KASIR
    $show = $pdo->prepare("SELECT id FROM tb_admin WHERE nama=:nama AND email=:email AND nohp=:nohp");
    $show->bindValue(":nama", $register['nama']);
    $show->bindValue(":email", $register['email']);
    $show->bindValue(":nohp", $register['nohp']);
    $show->execute();
    $show_res = $show->fetchAll();
    $res = $show_res[0];

    $data_user = array(
        'kode_pelanggan' => $register["nama"] . '_001',
        'nama' => $register["nama"] . '_guest',
        'email' => 'guest@' . $register["nama"] . '.com',
        'nohp' => '',
        'alamat' => '',
        'username' => $register["nama"] . 'user001',
        'pass' => md5($register["nama"] . 'user001'),
        'kode_role' => 3,
        'poin' => 0,
        'deleted' => 0
    );

    $data_kasir = array(
        'nama' => $register["nama"],
        'nohp' => $register["nohp"],
        'username' => $register["email"],
        'pass' => $register["password"]
    );

    $data_user['id_admin'] = $res['id'];
    $data_kasir['id_admin'] = $res['id'];

    if ($data_user) {
        user_store($data_user);     
    }
    if ($data_kasir){
        kasir_store($data_kasir);
    }
    

    session_start();
    $_SESSION['status'] = 'sukses';
    header('Location:../login.php');

}

if (isset($_POST['complete'])) {
    include_once 'config.php';

    $data = array(
        'id'        => $_SESSION['id'],
        'username'  =>  $_POST['username'],
        'nik'       =>  $_POST['nik'],
        'nama_toko' =>  $_POST['nama_toko'],
        'alamat'    => $_POST['alamat']
    );

    $up_reg = $pdo->prepare("UPDATE tb_admin SET username=:username, nik=:nik, nama_toko=:nama_toko, alamat=:alamat
                                WHERE id=:id");
    $up_reg->bindValue(':id', $data['id']);
    $up_reg->bindValue(':username', $data['username']);
    $up_reg->bindValue(':nik', $data['nik']);
    $up_reg->bindValue(':nama_toko', $data['nama_toko']);
    $up_reg->bindValue(':alamat', $data['alamat']);
    $up_reg->execute();

    session_start();
    $_SESSION['status'] = 'sukses';
    header('Location:/'.$basename.'/views/printer-setup.php');
}

else {
    header('Location:../login.php');
}
