<?php
$primaryLanguage = getPrimaryLanguage();
$this->lang->load('common', $primaryLanguage);
?>
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
    <!--<link rel="stylesheet" href="<?php /*echo base_url('ref/bootstrap/css/bootstrap-responsive.css'); */ ?>"/>-->
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
    <!--    <script src="-->
    <!--/*https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--Boostrap Validator -->
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("ref/validation/css/bootstrapValidator.min.css"); ?>" />

    <!--Boostrap Vertical tabs -->
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("ref/bootstrap-vertical-tabs-1.2.1/bootstrap.vertical-tabs.min.css"); ?>" />

    <!--DataTable-->
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/datatables/resources/media/css/jquery.dataTables.min.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/jquery/datatables.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('ref/datatables/resources/media/Responsive-master/css/responsive.dataTables.min.css'); ?>" />

    <!-- Date range picker -->
    <link rel="stylesheet" href="<?php echo base_url('ref/adminlte/plugins/daterangepicker/daterangepicker-bs3.css'); ?>">

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

        .skin-blue .main-header .navbar .sidebar-toggle:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini" style="background-color:#fff;">
    <div class="wrapper">
        <!-- < ?php $server_status = check_server(); ?> -->
        <header class="main-header">
            <!-- Logo -->
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation" style="background-color:#fff;margin-left:-5px;">
                <!-- Sidebar toggle button-->
                <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color:black;">
                    <span class="sr-only">Toggle navigation</span>
                </a> -->

                <a href="#" class="logo" style="background-color:white !important;height: 64px;width:300px">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="<?php $server_status = check_server(); echo base_url('ref/images/excalibur_logo_black.png'); ?>" style="height:64px;padding: 5px;border-color:white;"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg" style="font-size: 14px;"><img src="<?php echo base_url('ref/images/excalibur_logo_black.png'); ?>" style="height:64px;padding: 5px;border-color:white;"></strong></b></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="getParMessages();" style="color:black;">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-warning" id="NotificationNumTag" style="display:none;">0</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header" id="Notification_dropdown_header"></li>
                                <li>
                                    <ul class="menu" id="Notification_dropdown" style="display: none;">
                                    </ul>
                                    <ul id="dropDownMLoaderDiv">
                                        <div style="position: relative; height: 10px;">
                                            <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 50%;top: 50%;margin-left: -32px;margin-top: -120px;"></i>
                                        </div>
                                    </ul>
                                </li>
                                <li class="footer"><a href="<?php echo site_url('Srp_sa_communicationParentController'); ?>">See All Messages</a></li>
                            </ul>
                        </li>

                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="getParNotifications();" style="color:black;">
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
                                            <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 50%;top: 50%;margin-left: -32px;margin-top: -120px;"></i>
                                        </div>
                                    </ul>
                                </li>
                                <li class="footer"><span class="pull-right"><button class="btn btn-primary btn-xxs" onclick="viewAllNotifications();" id="viewAllBtn" disabled>View all</button><button class="btn btn-success btn-xxs" onclick="clearAllNotification();" id="clearAllBtn" disabled>Clear all</button></span></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <?php $userimg = $_SESSION['UserImage']; ?>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:black;">
                                <!-- <img src="< ?php echo load_image($server_status, $userimg); ?>" class="user-image" alt="PUser Image"> -->
                                <?php 
                                    $server_status = check_server();
                                    $imag_path = '';
                                    if($server_status == "cloud"){
                                        $imag_path = base_url('ref/images/1.png');
                                    }else{
                                        $imag_path = base_url('ref/images/1.png');
                                    }
                                ?>
                                <img src="<?=$imag_path?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $this->userInfo['Ename']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header" style="background-color:rgba(0, 0, 0, 0.1);">
                                    <!-- <img src="< ?php echo load_image($server_status, $userimg); ?>" class="img-circle" alt="User Image"> -->
                                    <img src="<?=$imag_path?>" class="img-circle" alt="User Image">
                                    <p style="color:black;">
                                        <?php echo $this->userInfo['Ename']; ?> - <?php echo $this->userInfo['EmpDes']; ?>
                                        <small><?php echo $this->userInfo['SchName']; ?></small>
                                        <!-- <small><?php echo $userimg ?></small> -->
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('Srp_hi_ParUserProfilecontroller'); ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo site_url('Srp_saHa_loginController/unset_sess'); ?>" class="btn btn-default btn-flat" onclick="get_logDetails();">Sign out</a>
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
        <!--View all notificaion modal-->
        <div class="modal fade" role="dialog" id="parNotifications_Mod">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form role="form" id="clear_notification_fm" action="<?php echo site_url('Srp_notificationsController/post_clear'); ?>" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Notifications</h4>
                        </div>
                        <div class="modal-body">
                            <div><span class="pull-right"><a class="btn btn-success btn-xxs" id="clearSelectedBtn" onclick="ClearNotification();">Clear Selected</a></span></div>
                            <table id="parNotification_ul" border="1" width="100%" style="border: 1px solid #d3cdce; border-collapse: collapse;">

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
                //get number of unseen notifications of messages
                $.ajax({
                    type: "POST",
                    url: "Srp_notificationsController/get_parNotificationsCount",
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
                    url: "Srp_notificationsController/get_otherNotificationsCount",
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
                //get number of unseen notifications of messages
                $.ajax({
                    type: "POST",
                    url: "Srp_notificationsController/get_parNotificationsCount",
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
                    url: "Srp_notificationsController/get_otherNotificationsUnseen",
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
            });

            function update_isSeen_Other(x, pageName) {

                var id = x.id;
                var numberpattern = /\d+/g;
                var NotID = id.match(numberpattern);

                $.ajax({
                    type: "POST",
                    url: 'Srp_sa_parYearPlannerController/update_isSeen_Other',
                    data: {
                        'NotID': NotID
                    },
                    success: function(data) {
                        window.location.href = pageName;
                    }
                });
            }

            function getcommunication(iddes) {
                des = iddes.split('_')[0];
                id = iddes.split('_')[1];

                var StuID = id;

                $.ajax({
                    type: 'POST',
                    url: "Srp_ha_parentIndexController/StudentID",
                    data: {
                        'id': StuID
                    },

                    success: function(data) {
                        $.ajax({
                            type: 'POST',
                            url: "Srp_ha_parentIndexController/get_ComInfo",
                            data: {
                                'id': StuID,
                                'des' : des
                            },

                            success: function(data) {
                                window.location.href = "Srp_sa_communicationParentController?commid="+data;
                            }
                        });
                    }
                });
            }

            function getNewsboard(id) {
                var NewsBoardID = id;
        
                $.ajax({
                    type: "POST",
                    url: "Srp_ha_parentIndexController/get_newsboardDetails2",
                    data: {
                        'NewsBoardID': NewsBoardID
                    },
                    success: function(data) {
                        window.location.href = "Srp_ha_parentIndexController?newsid="+id;
                    }
                });
            }

            function viewAllNotifications() {
                $.ajax({
                    type: "POST",
                    url: "Srp_notificationsController/view_allNotifications",
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
                    url: "Srp_notificationsController/get_otherNotificationsCount",
                    data: {},
                    success: function(data) {
                        count = data;
                        document.getElementById('count').value = data;
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "Srp_notificationsController/view_allNotifications",
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
                    url: "Srp_notificationsController/get_otherNotificationsCount",
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
                    url: "Srp_notificationsController/get_otherNotificationsCount",
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
                $('#clear_notification_fm')
                    .bootstrapValidator({
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

            function getParMessages() {
                //get Notifications of messages
                $.ajax({
                    type: "POST",
                    url: "Srp_notificationsController/get_parNotifications",
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
                //get number of unseen notifications of messages
                $.ajax({
                    type: "POST",
                    url: "Srp_notificationsController/get_parNotificationsCount",
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

            function getParNotifications() {
                //get Notifications
                $.ajax({
                    type: "POST",
                    url: "Srp_notificationsController/get_otherNotifications",
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
                    url: "Srp_notificationsController/get_otherNotificationsUnseen",
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
                    url: "Srp_notificationsController/get_otherNotificationsUnseen",
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

            function get_logDetails() {
                $.ajax({
                    type: "POST",
                    url: "Srp_saHa_loginController/getLogDetails",
                    data: {},
                    success: function(data) {}
                });
            }
        </script>
        <?php
        //Notification chat script and bootstrap modal found in includes/srp_notification_chat
        $this->load->view('includes/Notification_Chat');
        $this->load->view('Srp_ha_parentSubscriptionView');
        ?>
        <?php
        /**
         * Created by PhpStorm.
         * User: Haaniya
         * Date: 11/03/2016
         * Time: 14:53
         */
