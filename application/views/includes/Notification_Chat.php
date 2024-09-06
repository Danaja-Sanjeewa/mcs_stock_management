<script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
<?php
    $primaryLanguage = getPrimaryLanguage();
    $this->lang->load('common', $primaryLanguage);
    $this->lang->load('communication_newsbrd', $primaryLanguage);
?>
<style>
    #Not_addResponse {
        display: inline-block;
        width: 340px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
    }

    #Not_addResponse_Tit {
        display: inline-block;
        width: 50px;
        white-space: nowrap;
        overflow: hidden !important;
        text-overflow: ellipsis;
    }
</style>
<!--Notification Chat Model-->
<form id="Not_responseForm" class="ajax" action="" method="post">
    <div class="modal fade" id="Not_communication_response" role="dialog" aria-labelledby="gridSystemModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" onclick="cls()">&times;</span></button>
                    <h4 class="modal-title"><span id="Not_addResponse_Tit">Chat | </span> <span id="Not_addResponse"></span><br><small id="Not_StuName"></small><br><small id="Not_StuClass"></small></h4>
                </div>
                <div class="modal-body" style="background-color: #d9d9d9;" id="Not_Res_Modal_Body">
                    <div id="Nav_Notification_modalLoaderDiv" style="position: relative; height: 375px; background-color: #d9d9d9 ;">
                        <i class="fa fa-spinner fa-pulse" style=" font-size:25px; position: absolute; left: 55%;top: 50%;margin-left: -32px;margin-top: -32px;"></i>
                    </div>
                    <div id="Nav_Notification_modalDiv" style="display: none;">
                        <div id="Not_respnseChats" style="font-size: 12px;">

                        </div>
                        <div class="form-group" id="Not_attDiv" style="display:none;">
                            <input type="text" name="attName" id="Not_attName" class="form-control" style="display:none;">
                            <input type="text" name="attType" id="Not_attType" value="" style="display:none;">
                            <img src="" name="imageResponse" id="Not_imageResponse" style="width:30px;height:30px;">
                            <h5 id="Not_docNameTag"><b> Document : </b></h5><h6 class="timeline-header" name="documentResponse" id="documentResponse"></h6>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="commId" id="Not_commId" style="display: none;">
                        </div>
                        <div class="form-group">
                            <input type="file" name="upload" id="Not_upload" onchange="Not_uploadOnChangeAttachmentRes(this);" style="display: none;">
                        </div>
                        <div id="Not_Comm_UploadQuotaDiv">

                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: left !important;">
                    <div class="row input-group Chat_MessageFieldDiv_Not" style="width:100%; margin: 0px;">
                        <div class="col-md-9" style="margin-bottom: 5px;">
                            <!-- <input type="text" style="height: 30px;" class="form-control" name="messageResponseNot" id="messageResponseNot"> -->
                            <textarea style="height: 90px; width: 100%;" id="messageResponseNot" name="messageResponseNot" rows="4" cols="50" onkeyup="checkField('text','messageResponseNot','Not_upload');" placeholder="Type your message here..."></textarea>
                            <small id="NEmsg" style="font-size: 80%; color: #dd2117; display: none"><?php echo $this->lang->line('communication_message_required') ?></small>
                        </div>

                        <input type="text" name="msg_not" id="msg_not" value="1" style="display:none;" />
                        <div class="col-md-3">
                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-default btn-sm btn-flat" onclick="Not_chooseattachmentRes(this);"><i class="fa fa-upload"></i> </button>
                                <button type="button" id="submitFakeBtn" onclick="checkField('all','messageResponseNot','Not_upload');" value="submit" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-chevron-circle-right"></i> <?php echo $this->lang->line('communication_send') ?></button>
                                <button type="submit" value="submit" style="display: none;" id="submitBtn" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-chevron-circle-right"></i> <?php echo $this->lang->line('communication_send') ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="Chat_MessagePendingSubsDiv_Not" style="padding:4px; border:4px solid #33adff; display:none;">
                        <i class="fa fa-cogs" aria-hidden="true" style="color:#33adff;"></i> Subscription request pending.
                    </div>
                    <div class="Chat_MessageInactiveSubsDiv_Not" style="padding:4px; border:4px solid #e60000; display:none;">
                        <i class="fa fa-exclamation-circle" aria-hidden="true" style="color:#e60000;"></i> Subscription Inactive! Please subscribe to chat <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" onclick="get_SubscriptionDet(<?php if (isset($_SESSION['par_StuID'])) {
                                                                                                                                                                                                                                                                                echo $_SESSION['par_StuID'];
                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                echo "";
                                                                                                                                                                                                                                                                            } ?>)">Subscribe Now!</button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</form>

