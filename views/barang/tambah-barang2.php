<?php
require '../../config/auth.inc';
include '../../controller/barangController.php';
include '../../controller/suplierController.php';

$suplier = suplier_all();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Barang</title>

    <!-- Favicons -->
    <link href="../../assets/img/alf-ico.png" rel="icon">
    <link href="../../assets/img/alf-ico.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="../../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Bootstrap Custom Select -->
    <link rel="stylesheet" href="../../assets/custom-select/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/custom-select/bootstrap-select.min.css">

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
                    <form action="insert-barang.php" method="post">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tambah Barang</h1>
                        <div class="mb-3">
                            <button type="button" id="add-barang" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                                <span class="text">Tambah Record</span>
                            </button>
                        </div>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Draft Barang Sementara</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" width="100%" cellspacing="2">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis</th>
                                                <th>Suplier</th>
                                                <th>Modal</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="chart">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row save text-center mb-3" style="display: none;">
                                <div class="col-lg-12">
                                    <button type="submit" id="add-barang" class="btn btn-success btn-icon-split save" name="simpan">
                                        <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                                        <span class="text">Simpan</span>
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../assets/js/sb-admin-2.min.js"></script>

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

    <script src="../../assets/custom-select/popper.min.js"></script>
    <script src="../../assets/custom-select/bootstrap.min.js"></script>
    <script src="../../assets/custom-select/bootstrap-select.min.js"></script>

    <script>
        $(function() {
            var count = 0;

            $('#add-barang').on('click', function() {
                count += 1;
                console.log(count);
                $('#chart').append(`
                <tr>
                    <td>` + count + `</td>
                    <td>
                        <input type="text" name="kode[]" class="form-control" requried>
                    </td>
                    <td>
                        <input type="text" name="nama[]" class="form-control" requried>
                    </td>
                    <td>
                        <input type="text" name="jenis[]" class="form-control" requried>
                    </td>
                    <td>
                        <input type="text" name="suplier[]" class="form-control" requried>
                    </td>
                    <td>
                        <input type="number" name="modal[]" class="form-control" requried>
                    </td>
                    <td>
                        <input type="number" name="harga[]" class="form-control" requried>
                    </td>
                    <td>
                        <input type="number" name="jumlah[]" class="form-control" requried>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove">Delete</button>
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