<footer class="main-footer" style="text-align: center !important;">
    <!--            <div class="pull-right hidden-xs">-->
    <!--                  <img src="--><?php //$server_status=check_server(); echo load_image($server_status,'excalibur_logo.png'); 
                                        ?>
    <!--" alt="" class="img-responsive" style="width: 90px; height:30px;"/>-->
    <!--            </div>-->
    <?php
    $linkType = "https://techbsl.com";
    if (isset($_SERVER['HTTPS'])) {
        $linkType = "https://techbsl.com";
    } else {
        $linkType = "http://techbsl.com";
    }
    ?>
    <strong>Copyright &copy; <?php echo date("Y"); ?> <span style="font-size: 6px"> </span> <a href="<?php echo $linkType ?>" target="_blank">Techcess Business Solutions</a>.</strong> All rights reserved.
</footer>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url('ref/adminlte/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('ref/adminlte/dist/js/app.min.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?php /*echo base_url('ref/adminlte/dist/js/pages/dashboard.js'); */ ?>"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('ref/adminlte/dist/js/demo.js'); ?>"></script>
<!-- Select2 -->
<script src="<?php echo base_url('ref/adminlte/plugins/select2/select2.full.min.js'); ?>"></script>

<!--multiselect-->
<script type="text/javascript" src="<?php echo base_url('ref/adminlte/plugins/multiSelectCheckbox/dist/js/bootstrap-multiselect.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('ref/adminlte/plugins/multiselect/dist/js/multiselect.js'); ?>"></script>

<script src="<?php echo base_url('ref/adminlte/plugins/morris/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('ref/adminlte/plugins/morris/morris.js'); ?>"></script>
<script src="<?php echo base_url('ref/adminlte/plugins/morris/morris.min.js'); ?>"></script>

<!--iCheck js-->
<script src="<?php echo base_url('ref/adminlte/plugins/iCheck/icheck.min.js'); ?>"></script>
<!--DataTable-->
<!--JS-->
<script type="text/javascript" src="<?php echo base_url('ref/datatables/resources/media/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('ref/datatables/resources/media/Responsive-master/js/jquery.dataTables.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('ref/datatables/resources/media/Responsive-master/js/dataTables.responsive.js'); ?>"></script>

<!--Boostrap Validator -->
<!--JS-->
<script type="text/javascript" src="<?php echo base_url('ref/validation/js/bootstrapValidator.min.js'); ?>"></script>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('ref/adminlte/plugins/daterangepicker/daterangepicker.js'); ?>"></script>

<!-- DatePicker -->
<script src="<?php echo base_url('ref/adminlte/plugins/datepicker/bootstrap-datepicker.js'); ?>"></script>

<!--Input Masks-->
<script src="<?php echo base_url('ref/adminlte/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
<script src="<?php echo base_url('ref/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
<script src="<?php echo base_url('ref/adminlte/plugins/input-mask/jquery.inputmask.extensions.js'); ?>"></script>

<!-- Colorpicker -->
<script src="<?php echo base_url('ref/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js'); ?>"></script>

<!--notify.js-->
<script src="<?php echo base_url('ref/notify_js/notify.js'); ?>"></script>

<!--growl notification-->
<script src="<?php echo base_url('ref/igrowl/dist/js/igrowl.min.js'); ?>"></script>

<!--Bootstrap notify.js-->
<script src="<?php echo base_url('ref/bootstrap-notify-master/bootstrap-notify.min.js'); ?>"></script>

<!--Bootbox.js-->
<script src="<?php echo base_url('ref/bootstrap/js/bootbox.min.js'); ?>"></script>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url('ref/adminlte/plugins/chartjs/Chart.min.js'); ?>"></script>

<!-- Knob Charts -->
<script src="<?php echo base_url('ref/adminlte/plugins/knob/jquery.knob.js'); ?>"></script>

<!-- J Crop -->
<script src="<?php echo base_url('ref/tapmodo-Jcrop-1902fbc/js/jquery.Jcrop.min.js'); ?>"></script>

<!-- Slim scroll 1.0.1 -->
<script src="<?php echo base_url('ref/adminlte/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>

<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="<?php echo base_url('ref/adminlte/plugins/fullcalendar/fullcalendar.js'); ?>"></script>

<!--editer-->
<script src="<?php echo base_url('ref/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>

<!--Jquery in the adminHeader makes datatables work-->

<script src="https://rawgit.com/jquery/jquery-ui/1-11-stable/external/jquery-simulate/jquery.simulate.js"></script>

<!--additional scripts-->
<script src="<?php echo base_url('ref/Additional_jScripts.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('ref/highchart/highcharts.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('ref/highchart/modules/exporting.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('ref/highchart/modules/no-data-to-display.js'); ?>"></script>

<!--jquery auto complete-->
<script src="<?php echo base_url('ref/adminlte/plugins/jQuery-Autocomplete-master/dist/jquery.autocomplete.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    <?php if (!empty($_SESSION['loggedInAs'] && $_SESSION['loggedInAs'] == 'emp')) { ?>
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/587f2892675718240c6df660/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    <?php } else { ?>

    <?php } ?>
</script>
<!--End of Tawk.to Script-->

<script type="text/javascript">
    var popTemplate = '<div class="popover"><div class="arrow"></div>';
    popTemplate += '<h3 class="popover-title"></h3><div class="popover-content"></div><div class="popover-footer"></div></div>';
    $('.popover-dismiss').popover({
        trigger: 'focus',
        template: popTemplate
    });

    $('.popover-dismiss').on('show.bs.popover', function(e) {
        details_in_popup();
    });

    function details_in_popup() {
        let FormID = window.localStorage.getItem('FormID');

        $.ajax({
            method: 'POST',
            dataType: 'json',
            url: 'Srp_ha_empDashboardController/common_instruction',
            data: {
                'FormID': FormID
            },
            success: function(data) {
                $(".popover-content").html(data.data.Memo);
            }
        });
    }

    function notify(_type, _meg, icon = '') {
        let title = 'Error! ';
        let cus_icon = 'fa fa-exclamation-circle';
        let notify_type = 'success';

        switch (_type) {
            case 'e':
                notify_type = 'danger';
                title = 'Error! ';
                cus_icon = 'fa fa-exclamation-circle';
                break;
            case 's':
                notify_type = 'success';
                title = 'Success !';
                cus_icon = 'fa fa-exclamation-circle';
                break;
        }

        if (icon != '') {
            cus_icon = icon;
        }

        $.notify({
            title: title,
            message: _meg,
            icon: cus_icon,
        }, {
            type: notify_type,
            delay: 10000,
            z_index: 5000,
            placement: {
                from: 'bottom',
                align: 'center'
            },
        });

        //     $(document).ready(function () {
        //     //Get CurrentUrl variable by combining origin with pathname, this ensures that any url appendings (e.g. ?RecordId=100) are removed from the URL
        //     var CurrentUrl = window.location.origin+window.location.pathname;
        //     //Check which menu item is 'active' and adjust apply 'active' class so the item gets highlighted in the menu
        //     //Loop over each <a> element of the NavMenu container
        //     $('#navbar-menu a').each(function(Key,Value)
        //     {
        //         //Check if the current url
        //         if(Value['href'] === CurrentUrl)
        //         {
        //             //We have a match, add the 'active' class to the parent item (li element).
        //             $(Value).parent().addClass('active');
        //         }
        //     });
        // });

    }
</script>
</body>

</html>