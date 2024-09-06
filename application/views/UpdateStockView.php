<script>
        $(document).ready(function() {

            $('#item_code').select2({
                placeholder: "Select an item...",
                allowClear: true
            });

            $('#branch').select2({
                placeholder: "Select an branch...",
                allowClear: true
            });
        });
    
    // $(document).ready(function(){
    //   $('[data-toggle="offcanvas"]').click(function(){
    //       $("#navigation").toggleClass("hidden-xs");
    //   });
    // });

    function geneareteItemData(){
        var item_code = document.getElementById('item_code').value;
        $.ajax({
            type:"POST",
            url:"UpdateStockManagementController/geneareteItemData",
            data:{
                'item_code' : item_code
            },
            success:function(data){
                if(data == '' || data == null){
                    document.getElementById('current_stock_price').value = '0';
                    document.getElementById('balance_stock_quantity').value = '0';
                }else{
                    var ar = data.split('_');
                    document.getElementById('current_stock_price').value = ar[0];
                    document.getElementById('balance_stock_quantity').value = ar[1];
                }
            }
        });
    }

    function postData(){
        var update_date = document.getElementById('update_date').value;
        var item_code = document.getElementById('item_code').value;
        var balance_stock_quantity = document.getElementById('balance_stock_quantity').value;
        var current_stock_price = document.getElementById('current_stock_price').value;
        var new_stock_quantity = document.getElementById('new_stock_quantity').value;
        var new_stock_price = document.getElementById('new_stock_price').value;
        $.ajax({
            type:"POST",
            url:"UpdateStockManagementController/postData",
            data:{
                'update_date' : update_date,
                'item_code' : item_code,
                'balance_stock_quantity' : balance_stock_quantity,
                'current_stock_price' : current_stock_price,
                'new_stock_quantity' : new_stock_quantity,
                'new_stock_price' : new_stock_price
            },
            before: function(){
                document.getElementById('modalLoaderDiv').style.display = '';
                // document.getElementById('modalDiv').style.display = 'none';
            },
            success:function(data){
                showNoti();
                if(data == 1){
                }else{
                }

                resetOption();
            },
            error: function () {
                document.getElementById('modalLoaderDiv').style.display = 'none';
                // document.getElementById('modalDiv').style.display = '';
                <?php echo notify('danger', '', '<strong>Failed to process your request! </strong>Please try again.', 'fa fa-exclamation-circle'); ?>
            }
        });
    }

    function resetOption(){
        document.getElementById('update_date').value = '';
        $('#item_code').select2("val", "0");
        document.getElementById('balance_stock_quantity').value = '';
        document.getElementById('current_stock_price').value = '';
        document.getElementById('new_stock_quantity').value = '';
        document.getElementById('new_stock_price').value = '';
    }

    function showNoti(){
        // Show the success alert
        $("#success-alert").fadeIn();
        
        // Fade out the alert after 3 seconds
        $("#success-alert").delay(3000).fadeOut(600);

        const alertBox = document.getElementById('success-alert');
        alertBox.style.display = 'block';
        alertBox.classList.remove('fade-out');

        // Set a timeout to fade out the alert after 3 seconds
        setTimeout(function () {
        alertBox.classList.add('fade-out');
        }, 4000); // 3000ms = 3 seconds

        // Remove the alert box from the DOM after the fade-out transition
        // setTimeout(function () {
        // alertBox.style.display = 'none';
        // }, 400); // 3600ms = 3 seconds + 0.6 seconds for fade-out transition
    }
</script>
<style>
    #backgroundDiv {
        position: fixed;
        top: 69px;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-image: url('../media/bg1.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        z-index: -1;
    }

</style>
</style>
<div class="alert alert-success" id="success-alert" style="display: none;">
    <strong>Success!</strong> Your form has been submitted successfully.
</div>

