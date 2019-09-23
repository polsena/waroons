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
        load_div_grid();
        $('#alert_frm').css('display', 'none');
        $("#myform").validate({
            onkeyup: false,
        });

        $.metadata.setType("attr", "validate");
    });

    function save() {
        $('#myform').submit();
    }
    function load_div_grid() {
        var p = {};
        $('#div_grid').load("<?php echo site_url('slide/ajax_get_grid') ?>", p);
        return false;
    }
    function grid_btn_del(id) {
        if (confirm('คุณต้องการลบข้อมูลรายการนี้ ใช่หรือไม่?')) {
            var p = {};
            p['id'] = id;
            $.ajax({
                data: p,
                url: "<?php echo site_url('slide/ajax_delete') ?>",
                type: 'POST',
                dataType: 'json',
                success: function () {
                    load_div_grid();
                },
                error: function () {
                    alert('ไม่สามารถทำรายการได้ !!');
                }
            });
        }
        return false;
    }
</script>

<div id="masthead">

    <div class="container">

        <div class="masthead-pad">
            <h2><?php echo $page_title; ?></h2>
            <div class="masthead-text pull-right">


                <?php echo anchor('slide/news', "<i class='glyphicon glyphicon-plus'></i> เพิ่มรายการใหม่", array('class' => 'btn btn-outline btn-defualt btn-xs')); ?>



            </div> <!-- /.masthead-text -->

        </div>

    </div> <!-- /.container -->	

</div> <!-- /#masthead -->

<div id="content">

    <div class="container">

        <div class="row">
            <div class="span12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="alert alert-error" style="display:none" id="alert_frm"></div>
                            <?php echo form_open_multipart('slide/save', array('id' => 'myform', 'name' => 'frmMain', 'class' => 'form-horizontal', 'role' => 'form')); ?>
                            <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>
                           
                            <div class="control-group">
                                <label class="control-label" for="name">เรื่อง :</label>
                                <div class="controls">
                                    <input type="text" id="topic" name="topic" class="span8 required"  maxlength="250" value="<?php echo @$row['topic']; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">ภาพสไลด์ :</label>
                                <div class="controls">
                                    <input type="file" class="form-control" id = "name" name="userfile" style="width: 350px" value="<?php echo @$row['thumb_name']; ?>" />
                                    <small>**(ขนาดภาพ 610*250 px) ** ชื่อภาพต้องเป็นภาษาอังกฤษเท่านั้นและห้ามเว้นวรรค รองรับไฟล์ที่มีนามสกุล .gif,.jpg,.png </small>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">URL :</label>
                                <div class="controls">
                                    <input type="text" id="url" name="url" class="span6"  maxlength="250" value="<?php echo @$row['url']; ?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">รายละเอียดเพิ่มเติม :</label>
                                <div class="controls">
                                    <textarea rows="2" cols="43" name="detail" id="detail" class="input-large"><?php echo @$row['detail']; ?></textarea>
                                    <?php echo $ckeditor; ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name">แนบไฟล์เอกสาร :</label>
                                <div class="controls">
                                    <input type="file" value="<?php echo @$row['filetmp']; ?>" name="filename" accept="gif|jpg|png|zip|rar|pdf|doc|docx" size="80" /> <span class="alert alert-info"> * รองรับไฟล์ PDF,ZIP ขนาดไฟล์ไม่เกิน 10 MB.ถ้าาเกินนี้จะอัฟไม่ได้</span>
                                </div>
                            </div>
                            <div class="form-actions">

                                <a href="#" class="btn btn-default" onclick="return save();"><i class="icon-hdd"></i> บันทึกข้อมูล</a>
                            </div>

                            <?php echo form_close(); ?>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                        <div class="col-lg-6">
                            <h3>รายการภาพ</h3>

                            <div id ='div_grid'></div>

                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /.row -->

