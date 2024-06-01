<?php
require_once '../../config/auth.inc';
include_once '../../controller/kasirController.php';
include_once '../../controller/roleController.php';
include_once '../../controller/transaksiController.php';


if (isset($_GET['identity'])) {
    $username = base64_decode($_GET['identity']);
    $detail_kasir = kasir_show($username);
    $transaksi = transaksi_kasir($detail_kasir['id'], $detail_kasir['id_admin']);
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
    <title>Detail Kasir</title>
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

    <!-- Function -->
    <link rel="stylesheet" href="../../assets/css/mycss.css">
    <script src="../../assets/js/funct.js"></script>

</head>

<body>

    <!-- Topbar -->
    <?php include '../../views/layout/navbar2.php'; ?>
    <!-- End of Topbar -->

    <!-- Content Wrapper -->
    <div class="page-content-wrapper">
    <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
          <!-- User Information-->
          <div class="card user-info-card">
            <div class="card-body p-4 d-flex align-items-center">
              <div class="user-profile me-3"><img src="../../assets/img/male.png" alt=""></div>
              <div class="user-info">
                <p class="mb-0 text-white"><?php echo $detail_kasir['username'] ?></p>
                <h5 class="mb-0"><?php echo $detail_kasir['nama'] ?></h5>
              </div>
            </div>
          </div>
          <!-- User Meta Data-->
          <div class="card user-data-card">
            <div class="card-body">
              <div class="single-profile-data d-flex align-items-center justify-content-between">
                <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Username</span></div>
                <div class="data-content"><?php echo $detail_kasir['username'] ?></div>
              </div>
              <div class="single-profile-data d-flex align-items-center justify-content-between">
                <div class="title d-flex align-items-center"><i class="lni lni-user"></i><span>Nama Lengkap</span></div>
                <div class="data-content"><?php echo $detail_kasir['nama'] ?></div>
              </div>
              <div class="single-profile-data d-flex align-items-center justify-content-between">
                <div class="title d-flex align-items-center"><i class="lni lni-phone"></i><span>No HP</span></div>
                <div class="data-content"><?php echo $detail_kasir['nohp'] ?></div>
              </div>
              <!-- <div class="single-profile-data d-flex align-items-center justify-content-between">
                <div class="title d-flex align-items-center"><i class="lni lni-star"></i><span>Riwayat Transaksi</span></div>
                <div class="data-content"><a class="btn btn-danger btn-sm" href="my-order.html">Lihat</a></div>
              </div> -->
              <!-- Edit Profile-->
              <div class="row">
                  <div class="col-6 edit-profile-btn mt-3"><a class="btn btn-info w-100" href="edit-kasir.php?identity=<?php echo base64_encode($detail_kasir['username']) ?>"><i class="lni lni-pencil me-2"></i>Edit Profile</a></div>
                  <div class="col-6 edit-profile-btn mt-3"><a class="btn btn-success w-100" href="account-kasir.php?identity=<?php echo base64_encode($detail_kasir['username']) ?>"><i class="lni lni-pencil-alt me-2"></i>Akun</a></div>
              </div>
            </div>
          </div>
        </div>

        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cash-register mr-2"></i>Data Transaksi <?php echo $detail_kasir['nama'] ?></h6>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="table-responsive" style="font-size: 10pt;">
                                    <table class="table table-striped table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Kode Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Tagihan</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Kode Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Tagihan</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $i = 1;

                                            foreach ($transaksi as $v) {
                                                $tanggal = explode(' ', $v['create_at']);
                                                $id = base64_encode($v['kode_transaksi']);
                                                ?>
                                                <tr class="clickable-row" onclick="detail_transaksi('<?php echo $id ?>')">
                                                    <td><?php echo $v['kode_transaksi'] ?></td>
                                                    <td><?php echo $tanggal[0] ?></td>
                                                    <td class="text-right">Rp. <?php echo number_format($v['total']) ?></td>
                                                    <!-- <td class="text-center">
                                                        <a href="../riwayat-transaksi/detail-transaksi.php?i=<?php // echo base64_encode($v['kode_transaksi']) ?>" class="btn btn-sm btn-outline-primary">Detail</a>
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
        $('#dataTable').dataTable({
            "order": [
                [1, "desc"]
            ]
        });
    </script>


</body>

</html>