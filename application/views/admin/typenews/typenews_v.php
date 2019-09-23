<?php $this->view('ajax_loading_v'); ?>
<script type="text/javascript">
    $(function () {
        load_div_grid();

        $("div.pagination a").live("click", function (event) {
            var p = {};
            p['txtsearch'] = $('#txtsearch').val();

            event.preventDefault();
            var url = $(this).attr("href");
            if (url != undefined) {
                $('#div_grid').load(url, p);
            }
            return false;
        });


        $('#txtsearch').focus();
        $('#txtsearch').keydown(function (e) {
            if ((e.keyCode == 13)) {
                load_div_grid();
                return false;
            }
        });

        $("#myform").validate({
            submitHandler: function () {
                save();
            }
        });
    });

    function load_div_grid() {
        var p = {};
        p['txtsearch'] = $('#txtsearch').val();
        $('#div_grid').load("<?php echo site_url('typenews/ajax_get_grid') ?>", p);
        return false;
    }

    function save() {
        var p = {};
        p['id'] = $('#id').val();
        //p['code'] = $('#code').val();
        p['type_name'] = $('#type_name').val();

        $.ajax({
            data: p,
            url: "<?php echo site_url('typenews/ajax_save') ?>",
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.msg == '1') {
                    //$.facebox(data.msg_text);
                    $('#alert_frm').text(data.msg_text).show();
                } else {
                    $('#myModal').modal('hide');
                    load_div_grid();
                }
            },
            error: function () {
                alert('ไม่สามารถทำรายการได้ !!');
            }
        });
        return false;
    }

    function grid_btn_edit(id) {
        clear_form();
        var p = {};
        p['id'] = id;
        $.ajax({
            data: p,
            url: "<?php echo site_url('typenews/ajax_get_data') ?>",
            type: 'POST',
            dataType: 'json',
            success: function (data) {
                $('#id').val(data.id);
                //$('#code').val(data.code);
                $('#type_name').val(data.type_name);
                $('#myModal').modal('show');
            },
            error: function () {
                alert('ไม่สามารถทำรายการได้ !!');
            }
        });
        return false;
    }

    function grid_btn_del(id) {
        if (confirm('คุณต้องการลบข้อมูลรายการนี้ ใช่หรือไม่?')) {
            var p = {};
            p['id'] = id;
            $.ajax({
                data: p,
                url: "<?php echo site_url('typenews/ajax_delete') ?>",
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

    function clear_form() {
        $('label.error,#alert_frm').css('display', 'none');
        $('input').removeClass('error');

        $('#id').val('');
        //$('#code').val('');
        $('#type_name').val('');
        return false;
    }
</script>
<div id="masthead">

    <div class="container">

        <div class="masthead-pad">

            <div class="masthead-text pull-right">
                <h2><?php echo $page_title; ?></h2>
                <div class="pull-right">
                    <a href="#myModal" role="button" class="btn btn-default" data-toggle="modal" onclick="return clear_form();"><i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูล</a>
                    <?php echo anchor('admin', "<i class='glyphicon glyphicon-off'></i> ปิด", array('class' => 'btn btn-default')); ?>
                </div>
            </div> <!-- /.masthead-text -->

        </div>

    </div> <!-- /.container -->	

</div> <!-- /#masthead -->

<div id="content">

    <div class="container">

        <div class="row">
            <div class="table-search">
                <?php echo form_open('', array('class' => 'form-inline')); ?>
                <label><b>ค้นหา</b></label>
                <div class="input-append">
                    <input class="form-control" id="txtsearch" name="txtsearch" type="text">
                    <button class="btn btn-default" type="button" onclick="return load_div_grid();"><i class="glyphicon glyphicon-search"></i> ค้นหา</button>
                </div>
                <?php echo form_close(); ?>
            </div><br/>
            <div id="div_grid"></div>
        </div>
    </div> 
</div> 



<!-- หน้าจอเพิ่มข้อมูล -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>

        <h3><?php echo $page_title; ?></h3>
    </div>
    <form method="post" class="form-horizontal" role="form"id="myform">

        <div class="modal-body">
            <div class="alert alert-error" style="display:none" id="alert_frm">
            </div>

            <input type="hidden" id="id" name ="id"/>

            <table border="0" cellpadding="4" cellspacing="1" class="tblform">
                <tbody>

                    <tr>
                        <td class="td1">ประเภทข่าว :</td>
                        <td>
                            <input type='text' id="type_name" name='type_name' class="form-control" maxlength="120" required/>

                        </td>
                    </tr>


                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true"> ปิด </button>
            <button class="btn btn-primary" type="submit"><i class="icon-hdd icon-white"></i> บันทึกข้อมูล</button>
        </div>
    </form>
</div>

