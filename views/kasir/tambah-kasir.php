<?php
require '../../config/auth.inc';
include '../../controller/kasirController.php';
include '../../controller/roleController.php';

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
    <title>Tambah Kasir</title>
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

    <!-- Content Wrapper -->
    <div class="page-content-wrapper">
        <div class="container">
            <div class="profile-wrapper-area py-3">
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <h4>Tambah Kasir</h4>
                    </div>
                </div>
                <div class="card user-data-card">
                    <div class="card-body">
                        <form action="insert-kasir.php" method="post">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="title mb-2"><span>Nama Kasir <span class="text-danger">*</span></span></div>
                                    <input class="form-control" type="text" name="nama" required autofocus>
                                </div>
                                <div class="col-md-6">
                                    <div class="title mb-2"><span>No Handphone</span></div>
                                    <input class="form-control" type="text" name="nohp" placeholder="+628xxxxxx" required autofocus>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="title mb-2"><span>Username <span class="text-danger">*</span></span></div>
                                    <input class="form-control" type="text" name="username" id="inputUsername" id="inputUsername" onclick="username_kasir()" required autofocus>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <div class="title mb-2"><span>Password <span class="text-danger">*</span></span></div>
                                    <input class="form-control" type="password" name="pass" required>
                                </div>
                            </div>
                            <button class="btn btn-success w-100" id="add-user" type="submit" name="simpan">Tambahkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="../../assets/js/control.js"></script>

    

</body>

</html>