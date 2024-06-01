<?php
require_once '../../config/auth.inc';
include_once '../../controller/barangController.php';

$data_barang = barang_all();

$title = "Master Barang.xls";
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
                    <th colspan="8" style="font-size:14pt; border: none; text-align:center; padding-bottom:0px">LAPORAN MASTER BARANG</th>
                </tr>
                <tr style="border: none;">
                    <th colspan="8" style="border: none; padding-bottom:15px"></th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Modal</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Stok</th>
                </tr>
                <?php
                $i = 1;
                foreach ($data_barang as $v) { ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $v['kode'] ?></td>
                        <td><?php echo $v['nama'] ?></td>
                        <td><?php echo $v['jenis'] ?></td>
                        <td style="text-align: right;"><?php echo number_format($v['modal']) ?></td>
                        <td style="text-align: right;"><?php echo number_format($v['harga']) ?></td>
                        <td><?php echo $v['jumlah'] ?></td>
                        <td><?php echo $v['sisa'] ?></td>
                    </tr>
                <?php
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>