  <script>
    $(document).ready(function(){
      $('[data-toggle="offcanvas"]').click(function(){
          $("#navigation").toggleClass("hidden-xs");
      });
    });
  </script>
                    <div class="row">
                        <div class="span5">
                            <!-- <br> -->
                            <h1 style="text-align: center; width:100%;">Stock Management</h1>
                            <!-- <a href="#" class="add-project btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#add_project">Add Project</a> -->
                            <!-- <br><br><br> -->
                            <table class="table table-striped table-condensed" border="1">
                                <thead>
                                    <tr style="vertical-align: middle;">
                                        <th rowspan="2">#</th>
                                        <th rowspan="2">Image</th>
                                        <th rowspan="2">Item Code</th>
                                        <th rowspan="2">Item</th>
                                        <th rowspan="2">Price</th>
                                        <th colspan="3">Quantity</th>
                                        <th rowspan="2">Update Date</th>
                                        <th rowspan="2">Update By</th>
                                        <th rowspan="2">Status</th>                                          
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Quantity</th>
                                        <th>Quantity</th>                                       
                                    </tr>
                                </thead>   
                                <tbody>
                                <?php
                                // $count = 1;
                        foreach($record as $row){
?>
                                    <tr>
                                    <?php 
                        foreach($row as $r){
                            ?>
                                    <tr>
                                    <?php 
                                    echo '<td>'.$r['count'].'</td>'; 
                                    echo '<td>'.$r['image'].'</td>'; 
                                    echo '<td>'.$r['itemCode'].'</td>'; 
                                    echo '<td>'.$r['itemDes'].'</td>'; 
                                    echo '<td>'.$r['Price'].'</td>'; 
                                    echo '<td>'.$r['PQty'].'</td>'; 
                                    echo '<td>'.$r['UQty'].'</td>'; 
                                    echo '<td>'.$r['TQty'].'</td>'; 
                                    echo '<td>'.$r['updateDate'].'</td>'; 
                                    echo '<td>'.$r['updateBy'].'</td>'; 
                                    // echo '<td>'.$r['status'].'</td>'; 
                                    echo '<td>'.count($row).'</td>'; 
                    }
                                    ?>
                                    </tr>
                                    <?php
                        }
                        ?>
                                    <!-- <tr>
                                        <td>2</td>
                                        <td>IC0002</td>
                                        <td>IC0002</td>
                                        <td>Gammiris Kudu</td>
                                        <td>120.00</td>
                                        <td>45 KG</td>
                                        <td>45 KG</td>
                                        <td>45 KG</td>
                                        <td>2011/12/01</td>
                                        <td>Staff</td>
                                        <td><span class="label label-important">Banned</span></td>                                       
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>IC0003</td>
                                        <td>IC0003</td>
                                        <td>Kaha Kudu</td>
                                        <td>154.00</td>
                                        <td>38 KG</td>
                                        <td>38 KG</td>
                                        <td>38 KG</td>
                                        <td>2010/08/21</td>
                                        <td>User</td>
                                        <td><span class="label">Inactive</span></td>                                        
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>IC0004</td>
                                        <td>IC0004</td>
                                        <td>ThunaPaha Kudu</td>
                                        <td>165.00</td>
                                        <td>57 KG</td>
                                        <td>57 KG</td>
                                        <td>57 KG</td>
                                        <td>2009/04/11</td>
                                        <td>Editor</td>
                                        <td><span class="label label-warning">Pending</span></td>                                       
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>IC0005</td>
                                        <td>IC0005</td>
                                        <td>Kalu Kud</td>
                                        <td>115.00</td>
                                        <td>62 KG</td>
                                        <td>62 KG</td>
                                        <td>62 KG</td>
                                        <td>2007/02/01</td>
                                        <td>Staff</td>
                                        <td><span class="label label-success">Active</span></td>                                        
                                    </tr>                                    -->
                                </tbody>
                            </table>
                        </div>
                    </div>