<div class="row" style="margin-top: 27px;background-color: #ffffff2e;border-radius: 6px;">
                        <div class="span5">
                            <div class="row">
                            <div id="modalLoaderDiv" style="position: absolute;height: 581px; display: none;border: solid 1px;background-color: #ddddddb3;width: 26%;left: 37%;z-index: 1;top: 18%;width: 100%;left: 0%;top: 0%;height: 100%;">
                                <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 50%;top: 50%;margin-left: -32px;margin-top: -32px;"></i>
                            </div>
                                <div id="backgroundDiv"></div>
                                <div id="modelDiv" >
                                                <h1>Update Stock</h1>
                                                <br>
                                                <div action="" method="">
                                                    <label for="update_date">Stock Update Date:</label>
                                                    <input type="date" id="update_date" name="update_date" required>
                                                    <label for="branch">Branch:</label>
                                                    <select id="branch" name="branch" required style="width: 100%; height:50% important">
                                                        <option value="0">Select an branch...</option>
                                                        <?php
                                                        foreach ($branchList as $branch) {
                                                        ?>
                                                            <option value="<?php echo $branch->id; ?>"><?php echo $branch->branchDes; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <br>
                                                    <br>
                                                    <label for="item_code">Item Code:</label>
                                                    <select id="item_code" name="item_code" onchange="geneareteItemData()" required style="width: 100%; height:50% important">
                                                        <option value="0">Select an item...</option>
                                                        <?php 
                                                            foreach($itemList as $item){
                                                                ?>
                                                                <option value="<?php echo $item->id; ?>"><?php echo $item->itemCode; ?> - <?php echo $item->itemDes; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>

                                                    <br>
                                                    <br>
                                                    <label for="balance_stock_quantity">Balance Stock Quantity:</label>
                                                    <input type="number" id="balance_stock_quantity" name="balance_stock_quantity" readonly>
                                                    
                                                    <label for="current_stock_price">Current Stock Price:</label>
                                                    <input type="text" id="current_stock_price" name="current_stock_price" readonly>

                                                    <label for="new_stock_quantity">New Stock Quantity:</label>
                                                    <input type="number" id="new_stock_quantity" name="new_stock_quantity" min="0" required>
                                                    
                                                    <label for="new_stock_price">New Stock Price:</label>
                                                    <input type="number" id="new_stock_price" name="new_stock_price" step="0.01" min="0" required>

                                                    <input type="submit" onclick="postData();" value="Update Stock">
                                                </form>
                                            </div>  
                                <div>
                                <!-- </div> -->
                            <!-- <div id="add_project" class="modal fade" role="dialog" aria-labelledby="mySmallModalLabel">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header login-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h4 class="modal-title">Update Stock</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <h1>Update Stock</h1>
                                                <form action="updateStock.php" method="post">
                                                    <label for="update_date">Stock Update Date:</label>
                                                    <input type="date" id="update_date" name="update_date" required>

                                                    <label for="item_code">Item Code:</label>
                                                    <select id="item_code" name="item_code" required>
                                                        <option value="">Select an item...</option>
                                                        <option value="ITEM001">ITEM001 - Example Item 1</option>
                                                        <option value="ITEM002">ITEM002 - Example Item 2</option>
                                                    </select>

                                                    <label for="balance_stock_quantity">Balance Stock Quantity:</label>
                                                    <input type="number" id="balance_stock_quantity" name="balance_stock_quantity" readonly>

                                                    <label for="current_stock_price">Current Stock Price:</label>
                                                    <input type="text" id="current_stock_price" name="current_stock_price" readonly>

                                                    <label for="new_stock_quantity">New Stock Quantity:</label>
                                                    <input type="number" id="new_stock_quantity" name="new_stock_quantity" min="0" required>

                                                    <label for="new_stock_price">New Stock Price:</label>
                                                    <input type="number" id="new_stock_price" name="new_stock_price" step="0.01" min="0" required>

                                                    <input type="submit" value="Update Stock">
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="cancel" data-dismiss="modal">Close</button>
                                            <button type="button" class="add-project" data-dismiss="modal">Update Stock</button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>            