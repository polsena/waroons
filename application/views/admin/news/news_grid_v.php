<table class="table table-hover table-striped">
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