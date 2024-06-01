<?php
include '../../controller/barangController.php';
include '../../controller/cartController.php';


if (isset($_POST['toCart'])) {
    $id_admin = $_POST['id_admin'];
    $id_kasir = $_POST['id_kasir'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $diskon = $_POST['diskon'];
    $subtotal = $_POST['subtotal'];

    $data = array (
        "id_admin" => $id_admin,
        "id_kasir" => $id_kasir,
        "kode_barang" => $kode,
        "nama" => $nama,
        "harga" => $harga,
        "qty" => $qty,
        "diskon" => $diskon,
        "subtotal" => $subtotal
    );

    $cek_keranjang = cart_check($kode);
    if (count($cek_keranjang) > 0) {
        $old_qty = $cek_keranjang[0]['qty'];
        $new_qty = $data['qty'];
        $last_qty = $old_qty + $new_qty;
        // $subtotal = $data['harga'] * $last_qty;
        // $subtotal = (($data['diskon']/100)*$data['harga'])*$last_qty;
        $subtotal = ($data['harga']*$last_qty) - ($data['harga']*$last_qty)*($data['diskon']/100);

        $data_update = array(
            'kode_barang' => $kode,
            'qty' => $last_qty,
            'diskon' => $diskon,
            'subtotal' => $subtotal
        );

        // print_r (json_encode($data_update));
        // print_r (json_encode($data['harga']*$last_qty));
        // print_r (json_encode($data['diskon']/100));
        cart_update($data_update);
        
    } else {
        cart_store($data);
    }

    // print_r($data);

    header('Location:/'.$basename.'/views/transaksi/');

    
} else {
    echo "Data not found !";
}
