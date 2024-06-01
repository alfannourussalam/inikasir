<?php
require '../../config/auth.inc';
include '../../controller/userController.php';
include '../../controller/roleController.php';

$data = user_show(base64_decode($_GET['identity']));

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Update Pelanggan</title>

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
                    <div class="row rounded rounded-4 shadow-lg mx-1 mb-4 bg-white">
                        <div class="col-md-4 bg-info p-5 text-white rounded">
                            <div class="row justify-content-center mb-5">
                                <img src="../../assets/img/up-profile.png" alt="Update Profile" srcset="" class="img-fluid" style="height: 180px;">
                            </div>
                            <div class="row justify-content-center mb-5">
                                <h4 style="font-weight: bold !important;">Let's complete you set up</h4>
                                <p class="fw-light fst-italic">Update profil pelanggan</p>
                            </div>
                            <div class="row justify-content-center">
                                <span class="btn btn-circle btn-light" style="cursor: default;"><i class="fas fa-chevron-right text-primary"></i></span>
                            </div>
                        </div>
                        <div class="col-md-8 bg-white p-5 text-black">
                            <div class="row justify-content-center mb-3">
                                <h3>Update Profil Pelanggan</h3>
                            </div>
                            <form action="update-user.php" method="post">
                                <div class="row mb-3">
                                    <input type="text" value="<?php echo base64_decode($_GET['identity']) ?>" name="id" hidden>
                                    <div class="col">
                                        <h5 class="text-lightgray"><i class="fas fa-square text-info mr-3"></i>Ubah Profil</h5>
                                        <div class="row mb-1 px-3 p-2">
                                            <div class="col">
                                                <label for="inputKode" class="form-label" style="font-size:small">Kode Pelanggan</label>
                                                <input type="text" class="form-control" name="kode_pelanggan" id="inputKode" value="<?php echo $data['kode_pelanggan'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-1 px-3 p-2">
                                            <div class="col">
                                                <label for="inputNama" class="form-label" style="font-size:small">Nama pelanggan</label>
                                                <input type="text" class="form-control" name="nama" id="inputNama" placeholder="masukkan nama lengkap pelanggan" value="<?php echo $data['nama'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-1 px-3 p-2">
                                            <div class="col-sm-6">
                                                <label for="inputNohp" class="form-label" style="font-size:small">Nomor Handphone</label>
                                                <input type="text" class="form-control" name="nohp" id="inputNohp" value="<?php echo $data['nohp'] ?>" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmail" class="form-label" style="font-size:small">Email</label>
                                                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="example@gmail.com" value="<?php echo $data['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-1 px-3 p-2">
                                            <div class="col">
                                                <label for="inputAlamat" class="form-label" style="font-size:small">Alamat</label>
                                                <input type="text" class="form-control" name="alamat" id="inputAlamat" value="<?php echo $data['alamat'] ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2" hidden>
                                            <label for="inputNohp" class="col-sm-3 col-form-label lbl-input">Role</label>
                                            <div class="col-sm-2">
                                                <select class="form-control bg-gray-200" aria-label="Default select example" name="kode_role">
                                                    <?php
                                                    $role = role_all();
                                                    foreach ($role as $v) { ?>
                                                        <option value="<?= $v['id'] ?>" <?php if ($v['id'] == $data['kode_role']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $v['ket_role'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 justify-content-end px-4">
                                    <a href="#" class="btn btn-secondary btn-icon-split mr-3" id="backward">
                                        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                                        <span class="text">Kembali</span>
                                    </a>
                                    <button type="submit" id="update-user" class="btn btn-primary btn-icon-split save" name="update-user">
                                        <span class="icon text-white-50"><i class="fas fa-paper-plane"></i></span>
                                        <span class="text">Kirim</span>
                                    </button>
                                </div>
                            </form>
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
        $(function(){
            $('#backward').on('click', function(){
                window.location(history.back());
            });
        });
    </script>


</body>

</html>