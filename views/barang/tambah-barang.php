<?php
require_once '../../config/auth.inc';
include_once '../../controller/barangController.php';
include_once '../../controller/suplierController.php';

$suplier = suplier_all();
$satuan = satuan_show();
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
    <title>Tambah Barang</title>
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
    <?php include '../../views/layout/navbar.php'; ?>
    <!-- End of Topbar -->

    <!-- Content Wrapper -->
    <div class="page-content-wrapper">

        <!-- Main Content -->
        <div id="content">


            <!-- Begin Page Content -->
            <div class="container-fluid">
                <form action="insert-barang.php" method="post">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Barang</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Data Barang</h6>
                        </div>
                        <div class="card-body">
                            <div class="p-4">
                                <div class="row mb-2">
                                    <label for="inputKode" class="col-sm-3 col-form-label lbl-input">Kode Barang</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="kode" id="inputKode" placeholder="masukkan kodde barang" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="inputNama" class="col-sm-3 col-form-label lbl-input">Nama Unit/Barang</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="nama" id="inputNama" placeholder="masukkan nama barang" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="inputJenis" class="col-sm-3 col-form-label lbl-input">Jenis Barang</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="jenis" id="inputJenis" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="inputSatuan" class="col-sm-3 col-form-label lbl-input">Satuan Barang</label>
                                    <div class="col-sm-3">
                                        <div class="search-select">
                                            <select class="selectpicker" data-live-search="true" name="satuan" id=satuan>
                                                <?php
                                                foreach ($satuan as $s) { ?>
                                                    <option value="<?php echo $s['id'] ?>"><?php echo $s['ket_satuan'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="inputModal" class="col-sm-3 col-form-label lbl-input">Modal/Harga Beli</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="modal" id="inputModal" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="inputHarga" class="col-sm-3 col-form-label lbl-input">Harga Jual</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="harga" id="inputHarga" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <label for="inputPass" class="col-sm-3 col-form-label lbl-input">Jumlah Barang</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" name="jumlah" id="inputJumlah" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row save mb-5">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-5 px-4">
                                    <button type="submit" id="add-barang" class="btn btn-success btn-icon-split save" name="simpan">
                                        <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                                        <span class="text">Simpan</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <!-- /.container-fluid -->

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