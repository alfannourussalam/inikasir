<?php

// $host = '127.0.0.1';
// $db   = 'inikasir';
// $user = 'root';
// $pass = '';
// $charset = 'utf8mb4';

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

include_once 'config.php';

// try {
//     $pdo = new PDO($dsn, $user, $pass);
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }

function validate($username, $pass, $role)
{
    global $pdo;
    if ($role == "tb_admin") {
        $sql = "SELECT * FROM $role WHERE (username=:username OR nohp=:username OR email=:username AND pass=:pass) AND status <> :status";
        $check = $pdo->prepare($sql);
        $check->bindValue(':username', $username);
        $check->bindValue(':pass', md5($pass));
        $check->bindValue(':status', 'nonaktif');
        $check->execute();
    }
    if ($role == "kasir") {
        $sql = "SELECT * FROM $role WHERE username=:username AND pass=:pass";
        $check = $pdo->prepare($sql);
        $check->bindValue(':username', $username);
        $check->bindValue(':pass', md5($pass));
        $check->execute();
    }

    $result = $check->fetchAll();
    return $result;
}

function kasir_default($id_admin){
    global $pdo;
    $sql = "SELECT id FROM `kasir` WHERE id_admin=:id_admin LIMIT 1;";
    $check = $pdo->prepare($sql);
    $check->bindValue(':id_admin', $id_admin);
    $check->execute();
    $result = $check->fetchAll();
    return $result[0];
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    switch ($role) {
        case 1:
            $validate = validate($username, $pass, 'tb_admin');
            if (count($validate) > 0) {
                $kasir_default = kasir_default($validate[0]['id']);
                session_start();
                // $_SESSION['loggedin'] = TRUE;
                $_SESSION['id'] = $validate[0]['id'];
                $_SESSION['myid'] = $kasir_default['id'];
                $_SESSION['name'] = $validate[0]['nama'];
                $_SESSION['nama_toko'] = $validate[0]['nama_toko'];
                $_SESSION['role'] = 'admin';

                $nik = $validate[0]['nik'];
                $printer = $validate[0]['printer'];

                if ($nik == '') {
                    header('Location:/' . $basename . '/views/setup.php');
                } else {

                    if ($printer == '') {
                        header('Location:/' . $basename . '/views/printer-setup.php');
                    } else {
                        header('Location:/' . $basename . '/');
                    }
                    // header('Location:/' . $basename . '/');
                }
            } else {
                header('Location:/' . $basename . '/login.php');
            }
            break;

        case 2:
            $validate = validate($username, $pass, 'kasir');
            if (count($validate) > 0) {
                session_start();
                // $_SESSION['loggedin'] = TRUE;
                $_SESSION['id'] = $validate[0]['id_admin'];
                $_SESSION['myid'] = $validate[0]['id'];
                $_SESSION['name'] = $validate[0]['nama'];
                $_SESSION['role'] = 'kasir';

                // $nik = $validate[0]['nik'];
                $printer = $validate[0]['printer'];

                print_r($validate);
                echo $printer;
                echo "-----------";
                echo strlen($printer);

                if (strlen($printer) == 0) {
                    header('Location:/' . $basename . '/views/printer-setup.php');
                } else {
                    header('Location:/' . $basename . '/views/transaksi');
                }               


            } else {
                header('Location:/' . $basename . '/login.php');
            }
            break;
        case 3:
            $validate = validate($username, $pass, 'pengguna');
            if (count($validate) > 0) {
                session_start();
                // $_SESSION['loggedin'] = TRUE;
                $_SESSION['id'] = $validate[0]['id_admin'];
                $_SESSION['myid'] = $validate[0]['id'];
                $_SESSION['name'] = $validate[0]['nama'];
                $_SESSION['nama_toko'] = $validate[0]['nama_toko'];
                $_SESSION['role'] = 'pelanggan';

                header('Location:/' . $basename . '/');
            } else {
                header('Location:/' . $basename . '/login.php');
            }
            break;

        default:
            header('Location:/' . $basename . '/login.php');
            break;
    }
}
