<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//send sms
if (!function_exists('send_sms')) {
    function send_sms($URL,$UserID,$APIKey,$SenderID,$Gateway,$ContactNo,$message)
    {
        $CI =& get_instance();

        if($Gateway=='Notify.lk')
        {
            $url='';
            $data = array(
                'user_id' => $UserID,
                'api_key' => $APIKey,
                'sender_id' => $SenderID,
                'to' => $ContactNo,
                'message' => $message,
            );

            $url = $URL . '?' . http_build_query($data);

         $headers = array (
        'Content-Type: application/json'
        );
        }
        else if($Gateway=='Newsletters.lk')
        {
            $url='';
            $data = array(
                'apikey' => $APIKey,
                'apitoken' => $UserID,
                'type' => 'sms',
                'from' => $SenderID,
                'to' => $ContactNo,
                'text' => $message,
            );

            $url = $URL . '?sendsms&' . http_build_query($data);

            $headers = array (
                'Content-Type: application/json'
            );
        }
        else if($Gateway=='Dialog.lk')
        {
            error_reporting(E_ALL);
            date_default_timezone_set('Asia/Colombo');
            $now = date("Y-m-d\TH:i:s");
            $username = $UserID;
            $password = $APIKey;
            $digest=md5($password);

            $data = '{"messages": [
            {"clientRef": "0934345",
            "number": "'.$ContactNo.'",
            "mask": "'.$SenderID.'",
            "text": "'.$message.'",
            "campaignName":""}]}';

            $url = $URL;

            $headers = ['Content-Type: application/json','USER: '.$username,
                'DIGEST: '.$digest,'CREATED: '.$now];
        }else if($Gateway=='Mrnotify.lk')
        {
            $url = $URL;
            $data = array(
                'msisdn' => $ContactNo,
                'name' => $SenderID,
                'message' => $message
            );

            $headers = array (
                'Content-Type: application/json',
                'Apikey: '.$APIKey,
                'Accept: application/json'
            );
        }

        $ch = curl_init ();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt ( $ch, CURLOPT_URL, $url);
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, json_encode($data) );

        $result = curl_exec ( $ch );
        curl_close ( $ch );

        return true;

    }
}
//Check sms configuration
if (!function_exists('get_SMSGatewayDetails')) {
    function get_SMSGatewayDetails()
    {
        $CI =& get_instance();

        $query = $CI->db->query("SELECT * FROM srp_smsconfiguration INNER JOIN srp_sys_gatewaymaster ON srp_sys_gatewaymaster.GatewayID=srp_smsconfiguration.GatewayID WHERE isActive = '1' AND SchMasterID = '".$_SESSION['schID']."' AND BranchID = '".$_SESSION['branchID']."' AND isDeleted = '0'");
        $res = $query->row();

        if(!empty($res)) {
            $config=array(
                "Message" => 'done',
                "UserID" => $res->UserID,
                "APIKey" => $res->APIKey,
                "SenderID" => $res->SenderID,
                "Gateway" => $res->Gateway,
                "URL" => $res->URL);

        } else {
            $config=array(
                "Message" => 'fail');
        }
        return  $config;
    }
}

//Check sms configuration
if (!function_exists('check_sms_n_notification_setup')) {
    function check_sms_n_notification_setup($documentType)
    {
        $CI =& get_instance();

        $query = $CI->db->query("SELECT * FROM srp_smsconfiguration INNER JOIN srp_sys_gatewaymaster ON srp_sys_gatewaymaster.GatewayID=srp_smsconfiguration.GatewayID WHERE isActive = '1' AND SchMasterID = '".$_SESSION['schID']."' AND BranchID = '".$_SESSION['branchID']."' AND isDeleted = '0'");
        $smsconfig = $query->row();

        $query = $CI->db->query("SELECT IsSMS,IsNotification FROM `srp_smsconfiguration_setup` where SchMasterID='".$_SESSION['schID']."' AND branchID='".$_SESSION['branchID']."' AND SMSSetupID='".$documentType."'");
        $res = $query->row();
        $a['data']=$res;
        $a['smsconfig']=$smsconfig;
        return ($a);

    }
}

//Check sms configuration parent portal
if (!function_exists('check_sms_n_notification_setup_parent')) {
    function check_sms_n_notification_setup_parent($documentType,$schlID,$branchID)
    {
        $CI =& get_instance();

        $query = $CI->db->query("SELECT * FROM srp_smsconfiguration INNER JOIN srp_sys_gatewaymaster ON srp_sys_gatewaymaster.GatewayID=srp_smsconfiguration.GatewayID WHERE isActive = '1' AND SchMasterID = '".$schlID."' AND BranchID = '".$branchID."' AND isDeleted = '0'");
        $smsconfig = $query->row();

        $query = $CI->db->query("SELECT IsSMS,IsNotification FROM `srp_smsconfiguration_setup` where SchMasterID='".$schlID."' AND branchID='".$branchID."' AND SMSSetupID='".$documentType."'");
        $res = $query->row();
        $a['data']=$res;
        $a['smsconfig']=$smsconfig;
        return ($a);

    }
}






/**
 * Created by PhpStorm.
 * User: Muditha
 * Date: 7/30/2019
 * Time: 11:13 AM
 */