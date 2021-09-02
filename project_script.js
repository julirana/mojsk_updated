var url_path = $('#baseurl').val();
var newUserid;
var checkOtpValidate;

// spinner
$(document).ajaxSend(function() {
    $("#overlay").fadeIn(300);　
});

function loadspinner() {
    setTimeout(function() {
        $("#overlay").fadeOut(300);
    }, 700);
}
// end of spinner

$('#otp').on('hidden.bs.modal', function() {
    location.reload();
});
$('#myprofile').on('hidden.bs.modal', function() {
    location.reload();
});

$('#register_btn').on('click', function() {
    // alert('Resistration Page');
    var f_name = document.forms['r_form']['r_fname'].value;
    var l_name = document.forms['r_form']['r_lname'].value;
    var email = document.forms['r_form']['r_email'].value;
    var mobile = document.forms['r_form']['r_mobile'].value;
    var password = document.forms['r_form']['r_password'].value;
    var c_password = document.forms['r_form']['r_Cpassword'].value;
    if (f_name && email && password && c_password) {
        if (password == c_password) {
            var letters = /^[a-zA-Z0-9\s]+$/;
            if (password.match(letters)) {
                // $('#passwordHint').removeClass('d-none');
                msgAlert('Password should be in proper formate !', 'error');
            } else {
                var emailregex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (emailregex.test(email)) {
                    $.ajax({
                        type: "POST",
                        url: url_path + "Home/check_user",
                        data: { email: email },
                        dataType: "json",
                        success: function(data) {
                            var result_set = JSON.stringify(data);
                            var result = $.parseJSON(result_set);

                            if (result.length === 0) {
                                // console.log('No result');
                                $('#register_btn').addClass('disabled');

                                $.ajax({
                                    type: "POST",
                                    url: url_path + "Home/registation",
                                    data: { f_name: f_name, l_name: l_name, email: email, mobile: mobile, password: password },
                                    dataType: "json",
                                    success: function(data) {
                                        // var result_set = $.parseJSON(data);
                                        // console.log(result_set);
                                        newUserid = data;
                                        var otp;
                                        $.ajax({
                                            type: "POST",
                                            url: url_path + "Home/get_user",
                                            data: { user_id: newUserid },
                                            dataType: "json",
                                            success: function(data) {
                                                // var result_set = $.parseJSON(data);
                                                // console.log(data);
                                                $.each(data, function(i, item) {
                                                    otp = item.otp;
                                                });
                                                // console.log(otp);
                                                if (otp) {
                                                    // $('#otpVal').text(otp);
                                                    $('#exampleModalCenter').modal('hide');
                                                    msgAlert('You have registered successfully', 'success');
                                                    $('#otp').modal('show');

                                                }
                                            }
                                        }).done(function() {
                                            loadspinner();
                                        });

                                    }
                                }).done(function() {
                                    loadspinner();
                                });

                            } else {
                                $('#register_btn').removeClass('disabled');
                                msgAlert('User already exists', 'error');
                            }

                        }
                    }).done(function() {
                        loadspinner();
                    });
                } else {
                    msgAlert('Email should be in proper formate !', 'error');
                }
            }
        } else {
            // console.log('password not match');
            $('#register_btn').removeClass('disabled');
            msgAlert('Password not Matched', 'error');
        }
    } else {
        $('#register_btn').removeClass('disabled');
        msgAlert('Failed to register . Try again !', 'error');
    }

});

$('#otp_btn').on('click', function() {
    var otp = document.forms['otp_form']['otp_value'].value;
    var userId = $('#isValidUser').val();
    newUserid = userId ? userId : newUserid;
    // console.log(newUserid);
    $.ajax({
        type: "POST",
        url: url_path + "Home/check_userOtp",
        data: { user_id: newUserid, otp: otp },
        dataType: "json",
        success: function(data) {
            // console.log(data);
            if (data.length === 0) {
                msgAlert('Invalid entries. Try again !', 'error');
            } else {
                $.ajax({
                    type: "POST",
                    url: url_path + "Home/validateOtp",
                    data: { user_id: newUserid },
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);
                        if (data) {
                            msgAlert('OTP validated successfully.', 'success');
                            $('#otp').modal('hide');
                            window.location.href = url_path + "Home/dashboard/";
                        }
                    }
                }).done(function() {
                    loadspinner();
                });
            }
        }
    }).done(function() {
        loadspinner();
    });
});

$('input[id="passwordCheck"]').click(function() {
    if ($(this).is(":checked")) {
        // console.log("Checkbox is checked.");
        $('#passwordDiv').removeClass('d-none');
    } else if ($(this).is(":not(:checked)")) {
        // console.log("Checkbox is unchecked.");
        $('#passwordDiv').addClass('d-none');
    }
});

function readURL(input) {
    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
            $('#p_profile_tag').attr('src', e.target.result);

        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#p_profile").change(function() {
    readURL(this);

    var file = this.files[0];
    var form = new FormData();

    form.append('user_id', $('#userid').val());
    form.append('profile_img', file);
    // console.log(file);

    $.ajax({
        type: "POST",
        url: url_path + "Home/profileImageUpdate",
        cache: false,
        contentType: false,
        processData: false,
        data: form,
        dataType: "json",
        success: function(data) {
            var result_set = $.parseJSON(data);
            console.log(data);
            msgAlert('Profile image update successfully', 'success');
        }
    }).done(function() {
        loadspinner();
    });
});

