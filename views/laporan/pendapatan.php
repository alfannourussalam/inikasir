<?php
require_once '../../config/auth.inc';
include_once '../../controller/laporanController.php';



if (isset($_POST['search-pendapatan'])) {
    $fdate = $_POST['fdate'];
    $ldate = $_POST['ldate'];
    $pendapatan =  pendapatan_range($fdate, $ldate);
    $judul = 'Periode ' . $fdate . ' s/d ' . $ldate;

    if (
        $fdate == '' ||
        $ldate == ''
    ) {
        $pendapatan =  pendapatan();
        $judul = 'Bulan Ini';
    }
} else {
    $fdate = '';
    $ldate = '';
    $pendapatan =  pendapatan();
    $judul = 'Bulan Ini';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Suha - Multipurpose Ecommerce Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Pendapatan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicons -->
    <link href="../../assets/img/mainlogo.png" rel="icon">
    <link href="../../assets/img/mainlogo.png" rel="apple-touch-icon">
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- CSS Libraries-->
    <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/animate.css">
    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/lineicons.min.css">
    <link rel="stylesheet" href="../../assets/css/magnific-popup.css">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="../../assets/style.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="../../assets/manifest.json">

    <!-- Sweet Alert -->
    <link href="../../assets/sweetalert/sweetalert2.min.css" rel="stylesheet">

</head>

<body>

    <!-- Topbar -->
    <?php include '../../views/layout/navbar2.php'; ?>
    <!-- End of Topbar -->

    <!-- Notification -->
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == "success") { ?>
            <input type="text" value="Data berhasil ditambahkan" hidden id="flash">
        <?php
        }
        if ($_GET['msg'] == "deleted") { ?>
            <input type="text" value="Data berhasil dihapus" hidden id="flash">
        <?php
        }
        if ($_GET['msg'] == "updated") { ?>
            <input type="text" value="Data berhasil diupdate" hidden id="flash">
    <?php
        }
    }
    ?><!-- End notification -->

    <!-- Content Wrapper -->
    <div class="page-content-wrapper">
        <div class="top-products-area py-3">
            <!-- Main Content -->
            <div id="container" class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h5>Laporan Pendapatan</h5>
                </div>
                <div class="row mt-4">
                    <div class="col">
                        <div class="card mb-4 py-3 border-left-success shadow">
                            <form method="post" action="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="fdate">Mulai Dari</label>
                                                <input class="form-control" type="date" id="fdate" name="fdate">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="fdate">Sampai Tanggal</label>
                                                <input class="form-control" type="date" id="ldate" name="ldate">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100" name="search-transaksi">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <!-- <form action="#" method="post">
                            <input type="text" name="fdate" id="" value="<?php // echo $fdate 
                                                                            ?>" hidden readonly>
                            <input type="text" name="ldate" id="" value="<?php // echo $ldate 
                                                                            ?>" hidden readonly>
                            <div class="card-header py-3">
                                <div class="row">
                                    <h6 class="col-9 m-0 font-weight-bold text-primary"><i class="fas fa-shipping-fast"></i> Pendapatan <?= $judul ?></h6>
                                    <span class="col-3 d-flex justify-content-end">
                                        <button name="go" type="submit" class="btn btn-secondary"><i class="fas fa-print"></i> Cetak</button>
                                    </span>
                                </div>
                            </div>
                        </form> -->
                    <div class="card-body">
                        <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Pendapatan Kotor</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($pendapatan['income']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    Pengeluaran</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($pendapatan['outcome']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-4 col-md-6 mb-4">
                                <div class="card border-left-info shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Pendapatan Bersih</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= number_format($pendapatan['netincome']) ?></div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

    <!-- Footer -->
    <?php
    include_once '../layout/footer.php';
    ?>
    <!-- End of Footer -->



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

    <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="../../assets/js/demo/datatables-demo.js"></script>

    <!-- Page level sweet alert -->
    <script src="../../assets/sweetalert/sweetalert2.js"></script>


</body>

</html>