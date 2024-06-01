<?php
require_once '../config/auth.inc';
include_once '../controller/adminController.php';
include_once '../controller/kasirController.php';

$role = $_SESSION['role'];
// $role = 'kasir';

if ($role == 'admin') {
  $role_id = 1;
  $nama_toko = $_SESSION['nama_toko'];
}
if ($role == 'kasir') {
  $role_id = 2;
  $nama_toko = '';
}

if ($_SESSION['role'] == 'kasir') {
    $data = kasir_only($_SESSION['myid']);
    $data = $data[0];
} else {
    $data = admin_show($_SESSION['id']);
}

if ($role_id == 1) {
    if ($data['printer'] != "") {
        header('Location:/'.$basename.'/');
    }
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
    <title>IniKasir - Atur Printer</title>
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
        <form action="./settings/update-printer.php" method="post">
            <div class="container">
                <!-- Profile Wrapper-->
                <div class="profile-wrapper-area py-3">
                    <!-- User Information-->
                    <div class="card user-info-card">
                        <div class="card-body p-4 d-flex align-items-center">
                            <h4>Atur Thermal Printer</h4>
                        </div>
                    </div>
                    <!-- User Meta Data-->
                    <div class="card user-data-card">
                        <div class="card-body">
                            <!-- <form action="" method=""> -->
                                <div class="mb-3">
                                    <div class="title mb-2"><i class="lni lni-printer"></i><span>Nama Printer <span class="text-danger">*</span></span></div>
                                    <input class="form-control" type="text" name="printer" value="<?php echo $data['printer'] ?>" required autofocus>
                                </div>
                                <button class="btn btn-success w-100" type="submit" name="setup-printer">Complete Setup</button>
                            <!-- </form> -->
                        </div>
                    </div>
                    <div class="card user-data-card mt-2">
                        <div class="card-body bg-white">
                            <b><span class="text-danger">* </span>Petunjuk: Nama printer harus sama dengan identitas/nama sesuai dengan yang ada pada printer sharing</b>
                            <ol>
                                <li>Buka Control Panel</li>
                                <li>Pilih Hardware and Sound</li>
                                <li>Selanjutnya pilih Devices and Printers</li>
                                <li>Klik kanan pada printer thermal yang akan dipakai</li>
                                <li>Pilih Printer properties</li>
                                <li>Kemudian pergi ke tab "Sharing"</li>
                                <li>Checklist pada bagian "Share this printer"</li>
                                <li>Isi kolom "share name" dengan nama printer (bebas)</li>
                                <li>Kemudian klik Apply dan OK</li>
                            </ol>
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

</body>

</html>