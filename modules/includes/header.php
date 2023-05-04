<?php
    ob_start();
    require_once("Check.php");
    $objCheck = new Check();
    require_once("../Classes/Groups.php");
    require_once("../Classes/Modules.php");
?>

<!DOCTYPE html>
<html lang="en">

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta name="csrf-token" content="OlztNREI4V5AnhsIn97YBhxK6V1TL9qrNtmsOVwR">
<link rel="icon" href="../assets/images/logo.png" type="image/x-icon"> <!-- Favicon-->
<title>e.lective widget</title>
<meta name="description" content="FKW">
<meta name="author" content="FKW">

<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">    
<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">    
<link rel="stylesheet" href="../assets/vendor/animate-css/vivify.min.css">

<link rel="stylesheet" href="../assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/vendor/sweetalert/sweetalert.css">

<link rel="stylesheet" href="../assets/vendor/summernote/dist/summernote.css">
<link rel="stylesheet" href="../assets/vendor/summernote/dist/summernote-bs4.min.css">

<link href="../assets/vendor/parsley/parsley.css" rel="stylesheet">
<link href="../assets/vendor/sweetalert/sweetalert.css" rel="stylesheet">

<link href="../assets/vendor/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet">

<!-- <link rel="stylesheet" href="../assets/vendor/dropify/css/dropify.min.css"> -->
<link rel="stylesheet" href="../assets/vendor/jquery-steps/jquery.steps.css">
    

<!-- Custom Css -->
<link rel="stylesheet" href="../assets/css/mooli.min.css">
<link rel="stylesheet" href="../assets/css/new_style.css">

<!-- ckeditor -->
<!-- <script src="../assets/vendor/ckeditor/ckeditor.js"></script> -->
</head>

<body data-theme="light">
    
<div id="body" class="theme-cyan">

    <div id="wrapper">
        
        <!-- main page header -->
        <nav class="navbar navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-left">
               <div class="navbar-btn">
                    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-align-left"></i></button>
                </div>
            </div>
            <div class="navbar-right">
                <div id="navbar-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="" class="right_toggle icon-menu" title="Right Menu"><i class="fa fa-user"></i></a></li>
                        <li><a href="../Controllers/logOut.php" class="icon-menu"><i class="fa fa-power-off badge-danger"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- project main left menubar -->
    <div id="left-sidebar" class="sidebar">
        <div class="navbar-brand">
            <a href=""><img src="../assets/images/logo.png" alt="e.lective Logo" width="220px"></a>
            <!-- <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="fa fa-close"></i></button> -->
        </div>
        <div class="sidebar-scroll">
            <nav id="left-sidebar-nav" class="sidebar-nav">
                <ul id="main-menu" class="metismenu animation-li-delay">
                    <li class="header">Main</li>
                    <li class=""><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                    
                    <li class="header">Widgets</li>
                    <!-- working on -->
                    <!-- ////////////////////////////////////////////////////////////////////////////////////////////////// -->
                    <?php 
                      $objGroups = new Groups;
                      $modulesId = $objGroups->get_user_modules($_SESSION['group_id']);
                      if (!empty($modulesId)) {
                        // passing the modules id to  get the pages url
                        $objModules = new Modules;
                        foreach ($modulesId as $module_id) {
                           $objModules->get_menu_modules($module_id);
                        }
                      }

                    ?>
                </ul>
            </nav>     
        </div>
    </div>

    <!-- modal for changing password -->
     <div class="modal fade" id="change_passwd_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content">
              <div class="modal-header" id="bg">
                 <button type="button" class="close" data-dismiss="modal"  aria-label="Close"><span aria-hidden="true" class="btn-default btnClose">&times;</span></button>
                <h4 class="modal-title"><b id="subject">Change Password</b></h4>
              </div>
              <div class="modal-body" id="bg">
                <form id="change_password_form" method="POST"> 
                    <!--  -->
                  <div class="row">
                    <div class="col-md-4"><label>New Password <span class="asterick"> *</span></label></div>
                    <div class="col-md-8">
                      <input type="password" class="form-control" id="newPasswd" name="newPasswd" minlength="4" autocomplete="off" placeholder="Enter New Password &hellip;" required>
                    </div>
                  </div>

                  <br>
                  <!--  -->
                  <div class="row">
                    <div class="col-md-4"><label>Retype Password <span class="asterick"> *</span></label></div>
                    <div class="col-md-8">
                      <input type="password" class="form-control" id="retypeNewPasswd" name="retypeNewPasswd" minlength="4" autocomplete="off" placeholder="Retype Password &hellip;" required>
                    </div>
                  </div>

                    <br>
                    <input type="hidden" name="mode" value="userChangePassword">

                    <div class=" modal-footer" id="bg">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i class="fa fa-times"></i></button>
                      <button type="submit" class="btn btn-primary" id="changePass_btn">Change Password <i class="fa fa-exchange"></i></button>
                    </div>        
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        
<!-- sticky note rightbar div -->
<div id="main-content">
    <div class="container-fluid"> 
    <?php 
        // check for accessible pages
        if (in_array(basename($_SERVER['PHP_SELF']), $_SESSION['user_modules']) || basename($_SERVER['PHP_SELF']) == 'dashboard.php'){
            header(basename($_SERVER['PHP_SELF']));
        }
        else{
            header('Location: dashboard.php');
        }
    ?>
