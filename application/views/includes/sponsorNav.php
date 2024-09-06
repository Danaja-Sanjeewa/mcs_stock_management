<?php
$sponsorPrimaryLanguage = getSponsorPrimaryLanguage();
$this->lang->load('sponsor', $sponsorPrimaryLanguage);
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" id="scrollspy">

        <!-- Sidebar user panel -->
        <?php
        //server gives noimage.jpg
        if($_SESSION['sponsorImage'] == "" || $_SESSION['sponsorImage'] == null || $_SESSION['sponsorImage'] == 'noimage.jpg'){
            $userimg = 'app_att/113-512.png';
        }else {
            $userimg = $_SESSION['sponsorImage'];
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
        if($_SESSION['sponsorloggedIn'] == 'sponsor') {
            ?>
            <form action="#" method="get" class="sidebar-form" style="border:none !important; border-radius: 0 !important;">

               <!-- School Dropdown-->
                <div class="form-group" style="margin-bottom: 0px; margin-top:8px; background-color:#000000 !important;" data-minimum-results-for-search="Infinity">
                    <select class="select2 SearchDisabledSelect2 School_Selection" id="School_Selection_Nav" onchange="set_School(this)" style="width: 100%; opacity:0.7 ; font-weight: bold;"> <!--set_Syllabus() function is found in additional_jScript under ref folder-->
                        <?php
                        foreach ($this->userInfo['sponsorLinkedSchools'] as $row) {
                            if ($row['SchMasterID'] == $_SESSION['sponsorSchMasterID']) {
                                echo "<option value = '" . $row['SchMasterID'] . "' selected>" . $row['SchNameEn'] . "</option>";
                            } else {
                                echo "<option value = '" . $row['SchMasterID'] . "'>" . $row['SchNameEn'] . "</option>";
                            }

                        }
                        ?>
                    </select>
                </div>

                <!--Branch Dropdown-->
                <div class="form-group" style="margin-bottom: 0px; margin-top:8px; background-color:#000000;" data-minimum-results-for-search="Infinity">
                    <select class="select2 SearchDisabledSelect2 Branch_Selection" id="Branch_Selection_Nav" onchange="set_Spo_Branch(this)" style="width: 100%; opacity:0.7 ; font-weight: bold;">
                        <?php
                        foreach ($this->userInfo['sponsorLinkedBranches'] as $row) {
                            if ($row['branchID'] == $_SESSION['sponsorBranchID']) {
                                echo "<option value = '" . $row['branchID'] . "' selected>" . $row['BranchDes'] . "</option>";
                            } else {
                                echo "<option value = '" . $row['branchID'] . "'>" . $row['BranchDes'] . "</option>";
                            }

                        }
                        ?>
                    </select>
                </div>

                <!--Syllabus Dropdown-->
                <div class="form-group" style="margin-bottom: 0px; margin-top:8px; background-color:#000000;" data-minimum-results-for-search="Infinity">
                    <select class="select2 SearchDisabledSelect2 Syllabus_Selection" id="Syllabus_Selection_Nav" onchange="set_Spo_Syllabus(this)" style="width: 100%; opacity:0.7 ; font-weight: bold;"> <!--set_Syllabus() function is found in additional_jScript under ref folder-->
                        <?php

                        foreach ($this->userInfo['sponsorLinkedSyllabus'] as $row_Syllabus) {
                            if ($row_Syllabus->SyllabusID == $_SESSION['sponsorSyllabusID']) {
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

            function createMenu()
            {
                $CI =& get_instance();

                echo '
                    <li>
                       <a href="'.base_url().'index.php/Srp_aa_sponsorDashboardController" id="dashboard" class="collapsed"> <i class="fa fa-tachometer" style="color: red"></i> <span class="nav-label"> '.$CI->lang->line('sponsor_dashboard').' </span> </a>
                    </li>
                    <li>
                       <a href="'.base_url().'index.php/Srp_aa_sponsorStuDetailsController"  id="student_details" class="collapsed"> <i class="fa fa-tasks" style="color: #18ff21"></i> <span class="nav-label"> '.$CI->lang->line('sponsor_student_details').' </span> </a>
                    </li>
                    <li>
                       <a href="'.base_url().'index.php/Srp_aa_sponsorStuExamsController"   id="exams" class="collapsed"> <i class="fa fa-book" style="color: #ed19ff"></i> <span class="nav-label">'.$CI->lang->line('sponsor_student_exams').'</span>  </a>
                    </li>
                ';

            }
            ?>
            <?php
        }
        ?>

        <ul class="nav sidebar-menu">
            <?php
            if($_SESSION['sponsorloggedIn'] == 'sponsor') {
                echo createMenu();
            }
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<script>

    $(function($) {
        var path = window.location.href;
        if(path.indexOf('#') != -1)
        {
            path=path.replace('#', '');
        }
        $('li a').each(function() {
            if (this.href === path) {
                $(this).parent().addClass('active');
            }
        });
    });

    function set_School(x) {

        var sponsorSchMasterID = x.value;
        var SchoolDropdownID = x.id;
        var School = $("#"+SchoolDropdownID+" option:selected").text();

        $.ajax({
            type: "POST",
            url: "Srp_aa_sponsorDashboardController/setSchoolSession",
            data: {'sponsorSchMasterID': sponsorSchMasterID},
            beforeSend: function () {
            },
            success: function (data) {
                    location.reload();
                    $.notify({
                        title: '<strong>Your Profile has been successfully changed to ' + School + '!</strong>',
                        message: ''
                    }, {
                        type: 'success',
                        placement: {from: "bottom", align: "right"},
                        delay: 0,
                        animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}
                    });


            }
        });
    }

    function set_Spo_Branch(x) {

        var sponsorBranchID = x.value;
        var BranchropdownID = x.id;
        var Branch = $("#"+BranchropdownID+" option:selected").text();

        $.ajax({
            type: "POST",
            url: "Srp_aa_sponsorDashboardController/setBranchSession",
            data: {'sponsorBranchID': sponsorBranchID},
            beforeSend: function () {
            },
            success: function (data) {
                location.reload();
                $.notify({
                    title: '<strong>Your Profile has been successfully changed to ' + Branch + '!</strong>',
                    message: ''
                }, {
                    type: 'success',
                    placement: {from: "bottom", align: "right"},
                    delay: 0,
                    animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}
                });


            }
        });
    }

    function set_Spo_Syllabus(x) {

        var sponsorSyllabusID = x.value;
        var SyllabusropdownID = x.id;
        var Syllabus = $("#"+SyllabusropdownID+" option:selected").text();

        $.ajax({
            type: "POST",
            url: "Srp_aa_sponsorDashboardController/setSyllabusSession",
            data: {'sponsorSyllabusID': sponsorSyllabusID},
            beforeSend: function () {
            },
            success: function (data) {
                location.reload();
                $.notify({
                    title: '<strong>Your Profile has been successfully changed to ' + Syllabus + '!</strong>',
                    message: ''
                }, {
                    type: 'success',
                    placement: {from: "bottom", align: "right"},
                    delay: 0,
                    animate: {enter: 'animated fadeInDown', exit: 'animated fadeOutUp'}
                });


            }
        });
    }

    
</script>

<!--additional scripts-->
<script src="<?php echo base_url('ref/Additional_jScripts.js'); ?>"></script>
