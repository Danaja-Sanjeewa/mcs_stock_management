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
    <link rel="stylesheet" href="<?php echo base_url('ref/bootstrap/css/bootstrap-responsive.css'); ?>"/>
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/daterangepicker/daterangepicker-bs3.css'); ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/datepicker/datepicker3.css'); ?>">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/iCheck/all.css'); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/select2/select2.css'); ?>">
    <!--multiselect-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/adminlte/plugins/multiSelectCheckbox/dist/css/bootstrap-multiselect.css'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/dist/css/AdminLTE.min.css'); ?>">
    <!--Morris-->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/morris/morris.css'); ?>">
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

    <!--DataTable-->
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/datatables/resources/media/css/jquery.dataTables.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/jquery/datatables.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/datatables/resources/media/Responsive-master/css/responsive.dataTables.min.css'); ?>"/>

    <!-- Colour picker -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>">

    <!-- j Crop -->
    <link rel="stylesheet" href="<?php echo base_url('ref/tapmodo-Jcrop-1902fbc/css/jquery.Jcrop.min.css'); ?>">
    <!--<link rel="stylesheet" href="<?php /*echo base_url('ref/tapmodo-Jcrop-1902fbc/demos/demo_files/demos.css'); */?>" type="text/css" />-->

    <!--igrowl dependencies : animate.css-->
    <link rel="stylesheet" href="<?php echo base_url('ref/igrowl/public/stylesheets/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('ref/igrowl/dist/css/igrowl.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('ref/igrowl/public/stylesheets/icomoon/vicons.css'); ?>">

    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/fullcalendar/fullcalendar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/fullcalendar/fullcalendar.print.css'); ?>" media="print">

    <!--vertical tabs-->
    <link rel="stylesheet" href="<?php echo base_url('ref/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.min.css'); ?>">

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"  href="<?php echo base_url('ref/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">

    <!--Additional Styles-->
    <link rel="stylesheet" href="<?php echo base_url('ref/additional_styles.css'); ?>">

</head>

<style>

    .headStyle1 {
        color: #fff7f7 !important;
    }

    .clswhite {
        color: #ffffff;
    }

    .slimScrollBar {
        background: none repeat scroll 0 0 #A9A9A9 !important;
        width: 8px!important;
    }
    .notif-hover:hover{
        background-color: #ebedf0;
    }
    .notification-message{
        font-size: 12px;
        color: #A9A9A9;
        white-space: nowrap;
        overflow:hidden !important;
        text-overflow: ellipsis;
    }
    .notif-message-container{
        margin: 0px !important;
        padding: 0px !important;
    }
    .notification-list{
        padding: 5px 3px;
        cursor:pointer;
        border-bottom: 1px solid #f4f4f4;
    }
    .main-header .logo .logo-lg {
         display: inline-block;
    }
    .skin-blue-light .main-header .navbar {
        background-color: #0f1923;
    }
    .skin-blue-light .main-header li.user-header {
        background-color: #0f1923;
    }
    #userShow:hover{
        background-color: rgba(235, 246, 224, 0.29) !important;
    }
    .modal .modal-body {
        max-height: 520px;

    }

</style>

<?php

$companyID = $_SESSION['Sponsor_ERP_CompanyID'];
$sponsorMasterID = $_SESSION['sponsorUserID'];
//$main_sys_title = 'EDUCAL SPONSOR PORTAL';

$language;

$query = "SELECT `primarylanguageemp`.`description` AS `language`, CASE WHEN primarylanguageemp.description = \"Arabic\" THEN \"ع\" WHEN primarylanguageemp.description = \"English\" THEN \"ENG\" END languageview 
          FROM educal_ecsrp_maindb.srp_publicsponsormaster INNER JOIN srp_erp_lang_languages AS primarylanguageemp ON primarylanguageemp.languageID = educal_ecsrp_maindb.srp_publicsponsormaster.LanguageID WHERE sponsorMasterID = $sponsorMasterID ";
$result_employee = $this->db->query($query)->row_array();

