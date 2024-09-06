<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// require_once('PHPMailer-master/PHPMailerAutoload.php');
include('configuration_helper_db.php');

/*connection to school DB*/
// if (!function_exists('connect_schoolDB')) {
//     function connect_schoolDB($conType, $schID, $hostname, $username, $password, $db_name, $status)
//     {
//         $CI = &get_instance();
//         if ($conType == '1') {

//             connect_applicationDB('');

//             $query_sch_con = $CI->db->get_where('srp_schoolmaster', array('SchMasterID' => $schID));
//             $res_sch_con = $query_sch_con->row();
//             if (!empty($res_sch_con)) {

//                 $hostname_db = decryptIt($res_sch_con->host);
//                 $username_db = decryptIt($res_sch_con->db_username);
//                 $password_db = decryptIt($res_sch_con->db_password);
//                 $db_name_db = decryptIt($res_sch_con->db_name);

//                 $_SESSION['attFolder'] = attachmentFolderPath('', $schID, '', '');

//                 $db['hostname'] = $hostname_db;
//                 $db['username'] = $username_db;
//                 $db['password'] = $password_db;
//                 $db['database'] = $db_name_db;
//                 $db['dbdriver'] = 'mysqli';
//                 $db['dbprefix'] = '';
//                 $db['pconnect'] = FALSE;
//                 $db['db_debug'] = TRUE;

//                 $CI->load->database($db, FALSE, TRUE);
//             }
//         } else {
//             $hostname_db = $hostname;
//             $username_db = $username;
//             $password_db = $password;
//             $db_name_db = $db_name;

//             $_SESSION['attFolder'] = attachmentFolderPath('', $schID, '', '');

//             $db['hostname'] = $hostname_db;
//             $db['username'] = $username_db;
//             $db['password'] = $password_db;
//             $db['database'] = $db_name_db;
//             $db['dbdriver'] = 'mysqli';
//             $db['dbprefix'] = '';
//             $db['pconnect'] = FALSE;
//             $db['db_debug'] = TRUE;

//             $CI->load->database($db, FALSE, TRUE);
//         }
//     }
// }


/*encrypt*/
if (!function_exists('attachmentFolderPath')) {
    function attachmentFolderPath($Type, $schID, $Path, $status)
    {

        $CI = &get_instance();

        if ($Type == '1') {

            connect_applicationDB('');

            $query_sch_con = $CI->db->get_where('srp_schoolmaster', array('SchMasterID' => $schID));
            $res_sch_con = $query_sch_con->row();

            if (!empty($res_sch_con)) {
                $att_folderName = decryptIt($res_sch_con->attachmentFolderName);
                $att_host = decryptIt($res_sch_con->attachmentHost);
            } else {
                $att_folderName = 'ref/images';
                $att_host = '';
            }
        } else {

            $att_folderName = 'ref/images';
            $att_host = '';
        }

        return base_url($att_folderName) . '/';
    }
}


/*encrypt*/
if (!function_exists('encryptIt')) {
    function encryptIt($q)
    {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), $q, MCRYPT_MODE_CBC, md5(md5($cryptKey))));
        return ($qEncoded);
    }
}

/*decrypt*/
if (!function_exists('decryptIt')) {
    function decryptIt($q)
    {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($cryptKey), base64_decode($q), MCRYPT_MODE_CBC, md5(md5($cryptKey))), "\0");
        return ($qDecoded);
    }
}

/*audit trail - get array of previous values*/
if (!function_exists('auditTrail_get_oldArray')) {
    function auditTrail_get_oldArray($tableName, $where, $newArray)
    {

        $CI = &get_instance();
        $CI->load->model('Srp_auditTrail');
        $old_array = $CI->Srp_auditTrail->get_oldArray($tableName, $where, $newArray);
        return $old_array;
    }
}


/*audit trail - get transaction id*/
if (!function_exists('auditTrail_transaction')) {
    function auditTrail_transaction($session_id, $module)
    {

        $CI = &get_instance();
        $CI->load->model('Srp_auditTrail');
        $trans_seq_no = $CI->Srp_auditTrail->audit_transaction($session_id, $module);
        return $trans_seq_no;
    }
}

/*audit trail - write*/
if (!function_exists('auditTrail_Table')) {
    function auditTrail_Table($session_id, $trans_seq_no, $trans_type, $where, $base_name, $table_name, $fieldarray, $oldarray, $sub_task_id = "")
    {

        $CI = &get_instance();
        $CI->load->model('Srp_auditTrail');
        $CI->Srp_auditTrail->audit_table($session_id, $trans_seq_no, $trans_type, $where, $base_name, $table_name, $fieldarray, $oldarray, $sub_task_id);
    }
}

//Image  Viewer
if (!function_exists('image_viewer')) {
    function image_viewer($status)
    {
        if ($status == "Horizontally Elongated") {
            $height = '180px';
        } else if ($status == "Vertically Elongated") {
            $height = '280px';
        } else if ($status == "Square") {
            $height = '260px';
        }

        echo '
        <div class="modal fade bs-example-modal-sm" id="ImageViewer" role="dialog"
             aria-labelledby="mySmallModalLabel"">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" id="image_veiwer_mod_content" style=" background-repeat: no-repeat; border-radius: 6px; background-size: contain; background-size: contain;width:20em;background-position: center; height: ' . $height . '; text-align: right;">
                    <i class="fa fa-times-circle" aria-hidden="true" style="margin-top: -10px; margin-right: -5px; font-size: 24px;  cursor: pointer;" onclick="Image_Viewer_close()"></i>
                </div>
            </div>
        </div>';

        return '<script>
            function Image_Viewer(x){
                 var img_src = x.src;
                 $("#ImageViewer").modal("show");
                 $("#image_veiwer_mod_content").css("background-image", "url(" + img_src + ")");
            } 
            
            function Image_Viewer_Thumbnail(x){
                 $("#ImageViewer").modal("show");
                 $("#image_veiwer_mod_content").css("background-image", "url(" + x + ")");
            }

            function Image_Viewer_close(){
                $("#ImageViewer").modal("hide");

            }
        </script>';
    }
}

/*header*/
if (!function_exists('head_page')) {
    function head_page($heading, $heading_small, $breadcrumb, $sub_heading, $status, $pageButtons)
    {
        $filter = '';
        if ($status) {
            $filter = '<a data-toggle="collapse" data-target="#filter-panel"><i class="fa fa-filter"></i></a>';
        }

        if (isset($_SESSION['ActiveAY'])) {
            $CI = &get_instance();
            $query_AY = $CI->db->get_where("srp_academicyearmaster", array("AY_AutoID" => $_SESSION['ActiveAY']));
            $res_AY = $query_AY->row();

            if (!empty($res_AY)) {
                $AY_Des = $res_AY->AY_Description;
            } else {
                $AY_Des = '';
            }
        } else {
            $AY_Des = '';
        }

        return '<div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        ' . $heading . '
                        <small>' . $heading_small . '</small>
                    </h1>
                    <ol class="breadcrumb">
                        <span class="label label-default" style="font-size:13px; letter-spacing:2px; font-weight:bolder;">' . $AY_Des . '</span>
                    </ol>
                </section>
                <section class="content">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">' . $sub_heading . '</h3>
                          <div class="box-tools pull-right">' . $pageButtons
            . '</div>
                        </div>
                        <div class="box-body">';
    }
}


/*footer*/
if (!function_exists('footer_page')) {
    function footer_page($right_foot, $left_foot, $status)
    {
        if ($status) {
            return '</div><div class="box-footer">' . $right_foot . '</div></div></section></div>';
        } else {
            return '</div></div></section></div>';
        }
    }
}

//Section Header
if (!function_exists('Section_Header')) {
    function Section_Header($title, $Buttons, $responsiveClass, $header, $type = 'primary')
    {

        echo '<div class="' . $responsiveClass . '" style="padding:5px;">
                    <div class="box box-' . $type . '" style="margin-bottom: 5px;">';
        if ($header == '1') {
            echo '<div class="box-header with-border"><h3 class="box-title">' . $title . '</h3><div class="box-tools pull-right">' . $Buttons . '</div></div>';
        }
        echo '<div class="box-body">';
    }
}

//Section Footer
if (!function_exists('Section_Footer')) {
    function Section_Footer()
    {
        echo '</div></div></div>';
    }
}


/*datatable*/
if (!function_exists('datatable_initialization')) {
    function datatable_initialization($datatableid, $loaderDiv, $datatableDiv)
    {
        return '$(document).ready(function() {
                        $("#' . $datatableid . '").DataTable({
                            responsive: true,
                            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                            "iDisplayLength": 50,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: 1 },
                                { responsivePriority: 3, targets: -1 }
                            ],
                            "initComplete": function(settings, json) {
                                    document.getElementById("' . $loaderDiv . '").style.display = "none";
                                    document.getElementById("' . $datatableDiv . '").style.display ="block";
                            },
                            "bRetrieve": true
                        })
                      });';
    }
}

if (!function_exists('datatableAll_initialization')) {
    function datatableAll_initialization($datatableid, $loaderDiv, $datatableDiv)
    {
        return '$(document).ready(function() {
                        $("#' . $datatableid . '").DataTable({
                            responsive: true,
                            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                            "iDisplayLength": -1,
                            columnDefs: [
                                { responsivePriority: 1, targets: 0 },
                                { responsivePriority: 2, targets: 1 },
                                { responsivePriority: 3, targets: -1 }
                            ],
                            "initComplete": function(settings, json) {
                                    document.getElementById("' . $loaderDiv . '").style.display = "none";
                                    document.getElementById("' . $datatableDiv . '").style.display ="block";
                            },
                            "bRetrieve": true
                        })
                      });';
    }
}

/*datatable- select row after editing*/
if (!function_exists('SelectRow_Function')) {
    function SelectRow_Function()
    {
        return 'function SelectRow(RowID){
                /*var tr_DT = document.getElementById(RowID);*/
                jQuery.fn.dataTableExt.oApi.fnDisplayRow = function ( oSettings, nRow )
                {
                    // Account for the "display" all case - row is already displayed
                    if ( oSettings._iDisplayLength == -1 )
                    {
                        return;
                    }

                    // Find the node in the table
                    var iPos = -1;
                    for( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                    {
                        if( oSettings.aoData[ oSettings.aiDisplay[i] ].nTr == nRow )
                        {
                            iPos = i;
                            break;
                        }
                    }

                    // Alter the start point of the paging display
                    if( iPos >= 0 )
                    {
                        oSettings._iDisplayStart = ( Math.floor(i / oSettings._iDisplayLength) ) * oSettings._iDisplayLength;
                        if ( this.oApi._fnCalculateEnd ) {
                            this.oApi._fnCalculateEnd( oSettings );
                        }
                    }

                    this.oApi._fnDraw( oSettings );
                };

                var table = $(".DT").DataTable();
                var row_index = table.row( "#"+RowID ).index();

                var table_d = $(".DT").dataTable();
                table_d.fnDisplayRow( table_d.fnGetNodes()[row_index] );

                var selected_Row = [];
                var id = RowID;
                var index = $.inArray(id, selected_Row);

                if ( index === -1 ) {
                    selected_Row.push( id );
                } else {
                    selected_Row.splice( index, 1 );
                }

                $("tr#"+RowID).toggleClass("selected");
                }';
    }
}

/*datatable- select row after editing*/
if (!function_exists('Deselect_Rows')) {
    function Deselect_Rows()
    {
        return "$('.DT tbody tr').removeClass('selected');";
    }
}


if (!function_exists('initializations')) {
    function initializations()
    {

        if (isset($_SESSION['Policy'])) {
            $dateFormat = $_SESSION['Policy'][1];
        } else {
            $dateFormat = 'dd/mm/yyyy';
        }
        return '
                <script type="text/javascript" charset="utf-8">
                    $(document).ready(function() {
                         /*tooltip initiation*/
                            $(".tool").tooltip();

                        /*select2 initiation*/
                           $(".select2").select2();

                        /*date picker*/
                            $(".datepicker").datepicker({
                                autoclose: true,
                                format: "' . $dateFormat . '"
                            });
                        /*Date Mask*/
                        $(".datepicker").inputmask("' . $dateFormat . '", {"placeholder": "' . $dateFormat . '"});
                     }) </script>
                ';
    }
}


if (!function_exists('School_Weekdays')) {
    function School_Weekdays()
    {

        $CI = &get_instance();
        $weekDays = array();
        if ($_SESSION['Policy']['13'] > $_SESSION['Policy']['14']) {
            for ($i = $_SESSION['Policy']['13']; $i <= 7; $i++) {

                $query_getWeekDays = $CI->db->query("SELECT DayDesc,ShortCode FROM srp_weekdays WHERE DayID = '" . $i . "'");
                $res_getWeekDays = $query_getWeekDays->row();

                $data = array(

                    "DayID" => $i,
                    "DayDescription" => $res_getWeekDays->DayDesc,
                    "DayShortCode" => $res_getWeekDays->ShortCode

                );

                $weekDays[$i] = $data;
            }

            for ($i = 1; $i <= $_SESSION['Policy']['14']; $i++) {

                $query_getWeekDays = $CI->db->query("SELECT DayDesc,ShortCode FROM srp_weekdays WHERE DayID = '" . $i . "'");
                $res_getWeekDays = $query_getWeekDays->row();

                $data = array(

                    "DayID" => $i,
                    "DayDescription" => $res_getWeekDays->DayDesc,
                    "DayShortCode" => $res_getWeekDays->ShortCode

                );

                $weekDays[$i] = $data;
            }
        } else {
            for ($i = $_SESSION['Policy']['13']; $i <= $_SESSION['Policy']['14']; $i++) {

                $query_getWeekDays = $CI->db->query("SELECT DayDesc,ShortCode FROM srp_weekdays WHERE DayID = '" . $i . "'");
                $res_getWeekDays = $query_getWeekDays->row();

                $data = array(

                    "DayID" => $i,
                    "DayDescription" => $res_getWeekDays->DayDesc,
                    "DayShortCode" => $res_getWeekDays->ShortCode

                );

                $weekDays[$i] = $data;
            }
        }

        return $weekDays;
    }
}

