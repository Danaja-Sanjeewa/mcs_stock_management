  <script>
    $(document).ready(function(){
        $('[data-toggle="offcanvas"]').click(function(){
            $("#navigation").toggleClass("hidden-xs");
        });
        
        // $('#dateFilter').select2({
        //     placeholder: "Select a Date...",
        //     allowClear: true
        // });

        $('#categoryFilter').select2({
            placeholder: "Select a Category...",
            allowClear: true
        });

        $('#itemFilter').select2({
            placeholder: "Select an item...",
            allowClear: true
        });

        $('#qtyFilter').select2({
            placeholder: "Select a Quantity...",
            allowClear: true
        });
    });

    function filterOption(){
        var dateFilter = document.getElementById('dateFilter').value;
        var categoryFilter = document.getElementById('categoryFilter').value;
        var itemFilter = document.getElementById('itemFilter').value;
        var qtyFilter = document.getElementById('qtyFilter').value;
        $.ajax({
            type:"POST",
            url:"StockManagementController/filterOption",
            data:{
                'dateFilter' : dateFilter,
                'categoryFilter' : categoryFilter,
                'itemFilter' : itemFilter,
                'qtyFilter' : qtyFilter
            },
            before: function(){
                document.getElementById('modalLoaderDiv').style.display = '';
                // document.getElementById('modalDiv').style.display = 'none';
            },
            success:function(data){
                // showNoti();
                document.getElementById('stockDataDiv').innerHTML = '';

                if(data!= ''){
                    document.getElementById('stockDataDiv').innerHTML = data;
                    // $.notify({
                    //     title: '',
                    //     message: '<strong>Stock Update has been successfully done! </strong>',
                    //     icon: 'fa fa-check-circle',
                    //     },{
                    //     type: 'success',
                    //     delay: 0,
                    //     placement: {
                    //     from: 'bottom',
                    //     align: 'center'
                    //     },
                    // });
                    <?php //echo notify('success', '', '<strong>Stock Update has been successfully done! </strong>', 'fa fa-check-circle'); ?>
                }else{
                    // $.notify({
                    //     title: '',
                    //     message: '<strong>Failed to process your request! </strong>Please try again.',
                    //     icon: 'fa fa-exclamation-circle',
                    //     },{
                    //     type: 'danger',
                    //     delay: 0,
                    //     placement: {
                    //     from: 'bottom',
                    //     align: 'center'
                    //     },
                    // });
                    <?php //echo notify('danger', '', '<strong>Failed to process your request! </strong>Please try again.', 'fa fa-exclamation-circle'); ?>
                }

                // resetOption();
            },
            error: function () {
                document.getElementById('modalLoaderDiv').style.display = 'none';
                // document.getElementById('modalDiv').style.display = '';
                <?php echo notify('danger', '', '<strong>Failed to process your request! </strong>Please try again.', 'fa fa-exclamation-circle'); ?>
            }
        });
    }
  </script>
                    <div class="row" style="margin-top: 27px;background-color: white;border-radius: 6px;">
                        <div class="span5" style="padding: 12px;">
                            <!-- <br> -->
                            <h1 style="text-align: center; width:100%;">Stock Management</h1>
                            <!-- <a href="#" class="add-project btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#add_project">Add Project</a> -->
                            <!-- <br><br><br> -->

                            <div style="display: inline-flex;width:100%;background-color: #d3d5dbc9;margin-bottom: 1%;border-radius: 9px;">
                                <div class="span3" style="width: 25%;padding: 1%;">
                                    <label for="dateFilter" class="control-label">Stock Date:</label>
                                    <input class="form-control" type="date" id="dateFilter" name="dateFilter" onchange="filterOption();">
                                    <!-- <select class="form-control select2" id="dateFilter" name="dateFilter" style="width:100%; margin-bottom: 0px;" data-placeholder="Select a Date..." onchange="getGrades('gradesME','groupsME');getTerms();">
                                        <option></option>
                                    </select> -->
                                </div>
                                <div class="span3" style="width: 25%;padding: 1%;">
                                    <label for="categoryFilter" class="control-label">Category:</label>
                                    <select class="form-control select2" id="categoryFilter" name="categoryFilter" style="width:100%; margin-bottom: 0px;" data-placeholder="Select a Category..." onchange="filterOption();">
                                        <option value="0">All</option>
                                        <?php
                                        foreach ($categoryFilter as $row) {
                                        ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->categoryDes .'     [<b>'.$row->categoryCode.'</b>]'; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="span3" style="width: 25%;padding: 1%;">
                                    <label for="itemFilter" class="control-label">Item:</label>
                                    <select class="form-control select2" id="itemFilter" name="itemFilter" style="width:100%; margin-bottom: 0px;" data-placeholder="Select an item..." onchange="filterOption();">
                                        <option value="0">All</option>
                                        <?php
                                        foreach ($itemFilter as $row) {
                                        ?>
                                            <option value="<?php echo $row->id; ?>"><?php echo $row->itemCode .' '.$row->itemDes; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="span3" style="width: 25%;padding: 1%;">
                                    <label for="qtyFilter" class="control-label">Quntity:</label>
                                    <select class="form-control select2" id="qtyFilter" name="qtyFilter" style="width:100%; margin-bottom: 0px;" data-placeholder="Select a Quantity..." onchange="filterOption();">
                                        <option value="0">All</option>
                                        <?php
                                        foreach ($qtyFilter as $row) {
                                        ?>
                                            <option value="<?php echo $row->finalQty; ?>"><?php echo $row->finalQty ; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>                        
                            </div>

                            <table class="table table-striped table-condensed table-bordered"  id="stockDetailTable">
                                <thead>
                                    <tr style="vertical-align: middle;">
                                        <th >#</th>
                                        <th >Image</th>
                                        <th >Item Code</th>
                                        <th >Item</th>
                                        <th >Price</th>
                                        <th>Current Quantity</th>
                                        <th>updating Quantity</th>
                                        <th>Final Quantity</th> 
                                        <th >Update Date</th>
                                        <th >Update By</th>
                                        <th >Status</th>    
                                                                              
                                    </tr>

                                    <!-- <tr style="vertical-align: middle;">
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
                                        <th>Current Quantity</th>
                                        <th>updating Quantity</th>
                                        <th>Final Quantity</th>                                       
                                    </tr> -->
                                </thead>   
                                <tbody id="stockDataDiv">
                                    <?php
                                        echo $record;                                        
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
