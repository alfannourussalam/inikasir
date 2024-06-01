<?php
require '../../config/auth.inc';
include '../../controller/userController.php';
include '../../controller/roleController.php';

if (isset($_GET['identity'])) {
    $id = base64_decode($_GET['identity']);
    $detail_user = user_show($id);
} else {
    header('Location:/'.$basename.'/views/users/');
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

    <title>Pengaturan Akun</title>

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
                    <div class="row rounded rounded-4 shadow mx-1 mb-4 bg-white">
                        <div class="col-md-4 bg-primary p-5 text-white rounded">
                            <div class="row justify-content-center mb-5">
                                <img src="../../assets/img/setup-profile.png" alt="Male" srcset="" class="img-fluid" style="height: 180px;">
                            </div>
                            <div class="row justify-content-center mb-5">
                                <h4 style="font-weight: bold !important;">Let's keep you account</h4>
                                <p class="fw-light fst-italic">Keep secret your account info</p>
                            </div>
                            <div class="row justify-content-center">
                                <span class="btn btn-circle btn-light" style="cursor: default;"><i class="fas fa-chevron-right text-primary"></i></span>
                            </div>
                        </div>
                        <div class="col-md-8 bg-white p-5 text-black">
                            <div class="row justify-content-center mb-3">
                                <h3>Pengaturan Akun Pelanggan</h3>
                            </div>
                            <form action="update-user-account.php" method="post">
                                <input name="id" value="<?= $id ?>" hidden readonly>
                                <div class="row mb-3">
                                    <div class="col">
                                        <h5 class="text-lightgray"><i class="fas fa-square text-primary mr-3"></i>Informasi Akun <?php echo $detail_user['nama'] ?></h5>
                                        <div class="row mb-1 px-3 p-2">
                                            <div class="col-lg-5">
                                                <label for="inputUsername" class="form-label" style="font-size:small">Username</label>
                                                <input type="text" id="oldUsername" value="<?= $detail_user['username'] ?>" hidden readonly>
                                                <input type="text" class="form-control" name="username" id="inputUsername" placeholder="masukkan username" value="<?= $detail_user['username'] ?>" readonly>
                                                <span id="respUname">
                                                    
                                                </span>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="inputUsername" class="form-label text-info" style="font-size:small; font-style: italic;">Klik tombol untuk mulai mengubah</label>
                                                <span class="btn btn-primary edit" id="changeUsername">Ganti</span>
                                            </div>
                                        </div>
                                        <div class="row mb-1 px-3 p-2">
                                            <span id="resetPassword" class="ml-3"><i class="text-primary" style="cursor: pointer;">Reset Password</i></span>
                                        </div>
                                        <div class="row mb-1 px-3 p-2" id="newPasswordGroup" style="display: none;">
                                            <div class="col-lg-5">
                                                <label for="inputPass" class="form-label" style="font-size:small">New Password</label>
                                                <input type="password" class="form-control" name="password" id="newPassword" placeholder="masukkan password baru">
                                            </div>
                                            <!-- <div class="col-lg-5">
                                                <label for="inputPass" class="form-label text-lightgray" style="font-size:small">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirmPass" id="confirmPass" placeholder="konfirmasi password baru">
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2 justify-content-start px-4 mt-5">
                                    <a href="#" class="btn btn-secondary btn-icon-split mr-3" id="backward">
                                        <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                                        <span class="text">Kembali</span>
                                    </a>
                                    <button type="submit" id="save-account" class="btn btn-primary btn-icon-split save" name="save-account" style="display: none;">
                                        <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                                        <span class="text">Simpan</span>
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
        $(function() {
            // $('#changeUsername').on('click', '.edit', function () {
            //     $('#changeUsername').removeClass('edit');
            //     $('#changeUsername').addClass('removeEdit');
            //     $('#inputUsername').prop('readOnly', false);
            // });
            // $('#changeUsername').on('click', '.removeEdit', function () {
            //     $('#changeUsername').removeClass('removeEdit');
            //     $('#changeUsername').addClass('edit');
            //     $('#inputUsername').prop('readOnly', true);
            // });

            $('#inputUsername').on('keyup', function(){
                var uname = $('#inputUsername').val();
                var olduname = $('#oldUsername').val();
                console.log(uname);
                if (uname != '') {
                    $('#respUname').show();
                    $.ajax({
                        url:'../../helper/userHelper.php',
                        type:'POST',
                        data:{username:uname},
                        success: function(response){
                            if (response > 0) {
                                if (uname == olduname) {
                                    $('#save-account').attr('disabled', false);    
                                    $('#respUname').html('');
                                } else {
                                    $('#respUname').html('<i class="text-danger" style="font-size:9pt">Username sudah terpakai !!!</i>');
                                    $('#save-account').attr('disabled', true);
                                }
                            } else {
                                $('#respUname').html('<i class="text-success" style="font-size:9pt">Username tersedia <i class="fas fa-check"></i></i>');
                                $('#save-account').attr('disabled', false);
                            }
                        }
                    });
                } else {
                    $('#respUname').hide();
                    $('#save-account').attr('disabled', true);
                }
            });

            // CHANGE USERNAME
            $('#changeUsername').on('click', function() {
                var val = $(this).text();
                // console.log(val);
                if (val === 'Ganti') {
                    $(this).text('Ok');
                    $('#inputUsername').prop('readOnly', false);
                }
                if (val === 'Ok') {
                    $(this).text('Ganti');
                    $('#inputUsername').prop('readOnly', true);
                    $('#save-account').show();
                }
            });


            // RESET PASSWORD
            $('#resetPassword').on('click', function() {
                var val = $(this).text();
                if (val === 'Reset Password') {
                    // $(this).text('Batal Reset Password');
                    $(this).html('<i class="text-primary" style="cursor: pointer;">Batal Reset Password</i>');
                    $('#newPasswordGroup').show();
                    $('#save-account').show();
                }
                if (val === 'Batal Reset Password') {
                    // $(this).text('Reset Password');
                    $(this).html('<i class="text-primary" style="cursor: pointer;">Reset Password</i>');
                    $('#newPasswordGroup').hide();
                }
            });

            $('#backward').on('click', function(){
                window.location(history.back());
            });
        });
    </script>

</body>

</html>