if (!function_exists('DateField')) {
    function DateField($Label, $id, $name, $value, $OnchangeFunc, $ResponsiveClass)
    {

        if (isset($_SESSION['Policy'])) {
            $dateFormat = $_SESSION['Policy'][1];
        } else {
            $dateFormat = 'dd/mm/yyyy';
        }

        if ($Label == "" || $Label == null) {
            $Label_tag = "";
        } else {
            $Label_tag = '<label for="' . $id . '" style="margin-bottom:0px;" class="control-label">' . $Label . '</label>';
        }

        return '
                <div class="form-group ' . $ResponsiveClass . '" >
                        ' . $Label_tag . '
                        <div class="input-group date" id="'.$id.'-'.$name.'">
                            <div class="input-group-addon" style="height:24px;">
                                <i class="fa fa-calendar" style="height:12px; "></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker UA_text_field_disable" id="' . $id . '" name="' . $name . '" value="' . $value . '" onchange="' . $OnchangeFunc . ';"  data-inputmask="\'alias\': \'' . $dateFormat . '\'" data-mask>
                        </div>
                    </div>
                ';
    }
}

if (!function_exists('CustomDateField')) {
    function CustomDateField($Label, $id, $name, $value, $OnchangeFunc, $ResponsiveClass, $state)
    {

        if (isset($_SESSION['Policy'])) {
            $dateFormat = $_SESSION['Policy'][1];
        } else {
            $dateFormat = 'dd/mm/yyyy';
        }

        if ($Label == "" || $Label == null) {
            $Label_tag = "";
        } else {
            $Label_tag = '<label for="' . $id . '" style="margin-bottom:0px;" class="control-label">' . $Label . '</label>';
        }

        return '
                <div class="form-group ' . $ResponsiveClass . '" >
                        ' . $Label_tag . '
                        <div class="input-group date" id="'.$id.'-'.$name.'">
                            <div class="input-group-addon" style="height:24px;">
                                <i class="fa fa-calendar" style="height:12px; "></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker UA_text_field_disable" id="' . $id . '" name="' . $name . '" value="' . $value . '"  '.$state.'  onchange="get_duration(this);checkTimeCrash(this, 1);" onkeyup="get_duration(this);checkTimeCrash(this, 2);"  data-inputmask="\'alias\': \'' . $dateFormat . '\'" data-mask>
                        </div>
                    </div>
                ';
    }
}

if (!function_exists('DateFieldWithNotification')) {
    function DateFieldWithNotification($Label, $id, $name, $value, $OnchangeFunc, $ResponsiveClass, $NotiMessage)
    {

        if (isset($_SESSION['Policy'])) {
            $dateFormat = $_SESSION['Policy'][1];
        } else {
            $dateFormat = 'dd/mm/yyyy';
        }

        if ($Label == "" || $Label == null) {
            $Label_tag = "";
        } else {
            $Label_tag = '<label id="'.$id.'-label" for="' . $id . '" style="margin-bottom:0px;" class="control-label">' . $Label . '</label>';
        }

        return '
                <div class="form-group ' . $ResponsiveClass . '" >
                        ' . $Label_tag . '
                        <div class="input-group date" id="'.$id.'-'.$name.'">
                            <div class="input-group-addon" style="height:24px;">
                                <i class="fa fa-calendar" style="height:12px; "></i>
                            </div>
                            <input type="text" class="form-control pull-right datepicker UA_text_field_disable" id="' . $id . '" name="' . $name . '" value="' . $value . '" onchange="' . $OnchangeFunc . ';"  data-inputmask="\'alias\': \'' . $dateFormat . '\'" data-mask>
                        </div>
                        <small id="'.$id.'n" style="display: none; color: red;" class="help-block">'.$NotiMessage.'</small>
                    </div>
                ';
    }
}

if (!function_exists('MySQL_DateFormat')) {
    function MySQL_DateFormat($date)
    {

        if ($date == "" || $date == null || $date == '0000-00-00' || $date == '00-00-0000') {
            $DF = null;
        } else {

            if (isset($_SESSION['Policy'])) {
                $dateFormat = $_SESSION['Policy'][1];
            } else {
                $dateFormat = 'dd/mm/yyyy';
            }

            $DateFormat = explode('-', $dateFormat);
            $First = $DateFormat[0];
            $Second = $DateFormat[1];
            $Third = $DateFormat[2];

            $Date = explode('-', $date);
            $FirstChar = $Date[0];
            $SecondChar = $Date[1];
            $ThirdChar = $Date[2];

            if ($First == 'dd') {
                if ($Second == 'mm') {
                    $DF = $ThirdChar . "-" . $SecondChar . "-" . $FirstChar;
                } else if ($Third == 'mm') {
                    $DF = $SecondChar . "-" . $ThirdChar . "-" . $FirstChar;
                } else {
                    $DF = '0000-00-00';
                }
            } else if ($Second == 'dd') {
                if ($First == 'mm') {
                    $DF = $ThirdChar . "-" . $FirstChar . "-" . $SecondChar;
                } else if ($Third == 'mm') {
                    $DF = $FirstChar . "-" . $ThirdChar . "-" . $SecondChar;
                } else {
                    $DF = '0000-00-00';
                }
            } else if ($Third == 'dd') {
                if ($First == 'mm') {
                    $DF = $SecondChar . "-" . $FirstChar . "-" . $ThirdChar;
                } else if ($Second == 'mm') {
                    $DF = $FirstChar . "-" . $SecondChar . "-" . $ThirdChar;
                } else {
                    $DF = '0000-00-00';
                }
            } else {
                $DF = '0000-00-00';
            }
        }

        return $DF;
    }
}

/*menu link activation*/
if (!function_exists('menu_setup')) {
    function menu_setup($main_menu, $sub_menu, $sub2_menu)
    {
        return '
                <script type="text/javascript" charset="utf-8">

                        //(function($) {
                            //$.fn.goTo = function() {
                                //$(".sidebar").animate({
                                    //scrollTop: (($(this).offset().top)-100) + "px"
                                //}, "fast");
                                //return this;
                            //}
                        //})(jQuery);

                        /* Activate menu link on page load*/
                        var d = document.getElementById("' . $main_menu . '");
                        d.className = d.className + " active";


                        //$("#' . $main_menu . '").goTo();

                        var d1 = document.getElementById("' . $sub_menu . '");
                        d1.className = d1.className + " active";

                        var d2 = document.getElementById("' . $sub2_menu . '");
                        d2.className = d2.className + " active";
                </script>
                ';
    }
}

/*global notification*/
if (!function_exists('notify')) {
    function notify($type, $title, $message, $icon)
    {

        if ($type == "danger") {
            $delay = 'delay: 0,';
        } else {
            $delay =  '';
        }

        return "
               $.notify({
                    title: '" . $title . "',
                    message: '" . $message . "',
                    icon: '" . $icon . "',
                    },{
                     type: '" . $type . "',
                     " . $delay . "
                     placement: {
                     from: 'bottom',
                     align: 'center'
                    },
               });
                ";
    }
}

/*element notification*/
if (!function_exists('notify_element')) {
    function notify_element($type, $element, $message, $position, $title, $icon, $status)
    {

        if ($type == "error") {
            $autoHide = 'false';
        } else {
            $autoHide =  'true';
        }

        return "
               $('" . $element . "').notify(
                  '" . $message . "',
                  {
                  position:'" . $position . "',
                  autoHide : " . $autoHide . ",
                  className : '" . $type . "',
                  clickToHide: true,
                   }
                );
                ";
    }
}

if (!function_exists('autoHide_notify_element')) {
    function autoHide_notify_element($type, $element, $message, $position, $title, $icon, $status)
    {

        if ($type == "error") {
            $autoHide = 'true';
        } else {
            $autoHide =  'true';
        }

        return "
               $('" . $element . "').notify(
                  '" . $message . "',
                  {
                  position:'" . $position . "',
                  autoHide : " . $autoHide . ",
                  className : '" . $type . "',
                  clickToHide: true,
                   }
                );
                ";
    }
}

//back to admin dashboard - button
if (!function_exists('Button_BackToAdminDashboard')) {
    function Button_BackToAdminDashboard()
    {

        if (isset($_GET['key'])) {
            if ($_GET['key'] == 'ADB') {
                return ' <a href="' . site_url('Srp_ha_empDashboardController?key=ADB') . '" class="btn btn-danger btn-xs"><i class="fa fa-arrow-circle-left"></i></a>';
            }
        }
    }
}

//convert date to school policy date
if (!function_exists('DateFormat')) {
    function DateFormat($date)
    {
        if ($date == "" || $date == null || $date == '0000-00-00') {
            $newDate = "";
        } else {
            if ($_SESSION['Policy'][1] == 'dd-mm-yyyy') {
                $newDate = date("d-m-Y", strtotime($date));
            } else if ($_SESSION['Policy'][1] == 'mm-dd-yyyy') {
                $newDate = date("m-d-Y", strtotime($date));
            } else if ($_SESSION['Policy'][1] == 'yyyy-mm-dd') {
                $newDate = date("Y-m-d", strtotime($date));
            }
        }

        return $newDate;
    }
}

//convert get second language order
if (!function_exists('SecLangAlignment')) {
    function SecLangAlignment()
    {
        if (($_SESSION['Policy']['SecondLangOrder'] == 'RL')) {
            $policyVal = 'right';
        } else if (($_SESSION['Policy']['SecondLangOrder'] == 'LR')) {
            $policyVal = 'left';
        } else {
            $policyVal = '';
        }

        return $policyVal;
    }
}

//convert get first language order
if (!function_exists('FirstLangAlignment')) {
    function FirstLangAlignment()
    {
        if (($_SESSION['Policy']['FirstLangOrder'] == 'RL')) {
            $policyVal = 'right';
        } else if (($_SESSION['Policy']['FirstLangOrder'] == 'LR')) {
            $policyVal = 'left';
        } else {
            $policyVal = '';
        }

        return $policyVal;
    }
}

//Name Cards
if (!function_exists('NameCards')) {
    function NameCards($ID, $Image, $Name, $Function, $flag)
    {

        $server_status = check_server();
        if ($server_status == 'cloud') {
            $flagImage = $Image;
        } else {
            if ($Image == "" || $Image == null) {
                if ($flag == 'stu') {
                    $flagImage = "UnknownStudent.png";
                } else {
                    $flagImage = "1.png";
                }
            } else {
                $external_link = 'ref/images/' . $Image;
                if ((file_exists($external_link)) && (getimagesize($external_link))) {
                    $flagImage = $Image;
                } else {
                    if ($flag == 'stu') {
                        $flagImage = "UnknownStudent.png";
                    } else {
                        $flagImage = "1.png";
                    }
                }
            }
        }

        echo '<div class="col-md-12 nameCards" id="stuCards' . $ID . '" style="cursor: pointer;padding: 2px; border: 1px solid #bfbfbf; background-color: #e6e6e6; margin-bottom: 5px;" onclick="' . $Function . '">
                            <table width="100%">
                                <tr>';
        if ($Image == "-1") {
        } else {
            echo '<td style="width: 20%; padding : 2px; background-color: #bfbfbf;"><img
                                            src="' .
                load_image($server_status, $flagImage) . '" width="100%"
                                            height="30px"></td>';
        }
        echo '<td style="width: 80%;text-align: ; padding-left: 5px; font-size: 11px;" id="nameCardtd' . $ID . '">
                                        <b>' . $Name . '</b></td>
                                </tr>
                            </table>
                        </div>';
    }
}

//Name Cards Search Field
if (!function_exists('NameCardSearchField')) {
    function NameCardSearchField()
    {
        $CI = &get_instance();
        $CI->load->library('company_language');
        $idiom = $CI->company_language->getPrimaryLanguage();
        $CI->lang->load('common', $idiom);
        //search search_nameCards() function is in Additional_jScript file (ref folder)
        echo '<input type="text" class="form-control input-sm" name="search_field" placeholder="' . $CI->lang->line('common_search') . '..." onkeyup="search_nameCards(this);" style="margin-bottom: 4px;">';
    }
}

//Table Search Field
if (!function_exists('TableSearchField')) {
    function TableSearchField($TableID, $SearchColumnIndex, $Placeholder)
    {
        return '<div class="input-group"><span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span><input type="text" class="form-control" name="search_field" placeholder="' . $Placeholder . '" onkeyup="search_namesInTable_' . $TableID . '(this);" style="height:32px !important;"></div>

        <script>
        function search_namesInTable_' . $TableID . '(x)
            {

              var input, filter, table, tr, td, i;
              input = x;
              filter = input.value.toUpperCase();
              table = document.getElementById("' . $TableID . '");
              tr = table.getElementsByTagName("tr");

              for (i = 0; i < tr.length; i++) {
                  td = tr[i].getElementsByTagName("td")[' . $SearchColumnIndex . '];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                  } else {
                        tr[i].style.display = "none";
                  }
                }
              }

            }
        </script>
';
    }
}

//Loader Gif
if (!function_exists('Loader_Image')) {
    function Loader_Image()
    {
        return '<img src="' . base_url('ref/images/facebook.gif') . '" style="width:28px; height:24px; display:none; " id="LoaderImage">';
    }
}

//Display Loader Image
if (!function_exists('Display_Loader_Image')) {
    function Display_Loader_Image()
    {
        echo 'document.getElementById("LoaderImage").style.display = "inline-block"';
    }
}

//Hide Loader Image
if (!function_exists('Hide_Loader_Image')) {
    function Hide_Loader_Image()
    {
        echo 'document.getElementById("LoaderImage").style.display = "none"';
    }
}

