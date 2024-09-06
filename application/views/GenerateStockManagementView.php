<script>
    $(document).ready(function() {

        $('#item_category').select2({
            placeholder: "Select an category...",
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

    function geneareteItems() {
        var item_category = document.getElementById('item_category').value;
        $.ajax({
            type: "POST",
            url: "GenerateStockManagementController/geneareteItems",
            data: {
                'item_category': item_category
            },
            success: function(data) {
                if (data == '' || data == null) {
                    showNoti('0');
                    // document.getElementById('stockGeneatingDiv').innerHTML = data;
                    // document.getElementById('current_stock_price').value = '0';
                    // document.getElementById('balance_stock_quantity').value = '0';
                } else {
                    document.getElementById('stockGeneatingDiv').innerHTML = data;
                    // var ar = data.split('_');
                    // document.getElementById('current_stock_price').value = ar[0];
                    // document.getElementById('balance_stock_quantity').value = ar[1];
                }
            }
        });
    }

    function postData(id, count) {
        var update_date = document.getElementById('update_date').value;
        var branch = document.getElementById('branch').value;
        var item = document.getElementById('itemLabel'+id).value;
        var balance_stock_quantity_K = document.getElementById('currentKQty'+id).value;
        var balance_stock_quantity_G = document.getElementById('currentGQty'+id).value;
        
        $.ajax({
            type: "POST",
            url: "GenerateStockManagementController/postData",
            data: {
                'update_date': update_date,
                'branch': branch,
                'item': item,
                'balance_stock_quantity_K': balance_stock_quantity_K,
                'balance_stock_quantity_G': balance_stock_quantity_G
            },
            before: function() {
                document.getElementById('modalLoaderDiv').style.display = '';
                // document.getElementById('modalDiv').style.display = 'none';
            },
            success: function(data) {
                // showNextSlide(id, count);
                // showNoti();
                // if (data == 1) {} else {}

                // resetOption();
            },
            error: function() {
                document.getElementById('modalLoaderDiv').style.display = 'none';
                // document.getElementById('modalDiv').style.display = '';
                <?php echo notify('danger', '', '<strong>Failed to process your request! </strong>Please try again.', 'fa fa-exclamation-circle'); ?>
            }
        });
    }

    function resetOption() {
        document.getElementById('update_date').value = '';
        $('#item_code').select2("val", "0");
        document.getElementById('balance_stock_quantity').value = '';
        document.getElementById('current_stock_price').value = '';
        document.getElementById('new_stock_quantity').value = '';
        document.getElementById('new_stock_price').value = '';
    }

    function showNoti(type) {
        if (type == '1') {
            id = "successNoti";
        } else if (type == '0') {
            id = "failNoti";
        }
        // Show the success alert
        $("#"+id).fadeIn();

        // Fade out the alert after 3 seconds
        $("#"+id).delay(3000).fadeOut(600);

        // const alertBox = document.getElementById('success-alert');
        // alertBox.style.display = 'block';
        // alertBox.classList.remove('fade-out');

        // // Set a timeout to fade out the alert after 3 seconds
        // setTimeout(function () {
        // alertBox.classList.add('fade-out');
        // }, 4000); // 3000ms = 3 seconds

        // Remove the alert box from the DOM after the fade-out transition
        // setTimeout(function () {
        // alertBox.style.display = 'none';
        // }, 400); // 3600ms = 3 seconds + 0.6 seconds for fade-out transition
    }

    function showNextSlide(id, eleLength) {
        document.getElementById('itemDiv' + id).style.display = 'none';
        if (eleLength == id) {
            // id = 0;
            showNoti('1');
        } else {
            id = (id + 1);
            document.getElementById('itemDiv' + id).style.display = 'block';
        }

    }
</script>
<style>
    #backgroundDiv {
        position: fixed;
        /* Ensure the div stays fixed in place */
        top: 69px;
        /* Align to the top of the viewport */
        left: 0;
        /* Align to the left of the viewport */
        width: 100vw;
        /* Full width of the viewport */
        height: 100vh;
        /* Full height of the viewport */
        background-image: url('../media/bg1.jpg');
        /* Relative path to your image */
        background-size: cover;
        /* Make sure the background image covers the entire div */
        background-position: center;
        /* Center the background image */
        background-repeat: no-repeat;
        /* Prevent the background image from repeating */
        z-index: -1;
        /* Optional: Send the div behind other content */
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
            <div id="modelDiv">
                <h1>Generate Stock</h1>
                <br>
                <form action="" method="">
                    <label for="update_date">Stock Generate Date:</label>
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
                    <label for="item_category">Item Category:</label>
                    <select id="item_category" name="item_category" onchange="geneareteItems()" required style="width: 100%; height:50% important">
                        <option value="0">Select an category...</option>
                        <?php
                        foreach ($categoryList as $category) {
                        ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->categoryDes . ' - [' . $category->categoryCode . ']'; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                    <div id="stockGeneatingDiv" style="display: inline-flex;" class="slider"></div>
                    <small id="successNoti" style="color:green;display: none;">Stock updated successfully.</small>
                    <small id="failNoti" style="color:red;display: none;">No Stock found for the selected Category.</small>
                </form>
            </div>
            <div>
            </div>
        </div>
    </div>