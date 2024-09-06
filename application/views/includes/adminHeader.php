<?php
// $primaryLanguage = getPrimaryLanguage();
// $this->lang->load('common', $primaryLanguage);
?>
<!DOCTYPE html>
<html>

<head>//

<?php //if ((base_url()=='http://excalibur.leaf.lyceum.lk/') or (base_url()=='https://excalibur.leaf.lyceum.lk/') or (base_url()=='http://excalibur.leaf.lyceum.lk/') or (base_url()=='https://excalibur.leaf.lyceum.lk/') or (base_url()=='https://exdev.appsdemo.live/') or (base_url()=='http://exdev.appsdemo.live/') or (base_url()=='https://exqa.appsdemo.live/')or (base_url()=='http://exqa.appsdemo.live/') or (base_url()=='https://exstaging.appsdemo.live/')or (base_url()=='https://exstaging.appsdemo.live/')or (base_url()=='https://exuat.appsdemo.live/')or (base_url()=='http://exuat.appsdemo.live/')){?>
        <link rel="icon" type="image/icon" href="<?php ////echo base_url('favicon_srp.png'); ?>" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Excalibur</title>
    <?///} else { ?>
        <!-- <link rel="icon" type="image/icon" href="<?php //echo base_url('favicon_zeta1.png'); ?>" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zeta | School Management System</title> -->
    <?php //}?>
  <!--Jquery -->
  <script type="text/javascript" src="<?php //echo base_url('ref/jquery/jquery-1.11.1.min.js'); ?>"></script>
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/bootstrap/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/font-awesome-4.3.0/css/font-awesome.min.css'); ?>">
  <!--bootstrap responsive-->
  <link rel="stylesheet" href="<?php //echo base_url('ref/bootstrap/css/bootstrap-responsive.css'); ?>" />
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/daterangepicker/daterangepicker-bs3.css'); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/datepicker/datepicker3.css'); ?>">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/iCheck/all.css'); ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/select2/select2.css'); ?>">
  <!--multiselect-->
  <link rel="stylesheet" type="text/css" href="<?php //echo base_url('ref/adminlte/plugins/multiSelectCheckbox/dist/css/bootstrap-multiselect.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/dist/css/AdminLTE.min.css'); ?>">
  <!--Morris-->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/morris/morris.css'); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->

  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/dist/css/skins/_all-skins.css'); ?>">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <!--    <script src="-->
  <!--/*https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!--Boostrap Validator -->
  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="<?php //echo base_url("ref/validation/css/bootstrapValidator.min.css"); ?>" />

  <!--DataTable-->
  <!--CSS-->
  <link rel="stylesheet" type="text/css" href="<?php //echo base_url('ref/datatables/resources/media/css/jquery.dataTables.min.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php //echo base_url('ref/jquery/datatables.css'); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php //echo base_url('ref/datatables/resources/media/Responsive-master/css/responsive.dataTables.min.css'); ?>" />

  <!-- Colour picker -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css'); ?>">

  <!-- j Crop -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/tapmodo-Jcrop-1902fbc/css/jquery.Jcrop.min.css'); ?>">
  <!--<link rel="stylesheet" href="<?php /*//echo base_url('ref/tapmodo-Jcrop-1902fbc/demos/demo_files/demos.css'); */ ?>" type="text/css" />-->

  <!--igrowl dependencies : animate.css-->
  <link rel="stylesheet" href="<?php //echo base_url('ref/igrowl/public/stylesheets/animate.css'); ?>">
  <link rel="stylesheet" href="<?php //echo base_url('ref/igrowl/dist/css/igrowl.css'); ?>">
  <link rel="stylesheet" href="<?php //echo base_url('ref/igrowl/public/stylesheets/icomoon/vicons.css'); ?>">

  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/fullcalendar/fullcalendar.css'); ?>">
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/fullcalendar/fullcalendar.print.css'); ?>" media="print">

  <!--vertical tabs-->
  <link rel="stylesheet" href="<?php //echo base_url('ref/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.min.css'); ?>">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php //echo base_url('ref/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>">

  <!--Additional Styles-->
  <link rel="stylesheet" href="<?php //echo base_url('ref/additional_styles.css'); ?>">

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
    width: 8px !important;
  }

  .notif-hover:hover {
    background-color: #ebedf0;
  }

  .notification-message {
    font-size: 12px;
    color: #A9A9A9;
    white-space: nowrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
  }

  .notif-message-container {
    margin: 0px !important;
    padding: 0px !important;
  }

  .notification-list {
    padding: 5px 3px;
    cursor: pointer;
    border-bottom: 1px solid #f4f4f4;
  }

  .skin-blue-light .main-header .navbar .sidebar-toggle:hover {
    background-color: rgba(0, 0, 0, 0.1);
  }
  .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: 50% 50% no-repeat rgb(249,249,249);
    opacity: .4;
    display: none;
  }
  .loader>i{
    position: relative;
    margin: 42rem 70rem;
    font-size: 100px;
  }
