<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//if (!function_exists('Srp_encrypt')) {
//
//    function Srp_encrypt($data, $key) {
//        // Remove the base64 encoding from our key
//        $encryption_key = base64_decode($key);
//        // Generate an initialization vector
//        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
//        // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
//        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
//        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
//        return base64_encode($encrypted . '::' . $iv);
//    }
//
//}
//
//if (!function_exists('Srp_decrypt')) {
//
//function Srp_decrypt($data, $key) {
//    // Remove the base64 encoding from our key
//    $encryption_key = base64_decode($key);
//    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
//    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
//    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
//}
//
//}

if (!function_exists('EncryptDecrypt')) {

    function Srp_encrypt_decrypt($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'MrvLLpPWtT';
        $secret_iv = 'VftfjXfVrh';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

}

if (!function_exists('timer')) {

    function timer($endTime) {
        session_start();
        //unset($_SESSION['exam_attempt']);exit;

        if (!isset($_SESSION['exam_attempt'])) {
            $x = strtotime($endTime) - time();
            if ($x < 1) {
                echo 'exam expired';
            } else {
                $_SESSION['exam_attempt'] = "";
                if (!isset($_SESSION['countdown'])) {
                    //Set the countdown to 120 seconds.
                    $_SESSION['countdown'] = 20;
                    //Store the timestamp of when the countdown began.
                    $_SESSION['time_started'] = time();
                }
                $now = time();

                $timeSince = $now - $_SESSION['time_started'];

                $remainingSeconds = $_SESSION['countdown'] - $timeSince;

                echo "There are $remainingSeconds seconds remaining.";
            }
        } else {
            if (!isset($_SESSION['countdown'])) {
                //Set the countdown to 120 seconds.
                $_SESSION['countdown'] = 20;
                //Store the timestamp of when the countdown began.
                $_SESSION['time_started'] = time();
            }

            $now = time();

            $timeSince = $now - $_SESSION['time_started'];

            $remainingSeconds = $_SESSION['countdown'] - $timeSince;

            echo "There are $remainingSeconds seconds remaining.";

            if ($remainingSeconds < 1) {

                unset($_SESSION['countdown']);
                unset($_SESSION['time_started']);
            }
        }
    }

}






