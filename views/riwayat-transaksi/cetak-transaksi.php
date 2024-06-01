<?php
require_once '../../config/auth.inc';
require_once '../../library/fpdf182/fpdf.php';
include_once '../../controller/laporanController.php';
include_once '../../controller/transaksiController.php';

if (isset($_POST['gotransaksi'])) {
    $fdate = $_POST['fdate'];
    $ldate = $_POST['ldate'];

    if ($fdate == '' || $ldate == '') {
        $fdate = '';
        $ldate = '';
        $transaksi =  transaksi_all($fdate, $ldate);
        $range = 'Semua Record';
    } else {
        $transaksi =  transaksi_all($fdate, $ldate);
        $range = 'Tanggal' . $fdate . 's/d' . $ldate;
    }

    $title = "Detail Transaksi " . $range . ".xls";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=" . $title . "");

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- Favicons -->
        <link href="../../assets/img/alf-ico.png" rel="icon">
        <link href="../../assets/img/alf-ico.png" rel="apple-touch-icon">
    </head>
    <style>
        body {
            color: black;
        }

        th,
        td {
            border: 1px solid black;
            padding: 2px;
            padding-right: 4px;
            padding-left: 4px;
            font-size: 12pt;
        }
    </style>

    <body>
        <div class="container">
            <div>
                <table>
                    <tr style="border: none;">
                        <th colspan="8" style="font-size:14pt; border: none; text-align:center; padding-bottom:0px">LAPORAN RIWAYAT TRANSAKSI</th>
                    </tr>
                    <tr style="border: none;">
                        <th colspan="8" style="border: none; text-align:center; padding-top:0px"><?php echo $range ?></th>
                    </tr>
                    <tr style="border: none;">
                        <th colspan="8" style="border: none; padding-bottom:15px"></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Tagihan</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($transaksi as $v) { ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $v['kode_transaksi'] ?></td>
                            <td><?php echo $v['create_at'] ?></td>
                            <td style="text-align: right;"><?php echo number_format($v['total']) ?></td>
                        </tr>
                    <?php
                        $i++;
                    } ?>
                </table>
            </div>
        </div>
    </body>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </html>

<?php
}

if (isset($_POST['godetail'])) {
    $fdate = $_POST['fdate'];
    $ldate = $_POST['ldate'];

    if ($fdate == '' || $ldate == '') {
        $fdate = '';
        $ldate = '';
        $transaksi =  transaksi_all($fdate, $ldate);
        $range = 'Semua Record';
    } else {
        $transaksi =  transaksi_all($fdate, $ldate);
        $range = 'Tanggal' . $fdate . 's/d' . $ldate;
    }

    $title = "Detail Transaksi " . $range . ".xls";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=" . $title . "");

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- Favicons -->
        <link href="../../assets/img/<?php echo $icon ?>" rel="icon">
        <link href="../../assets/img/<?php echo $icon ?>" rel="apple-touch-icon">
    </head>
    <style>
        body {
            color: black;
        }

        th,
        td {
            border: 1px solid black;
            padding: 2px;
            padding-right: 4px;
            padding-left: 4px;
            font-size: 12pt;
        }
    </style>

    <body>
        <div class="container">
            <div>
                <table>
                    <tr style="border: none;">
                        <th colspan="8" style="font-size:14pt; border: none; text-align:center; padding-bottom:0px">LAPORAN RIWAYAT TRANSAKSI</th>
                    </tr>
                    <tr style="border: none;">
                        <th colspan="8" style="border: none; text-align:center; padding-top:0px"><?php echo $range ?></th>
                    </tr>
                    <tr style="border: none;">
                        <th colspan="8" style="border: none; padding-bottom:15px"></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th>Tagihan</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($transaksi as $v) {
                        $details = detail_transaksi_show($v['kode_transaksi']);
                        foreach ($details as $det){
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $v['kode_transaksi'] ?></td>
                            <td><?php echo $v['create_at'] ?></td>
                            <td><?php echo $det['kode_barang'] ?></td>
                            <td><?php echo $det['nama'] ?></td>
                            <td><?php echo $det['qty'] ?></td>
                            <td style="text-align: right;"><?php echo number_format($det['harga']) ?></td>
                            <td style="text-align: right;"><?php echo number_format($v['total']) ?></td>
                        </tr>
                    <?php
                        $i++;
                        }
                    } ?>
                </table>
            </div>
        </div>
    </body>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    </html>

<?php
}

 else {
    echo 'Somthing wrong';
}
