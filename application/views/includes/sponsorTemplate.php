<?php
if (isset($_SESSION['sponsorUsername'], $_SESSION['sponsorUserID'])) {



    $this->load->view('includes/sponsorHeader',$title);
    $this->load->view('includes/sponsorNav',$title);
    $this->load->view($main_content,$extra);
//$this->load->view('includes/adminControlNav');
    $this->load->view('includes/sponsorFooter');


}