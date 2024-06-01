<?php
// require("../../library/fpdf182/fpdf.php");
include_once '../../controller/transaksiController.php';
include_once '../../controller/kasirController.php';
include_once '../../library/library.php';

if (isset($_GET['i'])) {
    $invoice = base64_decode($_GET['i']);
    $transaksi = transaksi_show($invoice);
    $details = detail_transaksi_show($invoice);

    $kasir = kasir_only($transaksi['id_kasir']);

?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="">

    <title>Nota Penjualan</title>

    <!-- Favicons -->
    <link href="../../assets/img/<?php echo $icon ?>" rel="icon">
    <link href="../../assets/img/<?php echo $icon ?>" rel="apple-touch-icon">

    <!-- Bootstrap -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <!-- Custom styles for this page -->
    <!-- <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

    <!-- Sweet Alert -->
    <link href="../../assets/sweetalert/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- Bootstrap Custom Select -->
    <link rel="stylesheet" href="../../assets/custom-select/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/custom-select/bootstrap-select.min.css">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../assets/css/note.css" rel="stylesheet">

    </head>

    <body>
        <div class="containeran">
            <div class="page shadow-lg">
                <div class="banner bg-primary pt-5">
                    <div class="row text-center">
                        <h4 class="text-white fw-bold" style="text-shadow: 1px 1px 10px #1f41a5;">Detail Transaksi</h4>
                        <h6 class="text-white"><?php echo $transaksi['kode_transaksi'] ?></h6>
                    </div>
                </div>
                <div class="row shadow bg-white rounded body-note px-2 py-4">
                    <div class="col note-body">
                        <div class="head-note">
                            <div class="row text-center">
                                <h5 class="text-black fw-bold"><?php echo $transaksi['nama_toko'] ?></h5>
                            </div>
                            <hr class="border border-dark">
                            <div class="row mb-2">
                                <span class="text-left col-sm-6 text-gray-500 fs-10" style="margin-top: -10px;"><?php echo $kasir[0]['nama'] ?></span>
                                <span class="text-right col-sm-6 text-gray-500 fs-10" style="margin-top: -10px;"><?php echo $transaksi['create_at'] ?></span>
                            </div>
                        </div>


                        <div class="main-note my-3">
                            <b class="text-black">Detail Transaksi</b>
                            <table class="table table-sm mt-2 text-black fs-10">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Disc%</th>
                                    <th class="text-end">Harga</th>
                                </tr>
                                <?php
                                foreach ($details as $detail) {?>
                                    <tr>
                                        <td><?php echo $detail['nama'] ?><br><?php echo number_format($detail['subharga']) ?> x <?php echo $detail['qty'] ?></td>
                                        <td class="text-center"><?php echo $detail['diskon'] ?></td>
                                        <td class="text-right">Rp. <?php echo number_format($detail['harga']) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>


                        <div class="foot-note fs-10">
                            <div class="row bg-primary-subtle p-2">
                                <div class="col-sm-6">
                                    <b class="text-black">Subtotal</b>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <b class="text-black">Rp. <?php echo number_format($transaksi['subtotal']) ?></b>
                                </div>
                            </div>
                            <div class="row px-2 py-1" hidden>
                                <div class="col-sm-6">
                                    <span class="text-black">Potongan Harga</span>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span class="text-black"><?php echo number_format(pointomoney($transaksi['potongan'])) ?></span>
                                </div>
                            </div>
                            <div class="row px-2 py-1" hidden>
                                <div class="col-sm-6">
                                    <span class="text-black">Total Tagihan</span>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span class="text-black"><?php echo number_format($transaksi['total']) ?></span>
                                </div>
                            </div>
                            <div class="row px-2 py-1">
                                <div class="col-sm-6">
                                    <span class="text-black">Bayar</span>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <span class="text-black">Rp. <?php echo number_format($transaksi['bayar']) ?></span>
                                </div>
                            </div>
                            <hr style="background: black; margin-top:-2px; margin-bottom:-2px;">
                            <div class="row p-2 bg-success-subtle">
                                <div class="col-sm-6">
                                    <b class="text-black">Kembali</b>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <b class="text-black">Rp. <?php echo number_format($transaksi['kembalian']) ?></b>
                                </div>
                            </div>
                        </div>
                        <div class="action mt-3">
                            <div class="row">
                                <!-- <a class="btn btn-outline-secondary mb-2" href="../riwayat-transaksi/" id="backward">Kembali ke halaman awal</a> -->

                                <a class="btn btn-primary" target="_blank" href="../transaksi/print-note.php?i=<?php echo base64_encode($transaksi['kode_transaksi']) ?>"><i class="fas fa-print"> </i> Cetak Nota</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SPONSORSHIP -->
                <footer class="p-3 mt-5 text-center">
                    <div class="row mb-2">
                        <i class="ft-dev">Powered by</i>
                    </div>
                    <img src="../../assets/img/warxclo.png" alt="sponsor" class="img-sponsor">
                </footer>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../../assets/vendor/jquery/jquery.min.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <!-- <script src="../../assets/js/sb-admin-2.min.js"></script> -->
        <script src="../../assets/js/sb-admin-2.js"></script>

        <!-- Page level plugins -->
        <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../assets/js/demo/chart-area-demo.js"></script>
        <script src="../../assets/js/demo/chart-pie-demo.js"></script>


        <!-- Page level custom scripts -->
        <script src="../../assets/js/demo/chart-area-demo.js"></script>
        <script src="../../assets/js/demo/chart-pie-demo.js"></script>

        <!-- Page level plugins -->
        <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../assets/js/demo/datatables-demo.js"></script>

        <!-- Page level sweet alert -->
        <script src="../../assets/sweetalert/sweetalert2.js"></script>
    </body>

    </html>

<?php
}
?>