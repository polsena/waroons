<table class="table table-bordered table-striped">
    <thead>
        <tr>
             <th width="20">ชื่อ-สกุล</th>
            <th width="120">ชื่อ-สกุล</th>
            <th width="80">ชื่อเข้าใช้งาน</th>
            <th width="60">ประเภท</th>
            <th width=10">สถานะ</th>
            <th width="40">เมนู</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $irow = 0;
        $i = $this->uri->segment(3)+1;
        foreach ($query as $r) {
            $irow++;
            $id=$r['id'];
            
            echo "<tr>";
             echo "<td>".$i++."</td>";
            echo "<td>".$r['name']."</td>";
            echo "<td>".$r['username']."</td>";
            echo "<td class='center'>".$member_m->display_memtype($r['mem_type'])."</td>";
            echo "<td class='center'>".$member_m->display_status($r['status'])."</td>";
            echo "<td class='center'>";
            echo anchor("member/edit/$id",'<i class="glyphicon glyphicon-pencil"></i>แก้ไข',array('class'=>'btn btn-default btn-sm')).  nbs();
            echo '<a href="#" onclick="return grid_btn_del(\''.$id.'\')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i>ลบ</a>';
            echo "</td>";
            echo "</tr>";
        }
        if($irow==0){
            echo "<tr><td colspan='5' class='center'>*** ไม่พบข้อมูล ***</td></tr>";
        }
        ?>
    </tbody>
</table>
<?php echo $pagination; ?>