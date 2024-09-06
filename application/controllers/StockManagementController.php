<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StockManagementController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('StockManagementModel');
    }
    
	public function index()
	{
        $result['templateView'] = 'login';

        $this->load->model('StockManagementModel');
        $data['record'] = $this->StockManagementModel->getStock();
        // $data['dateFilter'] = $this->StockManagementModel->getStockDates();
        $data['categoryFilter'] = $this->StockManagementModel->getStockByCategories();
        $data['itemFilter'] = $this->StockManagementModel->getStockItem();
        $data['qtyFilter'] = $this->StockManagementModel->getStockQty();

        $data['title'] = 'StockMangement | Welcome';
        $data['main_content'] = 'StockManagementView';
        $data['extra'] = NULL;
        $this->load->view('includes/template', $data);
	}
    public function filterOption()
    {
        $stockDate = $_POST['dateFilter'];
        $category = $_POST['categoryFilter'];
        $item = $_POST['itemFilter'];
        $finalQty = $_POST['qtyFilter'];

        $this->load->model('StockManagementModel');
        $this->StockManagementModel->filterOption($stockDate, $category, $item, $finalQty);
    }
}