$('#profile_btn').on('click', function() {
    var user_id = document.forms['p_form']['userid'].value;
    var f_name = document.forms['p_form']['p_fname'].value;
    var l_name = document.forms['p_form']['p_lname'].value;
    var email = document.forms['p_form']['p_email'].value;
    var mobile = document.forms['p_form']['p_mobile'].value;
    var p_panNo = document.forms['p_form']['p_panNo'].value;
    var p_aadharNo = document.forms['p_form']['p_aadharNo'].value;
    var address = document.forms['p_form']['p_address'].value;
    var password = '';

    if ($("#passwordCheck").prop("checked") == true) {
        password = document.forms['p_form']['p_password'].value;
    }
    // console.log(password);
    if (f_name && email) {
        $.ajax({
            type: "POST",
            url: url_path + "Home/check_user",
            data: { email: email },
            dataType: "json",
            success: function(data) {
                var result_set = JSON.stringify(data);
                var result = $.parseJSON(result_set);

                if (result.length === 1) {
                    // console.log(password);
                    var letters = /^[a-zA-Z0-9\s]+$/;
                    if (password != '' && password.match(letters)) {
                        // $('#passwordHint').removeClass('d-none');
                        msgAlert('Password should be in alphanumeric formate !', 'error');
                    } else {
                        $.ajax({
                            type: "POST",
                            url: url_path + "Home/profileUpdate",
                            data: { user_id: user_id, f_name: f_name, l_name: l_name, email: email, mobile: mobile, password: password, p_panNo: p_panNo, p_aadharNo: p_aadharNo, address: address },
                            dataType: "json",
                            success: function(data) {
                                // var result_set = $.parseJSON(data);
                                // console.log(data);
                                msgAlert('You have updated profile successfully', 'success');
                                location.reload();
                            }
                        }).done(function() {
                            loadspinner();
                        });
                    }

                } else {
                    msgAlert('Email has multiple accounts exist !', 'error');
                }

            }
        }).done(function() {
            loadspinner();
        });
    } else {
        msgAlert('Failed to update profile . Try again !', 'error');
    }
});

$('#login_btn').on('click', function() {
    var email = document.forms['l_form']['l_email'].value;
    var password = document.forms['l_form']['l_password'].value;
    if (email && password) {
        $.ajax({
            type: "POST",
            url: url_path + "Home/login",
            data: { email: email, password: password },
            dataType: "json",
            success: function(data) {
                var otp;
                $.each(data, function(i, item) {
                    checkOtpValidate = item.is_validated;
                    otp = item.otp;
                    $('#isValidUser').val(item.user_id);

                });

                if (checkOtpValidate === '1') {
                    msgAlert('Login successfully.', 'success');
                    $('#login').modal('hide');
                    $('#login').on('hidden.bs.modal', function() {
                        window.location.href = url_path + "Home/dashboard/";
                    });
                } else if (checkOtpValidate === '0') {
                    $('#login').modal('hide');
                    // $('#otpVal').text(otp);
                    $('#otp').modal('show');
                } else {
                    msgAlert('Invalid entries. Try again !', 'error');
                }
            }
        }).done(function() {
            loadspinner();
        });
    } else {
        msgAlert('Invalid entries. Try again !', 'error');
    }

});

function msgAlert(message, type) {
    var bgColor = type == 'error' ? 'bg-danger' : 'bg-success';
    var title = type == 'error' ? 'Error' : 'Success';

    $('#msgBody').empty();
    $('#msgBg').removeClass('bg-danger');
    $('#msgBg').removeClass('bg-success');
    $('#msgBg').addClass(bgColor);
    $('#msgModal').show();
    $('#msgBody').empty().append('<h4 class="modal-title text-white" id="msgTitle">' + title + '</h4><p class="text-white">' + message + '</p>');
    setTimeout(function() {
        $('#msgModal').hide();
    }, 3000);
}

