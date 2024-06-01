<?php
require_once(__DIR__ . '../../../config/auth.inc');
include_once(__DIR__ . '../../../library/library.php');
include_once('../../controller/transaksiController.php');
include_once('../../controller/barangController.php');
include_once('../../controller/userController.php');
include_once('../../controller/cartController.php');
include_once '../../controller/kasirController.php';

// header('Content-Type: application/json; charset=utf-8'); //coment

$admin = admin_info();
$datetime = date('Y-m-d H:i:s', time());
$kode_transaksi = set_kode_transaksi();

if (isset($_POST['simpan-transaksi'])) {

    $getNext = $pdo->prepare("SELECT MAX(nourut) AS nomor FROM transaksi WHERE id_admin=:id_admin AND YEAR(create_at)=:y");
    $getNext->bindValue(':id_admin', $_SESSION['id']);
    $getNext->bindValue(':y', $y);
    $getNext->execute();
    $currentNumb = $getNext->fetchColumn();


    if ($currentNumb == "" || $md == '01-01') {
        $nextNumb = 0;
    } else {
        $nextNumb = $currentNumb;
    }
    $myNumb = $nextNumb + 1;

    // $cust = $_POST['pelanggan'];
    // $cust_code = $_POST['kode_pelanggan'];

    $cust = 0;
    $cust_code = 0;
    $kasir = kasir_only($_POST['kasir']);
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $diskon = $_POST['diskon'];
    $subtotal = $_POST['subtotal'];
    // $potongan = $_POST['poin'];
    $potongan = 0;
    // $potonganharga = $_POST['convpoin'];
    $potonganharga = pointomoney($potongan);
    $subtotalbayar = $_POST['subtotalbayar'];
    $total = $_POST['total'];
    // $total = $_POST['subtotalbayar'];
    $bayar = $_POST['bayar'];
    $kembalian = $bayar - $total;

    // REWARD POIN
    if ($total >= 100000 && $cust != 0) {
        $poin_earned = moneytopoin($total);
        update_poin($cust, $poin_earned, $potongan);
    }

    // DETAIL TRANSASKI
    $details = array();
    for ($i = 0; $i < sizeof($_POST['nama']); $i++) {
        $detail_barang = barang_show_by_kode($kode[$i]);

        $detail_transaksi = array(
            'id_admin' => $_POST['admin'],
            'kode_transaksi' => $kode_transaksi,
            'kode_barang' => $kode[$i],
            'nama_barang' => $detail_barang['nama'],
            'subharga' => $harga[$i],
            'qty' => $qty[$i],
            'diskon' => $diskon[$i],
            'harga' => $subtotal[$i]
        );

        ambil_barang($kode[$i], $qty[$i]); //SOURCE: barangController : kurangi stok barang setelah dibeli
        detailtransaksi_store($detail_transaksi);
        array_push($details, $detail_transaksi); //coment

    }

    $transaksi = array(
        'id_admin' => $_POST['admin'],
        'id_kasir' => $_POST['kasir'],
        'toko' => $admin['nama_toko'],
        'email' => $admin['email'],
        'nourut' => $myNumb,
        'kode_transaksi' => $kode_transaksi,
        'id_pengguna' => $cust,
        'kode_pengguna' => $cust_code,
        'subtotal' => $subtotalbayar,
        'potongan' => $potongan,
        'potonganharga' => $potonganharga,
        'total' => $total,
        'bayar' => $bayar,
        'kembalian' => $kembalian,
        'create_at' => $datetime,
    );

    transaksi_store($transaksi);
    cart_reset();
    $_SESSION['status'] = 'sukses';

    // $transaksi['details'] = $details; //coment

    // echo json_encode($transaksi); //coment

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
        <meta name="description" content="">
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

        <!-- CSS Libraries-->
        <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../assets/css/animate.css">
        <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../assets/css/lineicons.min.css">
        <link rel="stylesheet" href="../../assets/css/magnific-popup.css">

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
        <!-- Topbar -->
        <?php include '../../views/layout/navbar2.php'; ?>
        <!-- End of Topbar -->

        <?php
        if (isset($_SESSION['status'])) {
            if ($_SESSION['status'] == 'sukses') { ?>
                <input type="text" value="Silahkan cetak nota" hidden id="flash">
        <?php
                unset($_SESSION['status']);
            }
        }

        ?><!-- End notification -->
        <div class="containeran">
            <div class="page shadow-lg">
                <div class="banner bg-primary pt-5">
                    <div class="row text-center">
                        <h4 class="text-white fw-bold" style="text-shadow: 1px 1px 10px #1f41a5;"><i class="fas fa-check-circle mr-1" style="color:#39e75f; text-shadow: 1px 1px 10px #1f41a5;"></i> Transaksi Berhasil</h4>
                        <h6 class="text-white"><?php echo $transaksi['kode_transaksi'] ?></h6>
                    </div>
                </div>
                <div class="row shadow bg-white rounded body-note px-2 py-4">
                    <div class="col note-body">
                        <div class="head-note">
                            <div class="row text-center">
                                <h5 class="text-black fw-bold"><?php echo $transaksi['toko'] ?></h5>
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
                                    <th class="text-center">Harga</th>
                                </tr>
                                <?php
                                foreach ($details as $detail) { ?>
                                    <tr>
                                        <td><?php echo $detail['nama_barang'] ?><br><?php echo number_format($detail['subharga']) ?> x <?php echo $detail['qty'] ?></td>
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
                                    <span class="text-black"><?php echo number_format($transaksi['potonganharga']) ?></span>
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
                                <!-- <a class="btn btn-outline-secondary mb-2" href="/<?= $basename ?>/views/transaksi/">Kembali ke halaman awal</a> -->

                                <a class="btn btn-primary" href="print-note.php?i=<?php echo base64_encode($detail_transaksi['kode_transaksi']) ?>"><i class="fas fa-print"> </i> Cetak Nota</a>
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

        <!-- All JavaScript Files-->
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/waypoints.min.js"></script>
        <script src="../../assets/js/jquery.easing.min.js"></script>
        <script src="../../assets/js/jquery.magnific-popup.min.js"></script>
        <script src="../../assets/js/owl.carousel.min.js"></script>
        <script src="../../assets/js/jquery.counterup.min.js"></script>
        <script src="../../assets/js/jquery.countdown.min.js"></script>
        <script src="../../assets/js/jquery.passwordstrength.js"></script>
        <script src="../../assets/js/dark-mode-switch.js"></script>
        <script src="../../assets/js/active.js"></script>
        <script src="../../assets/js/pwa.js"></script>

        <!-- Page level plugins -->
        <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../assets/js/demo/datatables-demo.js"></script>

        <!-- Page level sweet alert -->
        <script src="../../assets/sweetalert/sweetalert2.js"></script>
        <script>
            var flash = $('#flash').val();
            if (flash) {
                Swal.fire({
                    title: 'Transaksi Berhasil!',
                    icon: 'success',
                    text: flash,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        </script>
        <script type="text/javascript">
            window.onbeforeunload = function() {
                return "Dude, are you sure you want to leave? Think of the kittens!";
            }
        </script>
    </body>

    </html>



<?php
} else {
    echo 'gagal';
    header('Location:/' . $basename . '/views/kasir/');
}
?>