<script>

    window.onload = resetUpload();
    var ComH = 0;

    function resetUpload(){

        document.getElementById('Not_attName').value = '';
        document.getElementById('Not_upload').value = '';
        document.getElementById('messageResponseNot').value = '';
        document.getElementById('Not_attDiv').style.display = 'none';
        document.getElementById('Not_imageResponse').src = ""; 
        document.getElementById('documentResponse').innerHTML = "";
        document.getElementById('Not_attType').value = '';

        document.getElementById('submitFakeBtn').style = "";
        document.getElementById('submitBtn').style = "display: none;";
    }

    function checkField(type, id, uploadID){
        if(type == 'text'){
            if(document.getElementById(id).value == ""){
                var file = document.getElementById(uploadID);
                if(file.value == ''){
                    document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117;";
                    ComH = 0;
                } else {
                    document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117; display: none;";
                    ComH = 1;
                }    
            }else{
                document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117; display: none;";
                ComH = 1;
            }
        }else if(type == 'all'){
            if(document.getElementById(id).value == ""){
                var file = document.getElementById(uploadID);
                if(file.value == ''){
                    document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117;";
                    ComH = 0;
                } else {
                    document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117; display: none;";
                    ComH = 1;
                }
            }else{
                document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117; display: none;";
                ComH = 1;
            }
        }else{
            var file = document.getElementById(uploadID);
            if(file.value == ''){
                if(document.getElementById(id).value == ""){
                    document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117;";
                    ComH = 0;
                }else{
                    document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117; display: none;";
                    ComH = 1;
                }
            } else {
                document.getElementById('NEmsg').style = "font-size: 80%;color: #dd2117; display: none;";
                ComH = 1;
            }
        }

        if(ComH == 1){
            document.getElementById('submitFakeBtn').style = "display: none;";
            document.getElementById('submitBtn').style = "";
        }else{
            document.getElementById('submitFakeBtn').style = "";
            document.getElementById('submitBtn').style = "display: none;";
        }
    }

    function cls() {
        $('#Not_responseForm').bootstrapValidator("resetForm", true);
        resetUpload();
    }

    function Not_chat_details(x,f,t,c,n) {
        <?php if ($_SESSION['loggedInAs'] == 'emp') { ?>
            var pageName = 'Srp_sa_communicationMasterController';
        <?php } else if ($_SESSION['loggedInAs'] == 'par') { ?>
            pageName = 'Srp_sa_communicationParentController';
        <?php } ?>

        var id = x.id;
        var numberpattern = /\d+/g;
        var commID = id.match(numberpattern);
        document.getElementById('Not_commId').value = commID;
        var comIDR = document.getElementById('Not_commId').value;

        $.ajax({
            type: "POST",
            url: pageName + "/chat_details",
            dataType: 'json',
            data: {
                'id': comIDR,
                'formId': f,
                'comTo': t,
                'comId': c,
                'type' : n
            },
            beforeSend: function() {
                document.getElementById('Nav_Notification_modalDiv').style.display = 'none';
                document.getElementById('Nav_Notification_modalLoaderDiv').style.display = 'block';
            },
            success: function(data) {
                $('#Not_respnseChats').html(data.chatResp);
                $('#Not_addResponse').html(data.CommSubject);
                $('#Not_StuName').html('Student : '+data.studentCode+' | '+data.student);
                $('#Not_StuClass').html('Class : '+data.studentClass);
                resetUpload();
                Not_scroll_to_End();

                document.getElementById('Nav_Notification_modalLoaderDiv').style.display = 'none';
                document.getElementById('Nav_Notification_modalDiv').style.display = 'block';

                get_Not_Comm_UploadQuotas(comIDR);

            }
        });
    }

    function Reloaded_Not_chat_details(x, ChatSubject, Student) {

        <?php if ($_SESSION['loggedInAs'] == 'emp') { ?>
            var pageName = 'Srp_sa_communicationMasterController';
        <?php } else if ($_SESSION['loggedInAs'] == 'par') { ?>
            pageName = 'Srp_sa_communicationParentController';
        <?php } ?>

        document.getElementById('Not_commId').value = x;
        var comIDR = document.getElementById('Not_commId').value;

        $('#Not_addResponse').html(ChatSubject);
        $('#Not_StuName').html(Student);
        $.ajax({
            type: "POST",
            url: pageName + "/chat_details",
            dataType: 'json',
            data: {
                'id': comIDR
            },
            success: function(data) {
                $('#Not_respnseChats').html(data.chatResp);

                Not_scroll_to_End();
            }
        });
    }

    function Not_scroll_to_End() {

        var container = document.getElementById('Not_Res_Modal_Body');

        function Not_scrollToBottom() {
            container.scrollTop = container.scrollHeight;
        }

        Not_scrollToBottom();

    }

    //posting response
    $(document).ready(function() {
        $('#Not_responseForm')
            .bootstrapValidator({
                framework: 'bootstrap',
                fields: {
                    messageResponseNot: {
                        validators: {
                            // notEmpty: {
                            //     message: 'The message is required'
                            // }
                        }
                    }
                }
            })
            .on('success.form.bv', function(e) {
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                var data = $form.serializeArray();

                var that = $(this),
                    url = that.attr('action'),
                    type = that.attr('method'),
                    data = {};
                that.find('[name]').each(function(index, value) {
                    var that = $(this),
                        name = that.attr('name'),
                        value = that.val();

                    data[name] = value;
                });
                var data = new window.FormData($('#Not_responseForm')[0]);
                e.preventDefault();

                <?php if ($_SESSION['loggedInAs'] == 'emp') {
                    $pageName = 'Srp_sa_communicationMasterController';
                } else if ($_SESSION['loggedInAs'] == 'par') {
                    $pageName = 'Srp_sa_communicationParentController';
                } ?>

                $.ajax({
                    url: "<?php echo site_url($pageName . '/responsePost'); ?>",
                    xhr: function() {
                        return $.ajaxSettings.xhr();
                    },
                    type: type,
                    data: data,
                    success: function(data) {
                        var comIDR = document.getElementById('Not_commId').value;

                        $('#Not_responseForm').bootstrapValidator("resetForm", true);
                        /*if ((data) == 'available') {
                            <?php echo notify('danger', '', '<strong>Data Insertion Failed! </strong>Record Already Exists', 'fa fa-exclamation-circle'); ?>
                        }
                        if((data) == 'inserted'){
                            <?php echo notify('success', '', '<strong>Data Successfully Inserted! </strong>', 'fa fa-check-circle'); ?>
                        }*/
                        var ChatSubject = document.getElementById('Not_addResponse').innerHTML;
                        var ChatStudent = document.getElementById('Not_StuName').innerHTML;

                        document.getElementById('Not_attDiv').style.display = 'none';
                        document.getElementById('Not_imageResponse').src = ""; 
                        resetUpload();
                        
                        Reloaded_Not_chat_details(comIDR, ChatSubject,ChatStudent);
                        
                        
                    },
                    error: function() {
                        <?php echo notify('danger', '', '<strong>Data Insertion Failed! </strong>', 'fa fa-exclamation-circle'); ?>
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

    });

    function get_Not_Comm_UploadQuotas(CommID) {

        $.ajax({
            type: 'POST',
            url: 'Srp_UploadController/get_uploadQuotas_Notifications',
            data: {
                'UploadTypeMasterID': '8',
                'CommID': CommID
            },
            success: function(data) {
                $('#Not_Comm_UploadQuotaDiv').html(data);
            }
        });

    }

    function Not_chooseattachmentRes() {
        document.getElementById('Not_upload').click();
    }

    function Not_uploadOnChangeAttachmentRes(w) {

        if (w.files && w.files[0]) {
            var reader = new FileReader();

            var fileName = w.files[0].name;
            var patternFileExtension = /\.([0-9a-z]+)(?:[\?#]|$)/i;
            var fileExtensionL = (fileName).match(patternFileExtension);

            if(fileExtensionL.indexOf("pdf") == 1 || fileExtensionL.indexOf("doc") == 1 || fileExtensionL.indexOf("docx") == 1){
                document.getElementById('Not_docNameTag').style = '';
                document.getElementById('documentResponse').innerHTML = fileName;
                document.getElementById('documentResponse').style = '';
                document.getElementById('Not_imageResponse').style = 'display:none;';
                document.getElementById('Not_imageResponse').src = ""; 
                document.getElementById('Not_attType').value = "doc";

            }else{
                reader.onload = function(e) {
                    $("#Not_imageResponse")
                        .attr("src", e.target.result)
                };

            reader.readAsDataURL(w.files[0]);
                document.getElementById('Not_imageResponse').style = 'width: 30px;height: 30px;';
                document.getElementById('documentResponse').style = 'display:none;';
                document.getElementById('documentResponse').innerHTML = "";
                document.getElementById('Not_docNameTag').style = 'display:none;';
                document.getElementById('Not_attType').value = "img";
            }
            checkField('upload','messageResponseNot','Not_upload');
        }


        var filename2 = w.value;
        var filename = filename2.replace(/^.*[\\\/]/, "");
        var base_url = '<?php echo base_url("ref/images/") ?>';

        if (filename == "" || filename == null) {} else {
            document.getElementById('Not_attName').value = filename;
            document.getElementById('Not_attDiv').style.display = 'block';
        }

        Not_check_uploadQuota_comm(w, '', '', '', '', '1');

    }


    function Not_check_uploadQuota_comm(x, FlagName1, FlagName2, UploadName1, UploadName2, isResponse) {

        var UploadFieldID = x.id;
        var filesize = (($('#' + UploadFieldID)[0].files[0].size) / 1024); //KB
        var isCountEnabled = document.getElementById('Not_File_isCountedForQuota').value;
        var File_UploadSize = document.getElementById('Not_File_UploadSize').value;
        var File_UsedUploadSize = document.getElementById('Not_File_UsedUploadSize').value;
        var File_MaxUploadSize = document.getElementById('Not_File_MaxUploadSize').value;

        <?php if ($_SESSION['loggedInAs'] == 'emp') { ?>
            var loggedInAs = 'emp';
        <?php } else if ($_SESSION['loggedInAs'] == 'par') { ?>
            loggedInAs = 'par';
        <?php } ?>



        if ((filesize / 1024) > File_UploadSize) { //filesize in MB

            $.notify({
                title: '<strong>Uploading Failed!</strong>',
                message: 'The attachment size exceeds the allowable limit (' + File_UploadSize + 'MB). Please upload an attachment within the limit.'
            }, {
                element: '#Not_communication_response',
                allow_dismiss: true,
                type: 'danger',
                placement: {
                    from: 'bottom'
                },
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
            resetUpload();

        } else {
            if (loggedInAs == 'emp') {
                if (isCountEnabled == '1') {
                    var UsedSpace = File_UsedUploadSize + (filesize / 1024 / 1024); //filesize in GB

                    if (UsedSpace > File_MaxUploadSize) {

                        $.notify({
                            title: '<strong>Uploading Failed!</strong>',
                            message: 'No free space available for uploading.'
                        }, {
                            element: '#Not_communication_response',
                            allow_dismiss: true,
                            type: 'danger',
                            placement: {
                                from: 'bottom'
                            },
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            }
                        });
                        resetUpload();
                    }

                }
            }
        }

    }


    function update_isSeen(x) {

        var id = x.id;
        var numberpattern = /\d+/g;
        var commID = id.match(numberpattern);

        <?php if ($_SESSION['loggedInAs'] == 'emp') { ?>
            var pageName = 'Srp_notificationsController/Update_isSeen';
        <?php } else if ($_SESSION['loggedInAs'] == 'par') { ?>
            pageName = 'Srp_notificationsController/Update_parIsSeen';
        <?php } ?>

        $.ajax({
            type: "POST",
            url: pageName,
            data: {
                'id': commID
            },
            success: function(data) {
                getEmpNotificationsUnseen();
                getOtherEmpNotificationsUnseen();
            }
        });

    }
</script>
<?php
/**
 * Created by PhpStorm.
 * User: Haaniya
 * Date: 31/08/2016
 * Time: 02:15 PM
 */
