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
        $('#div_grid').load("<?php echo site_url('news/ajax_get_grid_v') ?>", p);
        return false;
    }

    function grid_btn_del(id) {
        if (confirm('คุณต้องการลบข้อมูลรายการนี้ ใช่หรือไม่?')) {
            var p = {};
            p['id'] = id;
            $.ajax({
                data: p,
                url: "<?php echo site_url('news/ajax_delete') ?>",
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
            <div class="table-search pull-right">
                <?php echo form_open('', array('class' => 'form-inline')); ?>
                <label><b>ค้นหาข่าว</b></label>
                <div class="input-append">
                    <select id="txtsearch" name="txtsearch" class="form-control" title="เลือกรายการที่ต้องการค้นหา !" validate="required:true">
                            <option value="">*** เลือกรายการที่ต้องการค้นหา***</option>
                            <?php
                            $this->db->order_by('id','asc');
                            $user  = $this->db->get('tbmember')->result_array();
                            foreach ($user as $r):
                              
                                ?>
                                <option value="<?php echo $r['id']; ?>"><?php echo $r['fac_short']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    <button class="btn btn-default" type="button" onclick="return load_div_grid();"><i class="glyphicon glyphicon-search"></i> ค้นหา</button> 
                </div>
                <?php echo form_close(); ?>

            </div>
            <div id="div_grid"></div>
        </div> <!-- /.row -->
    </div> <!-- /.container -->

</div> <!-- /#content -->

