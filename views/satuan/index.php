<?php
require_once '../../config/auth.inc';
require_once '../../config/permission.php';
include_once '../../controller/satuanController.php';

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
    <title>Satuan Barang/Item</title>
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
                    <h5>Satuan</h5>
                </div>
                <div class="card">
                    <div class="card-header py-3">
                        <div class="row">
                            <h6 class="col-md-6 m-0 mb-2 font-weight-bold text-primary"><i class="fas fa-shipping-fast"></i>Data Satuan Item/Barang</h6>
                            <div class="col-md-6 d-flex justify-content-end">
                                <span class="mx-2">
                                    <a href="tambah-satuan.php" class="btn btn-primary">Tambah Satuan</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped data" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Satuan</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Satuan</th>
                                        
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $data_satuan = satuan_all();
                                    $i = 1;
                                    foreach ($data_satuan as $v) { 
                                        $id = base64_encode($v['id']);
                                        ?>
                                        <tr class="clickable-row" onclick="edit_satuan('<?php echo $id ?>')">
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $v['ket_satuan'] ?></td>
                                            <!-- <td class="text-center">
                                                <a href="delete-satuan.php?dest=<?php // echo base64_encode($v['id']) ?>" class="btn btn-sm btn-danger" title="Hapus data" id="hapus-data">Hapus</a>
                                            </td> -->
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
        $(document).on('click', '#hapus-data', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');
            Swal.fire({
                title: 'Apakah Anda yakin ?',
                text: "Data akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
            })
        });

        $('#dataTable').dataTable();
    </script>



</body>

</html>