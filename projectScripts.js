var url_path = $('#baseUrl').val();
var otpselectedVal;
var paymentstatusselectedVal;
// spinner
// $(document).ajaxSend(function() {
//     $("#overlay").fadeIn(300);　
// });

function loadspinner() {
    setTimeout(function() {
        $("#overlay").fadeOut(300);
    }, 700);
}
// end of spinner
$(document).ready(function() {
    $('#userTable').DataTable({
        "ajax": url_path + "getProperty_ajax",
        "order": []
    });

});

function deactiveDesc(id) {
    $('#exampleModalCenterd').modal('show');
}


function userData(selectedVal) {
    $.ajax({
        type: "POST",
        url: url_path + "getUserByOTP_ajax",
        data: { is_validated: selectedVal },
        dataType: "json",
        success: function(data) {

            var result_set = JSON.stringify(data.data);
            // console.log(result_set);            
            var dataSet = JSON.parse(result_set);
            var table = $('#userTable').DataTable();
            table.clear().draw();
            $('#userTable').dataTable().fnAddData(dataSet);

        },
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        complete: function() {
            loadspinner();
        }
    });
}

function userPaymentStatusData(selectedVal) {
    $.ajax({
        type: "POST",
        url: url_path + "getUserByPaymentStatus_ajax",
        data: { payment_status: selectedVal },
        dataType: "json",
        success: function(data) {
            var result_set = JSON.stringify(data.data);
            console.log(result_set);
            var dataSet = JSON.parse(result_set);
            var table = $('#userTable').DataTable();
            table.clear().draw();
            $('#userTable').dataTable().fnAddData(dataSet);

        },
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },
        complete: function() {
            loadspinner();
        }
    });
}

$('#otp_filter').on('change', function() {
    paymentstatusselectedVal = '';
    $("#payment_filter").val(paymentstatusselectedVal);
    otpselectedVal = $("#otp_filter").val();
    if (otpselectedVal != '') {
        userData(otpselectedVal);
    } else {
        location.reload();
    }

});

$('#payment_filter').on('change', function() {
    otpselectedVal = '';
    $("#otp_filter").val(otpselectedVal);
    paymentstatusselectedVal = $("#payment_filter").val();
    // console.log(selectedVal);
    if (paymentstatusselectedVal != '') {
        userPaymentStatusData(paymentstatusselectedVal);
    } else {
        location.reload();
    }

});

function do_deactive(id) {
    // console.log(id);
    // $('#userTable').DataTable().ajax.reload();
    $('#modalONELongTitle').empty().html('Deactive reason');
    $('#modalONEbody').empty().append('<textarea class="form-control" id="deactiveDesc" placeholder="Deactive reason goes here.." rows="3"></textarea><input type="hidden" id="userid" name="userid" value="">');
    $('#userid').val(id);
    $('#submit_btn').removeClass('d-none');
    $('#modalONE').modal('show');

}
$('#submit_btn').on('click', function() {

    var id = $('#userid').val();
    var reason = $('#deactiveDesc').val();
    // alert(reason);
    if (reason && id) {

        $.ajax({
            type: "POST",
            url: url_path + "check_userStatus",
            data: { user_id: id },
            dataType: "json",
            success: function(data) {
                // console.log(data);
                var status;
                $.each(data, function(i, item) {
                    status = item.status;
                });
                if (status === '1') {
                    // console.log('Active');
                    if (confirm('Do you want to deactive this user ?')) {
                        $('#submit_btn').addClass('disabled');
                        $('#modalONE').modal('hide');
                        $.ajax({
                            type: "POST",
                            url: url_path + "updateStatus",
                            data: { user_id: id, status: 0, reason: reason },
                            dataType: "json",
                            success: function(data) {
                                $('#userTable').DataTable().ajax.reload();
                            }
                        });
                    }

                }
            },
            beforeSend: function() {
                $("#overlay").fadeIn(300);
            },
            complete: function() {
                $('#submit_btn').removeClass('disabled');
                loadspinner();
            }
        });
    }
});

function deactiveReason(id) {
    $('#modalONELongTitle').empty().html('Deactive reason');
    $('#modalONEbody').empty().append('<textarea class="form-control" id="deactiveDesc" placeholder="Deactive reason goes here.." rows="3"></textarea><input type="hidden" id="userid" name="userid" value="">');
    $('#userid').val(id);
    $("#deactiveDesc").attr("disabled", "disabled");
    $('#submit_btn').addClass('d-none');
    $('#modalONE').modal('show');
    $.ajax({
        type: "POST",
        url: url_path + "check_userStatus",
        data: { user_id: id },
        dataType: "json",
        success: function(data) {
            // console.log(data);
            var reason;
            $.each(data, function(i, item) {
                reason = item.deactive_reason;
            });
            $('#deactiveDesc').empty().html(reason);
        }
    });
}
function deleteUser(id) {
    var result = confirm("Are you sure to delete?");
    if(result){
        $.ajax({
            type: "POST",
            url: url_path + "delete_user",
            data: { user_id: id },
            dataType: "json",
            success: function(data) {
                if(data){
                 location.reload();
                }
            }
        });
    }
   
}
function do_active(id) {
    if (confirm('Do you want to active this user ?')) {
        $.ajax({
            type: "POST",
            url: url_path + "updateStatus",
            data: { user_id: id, status: 1, reason: null },
            dataType: "json",
            success: function(data) {
                $('#userTable').DataTable().ajax.reload();
            },
            beforeSend: function() {
                $("#overlay").fadeIn(300);
            },
            complete: function() {
                loadspinner();
            }
        });
    }
}

// to get payment details by id(By JR,1-9-21)     
function paymentStatus(user_id) {
    // alert(user_id);
    var user_id = user_id;
    $(".modal-body #user_id").val(user_id);
    $("#exampleModal").modal('show');
} 
