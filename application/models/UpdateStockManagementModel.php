<?php
class UpdateStockManagementModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database manually
    }

    function getItem()
    {
        $queryItem = $this->db->query("SELECT * FROM item");
        $resItem = $queryItem->result();
        return $resItem;
    }

    function getBranchList(){
        $queryBranch = $this->db->query("SELECT * FROM branch WHERE masterId = '1' AND isDeleted = '0'");
        $resBranch = $queryBranch->result();
        return $resBranch;
    }

    function geneareteItemData($item_code){
        $res = '';
        if($item_code == '' || $item_code == null){

        }else{
            $queryItem = $this->db->query("SELECT * FROM `stock` WHERE `branchId` = '1' AND `itemId` = '".$item_code."' AND `isActive` = '1' ORDER BY `id` DESC");
            $resItem = $queryItem->row();
            if(!empty($resItem)){
                // foreach($resItem as $item){
                    $res = $resItem->updatingPrice.'_'.$resItem->finalQtyK;
                // }
            }
        }
        echo $res;
    }

    function postData($update_date, $item_code, $balance_stock_quantity, $current_stock_price, $new_stock_quantity, $new_stock_price){
        
        $data = array(
            'stockDate' => $update_date,
            'itemId' => $item_code,
            'currentQty' => $balance_stock_quantity,
            'currentPrice' => $current_stock_price,
            'updatingQty' => $new_stock_quantity,
            'updatingPrice' => $new_stock_price,
            'updatingDate' => date('Y-m-d H:m:s'),
            'updatingBy' => '1',
            'finalQty' => ($new_stock_quantity+1),
            'branchId' => 1,
            'isActive' => 1
        );
        $data = array(
            'stockDate' => $update_date,
            'itemId' => $item,
            'currentQtyK' => $resStock->currentQtyK,
            'currentQtyG' => $resStock->currentQtyG,
            'currentPrice' => $resStock->currentPrice,
            'updatingQtyK' => $balance_stock_quantity_K,
            'updatingQtyG' => $balance_stock_quantity_G,
            'updatingPrice' => $resStock->currentPrice,
            'updatingDate' => date('Y-m-d H:m:s'),
            'updatingBy' => '1',
            'finalQtyK' => ($balance_stock_quantity_K+$newKilo),
            'finalQtyG' => $newGram,
            'branchId' => $branch,
            'isActive' => 1,
            'isStockDate' => 1
        );
        // $_SESSION['UserID']
        $this->db->insert('stock', $data);
        echo '1';
    }
}

