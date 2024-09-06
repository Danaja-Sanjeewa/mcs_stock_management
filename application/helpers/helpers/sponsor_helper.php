<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



if (!function_exists('getSponsorPrimaryLanguage')) {
    function getSponsorPrimaryLanguage()
    {
        $CI =& get_instance();
        $CI->load->library('sponsor_language');
        $language = $CI->sponsor_language->getSponsorPrimaryLanguage();

        return $language;
    }
}

if(!function_exists('getStudentExams')) {

    function getStudentExams($sponsorId,$sponsorSchMasterID,$sponsorbranchID,$sponsorSyllabusID)
    {
        connect_schoolDB('1',$sponsorSchMasterID,'','','','','');

        $CI =& get_instance();
        $query = $CI->db->query('SELECT srp_studentdetails.StudentID,srp_studentdetails.studentCode,fName,studentCourseHours,isHired,SponsorId,srp_classes.Class,srp_studentdetails.ClassId,srp_studentdetails.GrpID,AverageMarks,srp_syllabusmaster.SyllabusID
                                        FROM srp_studentdetails 
                                        INNER JOIN srp_classes ON srp_studentdetails.ClassId=srp_classes.ClassId 
                                        INNER JOIN srp_syllabusmaster ON srp_classes.SyllabusID = srp_syllabusmaster.SyllabusID
                                        LEFT JOIN (SELECT StudentID, ROUND(AVG(Marks),2) AS AverageMarks FROM srp_marks GROUP BY StudentID) as stuAvg ON srp_studentdetails.StudentID=stuAvg.StudentID 
                                        WHERE (srp_studentdetails.SchMasterID="' . $sponsorSchMasterID . '"  AND srp_studentdetails.BranchID="' . $sponsorbranchID . '" ) AND srp_studentdetails.SponsorId='.$sponsorId.' AND isHired=1 AND srp_syllabusmaster.SyllabusID="' . $sponsorSyllabusID . '" ');

        return $query->result_array();


    }

}

if(!function_exists('getMarkingSchm')) {

    function getMarkingSchm($ClassId,$GrpID,$sponsorSchMasterID,$sponsorBranchID)
    {

        $CI =& get_instance();

        connect_schoolDB('1',$sponsorSchMasterID,'','','','','');

        $filter_var = array("AND (GradeID=".$ClassId.")"=>$ClassId, "AND (GrpID=" . $GrpID . ")" => $GrpID);
        $set_filter_var = array_filter($filter_var);
        $where_clause =  join(" ",array_keys($set_filter_var));

        //  $acyear=getActive_academicYear();
        $query = $CI->db->query('SELECT MarkFrom,MarkTo,Grade FROM srp_marking_scheme WHERE (SchMasterID="' . $sponsorSchMasterID . '"  AND BranchID="' . $sponsorBranchID . '") AND AcademicYearID="' .$_SESSION['sponsorActiveAY'] . '" '.$where_clause.' AND SubID= -1 ');

        return $query->result_array();
    }

}

if(!function_exists('getHiredStudentDetails')){

    function getHiredStudentDetails($sponsorId,$sponsorSchMasterID,$sponsorbranchID,$sponsorSyllabusID)
    {
        connect_schoolDB('1',$sponsorSchMasterID,'','','','','');
        $CI =& get_instance();
        $query = $CI->db->query('SELECT srp_studentdetails.StudentID,srp_studentdetails.studentCode,fName,studentCourseHours,SponsorId,srp_classes.Class,srp_studentdetails.ClassId,srp_studentdetails.GrpID,srp_syllabusmaster.SyllabusID
                                        FROM srp_studentdetails 
                                        INNER JOIN srp_classes ON srp_studentdetails.ClassId=srp_classes.ClassId 
                                        INNER JOIN srp_syllabusmaster ON srp_classes.SyllabusID = srp_syllabusmaster.SyllabusID
                                        WHERE (srp_studentdetails.SchMasterID="' . $sponsorSchMasterID . '"  AND srp_studentdetails.BranchID="' . $sponsorbranchID . '" ) AND srp_studentdetails.SponsorId='.$sponsorId.' AND isHired=1 AND srp_syllabusmaster.SyllabusID="' . $sponsorSyllabusID . '" ');

        return $query->result_array();
    }
}

if(!function_exists('get_schoolDetails')){

    function get_schoolDetails($sponsorSchMasterID,$sponsorBranchID,$sponsorSyllabusID)
    {
        connect_schoolDB('1',$sponsorSchMasterID,'','','','','');
        $CI =& get_instance();
        $query = $CI->db->query("SELECT  srp_schbranches.BranchDes,srp_schoolmaster.SchNameEn,srp_syllabusmaster.SyllabusDescription
                                   FROM srp_schbranches 
                                   INNER JOIN srp_schoolmaster ON srp_schoolmaster.SchMasterID=srp_schbranches.schMasterID 
                                   INNER JOIN srp_syllabusmaster ON srp_syllabusmaster.SchMasterID=srp_schoolmaster.SchMasterID
                                   WHERE (srp_schbranches.branchID='" . $sponsorBranchID . "' AND srp_schoolmaster.SchMasterID='" . $sponsorSchMasterID . "' AND srp_syllabusmaster.SyllabusID='" . $sponsorSyllabusID . "' ) ");

        return $query->row_array();
    }
}


if (!function_exists('spo_drill_down_emp_language')) {
    function spo_drill_down_emp_language()
    {
        $CI =& get_instance();
        $data = $CI->db->query("SELECT *,CASE WHEN description = \"Arabic\" THEN \"ع\" 	WHEN description = \"English\" THEN	\"ENG\" END `languageshortcode` FROM srp_erp_lang_languages Where isActive = 1 ORDER BY languageID DESC")->result_array();
        return $data;
    }
}


/*header*/
if (!function_exists('sponsor_head_page')) {
    function sponsor_head_page($heading, $heading_small, $breadcrumb, $sub_heading, $status, $pageButtons)
    {
        $filter = '';
        if ($status) {
            $filter = '<a data-toggle="collapse" data-target="#filter-panel"><i class="fa fa-filter"></i></a>';
        }

        if(isset($_SESSION['sponsorActiveAY'])) {
            $CI =& get_instance();
            connect_schoolDB('1',$_SESSION['sponsorSchMasterID'],'','','','','');

            $query_AY = $CI->db->get_where("srp_academicyearmaster", array("AY_AutoID" => $_SESSION['sponsorActiveAY']));
            $res_AY = $query_AY->row();

            if(!empty($res_AY)) {
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
if (!function_exists('sponsor_footer_page')) {
    function sponsor_footer_page($right_foot, $left_foot, $status)
    {
        if ($status) {
            return '</div><div class="box-footer">' . $right_foot . '</div></div></section></div>';
        } else {
            return '</div></div></section></div>';
        }
    }
}

//Email Configuration
if (!function_exists('Sponsor_Send_Email')) {
    function Sponsor_Send_Email($ReciptientMail, $ReciptientName, $Subject, $HTML_Body, $NonHTML_Body)
    {

        require_once ('PHPMailer-master/PHPMailerAutoload.php');

        $mail = new PHPMailer;

        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mx-s3.vivawebhost.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'support@pbs-int.com';                 // SMTP username
        $mail->Password = 'Root@22112019';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        $mail->setFrom('support@pbs-int.com', 'Info ecSRP');
        $mail->addAddress($ReciptientMail, $ReciptientName);     // Add a recipient
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

        if(!$mail->send()) {
            return 'Message could not be sent';
            //echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message sent';
        }

    }
}

