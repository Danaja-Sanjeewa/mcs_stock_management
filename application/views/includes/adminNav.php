<?php
$primaryLanguage = getPrimaryLanguage();
$this->lang->load('nav_menu', $primaryLanguage);
?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" style="top: 10px !important;">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar" id="scrollspy">

          <!-- Sidebar user panel -->
          <?php
          //server gives noimage.jpg
          if($_SESSION['UserImage'] == "" || $_SESSION['UserImage'] == null || $_SESSION['UserImage'] == 'noimage.jpg'){
            $userimg = '1.png';
          }else {
            $userimg = $_SESSION['UserImage'];
          }
          ?>
          <!--<div class="user-panel">
            <div class="pull-left image">

              <img src="<?php /*echo base_url('ref/images/'.$userimg); */?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php /*echo $this->userInfo['Ename']; */?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>-->
          <!-- /.search form -->
              <?php
              if($_SESSION['loggedInAs'] == 'emp') {
              ?>
              <form action="#" method="get" class="sidebar-form" style="border:none !important; border-radius: 0 !important;">
			  
			  <?php
				//if(count($this->userInfo['BranchDetails']) > 1){
				?>
                  <div class="form-group" style="margin-bottom: 0px; background-color:#0077b3;" data-minimum-results-for-search="Infinity">
                      <select class="select2 Branch_Selection" id="Branch_Selection_Nav" onchange="set_Branch(this,'<?php echo $_SESSION["branchID"]; ?>')" style="width: 100%; opacity:0.7 ; font-weight: bold;"> <!--set_Branch() function is found in additional_jScript under ref folder-->
                          <?php
                          $a = 0;
                          foreach ($this->userInfo['BranchDetails']['branches'] as $row_Branch) {
                              if ($row_Branch->branchID == $_SESSION['branchID']) {
                                  if($primaryLanguage == 'arabic') {
                                      echo "<option value = '" . $this->userInfo['BranchDetails']['branch_employees'][$a] . "' selected> " . $this->lang->line('navigation_branch') . " - " . $row_Branch->BranchDesOther . "</option>";
                                  }else{
                                      echo "<option value = '" . $this->userInfo['BranchDetails']['branch_employees'][$a] . "' selected> " . $this->lang->line('navigation_branch') . " - " . $row_Branch->BranchDes . "</option>";
                                  }
                              } else {
                                  if($primaryLanguage == 'arabic') {
                                      echo "<option value = '" . $this->userInfo['BranchDetails']['branch_employees'][$a] . "'> " . $this->lang->line('navigation_branch') . " - " . $row_Branch->BranchDesOther . "</option>";
                                  }else{
                                      echo "<option value = '" . $this->userInfo['BranchDetails']['branch_employees'][$a] . "'> " . $this->lang->line('navigation_branch') . " - " . $row_Branch->BranchDes . "</option>";
                                  }
                              }
                              $a++;
                          }
                          ?>
                      </select>
                  </div>
				  <?php
				  //}
				  ?>
			  
                  <div class="form-group" style="margin-bottom: 0px; margin-top:8px; background-color:#0077b3;" data-minimum-results-for-search="Infinity">
                      <select class="select2 SearchDisabledSelect2 Syllabus_Selection" id="Syllabus_Selection_Nav" onchange="set_Syllabus(this,'<?php echo $_SESSION["SyllabusID"]; ?>')" style="width: 100%; opacity:0.7 ; font-weight: bold;"> <!--set_Syllabus() function is found in additional_jScript under ref folder-->
                            <?php

                                foreach ($this->userInfo['Syllabus'] as $row_Syllabus) {
                                    if ($row_Syllabus->SyllabusID == $_SESSION['SyllabusID']) {
                                        echo "<option value = '" . $row_Syllabus->SyllabusID . "' selected>" . $row_Syllabus->SyllabusDescription . "</option>";
                                    } else {
                                        echo "<option value = '" . $row_Syllabus->SyllabusID . "'>" . $row_Syllabus->SyllabusDescription . "</option>";
                                    }
                                }
                            ?>
                      </select>
                  </div>
              </form>

          <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php
			
		//var_dump($this->Branch_Selection_Nav);exit;
            $menu_data = $this->menu_pages;
            function buildTree(array $elements, $parentId = 0) {
                $branch = array();

                foreach ($elements as $element) {
                    if ($element['parent_id'] == $parentId) {
                        $children = buildTree($elements, $element['id']);
                        if ($children) {
                            $element['children'] = $children;
                        }
                        $branch[] = $element;
                    }
                }

                return $branch;
            }

            $tree = buildTree($menu_data);
            function createMenu($tree,$stat)
            {
				$color_arr = array("#003399","#00b359","#cc0000","#9900cc","#ff6600","#e6b800","#008080","#e60073","#999966","#7733ff","#2eb82e","#ff6600","#993366","#669999","#e60000","#cccc00","#1a8cff","#99ff99","#ff6666","#b30059","#996600","#ffa64d","#80aaff","#4dffb8","#ffff00","#669999","#e60000","#cccc00","#840BE8","#1a8cff","#99ff99","#ff6666","#347ecc");
				$CI =& get_instance();
                $a = 1;
				foreach ($tree as $row) {

                    if (array_key_exists("children", $row)) {

                        echo '<li class="treeview" id="' . $row['menuID'] . '">
                                <a href="#" id="' . $row['PageID'] . '" class="loadPage"><i class="' . $row['menuIcon'] . '"  style="color:'.$color_arr[$a].';"></i> <span>' . $CI->lang->line('navigation_menu_' . $row['PageID']) . '</span> <i class="fa fa-angle-left pull-right"></i></a>

                                <ul class="treeview-menu">';
                        createMenu($row['children'], '1');
                        echo '</ul>
                            </li>';

                    } else {

                        if ($stat == '0') {
                            if ($row['isExternalLink'] == '0') {

                                echo '<li id="' . $row['menuID'] . '">
                                            <a href="#" id="' . $row['PageID'] . '" onclick="user_access_control(' . $row['PageID'] . ' , \'' . $row['pageName'] . '\' , 1 )" class="loadPage"><i class="' . $row['menuIcon'] . '"  style="color:'.$color_arr[$a].';"></i> <span>' . $CI->lang->line('navigation_menu_' . $row['PageID']) . '</span></a>
                                      </li>';

                            } else {

                                echo '<li id="' . $row['menuID'] . '">
                                        <a href="' . "" . $row['pageName'] . '"  id="' . $row['PageID'] . '" target="_blank"> <i class="' . $row['menuIcon'] . '"  style="color:'.$color_arr[$a].';"></i> <span>' . $CI->lang->line('navigation_menu_' . $row['PageID']) . '</span></a>
                                      </li>';
                            }

                        } else {
                            echo '<li  id="' . $row['menuID'] . '"><a href="#" id="' . $row['PageID'] . '" onclick="user_access_control(' . $row['PageID'] . ' , \'' . $row['pageName'] . '\' , 1 )" class="loadPage"><i class="" style="color:'.$color_arr[$a].';"></i> ' . $CI->lang->line('navigation_menu_' . $row['PageID']) . '</a></li>';
                        }

                    }
                    $a++;
                }
            }
            ?>
                  <?php
              }
              ?>

            <ul class="nav sidebar-menu">
            <?php
            if($_SESSION['loggedInAs'] == 'emp') {
                echo createMenu($tree, '0');
            }
          ?>
            </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
