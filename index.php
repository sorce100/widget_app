<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="OlztNREI4V5AnhsIn97YBhxK6V1TL9qrNtmsOVwR">
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon"> <!-- Favicon-->
    <title>e.lective widget</title>
    <meta name="description" content="ferdinand">
    <meta name="author" content="ferdinand">
    
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/animate-css/vivify.min.css">
    <link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css">
    
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/css/mooli.min.css">
    <link rel="stylesheet" href="assets/css/new_style.css">
</head>

<body class="theme-cyan">

<div class="auth-main">
    <div class="auth_div vivify fadeIn"> 
        <div class="auth_brand">
           <img src="assets/images/logo.png" class="d-inline-block align-top mr-2" alt="" width="300px" height="300px">                                         
        </div>
        <div class="card" style="margin-top: 0px;">
            <div class="header">
                <p class="lead">Login to your account</p>
            </div>
            <div class="body">
                <form class="form-auth-small" method="POST" id="login_form" >
                    <div class="form-group c_form_group">
                        <label>Username</label>
                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter username" autofocus required>
                    </div>
                    <div class="form-group c_form_group">
                        <label>Password</label>
                        <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <input type="hidden" name="mode" value="log_user_in">
                    <!-- <a class="btn btn-lg btn-block" href="pages/dashboard.php" style="background-color: #0144A3;color: white;">LOGIN <i class="fa fa-sign-in"></i></a> -->
                    <button type="submit" class="btn btn-lg btn-block login_btn" >LOGIN <i class="fa fa-sign-in"></i></button>
                    <div class="bottom">
                        <!-- <span class="helper-text m-b-10" data-toggle="modal" data-target="#resetPassModal"><i class="fa fa-lock"></i> <a >Forgot password?</a></span> -->
                    </div>
                </form>
            </div>
        </div>

        <!-- <div>
          <p>© <?php echo date('Y');?> 
        </div> -->

        <div class="animate_lines">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
    </div>
</div>



<!-- modal -->
<div class="modal fade" id="change_password_modal" tabindex="-1" role="dialog" aria-labelledby="resetPassModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPassModalLabel"><b>CHANGE PASSWORD</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form class="form-auth-small" id="change_password_form" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="change_password_user_name" name="change_password_user_name">
                    <input type="hidden" id="change_password" name="change_password">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="title" class="col-form-label">PASSWORD <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <input type="password" class="form-control" id="new_user_password" name="new_user_password" placeholder="Enter Password &hellip;" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="title" class="col-form-label">RETYPE PASSWORD <span class="badge-danger"> *</span></label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                              <input type="password" class="form-control" id="retype_new_user_password" name="retype_new_user_password" placeholder="Retype Password &hellip;" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="mode" value="change_password">
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                  <button type="submit" class="btn btn-primary reset_password_btn" id="bg-primary">Reset Password <i class="fa fa-exchange"></i></button>
               </div>
            </form>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script>
<script src="log_user.js"></script>
    
</body>
</html>