<?php
$this->load->view('includes/stuAdminHeader',$title);
$this->load->view('includes/adminNav',$title);
$this->load->view($main_content,$extra);
$this->load->view('includes/adminControlNav');
$this->load->view('includes/adminFooter');


/**
 * Created by PhpStorm.
 * User: Haaniya
 * Date: 03/06/2016
 * Time: 08:08 AM
 */