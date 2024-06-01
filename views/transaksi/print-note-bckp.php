<?php
// require("../../library/fpdf182/fpdf.php");
require_once '../../vendor/autoload.php';
include_once '../../controller/transaksiController.php';
include_once '../../controller/kasirController.php';
include_once '../../controller/barangController.php';
include_once '../../controller/adminController.php';
include_once '../../library/library.php';

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;

$printer = get_printer();
$myprinter = $printer['printer'];

// header('Content-type: application/json; charset=utf-8');


class item
{
    private $name;
    private $price;
    private $rpSign;

    public function __construct($name = '', $price = '', $rpSign = false)
    {
        $this->name = $name;
        $this->price = $price;
        $this->rpSign = $rpSign;
    }

    public function getAsString($width = 48)
    {
        $rightCols = 10;
        $leftCols = $width - $rightCols;
        if ($this->rpSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols);

        $sign = ($this->rpSign ? 'Rp ' : '');
        $right = str_pad($sign . $this->price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }

    public function __toString()
    {
        return $this->getAsString();
    }
}

function getAsString($width, $rp, $name, $price)
    {
        $rightCols = 10;
        $leftCols = $width - $rightCols;
        if ($rp) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($name, $leftCols);

        $sign = ($rp ? 'Rp ' : '');
        $right = str_pad($sign . $price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }

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

// foreach ($details as $val) {
//     echo $val['nama']. ' '. $val['harga'];
//     echo "<br>";
//     echo $val['qty'];
//     echo "<br>";
// }


try {
    // $profile = CapabilityProfile::load("default");
    $profile = CapabilityProfile::load("POS-5890");
    $connector = new WindowsPrintConnector($myprinter);
    $printer = new Printer($connector, $profile);

    // $logo = EscposImage::load("resources/alf-ico.png", false);

    // HEADER
    $printer->setJustification(Printer::JUSTIFY_CENTER); //text align
    $printer->setTextSize(2, 2);
    $printer->setUnderline(true);
    $printer->text($transaksi['nama_toko']);
    $printer->feed(1); //new line

    // SUBHEADER
    $printer->setTextSize(1, 1);
    $printer->setUnderline(false);
    $printer->text("____________________________________");
    $printer->feed();
    $printer->text(getAsString(32, false, $transaksi['create_at'], $kasir[0]['nama']));
    $printer->text("____________________________________");
    $printer->feed();

    //ITEM
    $printer->text(getAsString(32, false, 'Nama Item', 'Harga'));
    $printer->feed();

    foreach ($details as $val) {
        $satuan = show_satuan($val['id_satuan']);
        $printer->text(getAsString(32, false, $val['nama'], number_format($val['harga'])));
        $printer->text(getAsString(32, false, 'x'.$val['qty'].' '.$satuan['ket_satuan'], ''));

    }
    $printer->text("____________________________________");
    $printer->feed();

    // FINAL
    $printer->text(getAsString(32, false, 'Subtotal: ', number_format($transaksi['subtotal'])));
    $printer->text(getAsString(32, false, 'Potongan: ', number_format($transaksi['potongan'])));
    $printer->text(getAsString(32, false, 'Total: ', number_format($transaksi['total'])));
    $printer->text(getAsString(32, false, 'Bayar: ', number_format($transaksi['bayar'])));
    $printer->text(getAsString(32, false, 'Kembali: ', number_format($transaksi['kembalian'])));
    $printer->feed();
    // $printer->text(getAsString(32, false, 'LAYANAN KONSUMEN ', $owner['nohp']));
    $printer->text(getAsString(1, false, '', 'LAYANAN KONSUMEN'));
    $printer->text(getAsString(1, false, '', $transaksi['email']));
    $printer->cut();
    $printer->pulse();
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    $printer->close();
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
