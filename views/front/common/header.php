<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Orbitor,business,company,agency,modern,bootstrap4,tech,software">

    <title>Mojsk:जन सुविधा केंद्र</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/project_assets/') ?>images/favicon.ico" />

    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="<?= base_url('assets/project_assets/') ?>plugins/bootstrap/css/bootstrap.min.css">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="<?= base_url('assets/project_assets/') ?>plugins/icofont/icofont.min.css">
    <!-- Slick Slider  CSS -->

    <link rel="stylesheet" href="<?= base_url('assets/project_assets/') ?>plugins/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="<?= base_url('assets/project_assets/') ?>plugins/slick-carousel/slick/slick-theme.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('assets/project_assets/') ?>css/style.css">

</head>

<body id="top">
    <!--My profile Now  modal-->
    <?php if (!empty($user_data)) {
        $data = json_decode($user_data);
    } ?>
    <header>
        <div class="header-top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <ul class="top-bar-info list-inline-item pl-0 mb-0">
                            <li class="list-inline-item hindi_txt">Welcome to MOJSK: जन सुविधा केंद्र </li>

                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
                            <a href="tel:+23-345-67890">
                                <span>Call Now : </span>
                                <span class="h4">0771-40-20-500</span>
                            </a>
                            &nbsp; <a href="<?= base_url('assets/project_assets/') ?>images/Mojsk.rar" class="button"><i class="icofont-download-alt"></i>Download Application </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navigation" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url('Home/hindex'); ?>">
                    <img src="<?= base_url('assets/project_assets/') ?>images/logo.png" alt="" class="img-fluid">
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain" aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icofont-navigation-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarmain">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= base_url('Home/hindex'); ?>">Home</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('Home/aboutUs'); ?>">About Us</a></li>

                        <?php if (!empty($session_data)) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="department.html" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product & Services <i class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown02">
                                <li><a class="dropdown-item" href="#">Recharge </a></li>
                                <li><a class="dropdown-item" href="#">M- ATM</a></li>

                                <li><a class="dropdown-item" href="#"> AEPS</a></li>
                                <li><a class="dropdown-item" href="https://www.pan.utiitsl.com/PAN/mainform.html;jsessionid=4D41803B7F0EB585996E3387F3204780" target="_blank">UTI PAN SERVICE</a></li>
                                <li><a class="dropdown-item" href="#">GST</a></li>
                                <li><a class="dropdown-item" href="#">ITR</a></li>
                                <li><a class="dropdown-item" href="#">TRAVEL</a></li>
                                <li><a class="dropdown-item" href="#">BILL PAYMENTS</a></li>
                            </ul>
                        </li>
                        <?php } ?>

                        <?php if (empty($session_data)) { ?>
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="department.html" id="dropdown02" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Product & Services <i class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown02">
                                <li><a class="dropdown-item" href="#">Recharge </a></li>
                                <li><a class="dropdown-item" href="#">M- ATM</a></li>

                                <li><a class="dropdown-item" href="#"> AEPS</a></li>
                                <li><a class="dropdown-item" href="#">UTI PAN SERVICE</a></li>
                                <li><a class="dropdown-item" href="#">GST</a></li>
                                <li><a class="dropdown-item" href="#">ITR</a></li>
                                <li><a class="dropdown-item" href="#">TRAVEL</a></li>
                                <li><a class="dropdown-item" href="#">BILL PAYMENTS</a></li>
                            </ul>
                        </li>
                        <?php } ?>    

                        <li class="nav-item"><a class="nav-link" href="<?= base_url('Home/gallery'); ?>">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= base_url('Home/contactUs'); ?>">Contact</a></li>

                    </ul>

                </div>
                <span class="navbar-text ml-md-4">
                    <?php if (empty($session_data)) { ?>
                        <button class=" btn btn-outline-danger" data-toggle="modal" data-target="#exampleModalCenter"><i class="icofont-user"></i> &nbsp;Register Now</button>
                        <button class=" btn btn-outline-danger" data-toggle="modal" data-target="#login"><i class=" icofont-login"></i> &nbsp;Log in</button>
                    <?php }
                    if (!empty($session_data)) { ?>
                        <div class="btn-group">
                            <button type="button" class="btn btn-link dropdown-toggle p-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= $data[0]->profile_img ? (base_url('assets/profilePic/') . $data[0]->profile_img) : (base_url('assets/project_assets/') . 'images/director.jpg') ?>" width="40" class=" rounded-circle"></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php if(isset($session_data['name'])) { ?>
                                <small class="p-2">Hi! <?php echo $session_data['name']?></small>
                                <hr>
                                <?php } ?>
                                <a data-toggle="modal" data-target="#myprofile" class="dropdown-item" type="button">Profile</a>
                                <a href="<?= base_url('Home/uploaddocs'); ?>" class="dropdown-item" type="button">Upload Documents</a>
                                <a href="<?= base_url('Home/dashboard'); ?>" class="dropdown-item" type="button">Dashboard</a>
                                <a href="<?= base_url('Home/logout'); ?>" class="dropdown-item" type="button">Logout</a>
                            </div>
                        </div>
                    <?php } ?>
                </span>
            </div>
        </nav>
    </header>

    <!--Register Now  modal-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient ">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle"><img src="<?= base_url('assets/project_assets/') ?>images/logo.png" width="30">&nbsp;&nbsp;&nbsp;Register New User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="r_form" name="r_form">
                        <div class="form-group row">
                            <div class="col-7">
                                <input type="text" class="form-control" placeholder="First name" id="r_fname" name="r_fname">
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control" placeholder="Last name" id="r_lname" name="r_lname">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="example@gmail.com" id="r_email" name="r_email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile" id="r_mobile" name="r_mobile">
                        </div>
                        <div class="form-group">
                            <input type="password" minlength="6" maxlength="10" class="form-control" placeholder="Password" id="r_password" name="r_password">
                        </div>

                        <div class="form-group">
                            <input type="password" minlength="6" maxlength="10" class="form-control" placeholder="Confirm Password" id="r_Cpassword" name="r_Cpassword">
                        </div>

                        <div class="form-group" id="passwordHint">
                            <small id="passwordHelp" class="text-success">
                                <strong>Password Hints :</strong>
                                <li>Minimum 6 alphanumeric character with at least one  special character</li>
                               
                            </small>
                        </div>

                        <button type="button" class="btn btn-danger btn-block mt-2" id="register_btn" name="register_btn">Register Now</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="myprofile" tabindex="-1" role="dialog" aria-labelledby="myprofileTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient ">
                    <h5 class="modal-title text-white" id="myprofileModalLongTitle"><img src="<?= base_url('assets/project_assets/') ?>images/logo.png" width="30">&nbsp;&nbsp;&nbsp;My Profile</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="p_form" name="p_form">
                        <div class="text-center">
                            <img id="p_profile_tag" name="p_profile_tag" src="<?= !empty($session_data) && $data[0]->profile_img ? (base_url('assets/profilePic/') . $data[0]->profile_img) : (base_url('assets/project_assets/') . 'images/director.jpg') ?>" class="avatar rounded-circle img-thumbnail" alt="avatar" style="object-fit: cover;width: 100px;height: 100px;">

                            <div class="image-upload" style="position:relative; top:-26px; right:-30px;">
                                <label for="p_profile">
                                    <img src="<?= base_url('assets/project_assets/') ?>images/user.png">
                                </label>
                                <input id="p_profile" name="p_profile" type="file" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="First name" id="p_fname" name="p_fname" value="<?= !empty($data) ? $data[0]->f_name : '' ?>">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Last name" id="p_lname" name="p_lname" value="<?= !empty($data) ? $data[0]->l_name : '' ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="example@gmail.com" id="p_email" name="p_email" value="<?= !empty($data) ? $data[0]->email : '' ?>" readonly>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile" id="p_mobile" name="p_mobile" value="<?= !empty($data) ? $data[0]->mobile : '' ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                            <input type="text" class="form-control" placeholder="PAN number" id="p_panNo" name="p_panNo" value="<?= !empty($data) ? $data[0]->pan_no : '' ?>">
                            </div>
                            <div class="col-6">
                            <input type="text" class="form-control" placeholder="Aadhar number" id="p_aadharNo" name="p_aadharNo" value="<?= !empty($data) ? $data[0]->aadhar_no : '' ?>">
                             </div>
                        </div>
                        
                        <div class="form-group">
                            <textarea class="form-control" id="p_address" placeholder="Business Address" rows="1"><?= !empty($data) ? $data[0]->address : '' ?></textarea>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="passwordCheck">
                                <label class="form-check-label" for="passwordCheck">
                                    Change password ?
                                </label>
                            </div>
                        </div>

                        <div class="input-group mb-3 d-none" id="passwordDiv" name="passwordDiv">
                            <input type="password" minlength="6" maxlength="10" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password_icon" id="p_password" name="p_password" value="<?= !empty($data) ? base64_decode($data[0]->password) : '' ?>" readonly>
                            <div class="input-group-append" id="enablePassword" name="enablePassword" onMouseOver="this.style.cursor='pointer'">
                                <span class="input-group-text" id="password_icon1"><i class="icofont-eye-alt"></i></span>
                            </div>
                            <div class="input-group-append d-none" id="disablePassword" name="disablePassword" onMouseOver="this.style.cursor='pointer'">
                                <span class="input-group-text" id="password_icon2"><i class="icofont-eye-blocked"></i></span>
                            </div>
                        </div>

                        <input type="hidden" id="userid" name="userid" value="<?= !empty($data) ? $data[0]->user_id : '' ?>">

                        <button type="button" class="btn btn-danger btn-block mt-2" id="profile_btn" name="profile_btn">Update profile</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- login section -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient">
                    <h5 class="modal-title text-white" id="loginModalLongTitle"><img src="<?= base_url('assets/project_assets/') ?>images/logo.png" width="30">&nbsp;&nbsp;&nbsp;Login</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="l_form" name="l_form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="example@gmail.com" id="l_email" name="l_email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="l_password" name="l_password">
                        </div>

                        <a type="button" class="btn btn-link" id="forgot_modal_btn" name="forgot_modal_btn" data-dismiss="modal"><small>Forgot password?</small></a>
                        <button type="button" id="login_btn" name="login_btn" class="btn btn-danger btn-block mt-2">Login</button>
                        <a href="#" class="btn btn-link text-secondary" data-toggle="modal" data-target="#exampleModalCenter" data-dismiss="modal"> <i class="icofont-user-alt-7"></i>&nbsp;Create Account</a>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- otp modal section -->
    <div class="modal fade" id="otp" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="otpTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient">
                    <h5 class="modal-title text-white" id="otpModalLongTitle"><img src="<?= base_url('assets/project_assets/') ?>images/logo.png" width="30">&nbsp;Enter your otp</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Note : Your OTP is <span id="otpVal"></span>. Enter to complete registration. -->
                    Note : Your OTP has been sent to mail.
                    <form id="otp_form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter your otp" id="otp_value" name="otp_value">
                        </div>
                        <small style="color:blue" onMouseOver="this.style.cursor='pointer'" id="resend_btn"> resend otp ?</small>
                        <button type="button" id="otp_btn" name="otp_btn" class="btn btn-outline-danger btn-block mt-2">Submit</button>
                    </form>
                </div>
                <input type="hidden" id="isValidUser" name="isValidUser" value="">

            </div>
        </div>
    </div>

    <!-- forgot section -->
    <div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="forgotTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient">
                    <h5 class="modal-title text-white" id="forgotModalLongTitle"><img src="<?= base_url('assets/project_assets/') ?>images/logo.png" width="30">&nbsp;&nbsp;&nbsp;Forgot Password</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="fg_form" name="fg_form">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="example@gmail.com" id="fg_email" name="fg_email">
                        </div>
                        <!-- <div class="form-group">
                            <input type="password" class="form-control" placeholder="Old Password" id="fg_old_password" name="fg_old_password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="New Password" id="fg_new_password" name="fg_new_password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Conform Password" id="fg_cnf_password" name="fg_cnf_password">
                        </div> -->

                        <button type="button" id="forgot_btn" name="forgot_btn" class="btn btn-danger btn-block mt-2">Update Password</button>
                        <a href="#" class="btn btn-link text-secondary" data-toggle="modal" data-target="#login" data-dismiss="modal"> <i class="icofont-user-alt-7"></i>&nbsp;login</a>

                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- alert modal -->
    <div class="modal" role="dialog" id="msgModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" id="msgBg">
                <div class="modal-body" id="msgBody">

                </div>
            </div>
        </div>
    </div>
    <!-- end of alert modal -->
    <!-- spinner/loader mod:dt:11/08/2021 -->
    <div id="overlay">
        <div class="cv-spinner">
            <span class="spinner"></span>
        </div>
    </div>
    <!-- end of spinner -->