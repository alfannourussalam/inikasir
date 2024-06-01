<?php
// require_once(dirname(__FILE__) . "/Escpos.php");
require_once '../../vendor/autoload.php';
include_once '../../controller/transaksiController.php';
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\Printer;
/**
 * Install the printer using USB printing support, and the "Generic / Text Only" driver,
 * then share it (you can use a firewall so that it can only be seen locally).
 * 
 * Use a WindowsPrintConnector with the share name to print.
 * 
 * Troubleshooting: Fire up a command prompt, and ensure that (if your printer is shared as
 * "Receipt Printer), the following commands work:
 * 
 *      echo "Hello World" > testfile
 *      print /D:"\\%COMPUTERNAME%\Receipt Printer" testfile
 *      del testfile
 */
try {
    // Enter the share name for your USB printer here
    $connector = new WindowsPrintConnector("EPSON TM-T82X");
    /* Print a "Hello world" receipt" */
    $printer = new Printer($connector);
    $printer -> text("Hello World!\n");
    $printer -> cut();

    /* Close printer */
    $printer -> close();
} catch(Exception $e) {
    echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}