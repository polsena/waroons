<?php $this->view('ajax_loading_v'); ?>

<?php if (isset($msg_text)): ?>
    <script type="text/javascript">
        $(function () {
            var msg_text = "<?php echo $msg_text; ?>";
            $.facebox(msg_text);
        });
    </script>
<?php endif; ?>

<script type="text/javascript">
    $(function () {
        $('#alert_frm').css('display', 'none');
        $("#myform").validate({
            onkeyup: false,
            messages: {
                password2: {
                    equalTo: "กรอกรหัสผ่านให้ตรงกัน"
                }
            }
        });

        $.metadata.setType("attr", "validate");
    });

    function save() {
        var p = {};
        p['id'] = $('#id').val();
        p['username'] = $('#username').val();
        p['email'] = $('#email').val();
        $.ajax({
            data: p,
            url: "<?php echo site_url('member/ajax_validate') ?>",
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.msg == '1') {
                    $('#alert_frm').text(data.msg_text).show();
                } else {
                    $('#myform').submit();
                }
            },
            error: function () {
                alert('ไม่สามารถทำรายการได้ !!');
            }
        });
        return false;
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><?php echo $page_title; ?></h3>
        <div class="panel panel-default">
            
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="textbox_content">
                            <div class="alert alert-error" style="display:none" id="alert_frm"></div>
                            <?php echo form_open('member/saveprofile', array('id' => 'myform', 'class' => 'form-horizontal', 'role' => 'form')); ?>
                            <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>

                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">ชื่อ-นามสกุล :<span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control required" name="name" style="width: 350px" value="<?php echo @$row['name']; ?>" />
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="" class="col-sm-2 control-label">ชื่อเล่น :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nickname" name="nickname" value="<?php echo @$row['nickname']; ?>" style="width:350px"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">ชื่อเข้าใช้งาน :<span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control required" disabled id="username" name="username" value="<?php echo @$row['username']; ?>" style="width:350px"/>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">รหัสผ่าน :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password1" name="password1" value="" style="width:350px"/>
                                <p class="commment">ว่างไว้ถ้าไม่ต้องการเปลี่ยน</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">ยืนยันรหัสผ่าน :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password2" name="password2" equalTo="#password1" value="" style="width:350px"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">email :<span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control required" id ="email" name="email" style="width: 350px" value="<?php echo @$row['email']; ?>" style="width:350px"/>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="" class="col-sm-2 control-label">ที่อยู่ :</label>
                                <div class="col-sm-10">
                                    <textarea cols="45" rows="5" name="address"><?php echo @$row['address']; ?></textarea>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">โทรศัพท์(มือถือ) :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tel" value="<?php echo @$row['tel']; ?>" style="width:150px"/>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Line ID :</label>
                                <div class="col-sm-10">

                                    <input type="text" class="form-control" name="lineid" value="<?php echo @$row['lineid']; ?>" style="width:150px"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Facebook :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="facebook" value="<?php echo @$row['facebook']; ?>" placeholder="http://www.facebook.com/9top"style="width:350px"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <a href="#" class="btn btn-default" onclick="return save();"><i class="glyphicon icon-hdd"></i> ปรับปรุ่ง</a>
                                </div>
                            </div>

                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>