<div class="span3">
    <h3 class="title"><i class="icon-bookmark"></i> สถิติข่าว</h3>
    <table class="table stat-table">
        <tbody>
            <?php
            $type = $this->db->get('tbtype')->result_array();
            foreach ($type AS $rs):
                ?>
                <tr>
                    <td class="full"><?php echo $rs['type_name']; ?></td>
                    <?php
                    $total = $this->db->get_where('tbnews', array('type_id' => $rs['id']))->num_rows();
                    ?>
                    <td class="value"><?php echo $total; ?></td>

                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="full alert alert-success">รวมทั้งหมด</td>
                <?php
                $total = $this->db->get('tbnews')->num_rows();
                ?>
                <td class="value alert alert-success"><?php echo $total; ?></td>

            </tr>

        </tbody>
    </table>
    <h3 class="title"><i class="icon-bookmark"></i> ผู้ประกาศข่าว <?php echo $t = $this->db->get('tbmember')->num_rows();?> หน่วยงาน</h3>
    <table class="table stat-table">
        <tbody>
            <?php
           
            $user = $this->db->get('tbmember')->result_array();
            $i = 1;
            foreach ($user AS $rs):
                ?>
                <tr>
                    <td class="full"><?php echo $i++;?>. <?php echo $rs['fac_short']; ?></td>
                    <?php
          
                    $total_m = $this->db->get_where('tbnews', array('user_id' => $rs['id']))->num_rows();
                    ?>
                    <td class="value"><?php echo $total_m; ?></td>

                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="full alert alert-success">รวมทั้งหมด</td>
                <?php
                $total_m = $this->db->get('tbnews')->num_rows();
                ?>
                <td class="value alert alert-success"><?php echo $total_m; ?></td>

            </tr>

        </tbody>
    </table>
</div> <!-- /.span4 -->

<div class="span9">

    <h3 class="title"><i class="icon-comment"></i> New Update แสดงตามข่าวที่ประกาศล่าสุด 20 รายการ</h3>
    <table class="table">
        <thead>
            <tr>
                <th width ='40'>No.</th>
                <th width ="50">ประเภทข่าว</th>
                <th width ="90">Date.</th>
                <th width="250">รายการ</th>  
                <th width ="60">อ่าน</th>
                <th width="100">เมนู</th>
            </tr>
        </thead>
        <tbody>
<?php
$irow = 0;
$i = $this->uri->segment(3) + 1;
foreach ($query as $r) {
    $irow++;
    $id = $r['id'];

    echo "<tr>";
    echo "<td>" . $i++ . "</td>";
    echo "<td width='20px'>";
    if ($r['type_id'] == '1') {
        echo "<span class=\"label label-primary\" >ข่าวประกาศ</span>";
    } else if ($r['type_id'] == '2') {
        echo "<span class=\"label label-success\" >ข่าวประชาสัมพันธ์</span>";
    } else if ($r['type_id'] == '3') {
        echo "<span class=\"label label-info\" >ข่าวสมัครงาน</span>";
    } else if ($r['type_id'] == '4') {
        echo "<span class=\"label label-warning\" >ข่าวประกวดราคา</span>";
    } else if ($r['type_id'] == '5') {
        echo "<span class=\"label label-danger\" >ข่าวบริการ</span>";
    } else if ($r['type_id'] == '6') {
        echo "<span class ='label label-theme'>ข่าวพระวรุณ</span>";
    } else if ($r['type_id'] == '7') {
        echo "<span class=\"label label-default\" >ข่าวกองทุน</span>";
    }

    echo "</td>";
    echo "<td>" . $mydate->dateThaiLongShotfull($r['date']) . "<br/>";
    $user = $this->db->get_where('tbmember', array('id' => $r['user_id']))->result_array();
    foreach ($user as $rs) {
        echo $rs['fac_short'] . '</td>';
    }

    echo "<td>" . anchor("news/edit/$id", $r['topic']) . "</td>";
    echo "<td>";
    echo $r['view'];
    echo "</td>";
    echo "<td class='center'>";
    echo anchor("news/edit/$id", '<i class="icon-pencil"></i>แก้ไข', array('class' => 'btn btn-mini')) . nbs();
    echo '<a href="#" onclick="return grid_btn_del(\'' . $id . '\')" class="btn btn-mini btn-danger"><i class="icon-remove icon-white"></i>ลบ</a>';
    echo "</td>";
    echo "</tr>";
}
if ($irow == 0) {
    echo "<tr><td colspan='6' class='center'>*** ไม่พบข้อมูล ***</td></tr>";
}
?>
        </tbody>
    </table>
<?php echo $pagination; ?>
</div> <!-- /.span7 -->