</style>

<?php

$companyID = '';
$curentuser ='';
$language;

// $query = "SELECT `primarylanguageemp`.`description` AS `language`, CASE WHEN primarylanguageemp.description = \"Arabic\" THEN \"ع\" WHEN primarylanguageemp.description = \"English\" THEN \"ENG\" END languageview 
//           FROM srp_employeesdetails INNER JOIN srp_erp_lang_languages AS primarylanguageemp ON primarylanguageemp.languageID = srp_employeesdetails.languageID WHERE EIdNo = $curentuser ";
// $result_employee = $this->db->query($query)->row_array();

// if (!empty($result_employee)) {
//   $language = $result_employee['languageview'];
// } else {
//   $q = "SELECT primarylang.description AS LANGUAGE, CASE WHEN primarylang.description = \"Arabic\" THEN \"ع\" ELSE \"\" END languageprimary FROM srp_erp_lang_companylanguages INNER JOIN srp_erp_lang_languages primarylang ON primarylang.languageID = srp_erp_lang_companylanguages.primaryLanguageID WHERE companyID = $companyID ";
//   $result = $this->db->query($q)->row_array();
//   if (!empty($result)) {
//     $language = $result['languageprimary'];
//   } else {
    $language = 'ENG';
//   }
// }
?>

<body class="hold-transition skin-blue-light sidebar-mini fixed" data-spy="scroll" data-target="#scrollspy" style="background-color:#fff;">
  <div class="wrapper">
    <div class="overlay loader" id="loader">
        <i class="fa fa-refresh fa-spin"></i>
    </div>
    <header class="main-header">
      <!-- Logo -->
      <?php //if ((//base_url()=='http://excalibur.leaf.lyceum.lk/') or (base_url()=='https://excalibur.leaf.lyceum.lk/') or (base_url()=='http://excalibur.leaf.lyceum.lk/') or (base_url()=='https://excalibur.leaf.lyceum.lk/') or (base_url()=='https://exdev.appsdemo.live/') or (base_url()=='http://exdev.appsdemo.live/') or (base_url()=='https://exqa.appsdemo.live/')or (base_url()=='http://exqa.appsdemo.live/') or (base_url()=='https://exstaging.appsdemo.live/')or (base_url()=='https://exstaging.appsdemo.live/')or (base_url()=='https://exuat.appsdemo.live/')or (base_url()=='http://exuat.appsdemo.live/')) { ?>
                <a href="#" class="logo" style="background-color:white !important;height: 64px;width:300px">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="<?php ////$server_status = check_server(); //echo base_url('ref/images/excalibur_logo_black.png'); ?>" style="height:64px;padding: 5px;border-color:white;"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg" style="font-size: 14px;"><img src="<?php //echo base_url('ref/images/excalibur_logo_black.png'); ?>" style="height:64px;padding: 5px;border-color:white;"></strong></b></span>
                </a>
                <?php //} else {?>
                    <!-- <a href="#" class="logo" style="background-color:white !important;height: 64px;"> -->
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!-- <span class="logo-mini"><img src="<?php //$server_status = check_server(); //echo base_url('ref/images/zeta_logo_black.png'); ?>" style="height:64px;padding: 5px;border-color:white;"></span> -->
                <!-- logo for regular state and mobile devices -->
                <!-- <span class="logo-lg" style="font-size: 14px;"><img src="<?php //echo base_url('ref/images/zeta_logo_black.png'); ?>" style="height:64px;padding: 5px;border-color:white;"></strong></b></span> -->
                <!-- </a> -->
                <?php //}?>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation" style="background-color:#fff;">
        <!--School Details - Header-->
        <?php 
            // $query = $this->db->query('SELECT * FROM srp_schoolmaster WHERE (SchMasterID="' . $_SESSION['schID'] . '")');
            // $res = $query->result();

            // foreach ($res as $row) {

                //$server_status=check_server();
                // if(//$server_status=='cloud'
                //   )
                // {
                //     $Image=$row->SchLogo;
                // }else {
                //     if ($row->SchLogo == "" || $row->SchLogo == null) {
                //         $Image = "app_att/unknownLogo.png";
                //     } else {
                //         $external_link = 'ref/images/' . $row->SchLogo;
                //         if ((file_exists($external_link)) && (getimagesize($external_link))) {
                //             $Image = $row->SchLogo;
                //         } else {
                //             $Image = 'app_att/unknownLogo.png';
                            $Image = '';
                //         }
                //     }
                // }
            // }
            // if ($this->userInfo['SchName'] !== "") {
            //   $sys_title = $this->userInfo['SchName'] . ', ' . $this->userInfo['Branch'];
            //   $sys_title_other = $this->userInfo['SchNameOther'];
            //   if ($this->userInfo['SchLogo'] == "" || $this->userInfo['SchLogo'] == null || $this->userInfo['SchLogo'] == 'noimage.jpg') {
            //     $sys_title_logo = '<img src="' . load_image(//$server_status,$Image) . '" class="user-image" alt="User Image" style="border-radius: 0%;height:40px !important;width:40px !important;padding:0 !important;">';
            //   } else {
            //     $sys_title_logo = '<img src="' . load_image(//$server_status,$Image) . '" class="user-image"  alt="User Image" style="border-radius: 0%;height:55px !important;width:37px !important;">';
            //   }
            //   $sys_title_plus_logo = $sys_title_logo;
            // } else {
              $sys_title_other = '';
              $sys_title = '';
              $sys_title_logo = '';
              $sys_title_plus_logo = "";
            // }

            // $query2 = $this->db->query("SELECT isTrialSchool,trialStartDate,trialEndDate FROM srp_schoolmaster WHERE SchMasterID='" . $_SESSION['schID'] . "'");
            // $res2 = $query2->row();
            // if ($res2->isTrialSchool == '1') {
            //   $trialDet = '<span>Trial Period End on : </span>' . $res2->trialEndDate . '<span> 12:01 AM</span>';
            // } else {
              $trialDet = '';
            // }
        ?>
        <!--<span class="logo-lg" style="font-size: 12px;"><?php /*echo $sys_title_plus_logo */ ?> <b><strong><?php /*echo strtoupper($sys_title); */ ?></strong></b></span>-->
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color:black;">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li style="margin-top:12px; ">
              <span class="label label-danger " style="margin-top:12px;font-size: 11px;padding: 2px 5px 2px"><?php echo $trialDet; ?></span>
            </li>

            <?php if ($sys_title_other != "") { ?>
              <li class="dropdown user user-menu" data-toggle="tooltip" title="Help Desk" style="position: absolute;left: 50%;transform: translateX(-70%);">
                <a target="_blank" style="padding-top: 5px !important;padding-bottom: 5px !important;color:black;">
                  <table>
                    <tr>
                      <td><span class="hidden-xs" style="font-size: 15px;"><?php echo $sys_title; ?>&nbsp;&nbsp;&nbsp;</span></td>
                      <td><?php echo $sys_title_plus_logo ?></td>
                      <td><span class="hidden-xs" style="font-size: 18px;"><?php echo $sys_title_other; ?></span></td>
                    </tr>
                  </table>
                </a>
              </li>
            <?php } else { ?>
              <li class="dropdown user user-menu" data-toggle="tooltip" title="Help Desk">
                <a target="_blank" style="padding-top: 5px !important;padding-bottom: 5px !important;color:black;">
                  <table>
                    <tr>
                      <td><?php echo $sys_title_plus_logo ?></td>
                      <td><span class="hidden-xs" style="font-size: 15px;"><?php echo $sys_title; ?></span></td>
                      <td><span class="hidden-xs" style="font-size: 18px;"><?php echo $sys_title_other; ?></span></td>
                    </tr>
                  </table>
                </a>
              </li>
            <?php } ?>

            <li class="dropdown user user-menu" data-toggle="tooltip" title="Help Desk" style="top:4px!important;">
              <a href="#" target="_blank" style="color:black;">
                <span class="hidden-xs" style="visibility: hidden;">.</span>
                <img src="<?php //echo base_url('ref/images/HelpDeskIcon.png'); ?>" class="user-image" alt="User Image" style="margin-right: -10px; height:22px; width:22px;">
                <span class="hidden-xs" style="visibility: hidden;">.</span>
              </a>
            </li>

            <li class="dropdown user user-menu" style="top:4px!important;">
              <a href="#" onclick="openlanguagemodel()" style="color:black;">
                <!--<img src="<?php ////echo base_url('ref/images/language.png'); 
                              ?>" class="user-image" alt="User Image" style="margin-right: 3px; height:22px; width:22px; ">-->
                <span class="hidden-xs" style="font-size: 15px;"><?php echo $language ?> </span>
              </a>
            </li>

            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu" style="top:4px!important;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="getEmpMessages();" style="color:black;">
                <i class="fa fa-envelope-o"></i>
                <span class="label label-warning" id="NotificationNumTag" style="display:none;"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header" id="Notification_dropdown_header"></li>
                <li>
                  <ul class="menu" id="Notification_dropdown" style="display: none;">
                  </ul>
                  <ul id="dropDownMLoaderDiv">
                    <div style="position: relative; height: 10px;">
                      <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 48%;top: 50%;margin-left: -32px;margin-top: -120px;"></i>
                    </div>
                  </ul>
                </li>
                <li class="footer"><a href="<?php //echo site_url('Srp_sa_communicationMasterController'); ?>">See All Messages</a></li>
              </ul>
            </li>

            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu" style="top:4px!important;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="getEmpNotifications();" style="color:black;">
                <i class="fa fa-bell-o"></i>
                <span class="label label-danger" id="Other_NotificationNumTag" style="display:none;"></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header" id="Other_Notification_dropdown_header">You have 10 notifications</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu" id="Other_Notification_dropdown" style="display: none;">
                  </ul>
                  <ul id="dropDownLoaderDiv">
                    <div style="position: relative; height: 10px;">
                      <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 55%;top: 50%;margin-left: -32px;margin-top: -120px;"></i>
                    </div>
                  </ul>
                </li>
                <li class="footer"><span class="pull-right"><button class="btn btn-primary btn-xxs" onclick="viewAllNotifications();" id="viewAllBtn" disabled>View all</button><button class="btn btn-success btn-xxs" onclick="clearAllNotification();" id="clearAllBtn" disabled>Clear all</button></span></li>
              </ul>
            </li>
            <?php
            //server gives noimage.jpg

            //$server_status = check_server();
            // if (//$server_status == 'cloud') {
            //   $userimg = $_SESSION['UserImage'];
            // } else {
            //   if ($_SESSION['UserImage'] == "" || $_SESSION['UserImage'] == null || $_SESSION['UserImage'] == 'noimage.jpg') {
            //     $userimg = '1.png';
            //   } else {
            //     if (file_exists('ref/images/' . $_SESSION['UserImage'])) {
            //       $userimg = $_SESSION['UserImage'];
            //     } else {
            //       $userimg = "1.png";
                  $userimg = "";
            //     }
            //   }
            // }
            ?>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu" style="top:4px!important;">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black;">
                <!-- <img src="<?php //echo load_image_thumb(//$server_status, $userimg); ?>" class="user-image" alt=""> -->
                  <img src="" class="user-image" alt="">
                <span class="hidden-xs"><?php echo $this->userInfo['Ename']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header" style="background-color:rgba(0, 0, 0, 0.1);">
                  <!-- <img src="<?php //echo load_image_thumb(//$server_status, $userimg); ?>" class="img-circle" alt="User Image"> -->
                    <img src="" class="img-circle" alt="User Image">
                  <p style="color:black;">
                    <?php echo $this->userInfo['Ename']; ?> - <?php echo $this->userInfo['EmpDes']; ?>
                    <small><?php echo $this->userInfo['SchName']; ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo site_url('srp_hi_UserProfileController'); ?>" class="btn btn-default btn-flat">Profile</a>
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

    <div aria-hidden="true" role="dialog" id="language_select_modal" class="modal" data-keyboard="true" data-backdrop="static">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <form class="form-horizontal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                    <a class="btn btn-block btn-social " style="background-color: rgba(154, 170, 157, 0.35)" onclick="change_emp_language(<?php echo $val['languageID'] ?>)" type="button">
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
    <!--View all notificaion modal-->
    <div class="modal fade" role="dialog" id="parNotifications_Mod">
      <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" id="clear_notification_fm" action="<?php echo site_url('Srp_notificationsController/post_Empclear'); ?>" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Notifications</h4>
            </div>
            <div class="modal-body">
              <div><span class="pull-right"><a class="btn btn-success btn-xxs" id="clearSelectedBtn" onclick="ClearNotification();">Clear Selected</a></span></div>
              <table id="parNotification_ul" width="100%">

              </table>
              <input type="hidden" id="count" name="count" value="0">
            </div>
            <div class="modal-footer" id="closeFooter">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <div class="modal-footer" id="confirmFooter" style="display: none;">
              <button type="button" class="btn btn-default" onclick="cancelChecked();">Cancel</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
            <div class="modal-footer" id="clearAllFooter" style="display: none;">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Confirm</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <script>
      window.setInterval(function() {
        //get number of unseen notifications of Messages
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_empNotificationsUnseen",
          data: {},
          success: function(data) {
            $('#NotificationNumTag').html(data);
            $('#Notification_dropdown_header').html("<?php echo $this->lang->line('common_you_have') ?> " + data + " <?php echo $this->lang->line('common_unseen_message') ?>");

            if (data == '0') {
              document.getElementById('NotificationNumTag').style.display = 'none';
            } else {
              document.getElementById('NotificationNumTag').style.display = 'inline-block';
            }
          }
        });

        //get number of unseen notifications
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsUnseen",
          data: {},
          success: function(data) {
            $('#Other_NotificationNumTag').html(data);
            $('#Other_Notification_dropdown_header').html("<?php echo $this->lang->line('common_you_have') ?> " + data + " <?php echo $this->lang->line('common_unseen_notifications') ?>");

            if (data == '0') {
              document.getElementById('Other_NotificationNumTag').style.display = 'none';
            } else {
              document.getElementById('Other_NotificationNumTag').style.display = 'inline-block';
            }
          }
        });
      }, 300000);

      $(document).ready(function() {
        //get number of unseen notifications
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_empNotificationsUnseen",
          data: {},
          success: function(data) {
            $('#NotificationNumTag').html(data);
            $('#Notification_dropdown_header').html("<?php echo $this->lang->line('common_you_have') ?> " + data + " <?php echo $this->lang->line('common_unseen_message') ?>");

            if (data == '0') {
              document.getElementById('NotificationNumTag').style.display = 'none';
            } else {
              document.getElementById('NotificationNumTag').style.display = 'inline-block';
            }
          }
        });

        //get number of other unseen notifications
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsUnseen",
          data: {},
          success: function(data) {
            $('#Other_NotificationNumTag').html(data);
            $('#Other_Notification_dropdown_header').html("<?php echo $this->lang->line('common_you_have') ?> " + data + " <?php echo $this->lang->line('common_unseen_notifications') ?>");

            if (data == '0') {
              document.getElementById('Other_NotificationNumTag').style.display = 'none';
            } else {
              document.getElementById('Other_NotificationNumTag').style.display = 'inline-block';
            }
          }
        });
        runOncePerDay();
      });

      function update_isSeen_Other(x, pageName, cls, grp, subID, ayID, staffID, LP_ID) {
        var id = x.id;
        var numberpattern = /\d+/g;
        var NotID = id.match(numberpattern);

        $.ajax({
          type: "POST",
          url: 'Srp_notificationsController/update_isSeen_OtherEmp',
          data: {
            'NotID': NotID,
            'ClassID': cls,
            'GroupID': grp,
            'subID': subID,
            'ayID': ayID,
            'staffID': staffID,
            'LP_ID': LP_ID
          },
          success: function(data) {
            window.location.href = pageName;
          }
        });
      }

      function viewAllNotifications() {
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/view_allEmpNotifications",
          data: {},
          success: function(data) {
            $('#parNotification_ul').html(data);
            $('#parNotifications_Mod').modal('show');
            document.getElementById('confirmFooter').style.display = 'none';
            document.getElementById('closeFooter').style.display = 'block';
            document.getElementById('clearAllFooter').style.display = 'none';
          }
        });
      }

      function clearAllNotification() {
        var count = 0;
        //get total count of other notifications
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsCount",
          data: {},
          success: function(data) {
            count = data;
            document.getElementById('count').value = data;
          }
        });

        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/view_allEmpNotifications",
          data: {},
          success: function(data) {
            $('#parNotification_ul').html(data);
            $('#parNotifications_Mod').modal('show');
            for (var i = 0; i < count; i++) {
              document.getElementById('checkDisplay' + i).style.display = 'block';
              document.getElementById('clear' + i).checked = true;
              document.getElementById('select_Val' + i).value = '1';
            }
            document.getElementById('clearSelectedBtn').style.display = 'none';
            document.getElementById('confirmFooter').style.display = 'none';
            document.getElementById('clearAllFooter').style.display = 'block';
            document.getElementById('closeFooter').style.display = 'none';
          }
        });
      }

      function ClearNotification() {
        var count = 0;
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsCount",
          data: {},
          success: function(data) {
            count = data;
            document.getElementById('count').value = data;
            for (var i = 0; i < count; i++) {
              document.getElementById('checkDisplay' + i).style.display = 'block';
              document.getElementById('clear' + i).checked = false;
              document.getElementById('select_Val' + i).value = '0';
            }
            document.getElementById('confirmFooter').style.display = 'block';
            document.getElementById('closeFooter').style.display = 'none';
            document.getElementById('clearAllFooter').style.display = 'none';
          }
        });
      }

      function cancelChecked() {
        var count = 0;
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsCount",
          data: {},
          success: function(data) {
            count = data;
            for (var i = 0; i < count; i++) {
              document.getElementById('checkDisplay' + i).style.display = 'none';
              document.getElementById('clear' + i).checked = false;
              document.getElementById('select_Val' + i).value = '0';
            }
            document.getElementById('confirmFooter').style.display = 'none';
            document.getElementById('closeFooter').style.display = 'block';
          }
        });
      }

      $(document).ready(function() {
        $('#clear_notification_fm').bootstrapValidator({
            live: 'enabled',
            excluded: [':disabled'],
            fields: {}
          })
          .on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();

            var $form = $(e.target),
              bv = $form.data('bootstrapValidation');

            // Use Ajax to submit form data
            var that = $(this),
              url = that.attr('action'),
              type = that.attr('method'),
              data = {};
            var serializedData = that.serialize();
            that.find('[name]').each(function(index, value) {
              var that = $(this),
                name = that.attr('name'),
                value = that.val();

              data[name] = value;
            });

            $.ajax({
              url: url,
              type: type,
              data: serializedData,
              success: function(data) {
                if (data == 'Deleted') {
                  <?php echo notify('success', '', '<strong>Selected Notifications have been successfully deleted! </strong>', 'fa fa-check-circle'); ?>
                }
                $('#clear_notification_fm').bootstrapValidator("resetForm", true);
                document.getElementById('clear_notification_fm').reset();
                viewAllNotifications();
              },
              error: function() {
                <?php echo notify('danger', '', '<strong>Failed to process your request! </strong>Please try again.', 'fa fa-exclamation-circle'); ?>
              }
            });
          });
      });

      function Active(x) {
        var id = x.id;
        var numberpattern = /\d+/g;
        var e = id.match(numberpattern);
        if (document.getElementById(id).checked == true) {
          document.getElementById('select_Val' + e).value = "1";
        }
        if (document.getElementById(id).checked == false) {
          document.getElementById('select_Val' + e).value = "0";
        }
      }

      // checks if one day has passed.
      function hasOneDayPassed() {
        var date = new Date().toLocaleDateString(); // get today's date
        // if there's a date in localstorage and it's equal to the above:
        if (localStorage.yourapp_date == date) {
          return false;
        } else {
          // this portion of logic occurs when a day has passed
          localStorage.yourapp_date = date;
          return true;
        }
      }

      //function which should run once a day
      function runOncePerDay() {
        if (hasOneDayPassed()) {
          // Delete older(more than 30 days) notifications
          $.ajax({
            type: "POST",
            url: "Srp_notificationsController/deleteOlderNotifications",
            data: {},
            success: function(data) {}
          });
        }
      }

      function getEmpMessages() {
        //get Notifications of Messages
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_empNotifications",
          data: {},
          beforeSend: function() {
            document.getElementById('dropDownMLoaderDiv').style.display = 'block';
            document.getElementById('Notification_dropdown').style.display = 'none';
          },
          success: function(data) {
            $('#Notification_dropdown').html(data);
            document.getElementById('dropDownMLoaderDiv').style.display = 'none';
            document.getElementById('Notification_dropdown').style.display = 'block';
          }
        });
      }

      function getEmpNotifications() {
        //get Notifications
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotifications",
          data: {},
          beforeSend: function() {
            document.getElementById('dropDownLoaderDiv').style.display = 'block';
            document.getElementById('Other_Notification_dropdown').style.display = 'none';
          },
          success: function(data) {
            $('#Other_Notification_dropdown').html(data);
            document.getElementById('dropDownLoaderDiv').style.display = 'none';
            document.getElementById('Other_Notification_dropdown').style.display = 'block';
          }
        });
        //get total count of other notifications
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsCount",
          data: {},
          success: function(data) {
            if (data == '0') {
              document.getElementById('viewAllBtn').disabled = true;
              document.getElementById('clearAllBtn').disabled = true;
            } else {
              document.getElementById('viewAllBtn').disabled = false;
              document.getElementById('clearAllBtn').disabled = false;
            }
          }
        });
        //get number of unseen notifications
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsUnseen",
          data: {},
          success: function(data) {
            $('#Other_NotificationNumTag').html(data);
            $('#Other_Notification_dropdown_header').html("<?php echo $this->lang->line('common_you_have') ?> " + data + " <?php echo $this->lang->line('common_unseen_notifications') ?>");

            if (data == '0') {
              document.getElementById('Other_NotificationNumTag').style.display = 'none';
            } else {
              document.getElementById('Other_NotificationNumTag').style.display = 'inline-block';
            }
          }
        });
      }

      function getEmpNotificationsUnseen(){
        //get number of unseen notifications of Messages
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_empNotificationsUnseen",
          data: {},
          success: function(data) {
            $('#NotificationNumTag').html(data);
            $('#Notification_dropdown_header').html("<?php echo $this->lang->line('common_you_have') ?> " + data + " <?php echo $this->lang->line('common_unseen_message') ?>");

            if (data == '0') {
              document.getElementById('NotificationNumTag').style.display = 'none';
            } else {
              document.getElementById('NotificationNumTag').style.display = 'inline-block';
            }
          }
        });
      }

      function getOtherEmpNotificationsUnseen(){
        $.ajax({
          type: "POST",
          url: "Srp_notificationsController/get_otherEmpNotificationsUnseen",
          data: {},
          success: function(data) {
            $('#Other_NotificationNumTag').html(data);
            $('#Other_Notification_dropdown_header').html("<?php echo $this->lang->line('common_you_have') ?> " + data + " <?php echo $this->lang->line('common_unseen_notifications') ?>");

            if (data == '0') {
              document.getElementById('Other_NotificationNumTag').style.display = 'none';
            } else {
              document.getElementById('Other_NotificationNumTag').style.display = 'inline-block';
            }
          }
        });
      }
      //Notification chat script and bootstrap modal found in includes/srp_notification_chat
    </script>
    <?php
    $this->load->view('includes/Notification_Chat');
    ?>
