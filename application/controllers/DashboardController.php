<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function index()
	{
		// $this->load->view('welcome_message');

		// $this->load->model('Srp_getTemplateModel');
        // $result['templateView'] = $this->Srp_getTemplateModel->get_template('375');
        $result['templateView'] = 'login';

        // $this->load->model('Srp_af_imageGalleryModel');
        // $data['employeeId'] = $this->Srp_af_imageGalleryModel->employeeId();
        // $data['classes'] = $this->Srp_af_imageGalleryModel->get_classes();
        // $data['albums'] = $this->Srp_af_imageGalleryModel->get_albums();
        // $data['assClasses'] = $this->Srp_af_imageGalleryModel->get_assignClasses();
        // $data['images'] = $this->Srp_af_imageGalleryModel->get_images();

        $data['title'] = 'StockMangement | Welcome';
        // $data['main_content'] = $result['templateView']->TempPageName;
        $data['main_content'] = 'dashboardView';
        $data['extra'] = NULL;
        $this->load->view('includes/template', $data);
	}
}
