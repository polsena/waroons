<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="10">#</th>
            <th width ="150">ประเภท</th>
              
            <th width="50">เมนู</th>
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
            echo "<td class='center'>".$i++."</td>";
            echo "<td>".$r['type_name']."</td>";
             
            echo "<td class='center'>";
            echo '<a href="#" onclick="return grid_btn_edit(\''.$id.'\')" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i> แก้ไข</a>&nbsp;';
            echo '<a href="#" onclick="return grid_btn_del(\''.$id.'\')" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> ลบ</a>';
            echo "</td>";
            echo "</tr>";
        }
        if($irow==0){
            echo "<tr><td colspan='3' class='center'>*** ไม่พบข้อมูล ***</td></tr>";
        }
        ?>
    </tbody>
</table>
<?php echo $pagination; ?>