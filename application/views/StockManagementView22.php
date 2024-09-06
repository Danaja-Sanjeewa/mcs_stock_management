<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

<body class="home">
  <script>
    $(document).ready(function() {
      $('[data-toggle="offcanvas"]').click(function() {
        $("#navigation").toggleClass("hidden-xs");
      });

      // Function to show the stock update modal
      function showStockUpdateView() {
        $('#add_project').modal('show'); // Show the modal with id 'add_project'
      }

      // Bind the 'Add Project' button to show the modal
      $('.add-project').click(function() {
        showStockUpdateView();
      });
    });
  </script>

  <div class="container-fluid display-table">
    <div class="row display-table-row">
      <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
        <div class="logo">
          <a href="home.html"><img src="http://jskrishna.com/work/merkury/images/logo.png" alt="merkery_logo" class="hidden-xs hidden-sm">
            <img src="http://jskrishna.com/work/merkury/images/circle-logo.png" alt="merkery_logo" class="visible-xs visible-sm circle-logo">
          </a>
        </div>
        <div class="navi">
          <ul>
            <li class="active"><a href="<?php echo get_instance()->config->site_url().'DashboardController'; ?>"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Home</span></a></li>
            <li><a href="<?php echo get_instance()->config->site_url().'StockManagementController'; ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Stock Management</span></a></li>
            <li><a href=""><i class="fa fa-tasks" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Grinding Management</span></a></li>
            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">User</span></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-10 col-sm-11 display-table-cell v-align">
        <div class="row">
          <header>
            <div class="col-md-7">
              <nav class="navbar-default pull-left">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="offcanvas" data-target="#side-menu" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
              </nav>
              <div class="search hidden-xs hidden-sm">
                <input type="text" placeholder="Search" id="search">
              </div>
            </div>
            <div class="col-md-5">
              <div class="header-rightside">
                <ul class="list-inline header-top pull-right">
                  <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
                  <li>
                    <a href="#" class="icon-info">
                      <i class="fa fa-bell" aria-hidden="true"></i>
                      <span class="label label-primary">3</span>
                    </a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="http://jskrishna.com/work/merkury/images/user-pic.jpg" alt="user">
                      <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li>
                        <div class="navbar-content">
                          <span>JS Krishna</span>
                          <p class="text-muted small">
                            me@jskrishna.com
                          </p>
                          <div class="divider">
                          </div>
                          <a href="#" class="view btn-sm active">View Profile</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </header>
        </div>
        <div class="container">
          <div class="row">
            <div class="span5">
              <br>
              <a href="#" class="add-project btn btn-primary btn-xs pull-right" data-toggle="modal">Add Project</a>
              <br><br><br>
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
                  <tr>
                    <td>1</td>
                    <td>IC0001</td>
                    <td>IC0001</td>
                    <td>Mirish Kudu</td>
                    <td>100.00</td>
                    <td>50 KG</td>
                    <td>50 KG</td>
                    <td>50 KG</td>
                    <td>2012/05/06</td>
                    <td>Editor</td>
                    <td><span class="label label-success">Active</span></td>
                  </tr>
                  <tr>
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
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div id="add_project" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
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
                <!-- Options will be populated dynamically with item codes -->
                <option value="ITEM001">ITEM001 - Example Item 1</option>
                <option value="ITEM002">ITEM002 - Example Item 2</option>
                <!-- Add more options as needed -->
              </select>

              <label for="balance_stock_quantity">Balance Stock Quantity:</label>
              <input type="number" id="balance_stock_quantity" name="balance_stock_quantity" readonly>

              <label for="current_stock_price">Current Stock Price:</label>
              <input type="text" id="current_stock_price" name="current_stock_price" readonly>

              <label for="new_stock_quantity">New Stock Quantity:</label>
              <input type="number" id="new_stock_quantity" name="new_stock_quantity" min="0" required>

              <label for="new_stock_price">New Stock Price:</label>
              <input type="number" id="new_stock_price" name="new_stock_price" step="0.01" min="0" required>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="cancel" data-dismiss="modal">Close</button>
          <button type="button" class="add-project" data-dismiss="modal">Update Stock</button>
        </div>
      </div>
    </div>
  </div>
</body>
