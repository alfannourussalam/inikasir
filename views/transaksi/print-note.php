<?php
// require("../../library/fpdf182/fpdf.php");
require_once '../../vendor/autoload.php';
include_once '../../controller/transaksiController.php';
include_once '../../controller/kasirController.php';
include_once '../../controller/barangController.php';
include_once '../../controller/adminController.php';
include_once '../../library/library.php';

if (isset($_GET['i'])) {
    $invoice = base64_decode($_GET['i']);
    // $transaksi['transaksi'][] = transaksi_show($invoice);
    $transaksi = transaksi_show($invoice);
    $details = detail_transaksi_show($invoice);

    $transaksi['details'] = $details;
}

// print_r($transaksi['transaksi'][0]);
$kasir = kasir_only($transaksi['id_kasir']);
$owner = admin_show($_SESSION['id']);

$namaToko = $transaksi['nama_toko'];
$tanggal = $transaksi['create_at'];
$kasir = $kasir[0]['nama'];

foreach ($details as $val) {
    $satuan = show_satuan($val['id_satuan']);
    $namaBarang = $val['nama'];
    $hargaBarang = number_format($val['harga']);
    $banyakBarang = $val['qty'];
    $satuanBarang = $satuan['ket_satuan'];
}

$subtotal = number_format($transaksi['subtotal']);
// $potongan = number_format($transaksi['potongan']);
$total = number_format($transaksi['total']);
$bayar = number_format($transaksi['bayar']);
$kembali = number_format($transaksi['kembalian']);

$email = $transaksi['email'];

// header('Location: ' . $_SERVER['HTTP_REFERER']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota</title>
</head>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
    }
    .canvas-print {
        max-width: 80mm;
        padding: 1.5mm;
        height: 100mm;
    }
    .footer{
        font-size: 9pt;
    }
    .bg-warning {
        background-color: yellow;
    }

    .bg-danger {
        background-color: red;
    }

    .text-center {
        text-align: center;
    }

    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }

    .mx-2 {
        margin-left: 2mm;
        margin-right: 2mm;
    }

    .mt-2{
        margin-top: 2mm;
    }

    table {
        border-collapse: collapse;
    }

    .logo {
        max-width: 1.5cm;
    }
</style>

<body>
    <div class="canvas-print mx-auto">
        <div class="header">
            <table>
                <tr style="border-bottom: 2px solid black">
                    <td class="text-center"><img src="../../assets/img/alf-icon.png" alt="logo" class="logo mx-2"></td>
                    <td style="width:100%">
                        <div class="text-center">
                            <h2><?= $namaToko ?></h4>
                        </div>
                    </td>
            </table>
        </div>
        <div class="body mt-2">
            <table style="width: 100%; font-size:10pt">
                <tr style="font-size: 9pt; font-style:italic">
                    <td><?= $tanggal ?></td>
                    <td><?= $invoice ?></td>
                </tr>
                <tr>
                    <th colspan="2" class="text-center" style="padding-top: 10px;">Detail Pesanan</th>
                </tr>
                <?php
                foreach ($details as $val) {
                    $satuan = show_satuan($val['id_satuan']);
                    $namaBarang = $val['nama'];
                    $hargaBarang = number_format($val['subharga']);
                    $banyakBarang = $val['qty'];
                    $diskon = $val['diskon'];
                    $satuanBarang = $satuan['ket_satuan']; ?>
                    <tr>
                        <td style="width:70%; padding-top: 7px;"><?= $namaBarang ?></td>
                        <td rowspan="3" style="width:30%; text-align:right;">Rp<?= number_format((int)$val['harga']) ?></td>
                    </tr>
                    <tr>
                        <td><?= $banyakBarang . "" . $satuanBarang . " x " . $hargaBarang ?></td>
                    </tr>
                    <tr>
                        <td style="font-size: 8pt;">Disc <?php echo $diskon ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-bottom: 1px solid black;"></td>
                    </tr>
                <?php
                }
                ?>
                <!-- <tr style="text-align: right;">
                    <td style="padding-top:10px">Subtotal</td>
                    <td>Rp<?php // echo $subtotal ?></td>
                </tr> -->
                <!-- <tr style="text-align: right;">
                    <td>Diskon</td>
                    <td>Rp<?php //echo $potongan ?></td>
                </tr> -->
                <tr style="text-align: right;">
                    <td>Total</td>
                    <td>Rp<?= $total ?></td>
                </tr>
                <tr style="text-align: right;">
                    <td>Bayar</td>
                    <td>Rp<?= $bayar ?></td>
                </tr>
                <tr style="text-align: right;">
                    <td>Kembalian</td>
                    <td>Rp<?= $kembali ?></td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p class="text-center"><?= $email ?></p>
        </div>
    </div>
</body>

</html>