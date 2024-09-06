<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*header*/
if (!function_exists('Stu_head_page')) {
    function Stu_head_page($heading, $heading_small, $breadcrumb, $sub_heading, $status, $pageButtons)
    {
        $filter = '';
        if ($status) {
            $filter = '<a data-toggle="collapse" data-target="#filter-panel"><i class="fa fa-filter"></i></a>';
        }
        return '<div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        ' . $heading . '
                        <small>' . $heading_small . '</small>
                    </h1>
                 
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
// if (!function_exists('Stu_head_page')) {
//     function Stu_head_page($heading, $heading_small, $breadcrumb, $sub_heading, $status, $pageButtons)
//     {
//         $filter = '';
//         if ($status) {
//             $filter = '<a data-toggle="collapse" data-target="#filter-panel"><i class="fa fa-filter"></i></a>';
//         }
//         return '<div class="content-wrapper">
//                 <section class="content-header">
//                     <h1>
//                         ' . $heading . '
//                         <small>' . $heading_small . '</small>
//                     </h1>
//                     <ol class="breadcrumb">
//                         <li><a href="' . site_url('srp_ha_empDashboardController') . '"><i class="fa fa-dashboard"></i> Dashboard</a></li>
//                         ' . $breadcrumb . '
//                     </ol>
//                 </section>
//                 <section class="content">
//                       <div class="box box-primary">
//                         <div class="box-header with-border">
//                           <h3 class="box-title">' . $sub_heading . '</h3>
//                           <div class="box-tools pull-right">' . $pageButtons
//         . '</div>
//                         </div>
//                         <div class="box-body">';
//     }
// }


/*footer*/
if (!function_exists('Stu_footer_page')) {
    function Stu_footer_page($right_foot, $left_foot, $status)
    {
        if ($status) {
            return '</div><div class="box-footer">' . $right_foot . '</div></div></section></div>';
        } else {
            return '</div></div></section></div>';
        }
    }
}

//Section Header
if (!function_exists('Stu_Section_Header')) {
    function Stu_Section_Header($title,$Buttons,$responsiveClass,$header,$boxClass)
    {

        echo '<div class="'.$responsiveClass.'" style="padding:0px;">
                    <div class="box box-'.$boxClass.'" style="margin-bottom: 12px;">';
        if($header == '1'){
            echo '<div class="box-header with-border"><h3 class="box-title">' . $title . '</h3><div class="box-tools pull-right">' . $Buttons . '</div></div>';
        }
        echo '<div class="box-body">';
    }
}

//Section Footer
if (!function_exists('Stu_Section_Footer')) {
    function Stu_Section_Footer()
    {
        echo '</div></div></div>';
    }
}


/**
 * Created by PhpStorm.
 * User: Haaniya
 * Date: 03/06/2016
 * Time: 08:41 AM
 */