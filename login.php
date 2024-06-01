<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
  <meta name="description" content="Ini Kasir - Inovative cash management">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#100DD1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
  <!-- Title-->
  <title>IniKasir</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
  <!-- Favicons -->
  <link href="./assets/img/mainlogo.png" rel="icon">
  <link href="./assets/img/mainlogo.png" rel="apple-touch-icon">
  <!-- Apple Touch Icon-->
  <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
  <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
  <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
  <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
  <!-- CSS Libraries-->
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/animate.css">
  <link rel="stylesheet" href="./assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="./assets/css/lineicons.min.css">
  <link rel="stylesheet" href="./assets/css/magnific-popup.css">
  <!-- Stylesheet-->
  <link rel="stylesheet" href="./assets/style.css">
  <!-- Web App Manifest-->
  <!-- <link rel="manifest" href="manifest.json"> -->
</head>


<body>

  <!-- Notification -->
  <?php
  if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == 'sukses') { ?>
      <input type="text" value="Register Berhasil" hidden id="flash">
    <?php
    }
    if ($_SESSION['status'] == 'error') { ?>
      <input type="text" value="Akun tidak ditemukan" hidden id="flash">
  <?php
    }
    unset($_SESSION['status']);
  }

  ?><!-- End notification -->


  <!-- Preloader-->
  <div class="preloader" id="preloader">
    <div class="spinner-grow text-secondary" role="status">
      <div class="sr-only">Loading...</div>
    </div>
  </div>
  <!-- Login Wrapper Area-->
  <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
    <!-- Background Shape-->
    <div class="background-shape"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo" src="./assets/img/logo2.png" alt="" style="width: 220px;">
          <!-- Register Form-->
          <div class="register-form mt-5 px-4">
            <form action="./config/auth.php" method="post">
              <div class="form-group text-start mb-4"><span>Username</span>
                <label for="username"><i class="lni lni-user"></i></label>
                <input class="form-control" id="username" name="username" type="text" placeholder="082980xx / info@example.com / username" autofocus>
              </div>
              <div class="form-group text-start mb-4"><span>Password</span>
                <label for="password"><i class="lni lni-lock"></i></label>
                <input class="form-control" id="password" name="password" type="password" placeholder="Password">
              </div>
              <div class="form-group text-start mb-4"><span>Role</span>
                <label for="password"><i class="lni lni-user-gorup"></i></label>
                <!-- <label for="role">Role</label> -->
                <select name="role" id="role" class="form-select" aria-label="Default select example">
                  <option value="1" selected>Admin</option>
                  <option value="2">Kasir</option>
                  <!-- <option value="3">Pelanggan</option> -->
                </select>
              </div>
              <button class="btn btn-warning btn-lg w-100" type="submit" name="login">Log In</button>
            </form>
          </div>
          <!-- Login Meta-->
          <div class="login-meta-data">
            <!-- <a class="forgot-password d-block mt-3 mb-1" href="forget-password.html">Forgot Password?</a> -->
            <p class="mb-0 mt-4">Didn't have an account?<a class="ms-1" href="register.php">Register Now</a></p>
          </div>

          <!-- SPONSORSHIP -->
          <footer class="p-3 text-center">
            <div class="row mb-2">
              <i class="text-white small opacity-50">Powered by</i>
            </div>
            <img src="assets/img/warxclo1.png" alt="sponsor" class="img-sponsor" width="64">
          </footer>

        </div>
      </div>
    </div>
  </div>
  <!-- All JavaScript Files-->
  <script src="./assets/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/jquery.min.js"></script>
  <script src="./assets/js/waypoints.min.js"></script>
  <script src="./assets/js/jquery.easing.min.js"></script>
  <script src="./assets/js/jquery.magnific-popup.min.js"></script>
  <script src="./assets/js/owl.carousel.min.js"></script>
  <script src="./assets/js/jquery.counterup.min.js"></script>
  <script src="./assets/js/jquery.countdown.min.js"></script>
  <script src="./assets/js/jquery.passwordstrength.js"></script>
  <script src="./assets/js/dark-mode-switch.js"></script>
  <script src="./assets/js/active.js"></script>
  <script src="./assets/js/pwa.js"></script>

  <!-- Notification -->
  <script src="./assets/sweetalert/sweetalert2.js"></script>

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
  </script>

</body>

</html>