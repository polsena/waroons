        <?php if (@$msg_text != ''): ?>
            <script type="text/javascript">
                $(function () {
                    $('#div_alert_text').text("<?php echo $msg_text; ?>");
                    $('#div_alert').show();
                });
            </script>

        <?php endif; ?>
<script type="text/javascript">
    $(function () {

        
        $('#alert_frm').css('display', 'none');
        $("#date").mask("99/99/9999");
        $("#myform").validate({
            onkeyup: false,
        });
        $.metadata.setType("attr", "validate");
    });
    function save() {

        $('#myform').submit();

    }

</script>

<div id="masthead">

    <div class="container">

        <div class="masthead-pad">

            <div class="masthead-text">
                <h2>แบบฟอร์มจัดการข่าวสาร</h2>
                <div class="pull-right">
                    <?php echo anchor('news/add', "<i class='glyphicon glyphicon-plus'></i> Add New", array('class' => 'btn btn-outline btn-defualt btn-xs')); ?>
                    <?php echo anchor('news', "<i class='glyphicon glyphicon-off'></i> ปิด", array('class' => 'btn btn-outline btn-defualt btn-xs')); ?>
                </div>
            </div> <!-- /.masthead-text -->

        </div>

    </div> <!-- /.container -->	

</div> <!-- /#masthead -->

<div id="content">

    <div class="container">

        <div class="row">
            <div class="span12">

                <div class="alert alert-error" style="display:none" id="alert_frm"></div>
                 <div id="div_alert" class="alert alert-danger" hidden="true" >
                    <div id="div_alert_text"></div>
                </div>
                <?php echo form_open_multipart('news/save', array('id' => 'myform', 'name' => 'frmMain', 'class' => 'form-horizontal', 'role' => 'form')); ?>
                <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>

                <div class="control-group">
                    <label class="control-label" for="name">วันที่ประกาศข่าว :</label>
                    <div class="controls">
                        <?php echo $this->mydate->dateThaiLong(date("d-m-Y")); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="name">ประเภทข่าว :<span class="required">*</span></label>
                    <div class="controls">
                        <select id="type_id" name="type_id" style="padding: 2px;" title="เลือกประเภทข่าว !" validate="required:true">
                            <option value="">*** เลือกแประเภทข่าว***</option>
                            <?php
                            foreach ($typenews as $r):
                                $selected = ($r['id'] == @$row['type_id']) ? 'selected' : '';
                                ?>

                                <option value="<?php echo $r['id']; ?>" <?php echo $selected; ?>><?php echo $r['type_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="name">เรื่อง :<span class="required">*</span></label>
                    <div class="controls">
                        <input type="text" id="topic" name="topic" class="span10 required"  value="<?php echo @$row['topic']; ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="name">รายละเอียด :</label>
                    <div class="controls">
                        <textarea rows="2" cols="43" name="detail" id="detail" class="input-large"><?php echo @$row['detail']; ?></textarea>
                        <?php echo $ckeditor; ?>
                    </div>
                </div>
                <?php if (@$row['filetmp'] != '') : ?>
                    <div class="control-group">
                        <label class="control-label" for="name">ไฟล์เดิม :</label>
                        <div class="controls">
                            <a href="<?php echo base_url() . "assets/upload/file/" . @$row['filetmp']; ?>"><?php echo @$row['filename']; ?></a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="control-group">
                    <label class="control-label" for="name">แนบไฟล์เอกสาร :</label>
                    <div class="controls">
                        <input type="file" name="filename" accept="gif|jpg|png|zip|rar|pdf|doc|docx" size="80" /> <span class="alert alert-info"> * รองรับไฟล์ PDF,ZIP ขนาดไฟล์ไม่เกิน 10 MB.ถ้าาเกินนี้จะอัฟไม่ได้</span>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="name">สถานะข่าว :</label>
                    <div class="controls">
                        <select name="status" class="my" style="width:120px">
                            <option value="1" <?php echo (@$row['status'] == '1') ? 'selected' : ''; ?> >แสดง</option>
                            <option value="0" <?php echo (@$row['status'] == '0') ? 'selected' : ''; ?> >ไม่แสดง</option>
                        </select>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="name">ตั้งเป็นข่าวเด่น :</label>
                    <div class="controls">
                        <select name="quick" class="my" style="width:120px">
                            <option value="0" <?php echo (@$row['quick'] == '0') ? 'selected' : ''; ?> >ไม่ใช่</option>
                            <option value="1" <?php echo (@$row['quick'] == '1') ? 'selected' : ''; ?> >ใช่</option>
                        </select>
                    </div>
                </div>
              




                <div class="form-actions">

                    <a href="#" class="btn btn-large btn-primary" onclick="return save()"><i class="icon-hdd"></i> บันทึกข้อมูล</a>
                </div>
            </div>

            <?php echo form_close(); ?>

        </div>
    </div> 
</div>
</div> 