//Email Configuration
if (!function_exists('Send_Email')) {
    function Send_Email($ReciptientMail, $ReciptientName, $Subject, $HTML_Body, $NonHTML_Body)
    {
        
        $mail = new PHPMailer;
        // $mail->SMTPDebug = 3;                                                               // Enable verbose debug output
        $mail->isSMTP();                                                                    // Set mailer to use SMTP
        $mail->Host = 'email-smtp.ap-southeast-1.amazonaws.com';                            // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                                                             // Enable SMTP authentication
        $mail->Username = 'AKIASOGLNEQ3ASLPBP7V';                                           // SMTP username
        $mail->Password = 'BAYCSH01r2WsXBPuq7yzDIIJNcCVrFNzlqwHrTOBzfyv';                   // SMTP password
        $mail->SMTPSecure = 'tls';                                                          // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                                                  // TCP port to connect to

        $mail->setFrom('no-reply-uat@techbsl.com', 'Info Excalibur');
        $mail->addAddress($ReciptientMail, $ReciptientName);     // Add a recipient techcess
        //$mail->addAddress('reyaasr@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $Subject;
        $mail->Body    = $HTML_Body;
        $mail->AltBody = $NonHTML_Body;

        if (!$mail->send()) {
            return 'Message could not be sent';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message sent';
        }
    }
}


//Send Check_Mail
if (!function_exists('Send_CheckMail')) {
    function Send_CheckMail()
    {

        $CI = &get_instance();
        $CI->load->model('Srp_checkMail');
        $CI->Srp_checkMail->send_checkMail();
    }
}

