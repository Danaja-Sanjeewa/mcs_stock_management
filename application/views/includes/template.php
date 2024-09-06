<?php
$this->load->view('includes/mainHeader',$title);
// $this->load->view('includes/adminNav',$title);
$this->load->view($main_content,$extra); 
//$this->load->view('includes/adminControlNav');
$this->load->view('includes/mainFooter');