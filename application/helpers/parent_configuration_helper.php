<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//parent discount calculation
if (!function_exists('parent_siblingDiscounts')) {
    function parent_siblingDiscounts($OtherFeeSetupID,$AY,$StuID,$schMasterId,$branchId)
    {

        $CI =& get_instance();

        //Sibling discounts
        if($StuID == "" || $StuID == null || $StuID == '0') {
            $res_SiblingDis = array();
        } else {
            $query_SiblingDis = $CI->db->query("SELECT * FROM srp_disoraddstudentsetup INNER JOIN srp_disoraddsetup ON srp_disoraddsetup.DisOrAddSetupID = srp_disoraddstudentsetup.DisOrAddSetupID INNER JOIN srp_disoraddmaster ON srp_disoraddmaster.DisOrAddMasterID = srp_disoraddsetup.DisOrAddMasterID WHERE srp_disoraddsetup.SchMasterID = '" . $schMasterId . "' AND srp_disoraddsetup.BranchID = '" . $branchId . "' AND srp_disoraddsetup.AcademicYearID = '" . $AY . "' AND srp_disoraddstudentsetup.StuID = '" . $StuID . "' AND OtherFeeSetupID = '".$OtherFeeSetupID."' AND srp_disoraddmaster.isSiblingDiscount='1'");
            $res_SiblingDis = $query_SiblingDis->result();
        }

        $SiblingDisInAmount = 0;
        $SiblingDisInPercent = 0;
        foreach ($res_SiblingDis as $row_SiblingDis){
            if($row_SiblingDis->isPercentage == '1'){
                $SiblingDisInPercent += $row_SiblingDis->DisOrAddPercent;
            } else {
                $SiblingDisInAmount += $row_SiblingDis->DisOrAddPercent;
            }
        }


        $data = array(
            "SiblingDiscount_Amounts" => $SiblingDisInAmount,
            "SiblingDiscount_Percents" => $SiblingDisInPercent,
            "SiblingDicountDetails" => $res_SiblingDis
        );

        return $data;

    }
}