//image uploading View - Employee Portal
// student details
if (!function_exists('UploadImageView')) {
    function UploadImageView($gridWidth, $gridHeight, $defaultimage, $UploadTypeMasterID)   
    {
        
        $server_status = check_server();
        echo "
        <script>
        document.getElementById('x').value('');
        document.getElementById('y').value('');
        document.getElementById('w').value('');
        document.getElementById('h').value('');
        </script>";

        if ($server_status == 'cloud') {
            $CI = &get_instance();
            $CI->load->library('s3');
            $image_path = $CI->s3->getMyAuthenticatedURL($defaultimage, 3600);
            $defaultimage = $image_path;
        } else {
            //$defaultimage='UnknownStudent.png';
            $image_path = base_url('ref/images/' . $defaultimage);
            $defaultimage = $image_path;
        }

        echo '<fieldset id="Upload_Fieldset">
            <table width="' . $gridWidth . '" border="1" style="border: 1px solid #CCC;">
                <tr>
                   <td>
                      <div style="background-color:#E0E0E0;" align="center" id="image_preview_div">
                         <div id="preview-pane">
                            <div class="preview-container">
                               <img src="' . $image_path . '" class="jcrop-preview" id="image" alt="Preview" width="' . $gridWidth . '" height="' . $gridHeight . '"/>
                             </div>
                         </div>
                      </div>
                      <div style="background-color:#E0E0E0; position: relative; height: ' . $gridHeight . '; display:none ; width:' . $gridWidth . ';" align="center" id="image_preview_div_loader">
                      <img src="' . base_url('ref/images/facebook.gif') . '" style="height:20px; width:26px; position: absolute; left: 40%;top: 35%;margin-left: -2px;margin-top: -2px;">
                      </div>
                   </td>
                </tr>
                <tr>
                   <td style="padding: 2px;">
                      <a class="btn btn-default btn-xs btn-block UA_Alter_btn" id="uploadBtn" name="uploadBtn" onclick="chooseimage(this)"><i class="fa fa-upload"></i>  Upload</a>
                         <input class="form-control" id="upload" name="upload" type="file" style=" display:none;" onchange="readURL(this);"/>
                         <div class="form-group" style="width: 100%; margin-bottom: 0px; display: none ;">
                             <input class="form-control" id="flag" name="flag" type="text" style="none" value="' . $defaultimage . '"/>
                          </div>
                   </td>
                </tr>
            </table>

            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="prvimage" name="prvimage" />
            <input type="hidden" id="UploadTypeMasterID" name="UploadTypeMasterID" value="' . $UploadTypeMasterID . '"/>

        </fieldset>
        ';

        echo '
       <style type="text/css">

            /* Apply these styles only when #preview-pane has
               been placed within the Jcrop widget */
            .jcrop-holder #preview-pane {
                display: block;
                position: absolute;
                z-index: 2000;
                top: 10px;
                right: -280px;
                padding: 6px;
                border: 1px rgba(0,0,0,.4) solid;
                background-color: white;

                -webkit-border-radius: 6px;
                -moz-border-radius: 6px;
                border-radius: 6px;

                -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
            }

            /* The Javascript code will set the aspect ratio of the crop
               area based on the size of the thumbnail preview,
               specified here */
            #preview-pane .preview-container {
                width: ' . $gridWidth . ';
                height: ' . $gridHeight . ';
                overflow: hidden;
            }

        </style>

        ';

        echo "
        <script>
            function chooseimage(x){
                    $('#x').val('');
                    $('#y').val('');
                    $('#w').val('');
                    $('#h').val('');
                    document.getElementById('upload').click();
                }
                var mainImage  = ' . $defaultimage . ';
                function readURL(input) {
                    console.log(input);
                    var onloadimage=document.getElementById('image').src;
                    
                    $('#prvimage').val(onloadimage);
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {

                            if ($('#jcrop_target').data('Jcrop')) {
                                $('#jcrop_target').data('Jcrop').destroy();
                            }
                            $('#jcrop_target')
                                .attr('src', e.target.result);
                                mainImage = $('#image').attr('src');;
                                $('#image')
                                    .attr('src', e.target.result);
                            $('#Crop_Mod').modal('show');
                            jQuery(function($){

                                // Create variables (in this scope) to hold the API and image size
                                var jcrop_api,
                                    boundx,
                                    boundy,

                                // Grab some information about the preview pane
                                    \$preview = $('#preview-pane'),
                                    \$pcnt = $('#preview-pane .preview-container'),
                                    \$pimg = $('#preview-pane .preview-container img'),
                                    xsize = \$pcnt.width(),
                                    ysize = \$pcnt.height();

                                console.log('init',[xsize,ysize]);
                                $('#jcrop_target').Jcrop({
                                    onChange: updatePreview,
                                    onSelect: updatePreview,
                                    aspectRatio: xsize / ysize,
                                    bgColor: '',
                                    bgFade:     true,
                                    //setSelect : [20,20,580,380],
                                    bgOpacity: .6,
                                    boxWidth: 570,   //Maximum width you want for your bigger images
                                    boxHeight: 350  //Maximum Height for your bigger images
                                },function(){
                                    // Use the API to get the real image size
                                    var bounds = this.getBounds();
                                    boundx = bounds[0];
                                    boundy = bounds[1];
                                    // Store the API in the jcrop_api variable
                                    jcrop_api = this;

                                    // Move the preview into the jcrop container for css positioning
                                    //\$preview.appendTo(jcrop_api.ui.holder);
                                });


                                function updatePreview(c)
                                {
                                    if (parseInt(c.w) > 0)
                                    {
                                        var rx = xsize / c.w;
                                        var ry = ysize / c.h;

                                        \$pimg.css({
                                            width: Math.round(rx * boundx) + 'px',
                                            height: Math.round(ry * boundy) + 'px',
                                            marginLeft: '-' + Math.round(rx * c.x) + 'px',
                                            marginTop: '-' + Math.round(ry * c.y) + 'px'
                                        });
                                    }

                                    $('#x').val(c.x);
                                    $('#y').val(c.y);
                                    $('#w').val(c.w);
                                    $('#h').val(c.h);

                                };

                                document.getElementById('image_preview_div_loader').style.display = 'block';
                                document.getElementById('image_preview_div').style.display = 'none';

                            });


                            function checkCoords()
                            {
                                if (parseInt($('#w').val())) return true;
                                alert('Please select a crop region then press submit.');
                                return false;
                            };
                        };

                reader.readAsDataURL(input.files[0]);
                    }


            var filename2 = input.value;
            var filename = filename2.replace(/^.*[\\\/]/, '');

                    if(filename=='' || filename==null){
                        document.getElementById('flag').value='" . $defaultimage . "';
                    }else{
                        document.getElementById('flag').value = filename;
                    }
                }

                $(document).ready(function(){
                    //close modal
                    $('#Crop_Mod')
                    .on('hidden.bs.modal', function() {
                        $('#jcrop_target').attr('src', '');
                        check_uploadQuota();
                    });

                });

                function closeBtnc (){
                    closeBtn(mainImage);
                }

                //append modal to the page
                $('body').append('<div class=\'modal fade\' id=Crop_Mod role=\'dialog\' aria-labelledby=\'mySmallModalLabel\'><div class=\'modal-dialog\'><div class=\'modal-content\'><div class=\'modal-header\'><button type=\'button\' class=\'close\' data-dismiss=\'modal\' aria-label=\'Close\' id=\'closeBtnc\' name=\'closeBtnc\' onclick=\'closeBtnc()\'><span aria-hidden=\'true\'>&times;</span></button><h4 class=\'modal-title\'>Crop</h4></div><div class=\'modal-header\'><h4 class=\'modal-title\' style=\'text-align: center;\'><i>Please crop the image and submit</i></h4></div><div class=\'modal-body\' style=\'text-align: center;\'><div style=\'display:flex; align-items:center; justify-content:center;\'><img src=\'\' id=\'jcrop_target\' alt=\'[Jcrop Example]\' style=\'text-align: center;\'/></div></div><div class=\'modal-footer\'><button type=\'button\' class=\'btn btn-default\' data-dismiss=\'modal\'>Upload</button></div></div></div></div>');


                function check_uploadQuota()
                {
                    
                    if(($('#x').val()=='' && $('#y').val() == '' && $('#w').val() == '' && $('#h').val() == '') || ($('#x').val()=='0' && $('#y').val() == '0' && $('#w').val() == '0' && $('#h').val() == '0'))
                    {
                        $.notify({title: '<strong>Uploading Failed!Please Crop Image</strong>', message: ''}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                        document.getElementById('image_preview_div_loader').style.display = 'none';
                        document.getElementById('image_preview_div').style.display = 'block';
                        if($('#prvimage').val()!='')
                        {
                            document.getElementById('flag').value = $('#prvimage').val();
                            document.getElementById('image').src = $('#prvimage').val();
                        }
                        else
                        {
                            document.getElementById('flag').value = '" . $defaultimage . "';
                            document.getElementById('image').src = '" . $defaultimage . "';
                        }
                    }   
                    else
                    {

                    var dataimg = new FormData();
                    dataimg.append('x', $('#x').val());
                    dataimg.append('y', $('#y').val());
                    dataimg.append('w', $('#w').val());
                    dataimg.append('h', $('#h').val());
                    dataimg.append('upload', $('#upload')[0].files[0]);
                    dataimg.append('UploadTypeMasterID', $UploadTypeMasterID);

                    $.ajax({
                        url:'Srp_UploadController/check_uploadQuota',
                        data: dataimg,
                        contentType: false,
                        processData: false,
                        cache: false,
                        type: 'POST',
                        beforeSend: function (){
                        },
                        success: function(data)
                        {
							
							if(data == 'Success' || data == 'Not considered'){

							} else {

								if(data == 'File size exceeding the limit') {
									$.notify({title: '<strong>Uploading Failed!</strong>', message: 'The attachment size exceeds the allowable limit! Please upload an attachment within the limit.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
									var base_url = '" . base_url('ref/images/') . "';
									document.getElementById('upload').value = '';
									document.getElementById('flag').value = '" . $defaultimage . "';
                                    document.getElementById('image').src = '" . $defaultimage . "';
								} else if(data == 'Used space exceeds limit') {
									$.notify({title: '<strong>Uploading Failed!</strong>', message: 'No free space available for uploading.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
									document.getElementById('upload').value = '';
									document.getElementById('flag').value = '" . $defaultimage . "';
                                    document.getElementById('image').src = '" . $defaultimage . "';
								} else {
									$.notify({title: '<strong>Uploading Failed!</strong>', message: 'The attachment size exceeds the allowable limit! Please upload an attachment within the limit.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
									var base_url = '" . base_url('ref/images/') . "';
									document.getElementById('upload').value = '';
                                    document.getElementById('flag').value = '" . $defaultimage . "';
                                    document.getElementById('image').src = '" . $defaultimage . "';
								}
								
							}
                                document.getElementById('image_preview_div_loader').style.display = 'none';
                                document.getElementById('image_preview_div').style.display = 'block';
                        }
                    });

                }

            }

        </script>
        ";
    }
}

//image uploading View - Other Portals
if (!function_exists('UploadImageView_OtherPortals')) {
    function UploadImageView_OtherPortals($gridWidth, $gridHeight, $defaultimage, $UploadTypeMasterID, $SchMasterID, $BranchID)
    {
        echo '<fieldset id="Upload_Fieldset">
            <table width="' . $gridWidth . '" border="1" style="border: 1px solid #CCC;">
                <tr>
                   <td>
                      <div style="background-color:#E0E0E0;" align="center" id="image_preview_div">
                         <div id="preview-pane">
                            <div class="preview-container">
                               <img src="' . base_url('ref/images/' . $defaultimage) . '" class="jcrop-preview" id="image" alt="Preview" width="' . $gridWidth . '" height="' . $gridHeight . '"/>
                             </div>
                         </div>
                      </div>
                      <div style="background-color:#E0E0E0; position: relative; height: ' . $gridHeight . '; display:none ; width:' . $gridWidth . ';" align="center" id="image_preview_div_loader">
                      <img src="' . base_url('ref/images/facebook.gif') . '" style="height:20px; width:26px; position: absolute; left: 40%;top: 35%;margin-left: -2px;margin-top: -2px;">
                      </div>
                   </td>
                </tr>
                <tr>
                   <td style="padding: 2px;">
                      <a class="btn btn-default btn-xs btn-block" id="uploadBtn" name="uploadBtn" onclick="chooseimage(this)"><i class="fa fa-upload"></i>Upload</a>
                         <input class="form-control" id="upload" name="upload" type="file" style=" display:none;" onchange="readURL(this);"/>
                         <div class="form-group" style="width: 100%; margin-bottom: 0px; display: none ;">
                             <input class="form-control" id="flag" name="flag" type="text" style="none" value="' . $defaultimage . '"/>
                          </div>
                   </td>
                </tr>
            </table>

            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="UploadTypeMasterID" name="UploadTypeMasterID" value="' . $UploadTypeMasterID . '"/>

        </fieldset>
        ';
        echo '
       <style type="text/css">

            /* Apply these styles only when #preview-pane has
               been placed within the Jcrop widget */
            .jcrop-holder #preview-pane {
                display: block;
                position: absolute;
                z-index: 2000;
                top: 10px;
                right: -280px;
                padding: 6px;
                border: 1px rgba(0,0,0,.4) solid;
                background-color: white;

                -webkit-border-radius: 6px;
                -moz-border-radius: 6px;
                border-radius: 6px;

                -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
            }

            /* The Javascript code will set the aspect ratio of the crop
               area based on the size of the thumbnail preview,
               specified here */
            #preview-pane .preview-container {
                width: ' . $gridWidth . ';
                height: ' . $gridHeight . ';
                overflow: hidden;
            }

        </style>

        ';

        echo "
        <script>
            function chooseimage(x){
                    document.getElementById('upload').click();
                }

                function readURL(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {

                            if ($('#jcrop_target').data('Jcrop')) {
                                $('#jcrop_target').data('Jcrop').destroy();
                            }
                            $('#jcrop_target')
                                .attr('src', e.target.result);
                            $('#image')
                            .attr('src', e.target.result);
                            $('#Crop_Mod').modal('show');
                            jQuery(function($){

                                // Create variables (in this scope) to hold the API and image size
                                var jcrop_api,
                                    boundx,
                                    boundy,

                                // Grab some information about the preview pane
                                    \$preview = $('#preview-pane'),
                                    \$pcnt = $('#preview-pane .preview-container'),
                                    \$pimg = $('#preview-pane .preview-container img'),
                                    xsize = \$pcnt.width(),
                                    ysize = \$pcnt.height();

                                console.log('init',[xsize,ysize]);
                                $('#jcrop_target').Jcrop({
                                    onChange: updatePreview,
                                    onSelect: updatePreview,
                                    aspectRatio: xsize / ysize,
                                    bgColor: '',
                                    bgFade:     true,
                                    //setSelect : [20,20,580,380],
                                    bgOpacity: .6,
                                    boxWidth: 570,   //Maximum width you want for your bigger images
                                    boxHeight: 350  //Maximum Height for your bigger images
                                },function(){
                                    // Use the API to get the real image size
                                    var bounds = this.getBounds();
                                    boundx = bounds[0];
                                    boundy = bounds[1];
                                    // Store the API in the jcrop_api variable
                                    jcrop_api = this;

                                    // Move the preview into the jcrop container for css positioning
                                    //\$preview.appendTo(jcrop_api.ui.holder);
                                });


                                function updatePreview(c)
                                {
                                    if (parseInt(c.w) > 0)
                                    {
                                        var rx = xsize / c.w;
                                        var ry = ysize / c.h;

                                        \$pimg.css({
                                            width: Math.round(rx * boundx) + 'px',
                                            height: Math.round(ry * boundy) + 'px',
                                            marginLeft: '-' + Math.round(rx * c.x) + 'px',
                                            marginTop: '-' + Math.round(ry * c.y) + 'px'
                                        });
                                    }

                                    $('#x').val(c.x);
                                    $('#y').val(c.y);
                                    $('#w').val(c.w);
                                    $('#h').val(c.h);

                                };

                                document.getElementById('image_preview_div_loader').style.display = 'block';
                                document.getElementById('image_preview_div').style.display = 'none';

                            });


                            function checkCoords()
                            {
                                if (parseInt($('#w').val())) return true;
                                alert('Please select a crop region then press submit.');
                                return false;
                            };
                        };

                reader.readAsDataURL(input.files[0]);
                    }


            var filename2 = input.value;
            var filename = filename2.replace(/^.*[\\\/]/, '');

                    if(filename=='' || filename==null){
                        document.getElementById('flag').value='" . $defaultimage . "';
                    }else{
                        document.getElementById('flag').value = filename;
                    }
                }

                $(document).ready(function(){
                    //close modal
                    $('#Crop_Mod')
                    .on('hidden.bs.modal', function() {
                        $('#jcrop_target').attr('src', '');
                        check_uploadQuota_OtherPortals();

                    });

                });

                //append modal to the page
                $('body').append('<div class=\'modal fade\' id=Crop_Mod role=\'dialog\' aria-labelledby=\'mySmallModalLabel\'><div class=\'modal-dialog\'><div class=\'modal-content\'><div class=\'modal-header\'><button type=\'button\' class=\'close\' data-dismiss=\'modal\' aria-label=\'Close\' id=\'closeBtnc\' name=\'closeBtnc\'><span aria-hidden=\'true\'>&times;</span></button><h4 class=\'modal-title\'>Crop</h4></div><div class=\'modal-body\' style=\'text-align: center;\'><div style=\'display:flex; align-items:center; justify-content:center;\'><img src=\'\' id=\'jcrop_target\' alt=\'[Jcrop Example]\' style=\'text-align: center;\'/></div></div><div class=\'modal-footer\'><button type=\'button\' class=\'btn btn-default\' data-dismiss=\'modal\'>Upload</button></div></div></div></div>');


                function check_uploadQuota_OtherPortals()
                {

                    if(($('#x').val()=='' && $('#y').val() == '' && $('#w').val() == '' && $('#h').val() == '') || ($('#x').val()=='0' && $('#y').val() == '0' && $('#w').val() == '0' && $('#h').val() == '0'))
                    {
                        $.notify({title: '<strong>Uploading Failed!Please Crop Image</strong>', message: ''}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                        document.getElementById('image_preview_div_loader').style.display = 'none';
                        document.getElementById('image_preview_div').style.display = 'block';
                        var base_url = '" . base_url('ref/images/') . "';
                        document.getElementById('flag').value = $('#prvimage').val();
                        document.getElementById('image').src = $('#prvimage').val();
                    }   
                    else
                    {
                    var dataimg = new FormData();
                    dataimg.append('x', $('#x').val());
                    dataimg.append('y', $('#y').val());
                    dataimg.append('w', $('#w').val());
                    dataimg.append('h', $('#h').val());
                    dataimg.append('upload', $('#upload')[0].files[0]);
                    dataimg.append('UploadTypeMasterID', $UploadTypeMasterID);
                    dataimg.append('SchID', $SchMasterID);
                    dataimg.append('BranchID', $BranchID);

                    $.ajax({
                        url:'Srp_UploadController/check_uploadQuota_OtherPortals',
                        data: dataimg,
                        contentType: false,
                        processData: false,
                        cache: false,
                        type: 'POST',
                        beforeSend: function (){
                        },
                        success: function(data)
                        {

                            if(data == 'File size exceeding the limit') {
                                $.notify({title: '<strong>Uploading Failed!</strong>', message: 'The attachment size exceeds the allowable limit! Please upload an attachment within the limit.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                                var base_url = '" . base_url('ref/images/') . "';
                                document.getElementById('upload').value = '';
                                document.getElementById('flag').value = '" . $defaultimage . "';
                                document.getElementById('image').src = '" . $defaultimage . "';
                            } else if(data == 'Used space exceeds limit') {
                                $.notify({title: '<strong>Uploading Failed!</strong>', message: 'No free space available for uploading.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                                document.getElementById('upload').value = '';
                                document.getElementById('flag').value = '" . $defaultimage . "';
                                document.getElementById('image').src = '" . $defaultimage . "';
                            }
                                document.getElementById('image_preview_div_loader').style.display = 'none';
                                document.getElementById('image_preview_div').style.display = 'block';
                        }
                    });
                }
                }

        </script>
        ";
    }
}

//Upload File
if (!function_exists('Upload_File')) {
    function Upload_File($allowedTypes, $maxSiz, $maxWidth, $maxHeight, $type, $Crop, $UploadTypeMasterID, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $PreviousImage)
    {

        $CI = &get_instance();
        $CI->load->model('Srp_UploadModel');
        $CI->Srp_UploadModel->upload_image($allowedTypes, $maxSiz, $maxWidth, $maxHeight, $type, $Crop, $UploadTypeMasterID, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $PreviousImage);
    }
}

//Upload File
if (!function_exists('Upload_File_OtherPortals')) {
    function Upload_File_OtherPortals($allowedTypes, $maxSiz, $maxWidth, $maxHeight, $type, $Crop, $UploadTypeMasterID, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $PreviousImage)
    {

        $CI = &get_instance();
        $CI->load->model('Srp_UploadModel');
        $CI->Srp_UploadModel->upload_image_OtherPortals($allowedTypes, $maxSiz, $maxWidth, $maxHeight, $type, $Crop, $UploadTypeMasterID, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $PreviousImage);
    }
}


//Delete Image from folder
if (!function_exists('DeleteImageFromFolder')) {
    function DeleteImageFromFolder($imageName, $UploadTypeMasterID)
    {

        //update upload
        $CI = &get_instance();
        $query_UploadSetup = $CI->db->query("SELECT * FROM srp_schooluploadsetup WHERE SchMasterID = '" . $_SESSION['schID'] . "' AND BranchID = '" . $_SESSION['branchID'] . "' AND UploadTypeMasterID = '" . $UploadTypeMasterID . "'");
        $res_UploadSetup = $query_UploadSetup->row();

        //update uploadsetup table
        if (file_exists(('ref/images/' . $imageName))) {
            $FileSize = (filesize('ref/images/' . $imageName)) / 1024; //in KB
            $UsedUploadSize = ($res_UploadSetup->UsedUploadSize) - ($FileSize / 1024);
            $query_setup = $CI->db->query("UPDATE srp_schooluploadsetup SET UsedUploadSize = '" . ($UsedUploadSize) . "' WHERE SchMasterID = '" . $_SESSION['schID'] . "' AND BranchID = '" . $_SESSION['branchID'] . "' AND UploadTypeMasterID = '" . $UploadTypeMasterID . "'");

            //update uploadquota
            if ($res_UploadSetup->isCountEnabled == '1') {

                //get image dimensions
                $query_UploadQuota = $CI->db->query("SELECT * FROM srp_schooluploadquota WHERE SchMasterID = '" . $_SESSION['schID'] . "' AND BranchID = '" . $_SESSION['branchID'] . "'");
                $res_UploadQuota = $query_UploadQuota->row();

                $TotalUsedSpace = ($res_UploadQuota->UsedUploadSize) - ($FileSize / 1024 / 1024);
                $query_setup = $CI->db->query("UPDATE srp_schooluploadquota SET UsedUploadSize = '" . ($TotalUsedSpace) . "' WHERE SchMasterID = '" . $_SESSION['schID'] . "' AND BranchID = '" . $_SESSION['branchID'] . "'");
            }

            unlink("ref/images/" . $imageName);
        }
    }
}

//attachment view
if (!function_exists('get_documentTypes')) {

    function get_documentTypes()
    {
        $CI = &get_instance();
        $query = $CI->db->query("SELECT * FROM srp_documentuploadtypes");
        $res = $query->result();
        return $res;
    }
}

if (!function_exists('Attachment')) {
    function Attachment($attTopic, $UploadTypeMasterID, $DocumentTypeID)
    {
        $CI = &get_instance();
        $CI->load->library('company_language');
        $idiom = $CI->company_language->getPrimaryLanguage();
        $CI->lang->load('common', $idiom);
        $get_docType = get_documentTypes();

        echo '<div class="modal fade" id="attachment_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog" style="width:700px;">
        <div class="modal-content">
            <div class="modal-header">
            <table border="0">
            <tr>
                <td style="padding:2px; text-align: left; width: 95%;"> <h4 class="modal-title">' . $attTopic . ' | ' . '<span id="Name"></span></h4></td>
                <td style="padding:2px; width: 5%;"><img src="' . base_url('ref/images/facebook.gif') . '" width="26px" height="24px" style="display:none; " id="imgLoader"></td>
            </tr>
            </table>

            </div>
            <div class="modal-body">
            <form id="attachmentForm"  method="post" enctype="multipart/form-data">
                <div class="well well-sm container row-fluid" style="width: 100%;" id="attachSbmtDiv">
                    <div class="span12">
                        <div class="row-fluid">
                <div class="form-group">
                    <label for="attDes">' . $CI->lang->line('common_attachment_description') . '</label>
                    <input type="text" name="attDes" id="attDes" class="form-control" placeholder="' . $CI->lang->line('common_attachment_description') . '" required>
                </div>';
        if ($DocumentTypeID == 2) {
            echo '<div class="form-group">
                                    <label for="DocumentTypeId">' . $CI->lang->line('common_document_type') . ' </label>
                                        <select class="form-control input-sm select2" id="DocumentTypeId" name="DocumentTypeId"
                                    style="width:100%; margin-bottom: 0px;" onchange="get_documentTypeForm();">
                                <option></option>';
            foreach ($get_docType as $row_docType) {
                if ($row_docType->DocumentTypeId == '1') {
                    echo '<option value="' . $row_docType->DocumentTypeId . '" selected="selected">' . $row_docType->DocumentTypeDes . '</option>';
                } else {
                    echo '<option value="' . $row_docType->DocumentTypeId . '">' . $row_docType->DocumentTypeDes . '</option>';
                }
            }

            echo '</select>

                </div>';
        }
        echo '<div class="form-group" id="attachmentTypeDiv" style="display: block;width:100%;">
                    <label for="attachmentName">' . $CI->lang->line('common_attachment') . ' </label>
                    <input type="text" style="height: 30px;width: 100%;" readonly="readonly" class="form-control" name="attachmentName" id="attachmentName"  placeholder="' . $CI->lang->line('common_attachment') . '..." required>
                    <span style="color:red; font-size:11px; display:none;" id="exceeding_FileSize_alert_Att"><strong>The attachment size exceeds the allowable limit! Please upload an attachment within the limit.</strong></span>
                    <span style="color:red; font-size:11px; display:none;" id="file_type_not_allowed"><strong>The file type you are attempting to upload is not allowed.</strong></span>
                    <span style="color:red; font-size:11px; display:none;" id="No_FreeSpace_alert_Att"><b>Uploading Failed! There is no free space left for uploading.</b></span>
                    <span style="color:red; font-size:11px; display:none;" id="Configuration_alert_Att"><b>Error in document upload location configuration.</b></span>
                </div>
                <div class="form-group" id="googleLinkTypeDiv" style="display: none;">
                <label for="googleDriveLink">' . $CI->lang->line('common_google_drive_link') . ' </label>
                 <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-copy"></i>
                                </div>
                                <input type="text" id="googleDriveLink" name="googleDriveLink" class="form-control" style="width: 100%;" value="" placeholder="Add / Edit Google Link">
                             
                            </div>
                </div>
                <div id="Att_UploadQuotaDiv"></div>
                <div class="form-group" style="text-align:right;">
                    <button type="button" class="btn btn-default btn-sm" id="uploadAttachment" onclick="attachChange();chooseAttachment(this)" ><i class="fa fa-upload"></i></button>
                    <button type="submit" value="submit" class="btn btn-primary btn-sm" id="attachSubmitBtn"><i class="fa fa-chevron-circle-right"></i></button>
                 </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="manID" id="manID"  class="form-control" style="display:none;">
                </div>
                <div class="form-group">
                    <input type="text" name="attachmentEditID" id="attachmentEditID"  class="form-control" style="display:none;" >
                </div>
                <input type="file" name="upload"  id="userfileAttachment" onchange="uploadOnChangeAttachment(this);" style="display:none;"/>

            </form>
                <div id="attachmentDisplay"></div>
            </div>
            
            <div class="modal-footer">
                <div style="float:left"  id="attachmentUpdate"> </div>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeAtt()" id="closeAttd">' . $CI->lang->line('common_close') . '</button>
            </div>
        </div>

    </div>
</div>';

        echo "<script>
                $(document).ready(function(){
                    $('#attachment_modal').on('show.bs.modal', function () {
                            $.ajax({
                                type: 'POST',
                                url: 'Srp_UploadController/get_uploadQuotas',
                                data: {
                                    'UploadTypeMasterID': '5'
                                },
                                success: function (data) {
                                    $('#Att_UploadQuotaDiv').html(data);

                                    document.getElementById('Quota_InfoDiv').style.float = 'left';
                                }
                            });
                    })
                    .on('hidden.bs.modal', function () {
                        $('#Att_UploadQuotaDiv').html('');

                        //hide alerts
                        document.getElementById('exceeding_FileSize_alert_Att').style.display = 'none';
                        document.getElementById('No_FreeSpace_alert_Att').style.display = 'none';
                    });
                });

                function chooseAttachment(){
                    document.getElementById('userfileAttachment').click();
                    document.getElementById('attachSubmitBtn').disabled = false;
                    
              //hide alerts
                        document.getElementById('exceeding_FileSize_alert_Att').style.display = 'none';
                        document.getElementById('No_FreeSpace_alert_Att').style.display = 'none';
                }

                function uploadOnChangeAttachment(w) {
                    var filename2= w.value;
                    var filename = filename2.replace(/^.*[\\\/]/,'');
                    if(filename !=='' || filename !==null){
                         document.getElementById('attachmentName').value =filename;
                    }

                    check_uploadQuota_Att();
                }

                function check_uploadQuota_Att()
                {

                    var filesize = (($('#userfileAttachment')[0].files[0].size)/1024); //KB
                    var isCountEnabled = document.getElementById('File_isCountedForQuota').value;
                    var File_UploadSize = document.getElementById('File_UploadSize').value;
                    var File_UsedUploadSize = document.getElementById('File_UsedUploadSize').value;
                    var File_MaxUploadSize = document.getElementById('File_MaxUploadSize').value;


                        if((filesize/1024) > File_UploadSize){ //filesize in MB

                        document.getElementById('exceeding_FileSize_alert_Att').style.display = 'block';
                        document.getElementById('userfileAttachment').value = '';
                        document.getElementById('attachmentName').value = '';

                        }else{
                            if(isCountEnabled == '1'){
                                var UsedSpace = File_UsedUploadSize+(filesize/1024/1024); //filesize in GB

                                if(UsedSpace > File_MaxUploadSize){

                                    document.getElementById('No_FreeSpace_alert_Att').style.display = 'block';
                                    document.getElementById('userfileAttachment').value = '';
                                    document.getElementById('attachmentName').value = '';

                                }

                            }
                        }

                }

                </script>";
    }
}


//document view
if (!function_exists('Document')) {
    function Document($docTopic, $UploadTypeMasterID)
    {
        $CI = &get_instance();
        $CI->load->library('company_language');
        $idiom = $CI->company_language->getPrimaryLanguage();
        $CI->lang->load('common', $idiom);
        echo '<div class="modal fade" id="document_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <!--header-->
                    <div class="modal-header">
                        <table >
                            <tr>
                                <td style="padding:2px; text-align: left; width: 98%;"> <h4 class="modal-title">' . $docTopic . '   ' . '<span id="EmpDocName"></span></h4></td>
                                <td style="padding:2px; text-align: right; width: 1%;"><img src="' . base_url('ref/images/facebook.gif') . '" width="26px" height="24px" style="display:none; " id="Doc_loaderDiv"></td>
                            </tr>
                        </table>
                    </div>
                    <!--body-->
                    <div class="modal-body">
                          <div class="col-md-5">
                                <div class="nav-tabs-custom">
                                 <ul class="nav nav-tabs">
                                    <li class="active"><a href="#activity" data-toggle="tab">' . $CI->lang->line('common_upload') . '...</a></li>
                                    <div id="Doc_UploadQuotaDiv"></div>
                                </ul>
                                  <div class="tab-content">
                                     <div class="active tab-pane" id="activity">

                                        <form id="documentForm"  method="post" enctype="multipart/form-data">

                                    <div class="well well-sm container row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <div class="form-group">
                                                    <label for="docDes">' . $CI->lang->line('common_document_desc') . ': </label>
                                                    <select class="form-control select2" name="docDes" id="docDes" style="width: 100%;" onchange="get_DocumenteditID();" data-placeholder="' . $CI->lang->line('common_document_desc') . '">
                                                    <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                     <label for="documentName">' . $CI->lang->line('common_document') . ': </label>
                                                     <input type="text" readonly  style="width: 90%;float:left; margin-right:2px; margin-left:0px;" class="form-control" name="documentName" id="documentName"  placeholder="' . $CI->lang->line('common_document') . '">
                                                     <span style="color:red; font-size:11px; display:none;" id="exceeding_FileSize_alert"><strong>The attachment size exceeds the allowable limit! Please upload an attachment within the limit.</strong></span>
                                                     <span style="color:red; font-size:11px; display:none;" id="No_FreeSpace_alert"><b>Uploading Failed! There is no free space left for uploading.</b></span>
                                                     <span style="color:red; font-size:11px; display:none;" id="file_type_not_allowed_msg"><strong>The file type you are attempting to upload is not allowed.</strong></span>
                                                     <span style="color:red; font-size:11px; display:none;" id="Configuration_alert_msg"><b>Error in document upload location configuration.</b></span>

                                                      <button type="button"  style="float: right ;margin-top:2px;" class="btn btn-info btn-xs" id="uploadDocument" onclick="chooseDocument(this)"  ><i class="fa fa-upload"></i></button>

                                                </div>';
        echo DateField($CI->lang->line('common_expires_on'), 'ExpiresOn', 'ExpiresOn', '', '', '');

        echo '<div class="form-group">
                                                    <label for="documentName">' . $CI->lang->line('common_remindexpireDays') . ': </label>
                                                     <input type="number"style="height: 30px;" class="form-control" name="RemindBefore" id="RemindBefore"  placeholder="' . $CI->lang->line('common_remind_expire') . '">
                                                </div>
                                                <div class="form-group" style="text-align:right;">
                                                    <button type="submit" value="submit" class="btn btn-success btn-sm"><i class="fa fa-chevron-circle-right"></i></button>
                                                </div>
                                            </div>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                         <input type="text" style="display:none;" name="docID" id="docID"  class="form-control">
                                    </div>
                                    <div class="form-group">
                                         <input type="text" style="display:none;" name="documentEditID" id="documentEditID"  class="form-control"  >
                                    </div>
                                        <input type="file" style="display:none;" name="upload"  id="userfileDocument" size="20" onchange="uploadOnChangeDocument(this);" />

                                </form>

                                     </div>
                                  </div>
                                  <div  id="DocumentUpdate"></div>

                              </div>

                          </div>
                          <div class="col-md-7 ">
                              <div class="nav-tabs-custom">
                                 <ul class="nav nav-tabs">
                                    <li class="active"><a href="#activity" data-toggle="tab">' . $CI->lang->line('common_document') . '...</a></li>
                                </ul>
                                  <div class="tab-content">
                                     <div class="active tab-pane" id="activity">
                                        <!--display documents-->
                                        <div id="documentDisplay"></div>
                                     </div>
                                  </div>
                              </div>
                         </div>
                    </div>
                    <!--footer-->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="closeDoc()" id="closeAttd">' . $CI->lang->line('common_close') . '</button>
                    </div>
                </div>
            </div>
          </div>';

        echo "<script>

                $(document).ready(function(){
                    $('#document_modal').on('show.bs.modal', function () {
                            $.ajax({
                                type: 'POST',
                                url: 'Srp_UploadController/get_uploadQuotas',
                                data: {
                                    'UploadTypeMasterID': '6'
                                },
                                success: function (data) {
                                    $('#Doc_UploadQuotaDiv').html(data);
                                }
                            });
                    });
                    $('#document_modal').on('hidden.bs.modal', function () {
                        $('#Doc_UploadQuotaDiv').html('');

                        //hide alerts
                        document.getElementById('exceeding_FileSize_alert').style.display = 'none';
                        document.getElementById('No_FreeSpace_alert').style.display = 'none';
                    });
                });

                function chooseDocument(){
                    document.getElementById('userfileDocument').click();

                   //hide alerts
                    document.getElementById('exceeding_FileSize_alert').style.display = 'none';
                    document.getElementById('No_FreeSpace_alert').style.display = 'none';

                }

                function uploadOnChangeDocument(w) {
                    var filename2= w.value;
                    var filename = filename2.replace(/^.*[\\\/]/,'');

                    if(filename !=='' || filename !==null){
                        document.getElementById('documentName').value =filename;
                    }

                    check_uploadQuota_doc();
                }

                function check_uploadQuota_doc()
                {

                    var filesize = (($('#userfileDocument')[0].files[0].size)/1024); //KB
                    var isCountEnabled = document.getElementById('File_isCountedForQuota').value;
                    var File_UploadSize = document.getElementById('File_UploadSize').value;
                    var File_UsedUploadSize = document.getElementById('File_UsedUploadSize').value;
                    var File_MaxUploadSize = document.getElementById('File_MaxUploadSize').value;


                        if((filesize/1024) > File_UploadSize){ //filesize in MB

                        document.getElementById('exceeding_FileSize_alert').style.display = 'block';
                        document.getElementById('userfileDocument').value = '';
                        document.getElementById('documentName').value = '';

                        }else{
                            if(isCountEnabled == '1'){
                                var UsedSpace = File_UsedUploadSize+(filesize/1024/1024); //filesize in GB

                                if(UsedSpace > File_MaxUploadSize){

                                    document.getElementById('No_FreeSpace_alert').style.display = 'block';
                                    document.getElementById('userfileDocument').value = '';
                                    document.getElementById('documentName').value = '';

                                }

                            }
                        }


                }

                </script>";
    }
}


//discount calculation
if (!function_exists('Discounts')) {
    function Discounts($OtherFeeSetupID, $SelectionSurcesID, $filterDate, $EffetiveDate, $AY, $StuID)
    {

        $CI = &get_instance();

        if ($SelectionSurcesID == '1' || $SelectionSurcesID == '2' || $SelectionSurcesID == '0') { // Monthly or Termly

            $startTimestamp = strtotime($EffetiveDate);
            $endTimestamp = strtotime($filterDate);

            $startYear = date('Y', $startTimestamp);
            $startMonth = date('n', $startTimestamp);

            $endYear = date('Y', $endTimestamp);
            $endMonth = date('n', $endTimestamp);

            $diff = ($endYear - $startYear) * 12 + ($endMonth - $startMonth);

            $day_diff_sign = ($diff >= 0) ? "+" : "-";
            $day_diff = abs($diff);
        } else if ($SelectionSurcesID == '3') { //Yearly

            if ($EffetiveDate == "" || $EffetiveDate == null) {
                $Date_beginning = $filterDate;
            } else {
                $Date_beginning = $EffetiveDate;
            }

            $Date_end = $filterDate;

            $startTimestamp = strtotime($Date_beginning);
            $endTimestamp = strtotime($Date_end);

            $startYear = date('Y', $startTimestamp);
            $startMonth = date('n', $startTimestamp);

            $endYear = date('Y', $endTimestamp);
            $endMonth = date('n', $endTimestamp);

            $diff = ($endYear - $startYear) * 12 + ($endMonth - $startMonth);

            $day_diff_sign = ($diff >= 0) ? "+" : "-";
            $day_diff = abs($diff);
        } else { //One-time payment
            $day_diff_sign = '';
            $day_diff = 0;
        }
 
        //getLast row of fee discour or penalty
        $qryLast_disPenalty = $CI->db->query("SELECT * FROM srp_feedisorpenaltysetup WHERE FeesSetupId = '" . $OtherFeeSetupID . "' AND isDeleted = '0' ORDER BY EffectedTo DESC LIMIT 1");
        $res_disPenalty = $qryLast_disPenalty->row();

        $PenaltyOnLP = 0;
        $DiscountOnAP = 0;
        if ($day_diff_sign == '+' && $EffetiveDate != '') { //Penalty

            if (!empty($res_disPenalty) && $day_diff >= $res_disPenalty->EffectedTo) {

                if (!empty($res_disPenalty)) {

                    $Discount = $res_disPenalty->PenaltyOnLP;
                    $PenaltyOnLP = $res_disPenalty->PenaltyOnLP;
                    $Status = "Overdue";
                } else {
                    $Discount = 0;
                    $PenaltyOnLP = 0;
                    $Status = "Due";
                }
            } else {
                $query_disPenalty = $CI->db->query("SELECT * FROM srp_feedisorpenaltysetup WHERE FeesSetupId = '" . $OtherFeeSetupID . "' AND isDeleted = '0' AND $day_diff >= `EffectedFrom` AND $day_diff <= `EffectedTo` ORDER BY EffectedTo DESC LIMIT 1");
                $res_disPenalty = $query_disPenalty->row();

                if (!empty($res_disPenalty)) {
                    $Discount = $res_disPenalty->PenaltyOnLP;
                    $PenaltyOnLP = $res_disPenalty->PenaltyOnLP;
                    $Status = "Overdue";
                } else {
                    $Discount = 0;
                    $PenaltyOnLP = 0;
                    $Status = "Due";
                }
            }
        } else if ($day_diff_sign == '-' && $EffetiveDate != '') { //discount
            //echo 'works1';
            $query_disPenalty = $CI->db->query("SELECT * FROM srp_feedisorpenaltysetup WHERE FeesSetupId = '" . $OtherFeeSetupID . "' AND isDeleted = '0' AND $day_diff >= `EffectedFrom` ORDER BY EffectedFrom DESC LIMIT 1");
            $res_disPenalty = $query_disPenalty->row();
            //echo $OtherFeeSetupID;
            if (!empty($res_disPenalty)) {
                //echo 'works2';
                $Discount = $res_disPenalty->DiscountOnAP;
                $DiscountOnAP = $res_disPenalty->DiscountOnAP;
            } else {
                $Discount = 0;
                $DiscountOnAP = 0;
            }

            $Status = "Due";
        } else {
            $res_disPenalty = array();
            $Discount = 0;
            $Status = "Due";
        }

        $query_isDisOrPenInPercent = $CI->db->query("SELECT srp_otherfeesmaster.isDisOrPenaltyInPercentage FROM srp_otherfeesetup INNER JOIN srp_otherfeesmaster ON srp_otherfeesmaster.OtherFeesID = srp_otherfeesetup.OtherFeesID WHERE OtherFeeSetupID = '" . $OtherFeeSetupID . "' AND srp_otherfeesmaster.isDeleted = '0'");
        $res_isDisOrPenInPercent = $query_isDisOrPenInPercent->row();
        if (!empty($res_isDisOrPenInPercent)) {
            $isDisOrPenaltyInPercent = $res_isDisOrPenInPercent->isDisOrPenaltyInPercentage;
        } else {
            $isDisOrPenaltyInPercent = 1;
        }

        //special discounts
        if ($StuID == "" || $StuID == null || $StuID == '0') {
            $res_specialDis = array();
        } else {
            $query_specialDis = $CI->db->query("SELECT * FROM srp_disoraddstudentsetup INNER JOIN srp_disoraddsetup ON srp_disoraddsetup.DisOrAddSetupID = srp_disoraddstudentsetup.DisOrAddSetupID INNER JOIN srp_disoraddmaster ON srp_disoraddmaster.DisOrAddMasterID = srp_disoraddsetup.DisOrAddMasterID WHERE srp_disoraddsetup.AcademicYearID = '" . $AY . "' AND srp_disoraddstudentsetup.StuID = '" . $StuID . "' AND OtherFeeSetupID = '" . $OtherFeeSetupID . "' AND srp_disoraddsetup.SchMasterID = '" . $_SESSION['schID'] . "' AND srp_disoraddsetup.BranchID = '" . $_SESSION['branchID'] . "'");
            $res_specialDis = $query_specialDis->result();
        }

        //General discounts in percentage
        $getBulkDis = $CI->db->query('SELECT * FROM srp_disoraddmaster WHERE (SchMasterID="' . $_SESSION['schID'] . '"  AND BranchID="' . $_SESSION['branchID'] . '") AND isDiscount="2" AND isPercentage="1" AND isPerInvoice="0"');
        $row_bulkDiscount = $getBulkDis->row();
        if (!empty($row_bulkDiscount)) {
            $res_generalDis = '';
        } else {
            $query_generalDis = $CI->db->query("SELECT * FROM srp_disoraddmaster WHERE srp_disoraddmaster.SchMasterID = '" . $_SESSION['schID'] . "' AND srp_disoraddmaster.BranchID = '" . $_SESSION['branchID'] . "' AND isDiscount='2' AND isPercentage='1'");
            $res_generalDis = $query_generalDis->row();
        }


        //General discounts in amount
        $qry_genDisAmount = $CI->db->query("SELECT * FROM srp_disoraddmaster WHERE srp_disoraddmaster.SchMasterID = '" . $_SESSION['schID'] . "' AND srp_disoraddmaster.BranchID = '" . $_SESSION['branchID'] . "' AND isDiscount='2' AND isPercentage='0'");
        $res_genDisAmount = $qry_genDisAmount->row();

        $SpecialDisInAmount = 0;
        $SpecialDisInPercent = 0;
        $SpeCntDisPer = 0;
        $SpeCntDisAmnt = 0;
        $SpeCntAditnPer = 0;
        $SpeCntAditnAmnt = 0;
        foreach ($res_specialDis as $row_specialDis) {
            if ($row_specialDis->isPercentage == '1') {
                $SpecialDisInPercent += $row_specialDis->DisOrAddPercent;
            } else {
                $SpecialDisInAmount += $row_specialDis->DisOrAddPercent;
            }

            if ($row_specialDis->isDiscount == '1') {
                if ($row_specialDis->isPercentage == '1') {
                    $SpeCntDisPer += $row_specialDis->DisOrAddPercent;
                } else {
                    $SpeCntDisAmnt += $row_specialDis->DisOrAddPercent;
                }
            } else {
                if ($row_specialDis->isPercentage == '1') {
                    $SpeCntAditnPer += $row_specialDis->DisOrAddPercent;
                } else {
                    $SpeCntAditnAmnt += $row_specialDis->DisOrAddPercent;
                }
            }
        }

        $data = array(
            "Status" => $Status,
            "isDiscountInPercentage" => $isDisOrPenaltyInPercent,
            "Discount" => $Discount,
            "DiscountSign" => $day_diff_sign,
            "DiscountDetails" => $res_disPenalty,
            "SpecialDiscount_Amounts" => $SpecialDisInAmount,
            "SpecialDiscount_Percents" => $SpecialDisInPercent,
            "PenaltyOnLP_Percents" => $PenaltyOnLP,
            "DiscountOnAP_Percents" => $DiscountOnAP,
            "SpeCntDis_Percents" => $SpeCntDisPer,
            "SpeCntDis_Amount" => $SpeCntDisAmnt,
            "SpeCntAdditn_Percents" => $SpeCntAditnPer,
            "SpeCntAdditn_Amount" => $SpeCntAditnAmnt,
            "SpecialDicountDetails" => $res_specialDis,
            "GeneralDisInPercentage" => $res_generalDis,
            "GeneralDisInAmount" => $res_genDisAmount
        );

        return $data;
    }
}

function fetch_currency_desimal($code)
{
    $CI = &get_instance();
    $CI->db->SELECT("DecimalPlaces");
    $CI->db->FROM('srp_erp_currencymaster');
    $CI->db->WHERE('CurrencyCode', $code);
    return $CI->db->get()->row('DecimalPlaces');
}

function currency_conversion($trans_currency, $local_currency, $amount = 0)
{
    $data = array();
    $CI = &get_instance();
    if ($trans_currency == $local_currency) {
        $CI->db->select('CurrencyCode,CurrencyName,DecimalPlaces');
        $CI->db->from('srp_erp_currencymaster');
        $CI->db->where('CurrencyCode', $trans_currency);
        $data_arr = $CI->db->get()->row_array();
        $data['conversion'] = 1;
        $data['CurrencyCode'] = $data_arr['CurrencyCode'];
        $data['CurrencyName'] = $data_arr['CurrencyName'];
        $data['DecimalPlaces'] = $data_arr['DecimalPlaces'];
    } else {
        $CI->db->select('conversion,srp_erp_currencymaster.CurrencyCode,srp_erp_currencymaster.CurrencyName,srp_erp_currencymaster.DecimalPlaces');
        $CI->db->from('srp_erp_currencyconversion');
        $CI->db->where('srp_erp_currencyconversion.masterCurrencyCode', $trans_currency);
        $CI->db->where('srp_erp_currencyconversion.subCurrencyCode', $local_currency);
        $CI->db->join('srp_erp_currencymaster', 'srp_erp_currencymaster.currencyID = srp_erp_currencyconversion.subCurrencyID');
        $data_arr = $CI->db->get()->row_array();
        $data['conversion'] = $data_arr['conversion'];
        $data['CurrencyCode'] = $data_arr['CurrencyCode'];
        $data['CurrencyName'] = $data_arr['CurrencyName'];
        $data['DecimalPlaces'] = $data_arr['DecimalPlaces'];
    }
    return $data;
}

if (!function_exists('drill_down_emp_language')) {
    function drill_down_emp_language()
    {
        $CI = &get_instance();
        $data = $CI->db->query("SELECT *,CASE WHEN description = \"Arabic\" THEN \"ع\" 	WHEN description = \"English\" THEN	\"ENG\" END `languageshortcode` FROM srp_erp_lang_languages Where isActive = 1 ORDER BY languageID DESC")->result_array();
        return $data;
    }
}

if (!function_exists('getPrimaryLanguage')) {
    function getPrimaryLanguage()
    {
        $CI = &get_instance();
        $CI->load->library('company_language');
        $idiom = $CI->company_language->getPrimaryLanguage();

        return $idiom;
    }
}

if (!function_exists('getSecondaryLanguage')) {
    function getSecondaryLanguage()
    {
        $CI = &get_instance();
        $CI->load->library('company_language');
        $idiom = $CI->company_language->getSecondaryLanguage();

        return $idiom;
    }
}

//other imageOther uploading View - Employee Portal
if (!function_exists('UploadOtherImageView')) {
    function UploadOtherImageView($gridWidth, $gridHeight, $defaultimage, $UploadTypeMasterID)
    {
        echo '<fieldset id="Upload_Fieldset">
            <table width="' . $gridWidth . '" border="1" style="border: 1px solid #CCC;">
                <tr>
                   <td>
                      <div style="background-color:#E0E0E0;" align="center" id="image_preview_div">
                         <div id="preview-pane">
                            <div class="preview-container">
                               <img src="' . base_url('ref/images/' . $defaultimage) . '" class="jcrop-preview" id="imageOther" alt="Preview" width="' . $gridWidth . '" height="' . $gridHeight . '"/>
                             </div>
                         </div>
                      </div>
                      <div style="background-color:#E0E0E0; position: relative; height: ' . $gridHeight . '; display:none ; width:' . $gridWidth . ';" align="center" id="image_preview_div_loader">
                      <img src="' . base_url('ref/images/facebook.gif') . '" style="height:20px; width:26px; position: absolute; left: 40%;top: 35%;margin-left: -2px;margin-top: -2px;">
                      </div>
                   </td>
                </tr>
                <tr>
                   <td style="padding: 2px;">
                      <a class="btn btn-default btn-xs btn-block UA_Alter_btn" id="uploadBtn" name="uploadBtn" onclick="chooseimage(this)"><i class="fa fa-upload"></i>Upload</a>
                         <input class="form-control" id="upload" name="upload" type="file" style=" display:none;" onchange="readURL(this);"/>
                         <div class="form-group" style="width: 100%; margin-bottom: 0px; display: none ;">
                             <input class="form-control" id="otherFlag" name="otherFlag" type="text" style="none" value="' . $defaultimage . '"/>
                          </div>
                   </td>
                </tr>
            </table>

            <input type="hidden" id="x" name="x" />
            <input type="hidden" id="y" name="y" />
            <input type="hidden" id="w" name="w" />
            <input type="hidden" id="h" name="h" />
            <input type="hidden" id="UploadTypeMasterID" name="UploadTypeMasterID" value="' . $UploadTypeMasterID . '"/>

        </fieldset>
        ';

        echo '
       <style type="text/css">

            /* Apply these styles only when #preview-pane has
               been placed within the Jcrop widget */
            .jcrop-holder #preview-pane {
                display: block;
                position: absolute;
                z-index: 2000;
                top: 10px;
                right: -280px;
                padding: 6px;
                border: 1px rgba(0,0,0,.4) solid;
                background-color: white;

                -webkit-border-radius: 6px;
                -moz-border-radius: 6px;
                border-radius: 6px;

                -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
            }

            /* The Javascript code will set the aspect ratio of the crop
               area based on the size of the thumbnail preview,
               specified here */
            #preview-pane .preview-container {
                width: ' . $gridWidth . ';
                height: ' . $gridHeight . ';
                overflow: hidden;
            }

        </style>

        ';

        echo "
        <script>
            function chooseimage(x){
                    document.getElementById('upload').click();
                }

                function readURL(input) {

                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {

                            if ($('#jcrop_target').data('Jcrop')) {
                                $('#jcrop_target').data('Jcrop').destroy();
                            }
                            $('#jcrop_target')
                                .attr('src', e.target.result);
                            $('#imageOther')
                            .attr('src', e.target.result);
                            $('#Crop_Mod').modal('show');
                            jQuery(function($){

                                // Create variables (in this scope) to hold the API and imageOther size
                                var jcrop_api,
                                    boundx,
                                    boundy,

                                // Grab some information about the preview pane
                                    \$preview = $('#preview-pane'),
                                    \$pcnt = $('#preview-pane .preview-container'),
                                    \$pimg = $('#preview-pane .preview-container img'),
                                    xsize = \$pcnt.width(),
                                    ysize = \$pcnt.height();

                                console.log('init',[xsize,ysize]);
                                $('#jcrop_target').Jcrop({
                                    onChange: updatePreview,
                                    onSelect: updatePreview,
                                    aspectRatio: xsize / ysize,
                                    bgColor: '',
                                    bgFade:     true,
                                    //setSelect : [20,20,580,380],
                                    bgOpacity: .6,
                                    boxWidth: 570,   //Maximum width you want for your bigger images
                                    boxHeight: 350  //Maximum Height for your bigger images
                                },function(){
                                    // Use the API to get the real imageOther size
                                    var bounds = this.getBounds();
                                    boundx = bounds[0];
                                    boundy = bounds[1];
                                    // Store the API in the jcrop_api variable
                                    jcrop_api = this;

                                    // Move the preview into the jcrop container for css positioning
                                    //\$preview.appendTo(jcrop_api.ui.holder);
                                });


                                function updatePreview(c)
                                {
                                    if (parseInt(c.w) > 0)
                                    {
                                        var rx = xsize / c.w;
                                        var ry = ysize / c.h;

                                        \$pimg.css({
                                            width: Math.round(rx * boundx) + 'px',
                                            height: Math.round(ry * boundy) + 'px',
                                            marginLeft: '-' + Math.round(rx * c.x) + 'px',
                                            marginTop: '-' + Math.round(ry * c.y) + 'px'
                                        });
                                    }

                                    $('#x').val(c.x);
                                    $('#y').val(c.y);
                                    $('#w').val(c.w);
                                    $('#h').val(c.h);

                                };

                                document.getElementById('image_preview_div_loader').style.display = 'block';
                                document.getElementById('image_preview_div').style.display = 'none';

                            });


                            function checkCoords()
                            {
                                if (parseInt($('#w').val())) return true;
                                alert('Please select a crop region then press submit.');
                                return false;
                            };
                        };

                reader.readAsDataURL(input.files[0]);
                    }


            var filename2 = input.value;
            var filename = filename2.replace(/^.*[\\\/]/, '');

                    if(filename=='' || filename==null){
                        document.getElementById('otherFlag').value='" . $defaultimage . "';
                    }else{
                        document.getElementById('otherFlag').value = filename;
                    }
                }

                $(document).ready(function(){
                    //close modal
                    $('#Crop_Mod')
                    .on('hidden.bs.modal', function() {
                        $('#jcrop_target').attr('src', '');
                        check_uploadQuota();

                    });

                });

                //append modal to the page
                $('body').append('<div class=\'modal fade\' id=Crop_Mod role=\'dialog\' aria-labelledby=\'mySmallModalLabel\'><div class=\'modal-dialog\'><div class=\'modal-content\'><div class=\'modal-header\'><button type=\'button\' class=\'close\' data-dismiss=\'modal\' aria-label=\'Close\' id=\'closeBtnc\' name=\'closeBtnc\'><span aria-hidden=\'true\'>&times;</span></button><h4 class=\'modal-title\'>Crop</h4></div><div class=\'modal-body\' style=\'text-align: center;\'><div style=\'display:flex; align-items:center; justify-content:center;\'><img src=\'\' id=\'jcrop_target\' alt=\'[Jcrop Example]\' style=\'text-align: center;\'/></div></div><div class=\'modal-footer\'><button type=\'button\' class=\'btn btn-default\' data-dismiss=\'modal\'>Upload</button></div></div></div></div>');


                function check_uploadQuota()
                {
                    if(($('#x').val()=='' && $('#y').val() == '' && $('#w').val() == '' && $('#h').val() == '') || ($('#x').val()=='0' && $('#y').val() == '0' && $('#w').val() == '0' && $('#h').val() == '0'))
                        {
                            $.notify({title: '<strong>Uploading Failed!Please Crop Image</strong>', message: ''}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                            document.getElementById('image_preview_div_loader').style.display = 'none';
                            document.getElementById('image_preview_div').style.display = 'block';
                            var base_url = '" . base_url('ref/images/') . "';
                            if($('#prvimage').val()!='')
                            {
                                document.getElementById('flag').value = $('#prvimage').val();
                                document.getElementById('image').src = $('#prvimage').val();
                            }
                            else
                            {
                                document.getElementById('flag').value = '" . $defaultimage . "';
                                document.getElementById('image').src = '" . $defaultimage . "';
                            }    
                        }   
                        else
                        {
                            var dataimg = new FormData();
                            dataimg.append('x', $('#x').val());
                            dataimg.append('y', $('#y').val());
                            dataimg.append('w', $('#w').val());
                            dataimg.append('h', $('#h').val());
                            dataimg.append('upload', $('#upload')[0].files[0]);
                            dataimg.append('UploadTypeMasterID', $UploadTypeMasterID);

                            $.ajax({
                                url:'Srp_UploadController/check_uploadQuota',
                                data: dataimg,
                                contentType: false,
                                processData: false,
                                cache: false,
                                type: 'POST',
                                beforeSend: function (){
                                },
                                success: function(data)
                                {
                                    if(data == 'Success' || data == 'Not considered'){
                                    } else {

                                        if(data == 'File size exceeding the limit') {
                                            $.notify({title: '<strong>Uploading Failed!</strong>', message: 'The attachment size exceeds the allowable limit! Please upload an attachment within the limit.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                                            var base_url = '" . base_url('ref/images/') . "';
                                            document.getElementById('upload').value = '';
                                            document.getElementById('otherFlag').value = '" . $defaultimage . "';
                                            document.getElementById('imageOther').src = '" . $defaultimage . "';
                                        } else if(data == 'Used space exceeds limit') {
                                            $.notify({title: '<strong>Uploading Failed!</strong>', message: 'No free space available for uploading.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                                            document.getElementById('upload').value = '';
                                            document.getElementById('otherFlag').value = '" . $defaultimage . "';
                                            document.getElementById('imageOther').src = '" . $defaultimage . "';
                                        } else {
                                            $.notify({title: '<strong>Uploading Failed!</strong>', message: 'The attachment size exceeds the allowable limit! Please upload an attachment within the limit.'}, {element: 'body',type: 'danger', placement: {from: 'bottom'}, animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}});
                                            var base_url = '" . base_url('ref/images/') . "';
                                            document.getElementById('upload').value = '';
                                            document.getElementById('otherFlag').value = '" . $defaultimage . "';
                                            document.getElementById('imageOther').src = '" . $defaultimage . "';
                                        }
                                        
                                    }
                                        document.getElementById('image_preview_div_loader').style.display = 'none';
                                        document.getElementById('image_preview_div').style.display = 'block';
                                }
                            });

                        }

                    }
        </script>
        ";
    }
}

if (!function_exists('array_group_by')) {
    /**
     * Groups an array by a given key.
     *
     * Groups an array into arrays by a given key, or set of keys, shared between all array members.
     *
     * Based on {@author Jake Zatecky}'s {@link https://github.com/jakezatecky/array_group_by array_group_by()} function.
     * This variant allows $key to be closures.
     *
     * @param array $array The array to have grouping performed on.
     * @param mixed $key,... The key to group or split by. Can be a _string_,
     *                       an _integer_, a _float_, or a _callable_.
     *
     *                       If the key is a callback, it must return
     *                       a valid key from the array.
     *
     *                       ```
     *                       string|int callback ( mixed $item )
     *                       ```
     *
     * @return array|null Returns a multidimensional array or `null` if `$key` is invalid.
     */
    function array_group_by(array $array, $key)
    {

        if (!is_string($key) && !is_int($key) && !is_float($key) && !is_callable($key)) {
            trigger_error('array_group_by(): The key should be a string, an integer, or a callback', E_USER_ERROR);
            return NULL;
        }
        $func = (is_callable($key) ? $key : NULL);
        $_key = $key;
        // Load the new array, splitting by the target key
        $grouped = [];
        foreach ($array as $value) {
            if (is_callable($func)) {
                $key = call_user_func($func, $value);
            } elseif (is_object($value) && isset($value->{$_key})) {
                $key = $value->{$_key};
            } elseif (isset($value[$_key])) {
                $key = $value[$_key];
            } else {
                continue;
            }
            $grouped[$key][] = $value;
        }
        // Recursively build a nested grouping if more parameters are supplied
        // Each grouped array value is grouped according to the next sequential key
        if (func_num_args() > 2) {
            $args = func_get_args();
            foreach ($grouped as $key => $value) {
                $params = array_merge([$value], array_slice($args, 2, func_num_args()));
                $grouped[$key] = call_user_func_array('array_group_by', $params);
            }
        }
        return $grouped;
    }
}

/*common academic year filters*/
/*get active academic year */
if (!function_exists('getActive_academicYear')) {
    function getActive_academicYear()
    {
        $CI = &get_instance();
        $qryActiveAy = $CI->db->query("SELECT srp_academicdetails.AcademicYear,srp_academicdetails.NextAcademicYear,srp_academicdetails.DateStarted,srp_academicdetails.DateEnded,srp_academicyearmaster.SortOrder FROM srp_academicdetails INNER JOIN srp_academicyearmaster ON srp_academicdetails.AcademicYear=srp_academicyearmaster.AY_AutoID WHERE (srp_academicdetails.AcademicYear='" . $_SESSION['ActiveAY'] . "' AND srp_academicdetails.ActiveAY='1' AND srp_academicdetails.isDeleted='0') AND (srp_academicdetails.SchMasterId='" . $_SESSION['schID'] . "' AND srp_academicdetails.BranchID='" . $_SESSION['branchID'] . "')");
        return $qryActiveAy->row();
    }
}
/*get academic years only from setup*/
if (!function_exists('select_academicYear')) {
    function select_academicYear()
    {
        $CI = &get_instance();
        $qry_selectAy = $CI->db->query('SELECT DISTINCT srp_academicyearmaster.AY_AutoID,srp_academicyearmaster.AY_Description FROM srp_academicyearmaster INNER JOIN srp_academicdetails actAy ON actAy.AcademicYear=srp_academicyearmaster.AY_AutoID WHERE (srp_academicyearmaster.SchMasterID="' . $_SESSION['schID'] . '" AND srp_academicyearmaster.BranchID="' . $_SESSION['branchID'] . '") AND srp_academicyearmaster.SyllabusID="' . $_SESSION['SyllabusID'] . '" AND srp_academicyearmaster.isDeleted="0" AND actAy.isDeleted = "0" ORDER BY srp_academicyearmaster.SortOrder ASC');
        return $qry_selectAy->result();
    }
}

/*get Test Types from DB*/
if (!function_exists('select_testTpes')) {
    function select_testTpes()
    {
        $CI = &get_instance();
        $qry_selectTesttype = $CI->db->query("SELECT Type_id,Type_Des FROM srp_testtype_master WHERE isActive = '1' AND isDeleted = '0'");
        return $qry_selectTesttype->result();
    }
}

/*get all academic years from master*/
if (!function_exists('selectAllAY_fromMaster')) {
    function selectAllAY_fromMaster()
    {
        $CI = &get_instance();
        $qry_selectAyMas = $CI->db->query('SELECT DISTINCT srp_academicyearmaster.AY_AutoID,srp_academicyearmaster.AY_Description,srp_academicyearmaster.SortOrder FROM srp_academicyearmaster WHERE (srp_academicyearmaster.SchMasterID="' . $_SESSION['schID'] . '" AND srp_academicyearmaster.BranchID="' . $_SESSION['branchID'] . '") AND srp_academicyearmaster.SyllabusID="' . $_SESSION['SyllabusID'] . '" AND srp_academicyearmaster.isDeleted="0" ORDER BY srp_academicyearmaster.SortOrder ASC');
        return $qry_selectAyMas->result();
    }
}
/*end of common academic years filter*/

/*get all student  from master*/
if (!function_exists('selectAllStu_fromMaster')) {
    function selectAllStu_fromMaster()
    {
        $CI = &get_instance();
        $qry_selectAyMas = $CI->db->query('SELECT 	srp_studentdetails.AcademicYearJoined ,srp_classes.SortOrder AS ClassOrder,srp_studentdetails.isDeleted,srp_studentdetails.StudentID,srp_studentdetails.serialNo,srp_studentdetails.studentCode,srp_studentdetails.SnameA,srp_studentdetails.fName,srp_studentdetails.mName,srp_studentdetails.lName,srp_studentdetails.othername,srp_studentdetails.surname,srp_studentdetails.image,srp_studentdetails.ClassId,srp_studentdetails.GrpID,srp_studentdetails.SDOB,srp_studentdetails.Gender,srp_studentdetails.PID,srp_studentdetails.Rid,srp_studentdetails.isLeft,srp_classes.Class,srp_religion.Religion,srp_parentdetails.ContactPerson,srp_groups.GroupID FROM srp_studentdetails INNER JOIN srp_groups ON srp_studentdetails.GrpID = srp_groups.GrpID INNER JOIN srp_classes ON srp_studentdetails.ClassId=srp_classes.ClassId INNER JOIN srp_religion ON srp_studentdetails.Rid=srp_religion.RId INNER JOIN srp_parentdetails ON srp_studentdetails.PID=srp_parentdetails.PID WHERE (srp_studentdetails.schMasterId="' . $_SESSION['schID'] . '" AND srp_studentdetails.branchId="' . $_SESSION['branchID'] . '" AND srp_classes.SyllabusID="' . $_SESSION['SyllabusID'] . '") AND srp_studentdetails.isDeleted = "0" ORDER BY srp_classes.SortOrder , srp_studentdetails.serialNo ASC ');
        return $qry_selectAyMas->result();
    }
}
/*end of cstudent filter*/

/*get next academic years from master*/
if (!function_exists('selectAll_nextAY_fromMaster')) {
    function selectAll_nextAY_fromMaster()
    {

        $CI = &get_instance();

        $getSortOrder = getActive_academicYear();

        $qry_selectAyMas = $CI->db->query('SELECT DISTINCT srp_academicyearmaster.AY_AutoID,srp_academicyearmaster.AY_Description FROM srp_academicyearmaster WHERE (srp_academicyearmaster.SchMasterID="' . $_SESSION['schID'] . '" AND srp_academicyearmaster.BranchID="' . $_SESSION['branchID'] . '") AND srp_academicyearmaster.SyllabusID="' . $_SESSION['SyllabusID'] . '" AND SortOrder > "' . $getSortOrder->SortOrder . '" AND srp_academicyearmaster.isDeleted="0"  ORDER BY srp_academicyearmaster.SortOrder ASC');
        return $qry_selectAyMas->result();
    }
}
/*end next academic years filter*/

/*common default currency filter*/
if (!function_exists('getDefault_currency')) {
    function getDefault_currency()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $qry_defCurrency = $CI->db->query("SELECT CurrencyID,CurrencyDes,CurrencyShortCode,DecimalPlaces,CurrencyShortCodeOther FROM srp_currencymaster WHERE isDefault='1' AND SchMasterID='" . $_SESSION['schID'] . "' AND BranchID='" . $_SESSION['branchID'] . "' AND isDeleted='0'");
        } else {
            $qry_defCurrency = $CI->db->query("SELECT CurrencyID,CurrencyDes,CurrencyShortCode,DecimalPlaces,CurrencyShortCodeOther FROM srp_currencymaster WHERE isDefault='1' AND SchMasterID='" . $_SESSION['schID'] . "' AND isDeleted='0'");
        }
        $currency = $qry_defCurrency->row();

        if (empty($currency)) {
            $currencyArr = '';
        } else {
            $currencyArr = $currency;
        }

        return $currencyArr;
    }
}
/*end of default currency filter*/

/*common logged school and branch details*/
/*common logged school*/
if (!function_exists('getLogged_school')) {
    function getLogged_school()
    {
        $CI = &get_instance();
        $query_getSch = $CI->db->query("SELECT SchNameEn,SchNameOther,SchLogo,SchShortCode,SecondarySchLogo FROM srp_schoolmaster WHERE SchMasterID='" . $_SESSION['schID'] . "'");
        return $query_getSch->row();
    }
}
/*common logged school-branch */
if (!function_exists('getLogged_schBranch')) {
    function getLogged_schBranch()
    {
        $CI = &get_instance();
        $query_getSchBranch = $CI->db->query("SELECT BranchDes,BranchDesOther,Address1,Telephone1,Telephone2,Telephone3,PO_Box,PostalCode,FaxNo1,PrimaryEmailID,SecondaryEmailID,URL1 FROM srp_schbranches WHERE branchID='" . $_SESSION['branchID'] . "' AND schMasterID = '" . $_SESSION['schID'] . "'");
        return $query_getSchBranch->row();
    }
}
/*end of logged school and branch filters*/
/*common logged employee details */
if (!function_exists('get_loggedInEmployee')) {
    function get_loggedInEmployee()
    {
        $CI = &get_instance();
        $query_getLoggedInEmp = $CI->db->query("SELECT EIdNo,Ename1,EEmail,Password,languageID FROM srp_employeesdetails WHERE (EIdNo = '" . $_SESSION['UserID'] . "' AND isDeleted='0') AND (SchMasterID='" . $_SESSION['schID'] . "' AND BranchID='" . $_SESSION['branchID'] . "')");
        return $query_getLoggedInEmp->row();
    }
}
/*end of logged employee details filter*/
/*common gender Filters */
if (!function_exists('load_genders_drop')) {
    function load_genders_drop()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $gender_fill = $CI->db->query('SELECT srp_gender.GenderID,srp_gender.GenderCode,srp_gender.GenderEn,srp_gender.GenderAr,srp_gender.isGenDefault,srp_genderdefault.GenDefId FROM srp_gender INNER JOIN srp_genderdefault ON srp_genderdefault.GenderCode = srp_gender.GenderCode WHERE (SchMasterId = "' . $_SESSION['schID'] . '" AND BranchID ="' . $_SESSION['branchID'] . '")');
        } else {
            $gender_fill = $CI->db->query('SELECT srp_gender.GenderID,srp_gender.GenderCode,srp_gender.GenderEn,srp_gender.GenderAr,srp_gender.isGenDefault,srp_genderdefault.GenDefId FROM srp_gender INNER JOIN srp_genderdefault ON srp_genderdefault.GenderCode = srp_gender.GenderCode WHERE (SchMasterId = "' . $_SESSION['schID'] . '")');
        }
        return $gender_fill->result();
    }
}
if (!function_exists('get_default_gender')) {
    function get_default_gender()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $defGender = $CI->db->query('SELECT srp_gender.GenderID,srp_gender.GenderCode,srp_gender.isGenDefault,srp_genderdefault.GenDefId FROM srp_gender INNER JOIN srp_genderdefault ON srp_genderdefault.GenderCode = srp_gender.GenderCode WHERE (SchMasterId = "' . $_SESSION['schID'] . '" AND BranchID ="' . $_SESSION['branchID'] . '") AND isGenDefault = "1"');
        } else {
            $defGender = $CI->db->query('SELECT srp_gender.GenderID,srp_gender.GenderCode,srp_gender.isGenDefault,srp_genderdefault.GenDefId FROM srp_gender INNER JOIN srp_genderdefault ON srp_genderdefault.GenderCode = srp_gender.GenderCode WHERE (SchMasterId = "' . $_SESSION['schID'] . '") AND isGenDefault = "1"');
        }
        return $defGender->row();
    }
}
/*end of gender details filter*/
/*common Country Filters */
if (!function_exists('load_country_drop')) {
    function load_country_drop()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $country_fill = $CI->db->query("SELECT countryID,countryShortCode,CountryDes,CountryDesOther,CountryTelCode,CountryTimeZone,countryMasterID,isCountryDefault FROM srp_countrymaster WHERE (SchMasterId='" . $_SESSION['schID'] . "' AND BranchID='" . $_SESSION['branchID'] . "')");
        } else {
            $country_fill = $CI->db->query("SELECT countryID,countryShortCode,CountryDes,CountryDesOther,CountryTelCode,CountryTimeZone,countryMasterID,isCountryDefault FROM srp_countrymaster WHERE (SchMasterId='" . $_SESSION['schID'] . "')");
        }
        return $country_fill->result();
    }
}
if (!function_exists('get_default_country')) {
    function get_default_country()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $defCountry = $CI->db->query("SELECT countryID,CountryDes,CountryDesOther FROM srp_countrymaster WHERE (SchMasterId='" . $_SESSION['schID'] . "' AND BranchID='" . $_SESSION['branchID'] . "' AND isCountryDefault='1')");
        } else {
            $defCountry = $CI->db->query("SELECT countryID,CountryDes,CountryDesOther FROM srp_countrymaster WHERE (SchMasterId='" . $_SESSION['schID'] . "' AND isCountryDefault='1')");
        }
        return $defCountry->row();
    }
}
/*end of Country details filter*/
/*common Nationality Filter */
if (!function_exists('load_nationality_drop')) {
    function load_nationality_drop()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $nationality_fill = $CI->db->query("SELECT NId,Nationality,NationalityAr,Erp_companyID,countryID FROM srp_nationality WHERE (SchMasterID='" . $_SESSION['schID'] . "' AND BranchID='" . $_SESSION['branchID'] . "')");
        } else {
            $nationality_fill = $CI->db->query("SELECT NId,Nationality,NationalityAr,Erp_companyID,countryID FROM srp_nationality WHERE (SchMasterID='" . $_SESSION['schID'] . "')");
        }
        return $nationality_fill->result();
    }
}