if (!empty($result_employee)) {
    $language = $result_employee['languageview'];
} else {
    $q = "SELECT primarylang.description AS LANGUAGE, CASE WHEN primarylang.description = \"Arabic\" THEN \"ع\" ELSE \"\" END languageprimary FROM srp_erp_lang_companylanguages INNER JOIN srp_erp_lang_languages primarylang ON primarylang.languageID = srp_erp_lang_companylanguages.primaryLanguageID WHERE companyID = $companyID ";
    $result = $this->db->query($q)->row_array();
    if (!empty($result)) {
        $language = $result['languageprimary'];
    } else {
        $language = 'ENG';
    }
}

$server_status=check_server();
if(isset($_SESSION['sponsorImage']) && !empty($_SESSION['sponsorImage'])){

    $flagImage = $_SESSION['sponsorImage'];
}else {
    $flagImage='app_att/113-512.png';
}

?>

<body class="hold-transition skin-blue-light sidebar-mini fixed" data-spy="scroll" data-target="#scrollspy" >
<div class="wrapper">

    <header class="main-header" >
        <!-- Logo -->
        <a class="logo" style="background-color:white !important;height: 64px;cursor: pointer;">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="<?php $server_status=check_server(); echo load_image($server_status,'excalibur_logo.png');?>" style="width:50px; height:50px;"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg" style="font-size: 14px;"><img src="<?php $server_status=check_server(); echo load_image($server_status,'excalibur_logo.png'); ?>" style="width:64px; height:64px;"></strong></b></span>
            <span style="color:  #0f1923;font-family: 'Courier New' ">SPONSORS</span>
        </a>


        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!--School Details - Header-->
            <?php
            if($this->userInfo['sponsorName'] !== ""){
                $sys_title = $this->userInfo['sponsorSchoolName'].', '. $this->userInfo['sponsorBranchDescription'];
                $sys_title_other = $this->userInfo['sponsorSchoolNameOther'];
                if($this->userInfo['sponsorSchLogo'] == "" || $this->userInfo['sponsorSchLogo'] == null || $this->userInfo['sponsorSchLogo'] == 'noimage.jpg'){
                    $sys_title_logo = '<img src="'.base_url('ref/images/unknownLogo.png').'" class="user-image" alt="User Image" style="border-radius: 0%;height:40px !important;width:40px !important;padding:0 !important;">';
                }else{
                    $sys_title_logo = '<img src="'.load_image($server_status,$this->userInfo['sponsorSchLogo']).'" class="user-image"  alt="User Image" style="border-radius: 0%;height:55px !important;width:55px !important;">';
                }
                $sys_title_plus_logo = $sys_title_logo;
            }else{
                $sys_title_other = '';
                $sys_title = '';
                $sys_title_logo = '';
                $sys_title_plus_logo = "";
            }

      /*      $query2 = $this->db->query("SELECT isTrialSchool,trialStartDate,trialEndDate FROM srp_schoolmaster WHERE SchMasterID='".$_SESSION['sponsorSchMasterID']."'");
            $res2 = $query2->row();
            if($res2->isTrialSchool == '1'){
                $trialDet='<span>Trial Period End on : </span>'.$res2->trialEndDate. '<span> 12:01 AM</span>';
            }else{
                $trialDet='';
            }*/
            $trialDet='';
            ?>
            <!--<span class="logo-lg" style="font-size: 12px;"><?php /*echo $sys_title_plus_logo */?> <b><strong><?php /*echo strtoupper($sys_title); */?></strong></b></span>-->
            <!-- Sidebar toggle button-->
            <a style="cursor: pointer;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li style="margin-top:12px; ">
                        <span class="label label-danger " style="margin-top:12px;font-size: 11px;padding: 2px 5px 2px"><?php echo $trialDet; ?></span>
                    </li>

                    <?php if($sys_title_other!="") {?>
                        <li class="dropdown user user-menu" id="userShow" data-toggle="tooltip" title="Help Desk" style="position: absolute;left: 50%;transform: translateX(-70%);">
                            <a target="_blank" style="padding-top: 5px !important;padding-bottom: 5px !important;">
                                <table>
                                    <tr><td><span class="hidden-xs" style="font-size: 15px;"><?php echo $sys_title; ?>&nbsp;&nbsp;&nbsp;</span></td>
                                        <td><?php echo $sys_title_plus_logo ?></td>
                                        <td><span class="hidden-xs" style="font-size: 18px;"><?php echo $sys_title_other; ?></span></td></tr>
                                </table>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="dropdown user user-menu" id="userShow" data-toggle="tooltip" title="Help Desk">
                            <a target="_blank" style="padding-top: 5px !important;padding-bottom: 5px !important; margin-right: 250px;">
                                <table>
                                    <tr><td><?php echo $sys_title_plus_logo ?></td>
                                        <td><span class="hidden-xs" style="font-size: 15px;"><?php echo $sys_title; ?></span></td>
                                        <td><span class="hidden-xs" style="font-size: 18px;"><?php echo $sys_title_other; ?></span></td></tr>
                                </table>
                            </a>
                        </li>
                    <?php } ?>

                    <li class="dropdown user user-menu" id="userShow" data-toggle="tooltip" title="Help Desk" style="top:4px!important;">
                        <a href="http://educalsupport.com/" target="_blank" >
                            <span class="hidden-xs" style="visibility: hidden;">.</span>
                            <img src="<?php echo base_url('ref/images/HelpDeskIcon.png'); ?>" class="user-image" alt="User Image" style="margin-right: -10px; height:22px; width:22px;">
                            <span class="hidden-xs" style="visibility: hidden;">.</span>
                        </a>
                    </li>

                    <li class="dropdown user user-menu" id="userShow" style="top:4px!important;">
                        <a style="cursor: pointer;" onclick="sponsorLanguage()">
                            <!--<img src="<?php //echo base_url('ref/images/language.png'); ?>" class="user-image" alt="User Image" style="margin-right: 3px; height:22px; width:22px; ">-->
                            <span class="hidden-xs" style="font-size: 15px;"><?php echo $language ?> </span>
                        </a>
                    </li>

                    <!-- Messages: style can be found in dropdown.less-->
                   <!-- <li class="dropdown messages-menu" style="top:4px!important;">
                        <a style="cursor: pointer;" class="dropdown-toggle" data-toggle="dropdown" onclick="getSponsorEmpMessages();">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-warning" id="NotificationNumTag" style="display:none;"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header" id="Notification_dropdown_header"></li>
                            <li>
                                <ul class="menu" id="Notification_dropdown" style="display: none;">
                                </ul>
                                <ul id="dropDownMLoaderDiv" >
                                    <div style="position: relative; height: 10px; background-color: ;">
                                        <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 48%;top: 50%;margin-left: -32px;margin-top: -120px;"></i>
                                    </div>
                                </ul>
                            </li>
                            <li class="footer"><a href="<?php /*echo site_url('Srp_sa_communicationMasterController'); */?>">See All Messages</a></li>
                        </ul>
                    </li>-->

                    <!-- Notifications: style can be found in dropdown.less -->
                    <!--<li class="dropdown notifications-menu" style="top:4px!important;">
                        <a style="cursor: pointer;" class="dropdown-toggle" data-toggle="dropdown" >
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-danger" id="Other_NotificationNumTag" style="display:none;"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header" id="Other_Notification_dropdown_header">You have 10 notifications</li>
                            <li>
                                <ul class="menu" id="Other_Notification_dropdown" style="display: none;">
                                </ul>
                                <ul id="dropDownLoaderDiv" >
                                    <div style="position: relative; height: 10px; background-color: ;">
                                        <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 55%;top: 50%;margin-left: -32px;margin-top: -120px;"></i>
                                    </div>
                                </ul>
                            </li>
                            <li class="footer"><span class="pull-right"><button class="btn btn-primary btn-xxs" onclick="viewAllNotifications();" id="viewAllBtn" disabled>View all</button><button class="btn btn-success btn-xxs" onclick="clearAllNotification();" id="clearAllBtn" disabled>Clear all</button></span></li>
                        </ul>
                    </li>-->
                    <?php
                    //server gives noimage.jpg

                    $server_status=check_server();
                    if($server_status=='cloud')
                    {
                        $userimg=$_SESSION['sponsorImage'];
                    }
                    else {
                        if ($_SESSION['sponsorImage'] == "" || $_SESSION['sponsorImage'] == null || $_SESSION['sponsorImage'] == 'noimage.jpg') {
                            $userimg = 'app_att/113-512.png';
                        } else {
                            if (file_exists('ref/images/' . $_SESSION['sponsorImage'])) {
                                $userimg = $_SESSION['sponsorImage'];
                            } else {
                                $userimg = "app_att/113-512.png";
                            }
                        }
                    }
                    ?>
                    <!-- User Account: style can be found in dropdown.less -->

                    <li class="dropdown user user-menu" id="userShow" style="top:4px!important;">
                        <a style="cursor: pointer;" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?php echo load_image($server_status,$userimg); ?>" class="user-image" alt="">
                            <span class="hidden-xs"><?php echo $this->userInfo['sponsorName']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?php echo load_image($server_status,$userimg); ?>" class="img-circle" alt="User Image">
                                <p>
                                    <?php echo $this->userInfo['sponsorName']; ?> - <?php  echo $this->userInfo['sponsorIndustry']; ?>

                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a style="cursor: pointer;" onclick="getSponsorProfile()" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo site_url('Srp_aa_sponsorLoginController/unset_sess'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <!--<li>
                      <a style="cursor: pointer;" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>-->
                </ul>
            </div>
        </nav>
    </header>

    <!--language_select_modal-->
    <div aria-hidden="true" role="dialog" id="sponsor_language_modal"  class="modal" data-keyboard="true" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form class="form-horizontal">
                    <div class="modal-header" style="background-color: #00607b;  color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    style="color: white;" aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> Language </h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $language = spo_drill_down_emp_language();
                        if (!empty($language)) {
                            foreach ($language as $val) {
                                $val['languageID'];
                                ?>
                                <div class="row-fluid" style="padding-bottom: 10px">
                                    <a class="btn btn-block btn-social " style="background-color: rgba(154, 170, 157, 0.35)"
                                       onclick="change_spo_emp_language(<?php echo $val['languageID'] ?>)" type="button">
                                        <i class="fa fa-language text-white"></i> <b><?php echo $val['description'] ?>
                                            | <?php echo $val['languageshortcode'] ?></b>
                                    </a>
                                </div>

                                <?php
                            }
                        } ?>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- sponsor profile -->
    <?php  $CI =& get_instance();

    $sponsorPrimaryLanguage = getSponsorPrimaryLanguage();
    $this->lang->load('sponsor', $sponsorPrimaryLanguage);

    ?>
    <div class="modal fade" id="sponsor_profile" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document" style="width: 900px;">
            <div class="modal-content">
                <form class="ajax" id="sponsorProfileForm" method="post" action="" enctype="multipart/form-data">
                    <input type="text" name="editf" id="editf" style="display: none;">
                    <div class="modal-header" style="background-color: #00607b;color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="clsProfile" onclick="clsModal();">
                            <span style="color: white"  aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="addsponsor"><?php echo $CI->lang->line('sponsor_profile_title'); ?></h4>
                    </div>
                    <div class="modal-body" style="background-color: rgba(10,157,249,0.07)">
                        <div class="form-row">
                            <div  id="imagediv" style="margin-left: 660px">
                                <label for="image" class="control-label" style="visibility:;"></label><img src="<?php echo load_image($server_status,$flagImage); ?>"  style="width:200px; height:200px;">
                                <h4><b><div id="spoName" style="text-align: center;"></div></b></h4>
                            </div>
                        </div>
                        <div class="form-row"  style="margin-top: -230px;">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_sponsor_ref');?>:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="sponsor_ref" name="sponsor_ref"
                                       placeholder="<?php echo $CI->lang->line('sponsor_sponsor_ref'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_sponsor_name');?>:</label>

                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <input type="text" class="form-control" id="sponsor" name="sponsor"
                                       placeholder="<?php echo $CI->lang->line('sponsor_sponsor_name'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_country');?>:</label>

                            <div class="col-sm-6" >
                                <input type="text" class="form-control" id="country" name="country"
                                       placeholder="<?php echo $CI->lang->line('sponsor_country'); ?>">

                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_area');?>:</label>

                            <div class="col-sm-6" >
                                <input type="text" class="form-control" id="area" name="area"
                                       placeholder="<?php echo $CI->lang->line('sponsor_area'); ?>">

                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_contact_address');?>:</label>

                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="<?php echo $CI->lang->line('sponsor_contact_address'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row" >
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_bussiness_reg');?>:</label>

                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <input type="text" class="form-control" id="bussiness_reg" name="bussiness_reg"
                                       placeholder="<?php echo $CI->lang->line('sponsor_bussiness_reg'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_sponsor_industry_category');?>:</label>
                            <div class="col-sm-6" >
                                <input type="text" class="form-control" id="industry_category" name="industry_category"
                                       placeholder="<?php echo $CI->lang->line('sponsor_sponsor_industry_category'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_contact_person');?>:</label>
                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <input type="text" class="form-control" id="contact_person" name="contact_person"
                                       placeholder="<?php echo $CI->lang->line('sponsor_contact_person'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_contact_no');?>:</label>

                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <input type="number" min="0" class="form-control" id="contact_no" name="contact_no"
                                       placeholder="<?php echo $CI->lang->line('sponsor_contact_no'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_contact_email');?>:</label>

                            <div class="col-sm-6" style="margin-bottom: 0px;">
                                <input type="email" class="form-control" id="contact_email" name="contact_email"
                                       placeholder="<?php echo $CI->lang->line('sponsor_contact_email'); ?>">
                            </div>
                        </div><br><br>

                        <div class="form-row">
                            <label class="col-sm-3"><?php echo $CI->lang->line('sponsor_debit_account');?>:</label>
                            <div class="col-sm-6" >
                                <input type="text" class="form-control" id="sponsorDebitAcc" name="sponsorDebitAcc"
                                       placeholder="<?php echo $CI->lang->line('sponsor_debit_account'); ?>">
                            </div>
                        </div><br><br>

                    </div>
                    <div class="modal-footer" style="padding: 8px !important;">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="cls" onclick="clsModal();"><?php echo $CI->lang->line('sponsor_close');?></button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <script>

        // swap language function
        function sponsorLanguage() {
            $('#sponsor_language_modal').modal('show');
        }

        // getSponsorEmpMessages function
        function getSponsorEmpMessages() {
        }

        // getSponsorEmpNotifications function
        function getSponsorEmpNotifications() {
        }

        function change_spo_emp_language(languageID) {

            $.ajax({
                async: true,
                type: 'post',
                data: {languageid: languageID},
                url: "User_accessController/update_spo_language",
                success: function (data) {
                    location.reload();

                }, error: function () {
                }
            });
        }

        function getSponsorProfile() {
            let SchID= document.getElementById('School_Selection_Nav').value;

            <?php echo Deselect_Rows(); ?>
            // SelectRow(sponsorId)

            $.ajax({
                type: 'POST',
                url: "Srp_aa_sponsorDashboardController/getProfileDetails",
                data: {'id': <?= $_SESSION['sponsorID']?>,'sponsorSchMasterID': SchID},
                dataType: 'json',
                encode: true,

                success: function (data) {
                    $("input").prop('readonly', true);

                    $('#sponsor_profile').modal('show');

                    $( "#sponsor" ).val(data.sponsor);
                    $( "#spoName" ).html(data.sponsor);
                    $( "#sponsor_ref" ).val(data.sponsorRefNo);
                    $( "#address" ).val(data.address);
                    $( "#bussiness_reg" ).val(data.bussinessRegNo);
                    $( "#contact_person" ).val(data.contactPerson);
                    $( "#contact_no" ).val(data.ContactNumber);
                    $( "#contact_email" ).val(data.contactEmail);
                    $( "#country" ).val(data.country);
                    $( "#area" ).val(data.areaE);
                    $( "#sponsorDebitAcc" ).val(data.sponsorDebitAcc);
                    $( "#industry_category" ).val(data.industryCategory);

                }
            });
        }

        function clsModal(){
            $("input").prop('readonly', false);

            document.getElementById('sponsorProfileForm').reset();
            $('#sponsorProfileForm').bootstrapValidator("resetForm",true);

        }
    </script>


