<?php
require_once '../../config/auth.inc';
require_once '../../config/permission.php';
include_once '../../controller/transaksiController.php';
// include '../../controller/barangmasukController.php';
include_once '../../controller/userController.php';
include_once '../../controller/cartController.php';
include_once '../../controller/barangController.php';
include_once '../../controller/barangmasukController.php';
include_once '../../controller/suplierController.php';
include_once '../../controller/satuanController.php';
include_once '../../library/library.php';

$user = user_all();
$kasir = admin_info();
$suplier = suplier_all();
$satuan = satuan_all();

if (isset($_POST['search-barangmasuk'])) {
    $fdate = $_POST['fdate'];
    $ldate = $_POST['ldate'];

    if ($fdate == '' || $ldate == '') {
        $fdate = '';
        $ldate = '';
        $data_barangmasuk = barangmasuk_all($fdate, $ldate);
    } else {
        $data_barangmasuk = barangmasuk_all($fdate, $ldate);
    }
} else {
    $fdate = '';
    $ldate = '';
    $data_barangmasuk = barangmasuk_all($fdate, $ldate);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Ini Kasir - Inovative cash management">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Barang Masuk</title>
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
    <link rel="stylesheet" href="../../assets/css/mycss.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="../../assets/manifest.json">

    <!-- Sweet Alert -->
    <link href="../../assets/sweetalert/sweetalert2.min.css" rel="stylesheet">

    <!-- JS FUNCTION -->
    <script src="../../assets/js/funct.js"></script>

</head>

<body>

    <!-- Topbar -->
    <?php include '../../views/layout/navbar.php'; ?>
    <!-- End of Topbar -->

    <!-- Notification -->
    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'sukses') { ?>
            <input type="text" value="Data berhasil ditambahkan" hidden id="flash">
        <?php
        }
        if ($_SESSION['status'] == 'delete') { ?>
            <input type="text" value="Data berhasil dihapus" hidden id="flash">
        <?php
        }
        if ($_SESSION['status'] == 'update') { ?>
            <input type="text" value="Data berhasil diubah" hidden id="flash">
    <?php
        }
        unset($_SESSION['status']);
    }

    ?><!-- End notification -->

    <!-- Content Wrapper -->
    <div class="page-content-wrapper">
        <div class="top-products-area py-3">
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h5>Barang Masuk</h5>
                </div>
                <div class="card">
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
                            <button type="submit" class="btn btn-primary w-100" name="search-barangmasuk">Tampilkan</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <h6 class="col-md-6 m-0 mb-2 font-weight-bold text-primary"><i class="fas fa-shipping-fast"></i>Daftar Barang Masuk</h6>
                            <div class="col-md-6 d-flex justify-content-end">
                                <span class="mx-2">
                                    <a href="barangmasuk.php" class="btn btn-primary">Tambah Barang Masuk</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-borderless table-striped nowrap data" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <!-- <th>Suplier</th> -->
                                        <th>Modal</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Terima</th>
                                        <th>Expired Date</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <!-- <th>Suplier</th> -->
                                        <th>Modal</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Terima</th>
                                        <th>Expired Date</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $i = 1;

                                    foreach ($data_barangmasuk as $v) {
                                        $id = base64_encode($v['id']);
                                        $tgl = explode(" ", $v['create_at']);
                                        $tgl = $tgl[0];
                                         ?>
                                        <tr class="clickable-row" onclick="edit_barangmasuk('<?php echo $id ?>')">

                                            <td><?php echo $i ?></td>
                                            <td><?php echo $v['kode_barang'] ?></td>
                                            <td><?php echo $v['nama'] ?></td>
                                            <!-- <td><?php // echo $v['nama_suplier'] 
                                                        ?></td> -->
                                            <td><?php echo number_format($v['total_modal']) ?></td>
                                            <td><?php echo $v['jumlah'] ?></td>
                                            <td><?php echo $tgl ?></td>
                                            <td><?php echo $v['expired'] ?></td>

                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
        <script src="../../assets/js/myjs.js"></script>
        <script>
            $('#dataTable').dataTable({
                
                "order": [
                    [0, "asc"]
                ],

                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],

                "pageLength": 25
            });

        </script>


</body>

</html>