if (!function_exists('load_area_drop')) {
    function load_area_drop()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $nationality_fill = $CI->db->query("SELECT * FROM srp_area WHERE (SchMasterID='" . $_SESSION['schID'] . "' AND BranchID='" . $_SESSION['branchID'] . "')");
        } else {
            $nationality_fill = $CI->db->query("SELECT * FROM srp_area WHERE (SchMasterID='" . $_SESSION['schID'] . "')");
        }
        return $nationality_fill->result();
    }
}

if (!function_exists('load_avg_monthly_income_drop')) {
    function load_avg_monthly_income_drop()
    {
        // $CI =& get_instance();
        // $CI->db->SELECT("AvgMonthIncome");
        // $CI->db->FROM('srp_avg_monthly_income');
        // $CI->db->where('isdeleted', '0');
        // $cntry = $CI->db->get()->result_array();

        // return $cntry;

        $CI = &get_instance();
        $data = $CI->db->query("SELECT AvgMonthlyIncomeID, AvgMonthIncome FROM srp_avg_monthly_income WHERE isdeleted='0'")->result();
        // $data = $CI->db->query("SELECT *,CASE WHEN description = \"Arabic\" THEN \"ع\" 	WHEN description = \"English\" THEN	\"ENG\" END `languageshortcode` FROM srp_erp_lang_languages Where isActive = 1 ORDER BY languageID DESC")->result_array();
        return $data;

        // if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
        //     $monthly_income = $CI->db->query("SELECT AvgMonthIncome FROM srp_avg_monthly_income WHERE isdeleted='0'");
        // } else {
        //     $monthly_income = $CI->db->query("SELECT AvgMonthIncome FROM srp_avg_monthly_income WHERE isdeleted='0'");
        // }
        // return $monthly_income->result();
    }
}


