<?php
require_once '../../config/auth.inc';
require_once '../../config/permission.php';
include_once '../../controller/adminController.php';
include_once '../../controller/roleController.php';

$data = admin_show($_SESSION['id']);
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
    <title>Settings</title>
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
    <!-- Notification -->
    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'update') { ?>
            <input type="text" value="Data berhasil diubah" hidden id="flash">
        <?php
        }
        if ($_SESSION['status'] == 'error') { ?>
            <input type="text" value="Password Tidak Sesuai" hidden id="errorFlash">
    <?php
        }
        unset($_SESSION['status']);
    }

    ?><!-- End notification -->

    <!-- Topbar -->
    <?php include_once('../layout/navbar.php'); ?>
    <!-- End of Topbar -->


    <div class="page-content-wrapper">
        <div class="container">
            <!-- Settings Wrapper-->
            <div class="settings-wrapper py-3">
                <!-- Single Setting Card-->
                <div class="card settings-card">
                    <div class="card-body">
                        <!-- Single Settings-->
                        <div class="single-settings d-flex align-items-center justify-content-between">
                            <div class="title"><i class="lni lni-night"></i><span>Night Mode</span></div>
                            <div class="data-content">
                                <div class="toggle-button-cover">
                                    <div class="button r">
                                        <input class="checkbox" id="darkSwitch" type="checkbox">
                                        <div class="knobs"></div>
                                        <div class="layer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Setting Card-->
                <div class="card settings-card">
                    <div class="card-body">
                        <!-- Single Settings-->
                        <div class="single-settings d-flex align-items-center justify-content-between">
                            <div class="title"><i class="lni lni-shopping-basket"></i><span>Pengaturan Toko</span></div>
                            <div class="data-content"><a href="setup.php">Setup<i class="lni lni-chevron-right"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- Single Setting Card-->
                <div class="card settings-card">
                    <div class="card-body">
                        <!-- Single Settings-->
                        <div class="single-settings d-flex align-items-center justify-content-between">
                            <div class="title"><i class="lni lni-printer"></i><span>Thermal Printer</span></div>
                            <div class="data-content"><a href="setup-printer.php">Change<i class="lni lni-chevron-right"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- Single Setting Card-->
                <div class="card settings-card">
                    <div class="card-body">
                        <!-- Single Settings-->
                        <div class="single-settings d-flex align-items-center justify-content-between">
                            <div class="title"><i class="lni lni-protection"></i><span>Privacy Policy</span></div>
                            <div class="data-content"><a href="privacy-policy.html">View<i class="lni lni-chevron-right"></i></a></div>
                        </div>
                    </div>
                </div>
                <!-- Single Setting Card-->
                <div class="card settings-card">
                    <div class="card-body">
                        <!-- Single Settings-->
                        <div class="single-settings d-flex align-items-center justify-content-between">
                            <div class="title"><i class="lni lni-lock"></i><span>Password<span>Updated 1 month ago</span></span></div>
                            <div class="data-content"><a href="change-password.php">Change<i class="lni lni-chevron-right"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include_once '../layout/footer.php';
    ?> <!-- End of Footer -->


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

    <!-- Page level sweet alert -->
    <script src="../../assets/sweetalert/sweetalert2.js"></script>

    <!-- <script>
        $(function() {
            $('#backward').on('click', function() {
                window.location(history.back());
            });
        });
    </script> -->
    <script>
        var flash = $('#flash').val();
        if (flash) {
            Swal.fire({
                title: 'Success!',
                icon: 'success',
                text: flash,
                showConfirmButton: false,
                timer: 1500
            });
        }

        var flash = $('#errorFlash').val();
        if (flash) {
            Swal.fire({
                title: 'Failed!!!',
                icon: 'error',
                text: flash,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>


</body>

</html>