<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateStockManagementController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('StockManagementModel');
    }
    
	public function index()
	{
        $result['templateView'] = 'login';

        $this->load->model('UpdateStockManagementModel');
        $data['branchList'] = $this->UpdateStockManagementModel->getBranchList();
        $data['itemList'] = $this->UpdateStockManagementModel->getItem();

        $data['title'] = 'StockMangement | Welcome';
        $data['main_content'] = 'UpdateStockView';
        $data['extra'] = NULL;
        $this->load->view('includes/template', $data);
	}

    public function geneareteItemData()
    {
        $item_code = $_POST['item_code'];
        $this->load->model('UpdateStockManagementModel');
        $this->UpdateStockManagementModel->geneareteItemData($item_code);
    }

    public function postData()
    {
        $update_date = $_POST['update_date'];
        $item_code = $_POST['item_code'];
        $new_stock_quantity = $_POST['new_stock_quantity'];
        $balance_stock_quantity = $_POST['balance_stock_quantity'];
        $current_stock_price = $_POST['current_stock_price'];
        $new_stock_price = $_POST['new_stock_price'];

        $this->load->model('UpdateStockManagementModel');
        $this->UpdateStockManagementModel->postData($update_date, $item_code, $balance_stock_quantity, $current_stock_price, $new_stock_quantity, $new_stock_price);
    }
}
