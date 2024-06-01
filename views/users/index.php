<?php
require '../../config/auth.inc';
include '../../controller/userController.php';


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Daftar Pelanggan</title>

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
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include '../../views/layout/navbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Notification -->
                <?php
                if (isset($_SESSION['status'])) {
                    if ($_SESSION['status']=='sukses') { ?>
                        <input type="text" value="Data berhasil ditambahkan" hidden id="flash">
                    <?php
                    }
                    if ($_SESSION['status']=='delete') { ?>
                        <input type="text" value="Data berhasil dihapus" hidden id="flash">
                    <?php
                    }
                    if ($_SESSION['status']=='update') { ?>
                        <input type="text" value="Data berhasil diubah" hidden id="flash">
                    <?php
                    }
                    unset($_SESSION['status']);
                }

                ?><!-- End notification -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Pelanggan</h1>
                    <div class="mb-3">
                        <a href="tambah-user.php" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-user-plus"></i>
                            </span>
                            <span class="text">Tambah Pelanggan Baru</span>
                        </a>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Daftar Pelanggan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered data" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No HP</th>
                                            <th>Poin</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No HP</th>
                                            <th>Poin</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $data_pelanggan = user_all();
                            
                                        foreach ($data_pelanggan as $v) { ?>
                                            <tr>
                                                <td><?php echo $v['kode_pelanggan'] ?></td>
                                                <td><?php echo $v['nama'] ?></td>
                                                <td><?php echo $v['username'] ?></td>
                                                <td><?php echo $v['nohp'] ?></td>
                                                <td><span class="btn btn-sm btn-success rounded-pill"><?php echo $v['poin'] ?></span></td>
                                                <td class="text-center">
                                                    <a href="show-user.php?identity=<?php echo base64_encode($v['id']) ?>" class="btn btn-sm btn-outline-primary" title="lihat data"><i class="fas fa-eye"></i></a>
                                                    <a href="edit-user.php?identity=<?php echo base64_encode($v['id']) ?>" class="btn btn-sm btn-outline-info" title="ubah data"><i class="fas fa-user-edit"></i></a>
                                                    <a href="delete-user.php?identity=<?php echo base64_encode($v['id']) ?>" class="btn btn-sm btn-outline-danger" title="hapus data" id="hapus-data"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        <?php
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

        $('#dataTable').dataTable ({
            "order":[[1, "asc"]]
        });
    </script>


</body>

</html>