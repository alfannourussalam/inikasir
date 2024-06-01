<?php
require_once '../config/auth.inc';
include_once '../controller/adminController.php';
$data = admin_show($_SESSION['id']);

if ($data['nama_toko'] != "") {
    header('Location:/' . $basename . '/');
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
    <title>IniKasir - Lengkapi Identitas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicons -->
    <link href="../assets/img/mainlogo.png" rel="icon">
    <link href="../assets/img/mainlogo.png" rel="apple-touch-icon">
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- CSS Libraries-->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/lineicons.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="../assets/style.css">
    <!-- Web App Manifest-->
    <!-- <link rel="manifest" href="manifest.json"> -->
</head>


<body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
        <div class="spinner-grow text-secondary" role="status">
            <div class="sr-only">Loading...</div>
        </div>
    </div>
    <div class="page-content-wrapper">
        <form action="../config/register.php" method="post">
            <div class="container">
                <!-- Profile Wrapper-->
                <div class="profile-wrapper-area py-3">
                    <!-- User Information-->
                    <div class="card user-info-card">
                        <div class="card-body p-4 d-flex align-items-center">
                            <div class="user-profile me-3"><img src="../assets/img/male.png" alt="">
                                <div class="change-user-thumb">
                                    <input class="form-control-file" type="file" name="foto">
                                    <button><i class="lni lni-pencil"></i></button>
                                </div>
                            </div>
                            <div class="user-info">
                                <p class="mb-0 text-dark"><?= $data['email'] ?></p>
                                <h5 class="mb-0"><?= $data['nama'] ?></h5>
                            </div>
                        </div>
                    </div>
                    <!-- User Meta Data-->
                    <div class="card user-data-card">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Username <span class="text-danger">*</span></span></div>
                                <input class="form-control" type="text" name="username" id="inputUsername" required autofocus>
                                <span id="error"></span>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-postcard"></i><span>NIK</span></div>
                                <input class="form-control" type="text" name="nik">
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-user"></i><span>Full Name</span></div>
                                <input class="form-control" type="text" value="<?= $data['nama'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-code"></i><span>Kode Toko</span></div>
                                <input class="form-control" type="text" value="<?= $data['kode'] ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-shopping-basket"></i><span>Nama Toko <span class="text-danger">*</span></span></div>
                                <input class="form-control" type="text" name="nama_toko" required>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-map-marker"></i><span>Alamat <span class="text-danger">*</span></span></div>
                                <input class="form-control" type="text" name="alamat" required>
                            </div>
                            <button class="btn btn-success w-100" type="submit" name="complete" id="complete">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- All JavaScript Files-->
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.easing.min.js"></script>
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/jquery.passwordstrength.js"></script>
    <script src="../assets/js/dark-mode-switch.js"></script>
    <script src="../assets/js/active.js"></script>
    <script src="../assets/js/pwa.js"></script>
    <script src="../assets/js/control.js"></script>

</body>

</html>