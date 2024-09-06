<?php
class StockManagementModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database manually
    }

    function getStock()
    {

        $queryItem = $this->db->query("SELECT * FROM item INNER JOIN stock ON item.id = stock.itemId INNER JOIN user ON stock.updatingBy = user.id ORDER BY stock.id ASC");
        $resItem = $queryItem->result();
        $itemList = '';
        if(!empty($resItem)){
            $count = 1;
            foreach($resItem as $row){
                $itemList .=  '<tr>';
                $itemList .=  '<td>'.$count.'</td>';
                $itemList .=  '<td>'.date('Y-m-d', strtotime($row->stockDate)).'</td>';
                $itemList .=  '<td>'.$row->itemCode.'</td>';
                $itemList .=  '<td>'.$row->itemDes.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->updatingPrice.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->currentQtyK.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->updatingQtyK.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->finalQtyK.'</td>';
                $itemList .=  '<td>'.$row->updatingDate.'</td>';
                $itemList .=  '<td>'.$row->fullName.'</td>';
                $itemList .=  '<td style="text-align:center;"><span class="label label-success">Available</span></td>';
                $itemList .=  '</tr>';

                $count++;
            }
        }
        return $itemList;
    }

    function getStockByCategories()
    {
        $queryCategory = $this->db->query("SELECT * FROM category");
        $resCategory = $queryCategory->result();
        return $resCategory;
    }
    function getStockItem()
    {
        $queryCategory = $this->db->query("SELECT * FROM item");
        $resCategory = $queryCategory->result();
        return $resCategory;
    }
    function getStockQty()
    {
        $queryCategory = $this->db->query("SELECT DISTINCT finalQtyK FROM stock");
        $resCategory = $queryCategory->result();
        return $resCategory;
    }

    function filterOption($stockDate, $category, $item, $finalQty){
        $whereClause = "";
        if($stockDate == null || $stockDate == "" || $stockDate == 0){
            $whereClause .= "";
        }else{
            $whereClause .= " AND stockDate LIKE '".$stockDate."%'";
        }

        if($category == null || $category == "" || $category == 0){
            $whereClause .= "";
        }else{
            $whereClause .= " AND categoryId = '".$category."'";
        }

        if($item == null || $item == "" || $item == 0){
            $whereClause .= "";
        }else{
            $whereClause .= " AND item.id = '".$item."'";
        }

        if($finalQty == null || $finalQty == "" || $finalQty == 0){
            $whereClause .= "";
        }else{
            $whereClause .= " AND finalQty = '".$finalQty."'";
        }
        
        $queryItem = $this->db->query("SELECT * FROM item INNER JOIN stock ON item.id = stock.itemId INNER JOIN user ON stock.updatingBy = user.id 
        WHERE stock.isActive = '1' ".$whereClause." ORDER BY stock.id ASC");
        $resItem = $queryItem->result();
        $itemList = '';
        if(!empty($resItem)){
            $count = 1;
            foreach($resItem as $row){
                $itemList .=  '<tr>';
                $itemList .=  '<td>'.$count.'</td>';
                $itemList .=  '<td>'.date('Y-m-d', strtotime($row->stockDate)).'</td>';
                $itemList .=  '<td>'.$row->itemCode.'</td>';
                $itemList .=  '<td>'.$row->itemDes.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->updatingPrice.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->currentQtyK.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->updatingQtyK.'</td>';
                $itemList .=  '<td style="text-align:right;">'.$row->finalQtyK.'</td>';
                $itemList .=  '<td>'.$row->updatingDate.'</td>';
                $itemList .=  '<td>'.$row->fullName.'</td>';
                $itemList .=  '<td style="text-align:center;"><span class="label label-success">Available</span></td>';
                $itemList .=  '</tr>';

                $count++;
            }
        }else{
            $itemList = '';
        }
        echo $itemList;
    }
}

