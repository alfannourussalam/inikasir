$('#complete').attr('disabled', true);


// ADMIN CONTROL ACCONT
$('#inputUsername').on('keyup change', function() {
    var uname = $('#inputUsername').val();
    if (uname != '') {
        $.ajax({
            url: '/inikasir/helper/accountHelper.php',
            type: 'POST',
            data: {
                username: uname
            },
            success: function(response) {
                if (response > 0) {
                    var oldUsername = $('#oldUsername').val();
                    var newUsername = $('#inputUsername').val();

                    if (newUsername == oldUsername) {
                        $('#error').html('');
                        $('#complete').attr('disabled', false);
                    } else {
                        $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1"></i>Enter a unique username<b class="ms-1 text-danger">Username tidak tersedia</b></small>');
                        $('#complete').attr('disabled', true);
                    }

                } else {
                    $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1 text-success"></i>Tersedia<b class="ms-1"><i class="lni lni-checkmark"></i></b></small>');
                    $('#complete').attr('disabled', false);
                }
            }
        });
    } else {
        $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1"></i>Enter a unique username<b class="ms-1 text-danger">Username tidak boleh kosong</b></small>');
        $('#complete').attr('disabled', true);
    }
});


// KASIR CONTROL ACCOUNT
function username_kasir() {
    $(document).ready(function() {
        $('#inputUsername').on('keyup change', function() {
            var uname = $('#inputUsername').val();
            
            if (uname != '') {
                $('#error').show();
                $.ajax({
                    url: '../../helper/kasirHelper.php',
                    type: 'POST',
                    data: {
                        username: uname
                    },
                    success: function(response) {
                        if (response > 0) {
                            $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1"></i>Enter a unique username<b class="ms-1 text-danger">Username tidak tersedia</b></small>');
                            $('#add-user').attr('disabled', true);
                        } else {
                            $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1 text-success"></i>Tersedia<b class="ms-1"><i class="lni lni-checkmark"></i></b></small>');
                            $('#add-user').attr('disabled', false);
                        }
                    }
                });
            } else {
                $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1"></i>Enter a unique username<b class="ms-1 text-danger">Username tidak boleh kosong</b></small>');
                $('#add-user').attr('disabled', true);
            }
        });
    });
}

function username_kasiredit(x) {
    $(document).ready(function() {
        $('#inputUsername').on('keyup change', function() {
            var uname = $('#inputUsername').val();
            var olduname = x;
            
            if (uname != '') {
                $('#error').show();
                $.ajax({
                    url: '../../helper/kasirHelper.php',
                    type: 'POST',
                    data: {
                        username: uname
                    },
                    success: function(response) {
                        if (response > 0) {                            
                            var oldUsername = olduname;
                            var newUsername = $('#inputUsername').val();

                            if (newUsername == oldUsername) {
                                $('#error').html('');
                                $('#save-account').attr('disabled', false);
                            } else {
                                $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1"></i>Enter a unique username<b class="ms-1 text-danger">Username tidak tersedia</b></small>');
                                $('#save-account').attr('disabled', true);
                            }
                        } else {
                            $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1 text-success"></i>Tersedia<b class="ms-1"><i class="lni lni-checkmark"></i></b></small>');
                            $('#save-account').attr('disabled', false);
                        }
                    }
                });
            } else {
                $('#error').html('<small class="ms-1"><i class="fa fa-lock me-1"></i>Enter a unique username<b class="ms-1 text-danger">Username tidak boleh kosong</b></small>');
                $('#save-account').attr('disabled', true);
            }
        });
    });
}




