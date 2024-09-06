<!DOCTYPE html>
<html>
<head>

    <!---favicon-->
    <link rel="icon" type="image/icon" href="<?php echo base_url('favicon_srp.png'); ?>" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--Jquery -->
    <script type="text/javascript" src="<?php echo base_url('ref/jquery/jquery-1.11.1.min.js'); ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('ref/font-awesome-4.3.0/css/font-awesome.min.css'); ?>">
    <!--bootstrap responsive-->
    <!--<link rel="stylesheet" href="<?php /*echo base_url('ref/bootstrap/css/bootstrap-responsive.css'); */?>"/>-->
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/iCheck/all.css'); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/select2/select2.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/dist/css/AdminLTE.min.css'); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/dist/css/skins/_all-skins.css'); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--    <script src="--><!--/*https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--Boostrap Validator -->
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("ref/validation/css/bootstrapValidator.min.css"); ?>"/>

    <!--Boostrap Vertical tabs -->
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("ref/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.min.css"); ?>"/>

    <!--DataTable-->
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/datatables/resources/media/css/jquery.dataTables.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/jquery/datatables.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/datatables/resources/media/Responsive-master/css/responsive.dataTables.min.css'); ?>"/>

    <!-- Colou picker -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>">

    <!--igrowl dependencies : animate.css-->
    <link rel="stylesheet" href="<?php echo base_url('ref/igrowl/public/stylesheets/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('ref/igrowl/dist/css/igrowl.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('ref/igrowl/public/stylesheets/icomoon/vicons.css'); ?>">

    <!--Additional Styles-->
    <link rel="stylesheet" href="<?php echo base_url('ref/additional_styles.css'); ?>">

    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/fullcalendar/fullcalendar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/fullcalendar/fullcalendar.print.css'); ?>" media="print">

    <!--vertical tabs-->
    <link rel="stylesheet" href="<?php echo base_url('ref/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.min.css'); ?>">
    <style>
    .skin-blue .main-header .navbar .sidebar-toggle:hover
        {
            background-color:rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini" style="background-color:#fff;">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo" style="background-color: white !important;height:65px !important;">
            <?php
            if($this->userInfo['SchName'] !== ""){
                $sys_title = $this->userInfo['SchName'].'<br>'.$this->userInfo['Branch'];
                $sys_title_logo = '<img src="'.base_url('ref/images/'.$this->userInfo['SchLogo']).'" style="width:25px; height:25px;">';
                $sys_title_plus_logo = $sys_title_logo;
            }else{
                $sys_title_man = 'EXCALIBUR MANAGEMENT PORTAL';
                $sys_title = '<img src="'.base_url('ref/images/excalibur_logo.png').'" class="user-image"  alt="User Image" style="border-radius: 0%;height:60px !important;width:60px !important;">';
                $sys_title_logo = '<img src="'.base_url('ref/images/excalibur_logo.png').'" class="user-image" alt="User Image" style="border-radius: 0%;height:40px !important;width:40px !important;padding:0 !important;">';
                //$sys_title_logo = 'SRP';
                $sys_title_plus_logo = "";
            }
            ?>
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?php echo $sys_title_logo ?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg" style="font-size: 12px;height:80px;color:black;"><?php echo $sys_title ?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation" style="background-color:#fff;">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color:black;">
                <span class="logo-lg" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif"><strong><?php echo strtoupper($sys_title_man); ?></strong></span>
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Tasks: style can be found in dropdown.less -->
                    <?php $userimg = $_SESSION['UserImage']; ?>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black;">
                            <img src="<?php $server_status=check_server(); echo load_image($server_status,$userimg); ?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $this->userInfo['Ename']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header" style="background-color:rgba(0, 0, 0, 0.1);">
                                <img src="<?php $server_status=check_server(); echo load_image($server_status,$userimg); ?>" class="img-circle" alt="User Image">
                                <p style="color:black;">
                                    <?php echo $this->userInfo['Ename']; ?> - <?php  echo $this->userInfo['EmpDes']; ?>
                                    <small><?php echo $this->userInfo['SchName']; ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo site_url('Srp_ha_manProfilecontroller'); ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo site_url('Srp_saHa_loginController/unset_sess'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <!--<li>
                      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>-->
                </ul>
            </div>
        </nav>
    </header>

<?php

/**
 * Created by PhpStorm.
 * User: Haaniya
 * Date: 14/10/2016
 * Time: 12:52
 */