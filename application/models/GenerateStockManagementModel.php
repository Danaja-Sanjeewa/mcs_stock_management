<?php
class GenerateStockManagementModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database manually
    }

    function getCategoryList()
    {
        $queryCategory = $this->db->query("SELECT * FROM category WHERE isDeleted='0'");
        $resCategory = $queryCategory->result();
        return $resCategory;
    }

    function getBranchList(){
        $queryBranch = $this->db->query("SELECT * FROM branch WHERE masterId = '1' AND isDeleted = '0'");
        $resBranch = $queryBranch->result();
        return $resBranch;
    }

    function geneareteItems($item_category){
        $res = '';
        if($item_category == '' || $item_category == null){

        }else{
            // $queryCategory = $this->db->query("SELECT * FROM `stock` WHERE `branchId` = '1' AND `categoryId` = '".$item_category."' AND `isActive` = '1' AND isDeleted='0' ORDER BY `id` DESC");
            $queryCategory = $this->db->query("SELECT * FROM item WHERE categoryId = '".$item_category."' AND isActive = '1' AND isDeleted = '0' ORDER BY id ASC");
            $resCategory = $queryCategory->result();
            if(!empty($resCategory)){
                $count = 1;
                foreach($resCategory as $item){
                    // $res[] = $item->itemDes;
                    $res .= '<div class="slide" id="itemDiv'.$item->id.'"><div style="display: inline-flex;width: 100%;justify-content: space-between;">
                                <label id="itemLabel'.$item->id.'">'.$item->itemDes.'</label>
                                <label><span id="itemCount" style="color:darkgoldenrod;">'.$count.'</span>/<span id="itemTotalCount"  style="color:brown;">'.count($resCategory).'</span></label>
                            </div>
                            <div style="display: inline-flex;width: 100%;">
                                <input type="number" id="currentKQty'.$item->id.'" name="currentKQty'.$item->id.'" style="width: 100%;border: 1px solid #2540aa;" placeholder="Kilo Gram">
                                <input type="number" id="currentGQty'.$item->id.'" name="currentGQty'.$item->id.'" style="width: 100%;border: 1px solid #2540aa;" placeholder="Gram">
                                <input type="button" class="generateStockBtn" onclick="postData('.$item->id.','.count($resCategory).');" value="Update & Next" style="height: 38px;width: 36%;background-color: brown;">
                            </div></div>';
                    $count++;
                }
            }
        }
        echo $res;
    }

    function postData($update_date, $branch, $item, $balance_stock_quantity_K, $balance_stock_quantity_G){
        
        $queryStock = $this->db->query("SELECT * FROM stock WHERE branchId = '".$branch."' AND isStockDate = '0' AND isActive = '1' AND itemId = '".$item."' ORDER BY updatingDate DESC LIMIT 1");
        $resStock = $queryStock->row();
            if(!empty($resStock)){
                $newGram = 0;
                $newKilo = 0;
                $grams = $resStock->currentQtyG+$balance_stock_quantity_G;
                if($grams > 999){
                    $newKilo = $grams/1000;
                    $newGram = $grams-($newKilo*1000);
                }else{
                    $newGram = $grams;
                }
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
            }
        // $_SESSION['UserID']
        $this->db->insert('stock', $data);
        echo '1';
    }
}

