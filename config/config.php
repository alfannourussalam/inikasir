<?php
date_default_timezone_set("Asia/Jakarta");

$host = '127.0.0.1';
$db   = 'inikasir';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$basename = 'inikasir';
$content = "Ini Kasir - Inovative cash management to revolutionize how you handle your finance";


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
	$pdo = new PDO($dsn, $user, $pass);

	// if ($pdo) {
	// 	return "Connected to the $db database successfully!";
	// }
} catch (PDOException $e) {
	echo $e->getMessage();
}

$page = array(
	'setup.php'			=> 'Pengaturan Toko',
	'setup-printer.php'	=> 'Pengaturan Printer',
	'change-password.php'	=> 'Ganti Password',

	'barangmasuk.php'	=> 'Tambahkan Barang Masuk',
	'edit-barangmasuk.php'	=> 'Update Barang Masuk',
	'edit-barang.php'	=> 'Update Item/Barang',

	'pendapatan.php'	=> 'Pendapatan',
	
	'tambah-kasir.php'	=> 'Tambahkan Kasir',
	'show-kasir.php'	=> 'Detail Kasir',
	'edit-kasir.php'	=> 'Ubah Data Kasir',
	'account-kasir.php'	=> 'Pengaturan Akun Kasir',

	'tambah-suplier.php'=> 'Tambahkan Suplier',
	'edit-suplier.php'=> 'Update Data Suplier',
	
	'tambah-satuan.php'	=> 'Tambahkan Satuan',
	'edit-satuan.php'	=> 'Update Satuan Item',

	'pay.php'			=> 'Transkasi Berhasil'

);

$page_access = array(
    'barang',
    'barangmasuk',
    'kasir',
    'users',
    'satuan',
    'settings',
    'supliers'
);


if (isset($_SESSION['role'])) {
	if ($_SESSION['role'] == 'kasir') {
		$p = $_SERVER['PHP_SELF'];
		$p = explode('/', $p);
		
		// if (in_array($p, $admin_access)) {
		//     header('Location:/' . $basename . '/views/transaksi');
		// }
	
		if (in_array($p[3], $page_access)) {
			header('Location:/' . $basename . '/views/transaksi');
		}
	}
}

?>