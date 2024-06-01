var inpkode = $("#kode");
var inpnama = $("#nama");
var inpharga = $("#harga");
var inpqty = $("#qty");
var inpsubtotal = $("#subtoal");

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
            $("#nama").val(data[i].nama);
            $("#harga").val(data[i].harga);
            $("#qty").val(1);
            $("#subtotal").val(data[i].harga);
            $("#stok").text(data[i].sisa);
            $("#qty").attr({
              max: data[i].sisa,
            });
            $("#tocarts").attr("disabled", false);
          } // for
        } else {
          $("#nama").val("");
          $("#harga").val("");
          $("#qty").val("");
          $("#subtotal").val("");
          $("#stok").text("");
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

    if (q > stok || q === "") {
      $("#tocarts").attr("disabled", true);
    } else {
      $("#tocarts").attr("disabled", false);
      $("#qty").removeClass("border-danger");
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

        if (data) {
        } // if
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
    } else {
      $("#poin3").val(0);
      $("#potongan").val(0);
      $("#totalbayar1").val($("#subtotalbayar1").val());
      var v = $("#subtotalbayar1").val();
      $("#totalbayar").val($.number(v));
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
