<?php
require_once '../../config/auth.inc';
include_once '../../controller/barangController.php';

// $admin = admin_info();
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
    <title>Tambah Supliers</title>
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

<body id="page-top">

    <!-- Topbar -->
    <?php include '../../views/layout/navbar2.php'; ?>
    <!-- End of Topbar -->

    <!-- Content Wrapper -->
    <div class="page-content-wrapper">

        <!-- Main Content -->
        <div class="top-products-area py-3">
            <!-- Begin Page Content -->
            <div class="container">
                <div class="section-heading d-flex align-items-center justify-content-between">
                    <h5>Tambah Suplier</h5>
                </div>
                <form action="insert-suplier.php" method="post">
                    <div class="mb-3">
                        <button type="button" id="add-suplier" class="btn btn-primary">
                            <span class="text">Tambah Record</span>
                        </button>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Suplier</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" width="100%" cellspacing="2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Suplier</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="temp-suplier">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row save mb-3 mx-3" style="display: none;">
                            <button type="submit" id="add-suplier" class="btn btn-success save" name="simpan">
                                <span class="text">Simpan</span>
                            </button>
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

    <script>
        $(function() {
            var count = 0;

            $('#add-suplier').on('click', function() {
                count += 1;
                console.log(count);
                $('#temp-suplier').append(`
                <tr>
                    <td class="text-muted">` + count + `</td>
                    <td>
                        <input type="text" placeholder="masukkan nama suplier" name="nama[]" class="form-control" requried>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove">Hapus</button>
                    </td>
                </tr>
            `);

                if (count > 0) {
                    $('.save').show();
                }

                $('.remove').on('click', function() {
                    $(this).closest('tr').remove();
                    count -= 1;
                    if (count == 0) {
                        $('.save').hide();
                    }
                })
            })
        })
    </script>


</body>

</html>