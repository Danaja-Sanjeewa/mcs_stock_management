<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('check_server')) {
    function check_server()
    {
        // If image get from AWS server return value should be 'cloud'.Other than 'local'
        return 'cloud';
    }
}

//load Image
if (!function_exists('load_image')) {
    function load_image($server_status, $Image)
    {
        if ($server_status == 'cloud') {
            $CI = &get_instance();
            $CI->load->library('s3');
            $display_image = $CI->s3->getMyAuthenticatedURL($Image, 3600);
        } else {
            $display_image = base_url('ref/images/' . $Image);
        }
        return $display_image;
    }
}
//load Image
if (!function_exists('load_image_thumb')) {
    function load_image_thumb($server_status, $Image)
    {
        if ($server_status == 'cloud') {
            $CI = &get_instance();
            $CI->load->library('s3');
            $display_image = $CI->s3->getMyAuthenticatedURL($Image, 3600);
            if (!$CI->s3->getMyObjectInfo($Image)) {
                $display_image = base_url('ref/images/' . '1.png');
            }else if($Image==''||$Image==null){
                $display_image = base_url('ref/images/' . '1.png');
            }
        } else {
            $display_image = base_url('ref/images/' . $Image);
        }
        return $display_image;
    }
}

//upload Image S3
if (!function_exists('upload_image_s3')) {
    function upload_image_s3($fileUpload, $allowedTypes, $maxSiz, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $s3FolderName, $IsThumbnail, $ThumbnailFolder, $UploadTypeMasterID)
    {
        $CI = &get_instance();
        $CI->load->model('Srp_UploadModel');
        $CI->Srp_UploadModel->upload_s3_image($fileUpload, $allowedTypes, $maxSiz, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $s3FolderName, $IsThumbnail, $ThumbnailFolder, $UploadTypeMasterID);
    }
}

//upload Image S3-FeeDocs
if (!function_exists('upload_image_s3_FeeDocs')) {
    function upload_image_s3_FeeDocs($fileUpload, $allowedTypes, $maxSiz, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $s3FolderName, $IsThumbnail, $ThumbnailFolder, $UploadTypeMasterID)
    {
        $CI = &get_instance();
        $CI->load->model('Srp_UploadModel');
        $CI->Srp_UploadModel->upload_image_s3_FeeDocs($fileUpload, $allowedTypes, $maxSiz, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $s3FolderName, $IsThumbnail, $ThumbnailFolder, $UploadTypeMasterID);
    }
}


//upload Portal Image S3
if (!function_exists('upload_portal_image_s3')) {
    function upload_portal_image_s3($fileUpload, $allowedTypes, $maxSiz, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $s3FolderName)
    {
        $CI = &get_instance();
        $CI->load->model('Srp_UploadModel');
        $CI->Srp_UploadModel->upload_portal_image_s3($fileUpload, $allowedTypes, $maxSiz, $TableName, $FieldName, $UniqueFieldName, $UniqueFieldID, $Image_Prefix, $s3FolderName);
    }
}

//upload Multiple Image S3
if (!function_exists('upload_multiple_s3_image')) {
    function upload_multiple_s3_image($fileUpload, $allowedTypes, $maxSiz, $Image_Prefix, $s3FolderName, $key, $UploadCom)
    {
        $CI = &get_instance();
        $CI->load->model('Srp_UploadModel');
        $fileName = $CI->Srp_UploadModel->upload_multiple_s3_image($fileUpload, $allowedTypes, $maxSiz, $Image_Prefix, $s3FolderName, $key, $UploadCom);
        return $fileName;
    }
}

//upload Portal Multiple Image S3
if (!function_exists('upload_portal_multiple_s3_image')) {
    function upload_portal_multiple_s3_image($fileUpload, $allowedTypes, $maxSiz, $Image_Prefix, $s3FolderName, $key, $UploadCom)
    {
        $CI = &get_instance();
        $CI->load->model('Srp_UploadModel');
        $fileName = $CI->Srp_UploadModel->upload_portal_multiple_s3_image($fileUpload, $allowedTypes, $maxSiz, $Image_Prefix, $s3FolderName, $key, $UploadCom);
        return $fileName;
    }
}
