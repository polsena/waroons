<?php $this->view('ajax_loading_v'); ?>
<script type="text/javascript">
    $(function () {
        load_div_grid();
        $("div.pagination a").live("click", function (event) {
            var p = {};
            p['txtsearch'] = $('#txtsearch').val();
            p['id'] = $('#id').val();
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
        p['id'] = $('#id').val();
        $('#div_grid').load("<?php echo site_url('home/ajax_get_grid_type') ?>", p);
        return false;
    }

</script>

<div class="content container">
    <div class="page-wrapper">

        <div class="page-content">
            <div class="row page-row">
                <div class="pull-right">
                    <?php echo form_open('', array('class' => 'form-inline')); ?>
                    <label><b>ค้นหาข่าวด่วน</b></label>
                    <div class="input-append">
                        <input class="form-control" id="id" name="id" type="hidden" value="<?php echo $rs['id']; ?>">
                        <select id="txtsearch" name="txtsearch" class="form-control" title="เลือกรายการที่ต้องการค้นหา !" validate="required:true">
                            <option value="">*** เลือกรายการที่ต้องการค้นหา***</option>
                            <?php
                            $this->db->order_by('id', 'asc');
                            $user = $this->db->get('tbmember')->result_array();
                            foreach ($user as $r):
                                ?>
                                <option value="<?php echo $r['id']; ?>"><?php echo $r['fac_short']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button class="btn btn-default" type="button" onclick="return load_div_grid();"><i class="glyphicon glyphicon-search"></i> ค้นหา</button> 
                    </div>
                    <?php echo form_close(); ?>
                </div>

                <h3 class="has-divider text-highlight"><span class="glyphicon glyphicon-bookmark"></span> รายการ<?php echo $rs['id'];?>ทั้งหมด</h3>

                <div id="div_grid"></div>
            </div><!--//page-row-->
        </div><!--//page-content-->
    </div><!--//page--> 
</div><!--//content-->

