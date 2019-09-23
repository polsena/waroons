<?php $this->view('ajax_loading_v'); ?>

      <?php if (@$msg != ''): ?>
            <script type="text/javascript">
                $(function () {
                    $('#div_alert_text').text("<?php echo $msg; ?>");
                    $('#div_alert').show();
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

<div id="masthead">

    <div class="container">

        <div class="masthead-pad">

            <div class="masthead-text pull-right">
                <h2><?php echo $page_title; ?></h2>
                <p>http://waroon.rmu.ac.th</p>

            </div> <!-- /.masthead-text -->

        </div>

    </div> <!-- /.container -->	

</div> <!-- /#masthead -->

<div id="content">

    <div class="container">

        <div class="row">
            <div class="span12">
                <div id="div_alert" class="alert alert-danger" hidden="true" >
                    <div id="div_alert_text"></div>
                </div>
                <div class="textbox_content">
                    <div class="alert alert-error" style="display:none" id="alert_frm"></div>
                    <?php echo form_open('member/save', array('id' => 'myform', 'class' => 'form-horizontal', 'role' => 'form')); ?>
                    <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>


                    <div class="control-group">
                        <label class="control-label" for="name">ประเภทผู้ใช้</label>
                        <div class="controls">
                            <select name="mem_type" style="width:350px">

                                <option value="2" <?php echo (@$row['mem_type'] == '2') ? 'selected' : ''; ?>>ผู้ประกาศข่าวประจำหน่วยงาน</option>
                                <option value="1" <?php echo (@$row['mem_type'] == '1') ? 'selected' : ''; ?>>ผู้ดูแลระบบ</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">สถานะ</label>
                        <div class="controls">
                            <select name="status" style="width:350px">
                                <option value="0" <?php echo (@$row['status'] == '0') ? 'selected' : ''; ?>>รออนุมัติ</option>
                                <option value="1" <?php echo (@$row['status'] == '1') ? 'selected' : ''; ?>>ใช้งาน</option>
                                <option value="2" <?php echo (@$row['status'] == '2') ? 'selected' : ''; ?>>ระงับการใช้งาน</option>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">ชื่อเข้าใช้งาน :<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" class="input-large required" id="username" name="username" value="<?php echo @$row['username']; ?>" />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">รหัสผ่าน :</label>
                        <div class="controls">

                            <input type="text" class="input-large"id="password" name="password">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">ชื่อ-นามสกุล :<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" class="input-large required" name="name" style="width: 350px" value="<?php echo @$row['name']; ?>" />
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="name">คณะ/สังกัด/หน่วยงาน :<span class="required">*</span></label>
                        <div class="controls">
                            <input type="text" class="input-large required" name="fac_short" style="width: 350px" value="<?php echo @$row['fac_short']; ?>" /><span class="comment"> * ใช้เป็นตัวย่อ เช่น ศูนย์คอมพิวเตอร์ ใช้ ศคพ.-จะแสดงตอนประกาศข่าว หน้าเว็บ</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="name">อีเมล์สำหรับการติดต่อ :</label>
                        <div class="controls">

                            <input type="text" class="input-large"id="email" name="email"  value="<?php echo @$row['email']; ?>">
                        </div>
                    </div>
                   <div class="form-actions">

                
                            <button type="submit" class="btn btn-primary btn-large" onclick="return save();" ><i class="icon-adjust"></i> บันทึกข้อมูล</button>

                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
