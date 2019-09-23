<!DOCTYPE html>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <META NAME="Keywords" CONTENT="ระบบข่าวออนไลน์ มหาวิทยาลัยราชภัฎมหาสารคาม" />
    <meta name="stats-in-th" content="c318" />
    <title>ระบบข่าวออนไลน์ มหาวิทยาลัยราชภัฎมหาสารคาม</title>

    <link href="<?php echo base_url(); ?>assets/home/tab/tabcontent.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/tab/default.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/css/reset.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/css/font.css" type="text/css"/>


    <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/jquery-1.10.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/home/tab/tabcontent.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/jquery.tablecolor.js"></script>


    <script type="text/javascript">
        $(function () {

            $('#mytable1').colorize({row: 'hover', oneClick: true});
            $('#mytable2').colorize({row: 'hover', oneClick: true});
            $('#mytable3').colorize({row: 'hover', oneClick: true});
            $('#mytable4').colorize({row: 'hover', oneClick: true});
            $('#mytable5').colorize({row: 'hover', oneClick: true});
            $('#mytable6').colorize({row: 'hover', oneClick: true});
            $('#mytable7').colorize({row: 'hover', oneClick: true});
        });
        $('#txtsearch').keydown(function (e) {
            if ((e.keyCode == 13)) {
                $('#btnsearch').click();
                return false;
            }
        });

        $('#user_id').change(function () {

        });



        function find_all() {
            $('#txtsearch').val('');
            $('#btnsearch').click();
        }
    </script>
</head>
<?php $this->view('ajax_loading_v'); ?>
<body style="background:#F6F9FC;font-family:Arial;">
    <div id="loading" style="display:none">
        <div style="padding-left:20px">กำลังประมวลผล....</div>
    </div>

    <div class ="readmore2">
        <?php echo form_open('search', array('id' => 'myform_search', 'target' => '_blank')); ?>
        <b>ค้นหาข่าว :</b>
        <select id="user_id" name="user_id" style="padding: 2px;" title="เลือกหน่วยงาน !" validate="required:true">
            <option value="">*** เลือกทุกหน่วยงาน ***</option>
            <?php
            $user = $this->db->get('tbmember')->result_array();
            foreach ($user as $r):
                ?>
                <option value="<?php echo $r['id']; ?>"><?php echo "ประกาศจาก : " . $r['fac_short']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" name="btnsearch" value="ค้นหา" style="font-size: 14px"/> <a href ="<?php echo base_url(); ?>login" type="button" name="btnsearch" target ="_blank">เข้าระบบ</a>
        <?php echo form_close(); ?>
    </div>

    <div>
        <ul class="tabs" data-persist="true">
            <?php
            $this->db->order_by('id', 'asc');
            $type = $this->db->get('tbtype')->result_array();
            foreach ($type AS $rs) :
                ?>
                <li><a href="#<?php echo $rs['type_name']; ?>"><?php echo $rs['type_name']; ?></a></li>
            <?php endforeach ?>
        </ul>
        <div class="tabcontents">
            <?php
            $this->db->order_by('id', 'asc');
            $v = $this->db->get('tbtype')->result_array();
            foreach ($v AS $rs) :
                ?>
                <div id="<?php echo $rs['type_name']; ?>">
                    <?php
                    $irow = 0;
                    $iLoop = 0;
                    echo'<table width ="100%"class="gridview" id ="mytable' . $rs['id'] . '">';
                    $this->db->limit(12);
                    $this->db->order_by('id', 'desc');
                    $public = $this->db->get_where('tbnews', array('type_id' => $rs['id']))->result_array();
                    foreach ($public as $r) {
                        $irow++;
                        $iLoop++;
                        $bgcolor = ( ($iLoop % 2) == 0 ) ? "color1" : "color2";
                        echo "<tbody><tr class='$bgcolor'>";
                        echo "<td class='' width ='50'>" . $this->mydate->dateThaiLongShotfull($r['date']) . "</td><td width='350'>" . anchor('pages/' . $r['id'], $r['topic'], 'target ="_blank"') . "</td>";
                        echo "</tr>";
                    }
                    if ($irow == 0) {
                        echo  "<tr><td colspan='2' class='center'>*** ไม่พบข่าวประกาศนี้ ***</td></tr>";
                    }
                    echo '</tbody></table>';
                    ?>
                    <div class="readmore"><?php echo anchor('news/'.$rs['type_name'], 'อ่านข่าวทั้งหมด', 'target ="_blank"'); ?></div>

                </div>
            <?php endforeach ?>
        </div>
    </div>       
</body>
</html>
