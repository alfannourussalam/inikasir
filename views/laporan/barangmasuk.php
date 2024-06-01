<?php
require_once '../../config/auth.inc';
include_once '../../controller/laporanController.php';

if (isset($_POST['search-barangmasuk'])) {
    $fdate = $_POST['fdate'];
    $ldate = $_POST['ldate'];
    $barangmasuk =  barangmasuk_range($fdate, $ldate);

    if ($fdate == '' || $ldate == '') {
        $barangmasuk =  barangmasuk();
    }
    $q = $fdate . $ldate;
} else {
    $fdate = '';
    $ldate = '';
    $barangmasuk =  barangmasuk();
    $q = 'all';
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

    <title>Daftar Barang Masuk</title>

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

    <!-- Sweet Alert -->
    <link href="../../assets/sweetalert/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- SIDEBAR INC -->
        <?php include '../../views/layout/sidebar.php'; ?>
        <!-- END SIDEBAR -->

        <!-- Content Wrapper -->
        <div class="page-content-wrapper">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../../views/layout/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Notification -->
                <?php
                if (isset($_GET['msg'])) {
                    if ($_GET['msg'] == "success") { ?>
                        <input type="text" value="Data berhasil ditambahkan" hidden id="flash">
                    <?php
                    }
                    if ($_GET['msg'] == "deleted") { ?>
                        <input type="text" value="Data berhasil dihapus" hidden id="flash">
                    <?php
                    }
                    if ($_GET['msg'] == "updated") { ?>
                        <input type="text" value="Data berhasil diupdate" hidden id="flash">
                <?php
                    }
                }
                ?><!-- End notification -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Laporan Barang Masuk</h1>
                    <div class="row mt-4">
                        <div class="col">
                            <div class="card mb-4 py-3 border-left-primary shadow">
                                <form method="post" action="">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6 col-lg-4 my-2">
                                                <label for="fdate">Mulai Dari</label>
                                                <input type="date" name="fdate" class="form-control" required>
                                            </div>
                                            <!-- <div class="col-sm-2 d-flex justify-content-center align-items-center">-</div> -->
                                            <div class="col-sm-6 col-lg-4 my-2">
                                                <label for="fdate">Sampai Tanggal</label>
                                                <input type="date" name="ldate" class="form-control" required>
                                            </div>
                                            <div class="col-sm-12 col-lg-1 col-md-2 my-2">
                                                <label for="submit">&nbsp;</label>
                                                <button type="submit" class=" form-control btn btn-primary" name="search-barangmasuk">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <form target="_blank" action="cetak-barangmasuk.php" method="post">
                            <input type="text" name="fdate" id="" value="<?php echo $fdate ?>" hidden readonly>
                            <input type="text" name="ldate" id="" value="<?php echo $ldate ?>" hidden readonly>
                            <div class="card-header py-3">
                                <div class="row">
                                    <h6 class="col-9 m-0 font-weight-bold text-primary"><i class="fas fa-shipping-fast"></i> Daftar Barang Masuk</h6>
                                    <span class="col-3 d-flex justify-content-end">
                                        <button name="go" type="submit" class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Suplier</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total Modal</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Suplier</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total Modal</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $i = 1;

                                        foreach ($barangmasuk as $v) { ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $v['kode_barang'] ?></td>
                                                <td><?php echo $v['nama'] ?></td>
                                                <td><?php echo $v['nama_suplier'] ?></td>
                                                <td><?php echo number_format($v['harga']) ?></td>
                                                <td><?php echo $v['jumlah'] ?></td>
                                                <td><?php echo number_format($v['harga']*$v['jumlah']) ?></td>
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

    <!-- Page level sweet alert -->
    <script src="../../assets/sweetalert/sweetalert2.js"></script>


</body>

</html>