//discount calculation
if (!function_exists('ParentStuDiscounts')) {
    function ParentStuDiscounts($OtherFeeSetupID,$SelectionSurcesID,$filterDate,$EffetiveDate,$AY,$StuID,$SchMasterID,$branchID)
    {

        $CI =& get_instance();

        if ($SelectionSurcesID == '1' || $SelectionSurcesID == '2') { // Monthly or Termly

            $Date_beginning = date_create($EffetiveDate);
            $Date_end = date_create($filterDate);

            $diff = date_diff($Date_beginning, $Date_end);
            $day_diff_sign = $diff->format("%R");
            $day_diff = $diff->format("%a");

        }  else if ($SelectionSurcesID == '3') {//Yearly

            if($EffetiveDate=="" || $EffetiveDate == null){
                $Date_beginning = date_create($filterDate);
            } else {
                $Date_beginning = date_create($EffetiveDate);
            }

            $Date_end = date_create($filterDate);

            $diff = date_diff($Date_beginning, $Date_end);
            $day_diff_sign = $diff->format("%R");
            $day_diff = $diff->format("%a");

        } else { //One-time payment
            $day_diff_sign = '';
            $day_diff = 0;
        }

        $PenaltyOnLP = 0;
        $DiscountOnAP = 0;
        if($day_diff_sign == '+' && $EffetiveDate !='') {//Penalty
            $query_disPenalty = $CI->db->query("SELECT * FROM srp_feedisorpenaltysetup WHERE FeesSetupId = '" . $OtherFeeSetupID . "' AND isDeleted = '0' AND $day_diff >= `EffectedFrom` AND $day_diff <= `EffectedTo` ORDER BY EffectedTo DESC LIMIT 1");
            $res_disPenalty = $query_disPenalty->row();

            if(!empty($res_disPenalty)){
                $Discount = $res_disPenalty->PenaltyOnLP;
                $PenaltyOnLP = $res_disPenalty->PenaltyOnLP;
                $Status = "Overdue";
            } else {
                $Discount = 0;
                $PenaltyOnLP = 0;
                $Status = "Due";
            }

        } else if($day_diff_sign == '-' && $EffetiveDate !='') { //discount

            $query_disPenalty = $CI->db->query("SELECT * FROM srp_feedisorpenaltysetup WHERE FeesSetupId = '" . $OtherFeeSetupID . "' AND isDeleted = '0' AND $day_diff >= `EffectedFrom` AND $day_diff <= `EffectedTo` ORDER BY EffectedFrom ASC LIMIT 1");
            $res_disPenalty = $query_disPenalty->row();

            if(!empty($res_disPenalty)){
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
        if(!empty($res_isDisOrPenInPercent)){
            $isDisOrPenaltyInPercent = $res_isDisOrPenInPercent->isDisOrPenaltyInPercentage;
        } else {
            $isDisOrPenaltyInPercent = 1;
        }

        //special discounts
        if($StuID == "" || $StuID == null || $StuID == '0') {
            $res_specialDis = array();
        } else {
            $query_specialDis = $CI->db->query("SELECT * FROM srp_disoraddstudentsetup INNER JOIN srp_disoraddsetup ON srp_disoraddsetup.DisOrAddSetupID = srp_disoraddstudentsetup.DisOrAddSetupID INNER JOIN srp_disoraddmaster ON srp_disoraddmaster.DisOrAddMasterID = srp_disoraddsetup.DisOrAddMasterID WHERE srp_disoraddsetup.AcademicYearID = '" . $AY . "' AND srp_disoraddstudentsetup.StuID = '" . $StuID . "' AND OtherFeeSetupID = '".$OtherFeeSetupID."' AND srp_disoraddsetup.SchMasterID = '" . $SchMasterID . "' AND srp_disoraddsetup.BranchID = '" . $branchID . "'");
            $res_specialDis = $query_specialDis->result();
        }

        //General discounts in percentage
        $query_generalDis = $CI->db->query("SELECT * FROM srp_disoraddmaster WHERE srp_disoraddmaster.SchMasterID = '" . $SchMasterID . "' AND srp_disoraddmaster.BranchID = '" . $branchID . "' AND isDiscount='2' AND isPercentage='1'");
        $res_generalDis = $query_generalDis->row();

        //General discounts in amount
        $qry_genDisAmount = $CI->db->query("SELECT * FROM srp_disoraddmaster WHERE srp_disoraddmaster.SchMasterID = '" . $SchMasterID . "' AND srp_disoraddmaster.BranchID = '" . $branchID . "' AND isDiscount='2' AND isPercentage='0'");
        $res_genDisAmount = $qry_genDisAmount->row();

        $SpecialDisInAmount = 0;
        $SpecialDisInPercent = 0;
        $SpeCntDisPer = 0;
        $SpeCntDisAmnt = 0;
        $SpeCntAditnPer = 0;
        $SpeCntAditnAmnt = 0;
        foreach ($res_specialDis as $row_specialDis){
            if($row_specialDis->isPercentage == '1'){
                $SpecialDisInPercent += $row_specialDis->DisOrAddPercent;
            } else {
                $SpecialDisInAmount += $row_specialDis->DisOrAddPercent;
            }

            if ($row_specialDis->isDiscount == '1') {
                if($row_specialDis->isPercentage == '1'){
                    $SpeCntDisPer += $row_specialDis->DisOrAddPercent;
                } else {
                    $SpeCntDisAmnt += $row_specialDis->DisOrAddPercent;
                }
            } else {
                if($row_specialDis->isPercentage == '1'){
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

/*start of Date Timezone*/
if (!function_exists('get_parent_default_timezonedetail')) {
    function get_parent_default_timezonedetail($schID)
    {
        $CI =& get_instance();
        $CI->db->select('srp_erp_timezonedetail.description');
        $CI->db->join('srp_erp_timezonedetail','srp_erp_company.defaultTimezoneID= srp_erp_timezonedetail.detailID','LEFT OUTER');
        return $CI->db->where('company_link_id', $schID)->get('srp_erp_company')->row();
    }
}

/**
 * Created by PhpStorm.
 * User: Moufiya
 * Date: 6/28/2019
 * Time: 12:17 PM
 */