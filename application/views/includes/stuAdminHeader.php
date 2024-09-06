<?php
$primaryLanguage = getPrimaryLanguage();
$this->lang->load('common', $primaryLanguage);
?>
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

    <script type="text/javascript" src="<?php echo base_url('ref/Additional_jScripts.js'); ?>"></script>
    <style>
    .skin-blue .main-header .navbar .sidebar-toggle:hover
        {
            background-color:rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<?php
if(isset($_SESSION['Stu_ERP_CompanyID']))
{
$companyID = $_SESSION['Stu_ERP_CompanyID'];
$curentuser = $_SESSION['UserID'];
}
else
{
$companyID = "";
$curentuser = "";    
}
$language;

if(isset($_SESSION['Stu_ERP_CompanyID']))
{
$query = "SELECT `primarylanguageemp`.`description` AS `language`, CASE WHEN primarylanguageemp.description = \"Arabic\" THEN \"ع\" WHEN primarylanguageemp.description = \"English\" THEN \"ENG\" END languageview 
          FROM srp_studentdetails INNER JOIN srp_erp_lang_languages AS primarylanguageemp ON primarylanguageemp.languageID = srp_studentdetails.languageID WHERE StudentID = '".$curentuser."' ";
$result_employee = $this->db->query($query)->row_array();

if (!empty($result_employee)) {
    $language = $result_employee['languageview'];
} else {
    $q = "SELECT primarylang.description AS LANGUAGE, CASE WHEN primarylang.description = \"Arabic\" THEN \"ع\" ELSE \"\" END languageprimary FROM srp_erp_lang_companylanguages INNER JOIN srp_erp_lang_languages primarylang ON primarylang.languageID = srp_erp_lang_companylanguages.primaryLanguageID WHERE companyID = '".$companyID."' ";
    $result = $this->db->query($q)->row_array();
    if (!empty($result)) {
        $language = $result['languageprimary'];
    } else {
        $language = 'ENG';
    }
}
}
else
{
        $language = 'ENG';
}
?>

<body style="background-color:#fff;">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <!--  -->
        <!-- Header Navbar: style can be found in header.less -->
        <nav> 
            <!-- Sidebar toggle button-->
            <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color:black;">
                <span class="sr-only">Toggle navigation</span>
            </a> -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <?php $userimg = $_SESSION['UserImage']; ?>
                    <li style="margin-top:0px; font-size: 11px 0px 0px 100px; padding: 2px 0px 2px" class="dropdown user user-menu">
                    <a href="#" class="logo" style="background-color:#ffffff;">
            <?php
            $server_status=check_server();
            if($this->userInfo['SchName'] !== ""){
                $sys_title = $this->userInfo['SchName'].'<br>'.$this->userInfo['Branch'];
                $sys_title_logo = '<img src="'.load_image($server_status,$this->userInfo['SchLogo']).'" style="width:25px; height:25px;">';
                $sys_title_plus_logo = $sys_title_logo;
            }else{
                $sys_title = '';
                $sys_title_logo = '<img src="'.load_image($server_status,'excalibur_logo.png').'" style="width:50px; height:50px;background-color:white;border:none;border-radius:0px;">';
                $sys_title_plus_logo = '<img src="'.load_image($server_status,'excalibur_logo.png').'" style="width:115px;border:none;border-radius:0px;background-color:white;">';
            }
            $trialDet='';
            if(isset($_SESSION['StuSchID'])){
            $query2 = $this->db->query("SELECT isTrialSchool,trialStartDate,trialEndDate FROM srp_schoolmaster WHERE IsActive = '1' AND isLive='1' AND SchMasterID='".$_SESSION['StuSchID']."'");
            $res2 = $query2->row();
            if($res2->isTrialSchool == '1'){
                $trialDet='<span>Trial Period End on : </span>'.$res2->trialEndDate. '<span> 12:01 AM</span>';
            }else{
                $trialDet='';
            }
            }
            ?>
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <!-- <span class="logo-mini"><?php echo $sys_title_logo ?></span> -->
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg" style="font-size: 12px; padding:1px 0px 0px 5px" ><?php echo $sys_title_plus_logo ?> <b style="color:black;"><strong><?php echo $sys_title; ?></strong></b></span>
        </a>
                    </li>

                    <li class="dropdown user user-menu">
                        <a href="#"  onclick="openlanguagemodel()" style="color:black;">
                            <!--<img src="<?php //echo base_url('ref/images/language.png'); ?>" class="user-image" alt="User Image" style="margin-right: 3px; height:22px; width:22px; ">-->
                            <span class="hidden-xs" style="font-size: 15px;"><?php echo $language ?> </span>
                        </a>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black;">
                            <img src="<?php echo load_image($server_status,$userimg);?>" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $this->userInfo['Ename']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header" style="background-color:rgba(0, 0, 0, 0.1);">
                                <img src="<?php echo load_image($server_status,$userimg); ?>" class="img-circle" alt="User Image">
                                <p style="color:black;">
                                    <?php echo $this->userInfo['Ename']; ?> - <?php  echo $this->userInfo['EmpDes']; ?>
                                    <small><?php echo $this->userInfo['SchName']; ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?php echo site_url('Srp_ha_SPProfileController'); ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?php echo site_url('srp_saHa_loginController/unset_sess'); ?>" class="btn btn-default btn-flat">Sign out</a>
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
    <div aria-hidden="true" role="dialog" id="language_select_modal" class="modal" data-keyboard="true"
         data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> Language </h4>
                    </div>
                    <div class="modal-body">
                        <?php
                        $language = drill_down_emp_language();
                        if (!empty($language)) {
                            foreach ($language as $val) {
                                $val['languageID'];
                                ?>
                                <div class="row-fluid" style="padding-bottom: 10px">
                                    <a class="btn btn-block btn-social " style="background-color: rgba(154, 170, 157, 0.35)"
                                       onclick="change_stu_language(<?php echo $val['languageID'] ?>)" type="button">
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


    <?php
    $this->load->view('Srp_ha_parentSubscriptionView');
    ?>
<script>
    function change_stu_language(languageid) {
        $.ajax({
            async: true,
            type: 'post',
            dataType: 'json',
            data: {languageid: languageid},
            url: "User_accessController/update_stu_language",
            success: function (data) {
                location.reload();

            }, error: function () {
            }
        });
    }
</script>


<?php
/**
 * Created by PhpStorm.
 * User: Haaniya
 * Date: 03/06/2016
 * Time: 08:06 AM
 */