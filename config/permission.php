<?php
$basename = 'inikasir';
$admin_access = array(
    '/'.$basename.'/views/barang/index.php',
    '/'.$basename.'/views/barangmasuk/index.php',
    '/'.$basename.'/views/kasir/index.php',
    '/'.$basename.'/views/users/index.php',
    '/'.$basename.'/views/satuan/index.php',
    '/'.$basename.'/views/settings/index.php',
    '/'.$basename.'/views/supliers/index.php'
);

// $page_access = array(
//     'barang',
//     'barangmasuk',
//     'kasir',
//     'users',
//     'satuan',
//     'settings',
//     'supliers'
// );

// if ($_SESSION['role'] == 'kasir') {
// 	$p = $_SERVER['PHP_SELF'];
//     $p = explode('/', $p);
	
//     // if (in_array($p, $admin_access)) {
//     //     header('Location:/' . $basename . '/views/transaksi');
//     // }

//     if (in_array($p[3], $page_access)) {
//         header('Location:/' . $basename . '/views/transaksi');
//     }
// }