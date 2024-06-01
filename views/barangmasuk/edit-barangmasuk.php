<?php
require '../../config/auth.inc';
include_once '../../controller/barangController.php';
include_once '../../controller/barangmasukController.php';
include_once '../../controller/suplierController.php';
include_once '../../controller/satuanController.php';


$data = barangmasuk_show(base64_decode($_GET['items']));
$suplier = suplier_all();
$satuan = satuan_all();

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
    <title>Update Barang Masuk</title>
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

    <link rel="stylesheet" href="../../assets/custom-select/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/custom-select/bootstrap-select.min.css">

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
        <form action="update-barangmasuk.php" method="post">
            <div class="container">
                <!-- Profile Wrapper-->
                <div class="profile-wrapper-area py-3">
                    <!-- User Information-->
                    <div class="card user-info-card">
                        <div class="card-body p-4 d-flex align-items-center">
                            <h4>Update Barang Masuk</h4>
                        </div>
                    </div>
                    <!-- User Meta Data-->
                    <div class="card user-data-card">
                        <div class="card-body">
                            <input type="text" name="id" value="<?php echo base64_decode($_GET['items']) ?>" hidden readonly>
                            <input type="number" name="jumlah_old" value="<?php echo $data['jumlah'] ?>" hidden readonly>
                            <!-- <form action="" method=""> -->
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-shortcode"></i><span>Kode Barang <span class="text-danger">*</span></span></div>
                                <input class="form-control" type="text" name="kode" id="kode" value="<?php echo $data['kode_barang'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-keyboard"></i><span>Nama Barang <span class="text-danger">*</span></span></span></div>
                                <input class="form-control" type="text" name="nama" id="nama" value="<?php echo $data['nama'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-tag"></i><span>Jenis Barang <span class="text-muted fst-italic">(optional)</span></span></span></div>
                                <input class="form-control" type="text" name="jenis" id="jenis" value="<?php echo $data['jenis'] ?>">
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-code"></i><span>Satuan Barang <span class="text-danger">*</span></span></span></div>
                                <div class="search-select">
                                    <select class="form-control selectpicker" data-live-search="true" name="satuan" id="satuan">
                                        <option value="">Pilih satuan</option>
                                        <?php
                                        foreach ($satuan as $s) {
                                            if ($s['id'] == $data['satuan']) { ?>
                                                <option value="<?php echo $s['id'] ?>" selected><?php echo $s['ket_satuan'] ?></option>
                                            <?php
                                            } else {
                                            ?>
                                                <option value="<?php echo $s['id'] ?>"><?php echo $s['ket_satuan'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="title mb-2"><i class="lni lni-delivery"></i><span>Suplier</span></div>
                                <select class="form-control selectpicker" name="suplier" id="suplier" data-live-search="true">
                                    <option value="">Pilih suplier</option>
                                    <?php
                                    foreach ($suplier as $sup) {
                                        if ($sup['id'] == $data['suplier']) { ?>
                                            <option value="<?php echo $sup['id'] ?>" selected><?php echo $sup['nama_suplier'] ?></option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="<?php echo $sup['id'] ?>"><?php echo $sup['nama_suplier'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-12 mb-3">
                                        <div class="title mb-2"><span>Harga Beli/Unit <span class="text-danger">*</span></span></div>
                                        <input class="form-control" type="number" min="1" name="modal" id="modal" value="<?php echo $data['modal'] ?>" required>
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-3">
                                        <div class="title mb-2"><span>Harga Jual/Unit <span class="text-danger">*</span></span></div>
                                        <input class="form-control" type="number" min="1" name="harga" id="harga" value="<?php echo $data['harga'] ?>" required>
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-3">
                                        <div class="title mb-2"><span>Jumlah Barang <span class="text-danger">*</span></span></div>
                                        <input class="form-control" type="number" min="1" name="jumlah" id="jumlah" value="<?php echo $data['jumlah'] ?>" required>
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-3">
                                        <div class="title mb-2"><span>Total Modal</span></div>
                                        <input class="form-control" type="number" name="total_modal" id="total_modal" value="<?php echo $data['total_modal'] ?>" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="title mb-2"><span>Tanggal Kadaluarsa</span></div>
                                <input class="form-control" type="date" name="exp" id="exp" value="<?php echo $data['expired'] ?>">
                            </div>
                            <button class="btn btn-success w-100" id="update-barang" type="submit" name="simpan-barangmasuk">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

    <script src="../../assets/custom-select/popper.min.js"></script>
    <script src="../../assets/custom-select/bootstrap.min.js"></script>
    <script src="../../assets/custom-select/bootstrap-select.min.js"></script>

    <!-- Page level sweet alert -->
    <script src="../../assets/sweetalert/sweetalert2.js"></script>


    <script src="../../assets/js/myjs.js"></script>

    <script>
        $(function() {
            $('#backward').on('click', function() {
                window.location(history.back());
            });
        });
    </script>


</body>

</html>