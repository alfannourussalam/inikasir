<?php
require_once '../../config/auth.inc';
include_once '../../controller/userController.php';
include_once '../../controller/roleController.php';
include_once '../../controller/transaksiController.php';

if (isset($_GET['identity'])) {
    $id = base64_decode($_GET['identity']);
    $detail_user = user_show($id);
    $transaksi = transaksi_user($id, $detail_user['id_admin']);
} else {
    header('Location:/' . $basename . '/views/users/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Detail Pelanggan</title>

    <!-- Favicons -->
    <link href="../../assets/img/<?php echo $icon ?>" rel="icon">
    <link href="../../assets/img/<?php echo $icon ?>" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- SIDEBAR INC -->
        <?php include '../../views/layout/sidebar.php'; ?>
        <!-- END SIDEBAR -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../../views/layout/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-id-card mr-2"></i> Profil</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="edit-user.php?identity=<?php echo base64_encode($detail_user['id']) ?>">Ubah</a>
                                            <a class="dropdown-item" href="delete-user.php?identity=<?php echo base64_encode($detail_user['id']) ?>">Hapus pelanggan</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="account-user.php?identity=<?php echo base64_encode($detail_user['id']) ?>">Pengaturan akun</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row justify-content-center mb-2">
                                        <img src="../../assets/img/male.png" alt="<?php echo $detail_user['nama'] ?>" srcset="" class="img-fluid rounded-circle" style="height: 160px;">
                                    </div>
                                    <div class="row justify-content-center" style="margin-bottom: -5px;">
                                        <i style="font-size: 12pt !important;"><?php echo $detail_user['kode_pelanggan'] ?></i>
                                    </div>
                                    <div class="row justify-content-center">
                                        <b style="font-size: 14pt !important;"><?php echo $detail_user['nama'] ?></b>
                                    </div>
                                    <div class="row justify-content-center">
                                        <span class="btn btn-primary btn-sm" style="border-radius: 20px !important;">
                                            <?php echo $detail_user['poin'] ?>
                                        </span>
                                    </div>
                                    <hr>
                                    <div class="row ml-4 mb-2">
                                        <i class="fas fa-envelope mr-4"></i><?php echo $detail_user['email'] ?>
                                    </div>
                                    <div class="row ml-4 mb-2">
                                        <i class="fas fa-phone mr-4"></i><?php echo $detail_user['nohp'] ?>
                                    </div>
                                    <div class="row ml-4">
                                        <i class="fas fa-map-marker-alt mr-4"></i><?php echo $detail_user['alamat'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cash-register mr-2"></i>Data Transaksi <?php echo $detail_user['nama'] ?></h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="table-responsive" style="font-size: 10pt;">
                                        <table class="table table-striped table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Kode Transaksi</th>
                                                    <th>Kasir</th>
                                                    <th>Tanggal</th>
                                                    <th>Tagihan</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Kode Transaksi</th>
                                                    <th>Kasir</th>
                                                    <th>Tanggal</th>
                                                    <th>Tagihan</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <?php
                                                $i = 1;

                                                foreach ($transaksi as $v) { ?>
                                                    <tr>
                                                        <td><?php echo $v['kode_transaksi'] ?></td>
                                                        <td><?php echo $v['nama_kasir'] ?></td>
                                                        <td><?php echo $v['create_at'] ?></td>
                                                        <td class="text-right">Rp. <?php echo number_format($v['total']) ?></td>
                                                        <td class="text-center">
                                                            <a href="../riwayat-transaksi/detail-transaksi.php?i=<?php echo base64_encode($v['kode_transaksi']) ?>" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                                                        </td>
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
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
            include_once '../layout/footer.html';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <!-- <script src="../../assets/js/sb-admin-2.min.js"></script> -->
    <script src="../../assets/js/sb-admin-2.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/chart-area-demo.js"></script>
    <script src="../../assets/js/demo/chart-pie-demo.js"></script>


    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/chart-area-demo.js"></script>
    <script src="../../assets/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../assets/js/demo/datatables-demo.js"></script>
    <script>
        
        $('#dataTable').dataTable({
            "order": [
                [2, "desc"]
            ]
        });
    </script>

</body>

</html>