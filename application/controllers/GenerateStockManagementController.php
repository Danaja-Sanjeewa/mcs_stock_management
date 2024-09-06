<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GenerateStockManagementController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('GenerateStockManagementModel');
    }
    
	public function index()
	{
        $result['templateView'] = 'login';

        $this->load->model('GenerateStockManagementModel');
        $data['branchList'] = $this->GenerateStockManagementModel->getBranchList();
        $data['categoryList'] = $this->GenerateStockManagementModel->getCategoryList();

        $data['title'] = 'StockMangement | Welcome';
        $data['main_content'] = 'GenerateStockManagementView';
        $data['extra'] = NULL;
        $this->load->view('includes/template', $data);
	}

    public function geneareteItems()
    {
        $item_category = $_POST['item_category'];
        $this->load->model('GenerateStockManagementModel');
        $this->GenerateStockManagementModel->geneareteItems($item_category);
    }

    public function postData()
    {
        $update_date = $_POST['update_date'];
        $branch = $_POST['branch'];
        $item = $_POST['item'];
        $balance_stock_quantity_K = $_POST['balance_stock_quantity_K'];
        $balance_stock_quantity_G = $_POST['balance_stock_quantity_G'];

        $this->load->model('GenerateStockManagementModel');
        $this->GenerateStockManagementModel->postData($update_date, $branch, $item, $balance_stock_quantity_K, $balance_stock_quantity_G);
    }
}
