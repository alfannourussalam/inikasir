<?php
require_once '../../config/auth.inc';
require_once '../../library/fpdf182/fpdf.php';
include_once '../../controller/laporanController.php';

if (isset($_POST['go'])) {
    $fdate = $_POST['fdate'];
    $ldate = $_POST['ldate'];

    if ($fdate == '' || $ldate == '') {
        $barangmasuk =  barangmasuk();
        $range = 'Semua Periode';
    } else {
        $barangmasuk =  barangmasuk_range($fdate, $ldate);
        $range = 'Tanggal' . $fdate . 's/d' . $ldate;
    }

    $title = "Barang Masuk " . $range . ".xls";
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=" . $title . "");

    // $pdf = new FPDF('L', 'mm', 'A4');

    // $pdf->AddPage();
    // $pdf->SetFont('Arial', 'B', 14);
    // $pdf->Cell(275, 10, 'LAPORAN BARANG MASUK', 0, 0, 'C');
    // $pdf->Ln(7);
    // $pdf->SetFont('Arial', '', 10);
    // $pdf->Cell(275, 10, $range, 0, 0, 'C');


    // $pdf->SetFont('Arial', 'B', 10);
    // $pdf->Ln(15);
    // $pdf->Cell(10, 7, 'No', 1, 0, 'C');
    // $pdf->Cell(30, 7, 'Kode Barang', 1, 0, 'C');
    // $pdf->Cell(55, 7, 'Nama Barang', 1, 0, 'C');
    // $pdf->Cell(55, 7, 'Nama Suplier', 1, 0, 'C');
    // $pdf->Cell(40, 7, 'Tanggal Masuk', 1, 0, 'C');
    // $pdf->Cell(25, 7, 'Harga (Rp)', 1, 0, 'C');
    // $pdf->Cell(20, 7, 'Jumlah', 1, 0, 'C');
    // $pdf->Cell(30, 7, 'Total Modal (Rp)', 1, 0, 'C');
    // $pdf->Ln();

    // $pdf->SetFont('Arial', '', 10);
    // $i = 1;
    // foreach ($barangmasuk as $v) {
    //     $pdf->Cell(10, 7, $i, 1, 0, 'C');
    //     $pdf->Cell(30, 7, $v['kode_barang'], 1, 0, 'L');
    //     $pdf->Cell(55, 7, $v['nama'], 1, 0, 'L');
    //     $pdf->Cell(55, 7, $v['nama_suplier'], 1, 0, 'L');
    //     $pdf->Cell(40, 7, $v['create_at'], 1, 0, 'L');
    //     $pdf->Cell(25, 7, number_format($v['harga'], 0, '.', ','), 1, 0, 'R');
    //     $pdf->Cell(20, 7, $v['jumlah'], 1, 0, 'R');
    //     $pdf->Cell(30, 7, number_format($v['harga'] * $v['jumlah']), 1, 0, 'R');
    //     $pdf->Ln();
    //     $i++;
    // }

    // $pdf->Output(); 
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
                        <th colspan="8" style="font-size:14pt; border: none; text-align:center; padding-bottom:0px">LAPORAN BARANG MASUK</th>
                    </tr>
                    <tr style="border: none;">
                        <th colspan="8" style="border: none; text-align:center; padding-top:0px"><?php echo $range ?></th>
                    </tr>
                    <tr style="border: none;">
                        <th colspan="8" style="border: none; padding-bottom:15px"></th>
                    </tr>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Suplier</th>
                        <th>Tanggal Input</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                    <?php
                    $i = 1;
                    foreach ($barangmasuk as $v) { ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td>'<?php echo $v['kode_barang'] ?></td>
                            <td><?php echo $v['nama'] ?></td>
                            <td><?php echo $v['nama_suplier'] ?></td>
                            <td><?php echo $v['create_at'] ?></td>
                            <td style="text-align: right;"><?php echo number_format($v['harga']) ?></td>
                            <td style="text-align: center;"><?php echo $v['jumlah'] ?></td>
                            <td style="text-align: right;"><?php echo number_format($v['jumlah'] * $v['harga']) ?></td>
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
} else {
    echo 'Somthing wrong';
}
