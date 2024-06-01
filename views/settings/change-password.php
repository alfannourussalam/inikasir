<?php
require_once '../../config/auth.inc';
include_once '../../controller/adminController.php';
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
    <title>Change Password</title>
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
    <!-- Topbar -->
    <?php include_once('../layout/navbar2.php'); ?>
    <!-- End of Topbar -->

    <!-- Notification -->
    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'update') { ?>
            <input type="text" value="Data berhasil diubah" hidden id="flash">
        <?php
        }
        if ($_SESSION['status'] == 'diff') { ?>
            <input type="text" value="Password Tidak Sesuai" hidden id="errorFlash">
    <?php
        }
        unset($_SESSION['status']);
    }

    ?><!-- End notification -->

    <div class="page-content-wrapper">
        <div class="container">
            <!-- Profile Wrapper-->
            <div class="profile-wrapper-area py-3">
                <!-- User Information-->
                <div class="card user-info-card">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="user-profile me-3"><img src="img/bg-img/9.jpg" alt=""></div>
                        <div class="user-info">
                            <p class="mb-0 text-dark"><?= $data['email'] ?></p>
                            <h5 class="mb-0"><?= $data['nama'] ?></h5>
                        </div>
                    </div>
                </div>
                <!-- User Meta Data-->
                <div class="card user-data-card">
                    <div class="card-body">
                        <form action="update-password.php" method="post">
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-key"></i><span>Old Password</span></div>
                                <input class="form-control" type="password" name="oldPassword" required>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-key"></i><span>New Password</span></div>
                                <input class="form-control" type="password" id="new" name="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-key"></i><span>Repeat New Password</span></div>
                                <input class="form-control" type="password" id="confirm" name="confirmPassword" required>
                            </div>
                            <button class="btn btn-success w-100" type="submit" name="update-password">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Internet Connection Status-->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Footer Nav-->

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

    <script>
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