function pay_now() {
    var name = $('#payment_user_name').val();
    var user_id = $('#payment_user_id').val();
    var amt = $('#payment_amt').val();
    // console.log(name);
    if (name && user_id && amt) {
        $.ajax({
            type: "POST",
            url: url_path + "Home/updatePaymentAmt",
            data: { user_id: user_id, amt: amt },
            dataType: "json",
            success: function(data) {
                var options = {
                    "key": "rzp_live_NXA7JsUIOjf9cx",
                    "amount": amt * 100,
                    "currency": "INR",
                    "name": "MOJSK",
                    "description": "Payment Transaction",
                    "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                    "handler": function(response) {
                        // console.log(response.razorpay_payment_id);
                        $.ajax({
                            type: 'post',
                            url: url_path + "Home/updatePaymentSuccess",
                            data: { user_id: user_id, payment_id: response.razorpay_payment_id },
                            success: function(result) {
                                msgAlert('Payment have successfully.', 'success');
                                setTimeout(function() { location.reload() }, 1000);
                            }
                        }).done(function() {
                            loadspinner();
                        });
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }
        }).done(function() {
            loadspinner();
        });
    }
}

$('#forgot_modal_btn').on('click', function() {
    $('#forgot').modal('show');
});

$('#forgot_btn').on('click', function() {
    var email = document.forms['fg_form']['fg_email'].value;
    // var old_password = document.forms['fg_form']['fg_old_password'].value;
    // var new_password = document.forms['fg_form']['fg_new_password'].value;
    // var cnf_password = document.forms['fg_form']['fg_cnf_password'].value;
    if (email) {

        $.ajax({
            type: "POST",
            url: url_path + "Home/ge_userByMail",
            data: { email: email },
            dataType: "json",
            success: function(data) {
                if (data.length != 0) {
                    // console.log(data);
                    var user_id;
                    $.each(data, function(i, item) {
                        user_id = item.user_id;
                    });
                    $.ajax({
                        type: "POST",
                        url: url_path + "Home/updateForgetPassword",
                        data: { user_id: user_id, email: email },
                        dataType: "json",
                        success: function(data) {
                            msgAlert('Password has been send to : ' + email, 'success');
                            $('#forgot').modal('hide');
                            $('#forgot').on('hidden.bs.modal', function() {
                                setTimeout(function() { location.reload() }, 2000);
                            });
                        }
                    }).done(function() {
                        loadspinner();
                    });
                } else {
                    msgAlert('Invalid email.Try again !', 'error');
                }
            }
        }).done(function() {
            loadspinner();
        });

    } else {
        msgAlert('Invaild entries.Try again !', 'error');
    }

});

$('#enablePassword').on('click', function() {
    $('#enablePassword').addClass('d-none');
    $('#disablePassword').removeClass('d-none');
    $('#p_password').attr('readonly', false);
    $('#p_password').prop("type", "text");
});
$('#disablePassword').on('click', function() {
    $('#enablePassword').removeClass('d-none');
    $('#disablePassword').addClass('d-none');
    $('#p_password').attr('readonly', true);
    $('#p_password').prop("type", "password");
});

$('#resend_btn').on('click', function() {
    var userId = $('#isValidUser').val();
    newUserid = userId ? userId : newUserid;
    $.ajax({
        type: "POST",
        url: url_path + "Home/resend_otp",
        data: { user_id: newUserid },
        dataType: "json",
        success: function(data) {
            // var result_set = $.parseJSON(data);
            msgAlert('Successfully otp send your mail.', 'success');
        }
    }).done(function() {
        loadspinner();
    });
});

// for file upload(By JR,2-9-21) 
$("#uploadDoc input[type=file]").change(function () {
    var fieldVal = $(this).val();
console.log($(this).attr('name'));
console.log(this.files[0]);

var form = new FormData();
console.log($("#uploadDoc #userid").val());
form.append('userid', $('#uploadDoc #userid').val());
form.append('doc_img', this.files[0]);
form.append('field_name', $(this).attr('name'));
    // Change the node's value by removing the fake path (Chrome)
    fieldVal = fieldVal.replace("C:\\fakepath\\", "");

    if (fieldVal != undefined || fieldVal != "") {
        $(this).next(".custom-file-label").attr('data-content', fieldVal);
        $(this).next(".custom-file-label").text(fieldVal);
    }      
    // console.log(file);

    $.ajax({
        type: "POST",
        url: url_path + "Home/documentsUpdate",
        cache: false,
        contentType: false,
        processData: false,
        data: form,
        dataType: "json",
        success: function(data) {
            var result_set = $.parseJSON(data);
            console.log(data);
            msgAlert('image update successfully', 'success');
            location.reload();
        }
    }).done(function() {
        loadspinner();
    });

});

// for file upload(By JR,2-9-21) 
function getURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#doc_tag').attr('src', e.target.result);

        }
        reader.readAsDataURL(input.files[0]);
    }
}

// for file remove and upload(By JR,2-9-21) 
function UpdateDoc(field) {
    // alert(field);
console.log(field);
console.log($("#uploadDoc #userid").val());
var form = new FormData();
form.append('userid', $('#uploadDoc #userid').val());
form.append('field_name', field);
$.ajax({
    type: "POST",
    url: url_path + "Home/documentsRemove",
    cache: false,
    contentType: false,
    processData: false,
    data: form,
    dataType: "json",
    success: function(data) {
        var result_set = $.parseJSON(data);
        console.log(data);
        msgAlert('image update successfully', 'success');
        location.reload();
    }
}).done(function() {
    loadspinner();
});

// form.append('userid', $('#uploadDoc #userid').val());
// form.append('field_name', field);
//     $.ajax({
//         type: "POST",
//         url: url_path + "Home/documentsRemove",
//         cache: false,
//         contentType: false,
//         processData: false,
//         data: form,
//         dataType: "json",
//         success: function(data) {
//             var result_set = $.parseJSON(data);
//             console.log(data);
//             msgAlert('Image Deleted successfully', 'success');
//         }
//     }).done(function() {
//         loadspinner();
//     });
}