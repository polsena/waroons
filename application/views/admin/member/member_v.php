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
        $('#div_grid').load("<?php echo site_url('member/ajax_get_grid') ?>", p);
        return false;
    }

    function grid_btn_del(id) {
        if (confirm('คุณต้องการลบข้อมูลรายการนี้ ใช่หรือไม่?')) {
            var p = {};
            p['id'] = id;
            $.ajax({
                data: p,
                url: "<?php echo site_url('member/ajax_delete') ?>",
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
            <div class="table-search">
                <?php echo form_open('', array('class' => 'form-inline')); ?>
                <label><b>ค้นหา</b></label>
                <div class="input-append">
                    <input class="form-control" id="txtsearch" name="txtsearch" type="text">
                    <button class="btn btn-default" type="button" onclick="return load_div_grid();"><i class="glyphicon glyphicon-search"></i> ค้นหา</button> 
                </div>
                <?php echo form_close(); ?>
               
            </div>

            <br/>
            <div id="div_grid"></div>
        </div>
    </div> 
</div>


