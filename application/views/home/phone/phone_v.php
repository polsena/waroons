<?php $this->view('ajax_loading_v'); ?>
<script type="text/javascript">
    $(function(){
        load_div_grid();

        $("div.pagination a").live("click",function(event){
            var p = {};
            p['txtsearch'] = $('#txtsearch').val();

            event.preventDefault();
            var url=$(this).attr("href");
            if(url!=undefined){
                $('#div_grid').load(url,p);
            }
            return false;
        });


        $('#txtsearch').focus();
        $('#txtsearch').keydown(function(e){
            if((e.keyCode==13)){
                load_div_grid();
                return false;
            }
        });
        
        $("#myform").validate({
            submitHandler: function() {
                save();
            }
        });
    });

    function load_div_grid(){
        var p = {};
        p['txtsearch'] = $('#txtsearch').val();
        $('#div_grid').load("<?php echo site_url('phone/ajax_get_grid') ?>",p);
        return false;
    }

    function grid_btn_del(id){
        if(confirm('คุณต้องการลบข้อมูลรายการนี้ ใช่หรือไม่?')){
            var p = {};
            p['id'] = id;
            $.ajax({
                data:p,
                url:"<?php echo site_url('phone/ajax_delete') ?>",
                type:'POST',
                dataType:'json',
                success: function(){
                    load_div_grid();
                },
                error:function(){
                    alert('ไม่สามารถทำรายการได้ !!');
                }
            });
        }
        return false;
    }
</script>


<div class="content container">
    <div class="page-wrapper">
        
        <div class="page-content">
            <div class="row page-row">
                <hr/><h3>หมายเลขโทรศัพท์อาจารย์/บุคลากร/เจ้าหน้าที่</h3>
                <div class="pull-right">
                    <?php echo form_open('', array('class' => 'form-inline')); ?>
                    <div class="input-append">

                        <input class="form-control span4" id="txtsearch" name="txtsearch" type="text" placeholder="ค้นหาจากชื่อ/สังกัดหน่วยงาน">
                      
                        <button class="btn btn-default" type="button" onclick="return load_div_grid();"><i class="glyphicon glyphicon-search"></i> ค้นหา</button> 
                    </div>
                    <?php echo form_close(); ?>
                </div>
                
               <div id="div_grid"></div>
               <hr/>
            </div><!--//page-row-->
        </div><!--//page-content-->
    </div><!--//page--> 
</div><!--//content-->
