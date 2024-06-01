

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


    // TRANSAKSI PROCESS
    // $(document).ready(function() {
    //     // Send Search Text to the server
    //     $("#search").on('submit', function() {
    //         let searchText = $(this).val();
    //         if (searchText != "") {
    //             // console.log(searchText);
    //             $.ajax({
    //                 url: "cari-barang.php",
    //                 method: "post",
    //                 data: {
    //                     query: searchText,
    //                 },
    //                 success: function(data) {
    //                     console.log(data);
    //                     $("#cart").html(data);
    //                 },
    //             });
    //         } else {
    //             $("#cart").html("");
    //         }
    //     });
    //     // Set searched text in input field on click of search button
    //     $(document).on("click", "a", function() {
    //         $("#search").val($(this).text());
    //         $("#show-list").html("");
    //     });

    // });

    $(document).ready(function() {
        
        $("#kode").on("keyup", function() {
            var kode = $("#kode").val();
            // var data = 'one=' + kode;

            $.ajax({
                type: "POST",
                url: "../../helper/barangmasukHelper.php",
                data: {
                    query: kode,
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data) {
                        for (var i = 0; i < data.length; i++) { //for each user in the json response
                            console.log(data[i].id_satuan);
                            $("#nama").val(data[i].nama);
                            $("select[name=satuan]").val(data[i].id_satuan);
                            $("#satuan").selectpicker('refresh');
                            $("#jenis").val(data[i].jenis);
                            $("#modal").val(data[i].modal);
                            $("#harga").val(data[i].harga);
                            $("#status").val(data[i].status);
                        } // for

                    } // if
                } // success
            }); // ajax
        });

        $('#jumlah').on('keyup change', function() {
            var modal = $('#modal').val();
            var jumlah = $('#jumlah').val();
            var total_modal = modal * jumlah;
            $('#total_modal').val(total_modal);

        });
        $('#modal').on('keyup change', function() {
            var modal = $('#modal').val();
            var jumlah = $('#jumlah').val();
            var total_modal = modal * jumlah;
            $('#total_modal').val(total_modal);

        });


        $('#qty').on('keyup', function() {
            var h = $('#harga').val();
            var harga = parseInt(h);
            var q = $('#qty').val();
            var qty = parseInt(q);
            var amount = qty * harga;
            $('#subtotal').val(amount);
        });
        $('#qty').on('change', function() {
            var h = $('#harga').val();
            var harga = parseInt(h);
            var q = $('#qty').val();
            var qty = parseInt(q);
            var amount = qty * harga;
            $('#subtotal').val(amount);
        });


        // CART
        var count = 0;

        $('#tocart').on('click', function() {
            count += 1;
            var kode = $('#kode').val();
            var nama = $('#nama').val();
            var harga = $('#harga').val();
            var qty = $('#qty').val();
            var subtotal = $('#subtotal').val();
            $('#cart').append(`
        <tr>
            <td>` + count + `</td>
            <td>
                <input type="text" name="kode[]" class="form-control" value="` + kode + `" readonly>
            </td>
            <td>
                <input type="text" name="nama[]" class="form-control" value="` + nama + `" readonly>
            </td>
            <td>
                <input type="text" name="harga[]" class="form-control" value="` + harga + `" readonly>
            </td>
            <td>
                <input type="text" name="qty[]" class="form-control" value="` + qty + `" readonly>
            </td>
            <td>
                <input type="number" name="subtotal[]" class="form-control" value="` + subtotal + `" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove">Delete</button>
            </td>
        </tr>
        `);

            $('#kode').val('');
            $('#nama').val('');
            $('#harga').val('');
            $('#qty').val('');
            $('#subtotal').val('');

            if (count > 0) {
                $('.save').show();
            }

            $('.remove').on('click', function() {
                $(this).closest('tr').remove();
                count -= 1;
            });
        });


        // POIN PELANGGAN
        $('#pelanggan').on('change', function() {
            var user = $("#pelanggan").val();
            console.log(user);

            $.ajax({
                type: "POST",
                url: "../../helper/userHelper.php",
                data: {
                    query: user,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data[0].poin);
                    $("#poin").text(data[0].poin);
                    if (data) {

                    } // if
                } // success
            }); // ajax
        });

    });