if (!function_exists('load_parent_occupation_drop')) {
    function load_parent_occupation_drop()
    {

        $CI = &get_instance();
        $data = $CI->db->query("SELECT ParentOccupationID, ParentOccupation FROM srp_parent_occupation WHERE isdeleted='0'")->result();
        return $data;
    }
}

if (!function_exists('load_blood_group')) {
    function load_blood_group()
    {

        $CI = &get_instance();
        $data = $CI->db->query("SELECT BloodGroupID, BloodGroupDes FROM srp_bloodgroups")->result();
        return $data;
    }
}


if (!function_exists('load_teacher_school_drop')) {
    function load_teacher_school_drop()
    {
        connect_applicationDB('');
        $CI = &get_instance();
        //$data = $CI->db->query("SELECT SchMasterID, SchNameEn FROM srp_schoolmaster WHERE IsActive='1' AND isLive='1'")->result();
        $data = $CI->db->query("SELECT * FROM srp_schbranches INNER JOIN srp_schoolmaster ON srp_schbranches.schMasterID = srp_schoolmaster.SchMasterID")->result();
        connect_schoolDB('1', $_SESSION['schID'], '', '', '', '', '');
       
       
        return $data;
    }
}


/*end of Nationality details filter*/
/*common People's Title Filter */
if (!function_exists('load_titles_drop')) {
    function load_titles_drop()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $title_fill = $CI->db->query('SELECT TitleID,TitleDescription,Erp_companyID FROM srp_titlemaster WHERE (SchMasterId="' . $_SESSION['schID'] . '" AND BranchID="' . $_SESSION['branchID'] . '")');
        } else {
            $title_fill = $CI->db->query('SELECT TitleID,TitleDescription,Erp_companyID FROM srp_titlemaster WHERE (SchMasterId="' . $_SESSION['schID'] . '")');
        }
        return $title_fill->result();
    }
}
/*end of People's Title details filter*/
/*common People's Title Filter */
if (!function_exists('load_religions_drop')) {
    function load_religions_drop()
    {
        $CI = &get_instance();
        if ($_SESSION['Policy'][47] == '0' || $_SESSION['Policy'][47] == null) {
            $religion_fill = $CI->db->query('SELECT RId,Religion,ReligionAr,Erp_companyID FROM srp_religion WHERE (SchMasterID="' . $_SESSION['schID'] . '" AND BranchID="' . $_SESSION['branchID'] . '")');
        } else {
            $religion_fill = $CI->db->query('SELECT RId,Religion,ReligionAr,Erp_companyID FROM srp_religion WHERE (SchMasterID="' . $_SESSION['schID'] . '")');
        }
        return $religion_fill->result();
    }
}
/*end of People's Title details filter*/
/*common People's Title Filter */
if (!function_exists('load_second_language_drop')) {
    function load_second_language_drop()
    {
        $CI = &get_instance();
        $religion_fill = $CI->db->query('SELECT * FROM srp_secondlanguage WHERE (srp_secondlanguage.SchMasterID="' . $_SESSION['schID'] . '" AND srp_secondlanguage.BranchID="' . $_SESSION['branchID'] . '")');
        $res = $religion_fill->result();
        $DataArray = array();
        foreach ($res as $row) {
            $subject = '-';
            if($row->linked_subject_id != null && $row->linked_subject_id != ''){
                $religion_fill1 = $CI->db->query('SELECT SubId,SubjectE FROM srp_subjects  WHERE SyllabusID="' . $_SESSION['SyllabusID'] . '" AND SchMasterID="' . $_SESSION['schID'] . '" AND branchID="' . $_SESSION['branchID'] . '" AND isDeleted ="0" AND SubId = "'.$row->linked_subject_id.'" ');
                $res1 = $religion_fill1->row();
                $subject = $res1->SubjectE;
            }
                
            $data = array(
                "SecondLanguageID"=> $row->SecondLanguageID,
                "SecondLanguage" => $row->SecondLanguage, 
                "is_link_subject" => $row->is_link_subject,
                "linked_subject" => $subject,
            );
            $DataArray[] = $data;
        }
        return $DataArray;
    }
}
/*end of People's Title details filter*/

/*start of Date Timezone*/
if (!function_exists('get_default_timezonedetail')) {
    function get_default_timezonedetail()
    {
        $CI = &get_instance();
        $CI->db->select('srp_erp_timezonedetail.description');
        $CI->db->join('srp_erp_timezonedetail', 'srp_erp_company.defaultTimezoneID= srp_erp_timezonedetail.detailID', 'LEFT OUTER');
        return $CI->db->where('company_link_id', $_SESSION['schID'])->get('srp_erp_company')->row();
    }
}
/*end of Date Timezone*/

/**
 * Created by PhpStorm.
 * User: Moufiya
 * Date: 09/12/2015
 * Time: 17:01
 */