<?php
require '../../config/auth.inc';
include '../../controller/kasirController.php';
include '../../controller/roleController.php';

if (isset($_GET['identity'])) {
    $uname = base64_decode($_GET['identity']);
    $detail_kasir = kasir_show($uname);
} else {
    header('Location:/' . $basename . '/views/kasir/');
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
    <title>Akun Kasir</title>
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

    <div class="page-content-wrapper">
        <div class="container">
            <!-- Checkout Wrapper-->
            <div class="checkout-wrapper-area py-3">
                <div class="credit-card-info-wrapper"><img class="d-block mb-4" src="img/bg-img/credit-card.png" alt="">
                    <div class="pay-credit-card-form">
                        <form action="update-kasir-account.php" method="post">
                        <input name="id" value="<?= $detail_kasir['id'] ?>" hidden readonly>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" onclick="username_kasiredit('<?php echo $detail_kasir['username'] ?>')" name="username" id="inputUsername" value="<?= $detail_kasir['username'] ?>" readonly>
                                <span id="error"></span>
                                <span class="mt-3 btn btn-secondary btn-sm w-100" id="changeUsername" style="cursor: pointer;">Enable Editing</span>
                            </div>
                            <div class="mb-3">
                                <span id="resetPassword" class="btn btn-danger btn-sm w-100" style="cursor: pointer;">Reset Password</i></span>
                            </div>
                            <div class="mb-3"  id="newPasswordGroup" style="display: none;">
                                <label for="paypalPassword">Password</label>
                                <input class="form-control" type="password" name="password" id="newPassword" value="">
                            </div>
                            <button class="btn btn-warning btn-lg w-100" type="submit" id="save-account" name="save-account">Simpan</button>
                        </form>
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

    <script src="../../assets/js/control.js"></script>

    <script>
        $(function() {

            $('#changeUsername').on('click', function() {
                var val = $(this).text();
                // console.log(val);
                if (val === 'Enable Editing') {
                    $('#inputUsername').prop('readOnly', false);
                    $(this).text('Finish Editing');
                    $(this).removeClass('btn-secondary');
                    $(this).addClass('btn-primary');
                    $('#inputUsername').focus();
                }
                if (val === 'Finish Editing') {
                    $('#inputUsername').prop('readOnly', true);
                    $(this).text('Enable Editing');
                    $(this).removeClass('btn-primary');
                    $(this).addClass('btn-secondary');
                    $('#save-account').attr('disabled', false);
                }
            });

            // RESET PASSWORD
            $('#resetPassword').on('click', function() {
                var val = $(this).text();
                if (val === 'Reset Password') {
                    // $(this).text('Batal Reset Password');
                    $(this).text('Batal Reset Password');
                    // $(this).html('<i class="text-primary" style="cursor: pointer;">Batal Reset Password</i>');
                    $('#newPasswordGroup').show();
                    $('#save-account').attr('disable', false);
                }
                if (val === 'Batal Reset Password') {
                    // $(this).text('Reset Password');
                    $(this).text('Reset Password');
                    $('#newPasswordGroup').hide();
                    $('#save-account').attr('disable', true);
                }
            });

            $('#backward').on('click', function() {
                window.location(history.back());
            });
        });
    </script>

</body>

</html>