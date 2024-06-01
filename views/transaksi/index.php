<?php
require_once '../../config/auth.inc';
require_once '../../config/permission.php';
include_once '../../controller/transaksiController.php';
include_once '../../controller/userController.php';
include_once '../../controller/kasirController.php';
include_once '../../controller/cartController.php';
include_once '../../controller/barangController.php';
include_once '../../library/library.php';

$user = user_all();
$cart = cart_all();
$kasir = admin_info();
$barang = barang_all();
$info = kasir_only($_SESSION['myid']);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Suha - Multipurpose Ecommerce Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Transaksi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
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
    <?php include '../../views/layout/navbar.php'; ?>
    <!-- End of Topbar -->

    <!-- Notification -->
    <?php
    if (isset($_SESSION['status'])) {
        if ($_SESSION['status'] == 'update') { ?>
            <input type="text" value="Data berhasil diubah" hidden id="flash">
            <?php
        }
        if ($_SESSION['status'] == 'error') { ?>
            <input type="text" value="Password Tidak Sesuai" hidden id="errorFlash">
            <?php
        }
        unset($_SESSION['status']);
    }

    ?><!-- End notification -->

    <!-- Content Wrapper -->
    <div class="page-content-wrapper">
        <div class="bg-primary pt-3 pb-1 text-center rounded-top rounded-pill mb-3 shadow-sm">
            <div class="section-heading align-items-center justify-content-between">
                <h4 class="fw-bold text-white">Transaksi</h4>
            </div>
        </div>
        <!-- Main Content -->
        <div id="content">

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <div class="row bg-white p-3 mx-1 mb-3">
                    <div class="col">
                        <form action="cart.php" method="post">
                            <div class="row">
                                <input type="text" value="<?php echo $_SESSION['id'] ?>" name="id_admin" hidden
                                    readonly>
                                <input type="hidden" value="<?php echo $_SESSION['myid'] ?>" name="id_kasir" hidden
                                    readonly>
                                <div class="col-sm-12 col-md-3 col-lg-3 mb-2">
                                    <label for="kodeBarang" class="form-label">Kode Barang</label>
                                    <input type="text" name="kode" class="form-control kode" id="kode"
                                        placeholder="Masukkan kode barang" autofocus>
                                </div>

                                <div class="col-sm-12 col-md-3 col-lg-3 mb-2">
                                    <label for="namaBarang" class="form-label">Nama Barang</label>
                                    <div class="search-select">
                                        <select class="form-control selectpicker" data-live-search="true" name="nama2" id=nama2>
                                            <option value="" selected>Pilih/cari item</option>
                                            <?php
                                            foreach ($barang as $b) { ?>
                                                <option value="<?php echo $b['id'] ?>">
                                                    <?php echo $b['nama'] ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3 col-lg-3 mb-2" hidden>
                                    <label for="namaBarang" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama" class="form-control nama" id="nama" readonly>
                                </div>
                                <div class="col-6 col-sm-6 col-md-1 col-lg-1 mb-2">
                                    <label for="hargaBarang" class="form-label">Harga</label>
                                    <input type="text" name="harga" class="form-control harga" id="harga" readonly>
                                </div>
                                <div class="col-6 col-sm-6 col-md-1 col-lg-1 mb-2" id="divqty">
                                    <label for="qtyBarang" class="form-label">QTY</label>
                                    <input type="number" min="1" name="qty" class="form-control qty" id="qty" required>
                                </div>
                                <div class="col-6 col-sm-6 col-md-1 col-lg-1 mb-2">
                                    <label for="diskon" class="form-label">Disc %</label>
                                    <input type="number" min='0' value='0' name="diskon" class="form-control qty" id="diskon">
                                </div>
                                <div class="col-6 col-sm-6 col-md-2 col-lg-2 mb-2">
                                    <label for="subtotalBarang" class="form-label">Subtotal</label>
                                    <input type="number" name="subtotal" class="form-control subtotal" id="subtotal"
                                        readonly>
                                </div>
                                <div class="col-12 col-sm-12 col-md-1 col-lg-1 mt-4 py-1"
                                    style="margin-top: 26px !important;">
                                    <button type="submit" name="toCart" class="form-control btn btn-success col-sm-12"
                                        id="tocarts">Add</button>
                                </div>

                            </div>
                        </form>
                        <div class="row text-black mt-2">
                            <div class="col-sm-12 col-md-3">
                                <h6 class="p-2 text-gray-500">STOK: <span id="stok"></span></h5>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <h6 class="p-2 opacity-50">ID/BATCH ID: <span id="id"></span></h5>
                            </div>
                            <!-- <div class="col-sm-12 col-md-3">
                                <h6 class="p-2 opacity-50">EXPIRED DATE: <span id="ed"></span></h5>
                            </div> -->
                        </div>
                    </div>
                </div>

                <form action="pay.php" method="post">
                    <input type="text" name="admin" value="<?php echo $_SESSION['id'] ?>" hidden readonly>
                    <input type="text" name="kasir" value="<?php echo $_SESSION['myid'] ?>" hidden readonly>
                    <div class="row bg-white p-3 mx-1 mb-3">
                        <div class="col-md-8" style="max-height:450px; overflow:auto">
                            <div class="cart-wrapper-area py-3">
                                <div class="cart-table card mb-3">
                                    <div class="table-responsive card-body">
                                        <table class="table mb-0">
                                            <tbody id="cart">
                                                <?php
                                                $i = 1;
                                                foreach ($cart as $value) { ?>

                                                    <tr>
                                                        <input type="text" value="<?= $value['kode_barang'] ?>"
                                                            name="kode[]" hidden readonly>
                                                        <input type="text" value="<?= $value['nama'] ?>" name="nama[]"
                                                            hidden readonly>
                                                        <input type="text" value="<?= $value['harga'] ?>" name="harga[]"
                                                            hidden readonly>
                                                        <input type="text" value="<?= $value['qty'] ?>" name="qty[]" hidden
                                                            readonly>
                                                        <input type="text" value="<?= $value['diskon'] ?>" name="diskon[]"
                                                            hidden readonly>
                                                        <input type="text" value="<?= $value['subtotal'] ?>"
                                                            name="subtotal[]" hidden readonly>

                                                        <!-- <td><span><?php // echo $value['kode_barang'] 
                                                            ?></span></td> -->
                                                        <td><a href="#">
                                                                <?= $value['nama'] ?><span>Rp.
                                                                    <?= number_format($value['harga']) ?> ×
                                                                    <?= $value['qty'] ?>
                                                                </span>
                                                            </a></td>
                                                        <td>Diskon:
                                                            <?php echo $value['diskon'] ?>
                                                        </td>
                                                        <td><b>Rp.
                                                                <?php echo number_format($value['subtotal']) ?>
                                                            </b></td>
                                                        <th scope="row"><a class="remove-product"
                                                                href="delete-cart.php?item=<?php echo base64_encode($value['id']) ?>"><i
                                                                    class="lni lni-close"></i></a></th>
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
                        <div class="col-md-4">
                            <?php
                            $payment = payment();
                            ?>
                            <!-- Cart Amount Area-->
                            <div class="card cart-amount-area px-2">
                                <div class="card-body d-flex align-items-center justify-content-between">

                                    <input name="subtotalbayar" type="text" id="subtotalbayar1"
                                        value="<?= $payment['total'] ?>" hidden readonly>
                                    <input name="potongan" class="form-control" type="text" id="potongan" value="0"
                                        readonly hidden>
                                    <input name="total" type="text" id="totalbayar1" hidden readonly>
                                    <input type="text" name="bayar" id="bayar1" hidden readonly>

                                    <!-- <input class="form-control fs-4 fw-bold btn btn-warning" type="text" id="totalbayar" style="outline: none; border:none; border-radius: 0;"> -->
                                    <h5 class="total-price mb-0">Total</h5><span
                                        class="bg-warning rounded px-3 py-2 fs-5 fw-bold" id="totalbayar2"></span>
                                </div>
                                <div class="row card-body d-flex align-items-center justify-content-between my-3">
                                    <input type="text" id="bayar" class="col-12 form-control mb-3 fw-bold"
                                        placeholder="Masukkan Nominal Uang"
                                        style="text-align:center; border: none; border-bottom:2px solid; border-color: gray; font-size:14pt">
                                    <button type="submit" class="btn btn-primary btn-lg bayar" id="add-transaksi"
                                        name="simpan-transaksi">Bayar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- End of Page Wrapper -->

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

    <!-- Page level sweet alert -->
    <script src="../../assets/sweetalert/sweetalert2.js"></script>
    <script src="../../assets/js/jquery.maskMoney.min.js"></script>
    <script src="../../assets/js/number.js"></script>
    <!-- <script src="../../assets/js/transaksi.js"></script> -->

    <script src="../../assets/custom-select/popper.min.js"></script>
    <script src="../../assets/custom-select/bootstrap.min.js"></script>
    <script src="../../assets/custom-select/bootstrap-select.min.js"></script>


    <script>
        $(function () {
            $('#bayar').maskMoney({
                decimal: ',',
                precision: 0
            });
        })
    </script>


    <script>
        // $(document).ready(function() {
        //     $('.search-select select').selectpicker();
        // });

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


    <script>
        var inpkode = $("#kode");
        var inpnama = $("#nama");
        var inpharga = $("#harga");
        var inpqty = $("#qty");
        var inpsubtotal = $("#subtoal");

        $('.selectpicker').selectpicker('refresh');

        $(document).on("click", "#hapus-data", function (e) {
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: "Apakah Anda yakin ?",
                text: "Data akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = link;
                }
            });
        });

        function parseCurrency(num) {
            return parseFloat(num.replace(/,/g, ""));
        }

        $(document).ready(function () {
            $("#tocarts").attr("disabled", true);

            $("#totalbayar1").val($("#subtotalbayar1").val());
            var x = $("#subtotalbayar1").val();
            $("#totalbayar").val($.number(x));
            $("#totalbayar2").text('Rp. ' + $.number(x));

            $(".bayar").attr("disabled", true);

            $("#kode").on("keyup", function () {
                var kode = $("#kode").val();
                // var data = 'one=' + kode;

                $.ajax({
                    type: "POST",
                    url: "../../helper/barangHelper.php",
                    data: {
                        query: kode,
                    },
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                //for each user in the json response
                                $('select[name=nama2]').val(data[i].id);
                                $('.selectpicker').selectpicker('refresh');
                                $("#nama").val(data[i].nama);
                                $("#harga").val(data[i].harga);
                                $("#qty").val(1);
                                $("#subtotal").val(data[i].harga);
                                $("#stok").text(data[i].sisa);
                                $("#qty").attr({
                                    max: data[i].sisa,
                                });
                                $("#id").text(data[i].kode);
                                $("#tocarts").attr("disabled", false);
                            } // for
                        } else {
                            $("#nama").val("");
                            $("#harga").val("");
                            $("#qty").val("");
                            $("#subtotal").val("");
                            $("#stok").text("");
                            $("#id").text("");
                            $("#tocarts").attr("disabled", true);
                        }

                    }, // success
                }); // ajax
            });


            // 
            $("#nama2").on("change", function () {
                var kode = $("#nama2").val();
                
                // var data = 'one=' + kode;

                $.ajax({
                    type: "POST",
                    url: "../../helper/barangHelper.php",
                    data: {
                        queryselected: kode,
                    },
                    dataType: "json",
                    success: function (data) {
                        // console.log(data);
                        if (data.length > 0) {
                            for (var i = 0; i < data.length; i++) {
                                //for each user in the json response
                                $("#kode").val(data[i].kode);
                                $('select[name=nama2]').val(data[i].id);
                                $('.selectpicker').selectpicker('refresh');
                                $("#nama").val(data[i].nama);
                                $("#harga").val(data[i].harga);
                                $("#qty").val(1);
                                $("#subtotal").val(data[i].harga);
                                $("#stok").text(data[i].sisa);
                                $("#qty").attr({
                                    max: data[i].sisa,
                                });
                                $("#id").text(data[i].kode);
                                $("#tocarts").attr("disabled", false);
                            } // for
                        } else {
                            $("#nama2").val("");
                            $("#nama").val("");
                            $("#harga").val("");
                            $("#qty").val("");
                            $("#subtotal").val("");
                            $("#stok").text("");
                            $("#id").text("");
                            $("#tocarts").attr("disabled", true);
                        }

                    }, // success
                }); // ajax
            });

            $("#qty").on("keyup", function () {
                var h = $("#harga").val();
                var harga = parseInt(h);
                var q = $("#qty").val();
                var qty = parseInt(q);
                var amount = qty * harga;
                var txtstok = $("#stok").text();
                var stok = parseInt(txtstok);
                $("#subtotal").val(amount);
                $("#diskon").val(0);

                if (q > stok || q === "") {
                    $("#tocarts").attr("disabled", true);
                    $("#qty").addClass("border-danger");
                } else {
                    $("#tocarts").attr("disabled", false);
                    $("#qty").removeClass("border-danger");
                }
            });

            $("#qty").on("change", function () {
                var h = $("#harga").val();
                var harga = parseInt(h);
                var q = $("#qty").val();
                var qty = parseInt(q);
                var amount = qty * harga;
                var txtstok = $("#stok").text();
                var stok = parseInt(txtstok);
                $("#subtotal").val(amount);
                $("#diskon").val(0);

                if (q > stok || q === "") {
                    $("#tocarts").attr("disabled", true);
                } else {
                    $("#tocarts").attr("disabled", false);
                    $("#qty").removeClass("border-danger");
                }
            });

            $("#diskon").on("keyup change", function () {
                var h = $("#harga").val();
                var harga = parseInt(h);
                var q = $("#qty").val();
                var qty = parseInt(q);
                var diskontxt = $("#diskon").val();
                var diskon = parseInt(diskontxt);

                temp_total = harga * qty;

                if (diskontxt != "") {
                    console.log(harga);
                    console.log(qty);
                    console.log(diskontxt);
                    var final = (harga - ((diskon / 100) * harga)) * qty;
                    $("#subtotal").val(final);
                } else {
                    $("#subtotal").val(temp_total);
                }
            });


            // CART

            // POIN PELANGGAN
            $("#pelanggan").on("change", function () {
                var user = $("#pelanggan").val();

                $.ajax({
                    type: "POST",
                    url: "../../helper/userHelper.php",
                    data: {
                        query: user,
                    },
                    dataType: "json",
                    success: function (data) {
                        $("#id_cust").text(data[0].id_cust);
                        $("#kode_pelanggan").val(data[0].id_cust);
                        $("#nama_cust").text(data[0].nama_cust);
                        $("#poin").text(data[0].poin);
                        $("#poin2").val(data[0].poin);

                        $("#poincheck").prop("checked", false);
                        $("#potongan").val(0);
                        $("#convpoin").val(data[0].potongan);

                        $("#poin").maskMoney({
                            decimal: ",",
                            precision: 0,
                        });

                        if (data) { } // if
                    }, // success
                }); // ajax
            });

            var a = $("#subtotalbayar1").val();
            $("#poin3").val(0);
            $("#poincheck").click(function () {
                if ($("#poincheck").is(":checked")) {
                    var get_poin = $("#poin3").val($("#poin2").val());
                    var get_potongan = $("#convpoin").val();
                    $("#potongan").val(get_potongan);
                    var totalbayar = $("#subtotalbayar1").val() - get_potongan;
                    $("#totalbayar1").val(totalbayar);
                    $("#totalbayar").val($.number(totalbayar));
                    $("#totalbayar2").text($.number(totalbayar));
                } else {
                    $("#poin3").val(0);
                    $("#potongan").val(0);
                    $("#totalbayar1").val($("#subtotalbayar1").val());
                    var v = $("#subtotalbayar1").val();
                    $("#totalbayar").val($.number(v));
                    $("#totalbayar2").text($.number(totalbayar));
                }
            });

            $("#bayar").keyup(function () {
                var amount = $("#totalbayar1").val();
                var uang = $("#bayar").val();
                uang = parseCurrency(uang);
                $("#bayar1").val(uang);

                if (parseInt(uang) >= parseInt(amount)) {
                    $(".bayar").attr("disabled", false);
                } else {
                    $(".bayar").attr("disabled", true);
                }
            });
        }); //ENDING
    </script>
</body>

</html>