<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width ='5'>#</th>
            <th width ='100'>ภาพ</th>
            <th width ="80">เมนู</th>
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
            echo '<td><img src="' . base_url() . 'assets/upload/intro/' . $r["thumb_name"] . $r['ext'] . '" width="250" height="50"/></td>';
          

            echo "</td>";
            echo "<td class='center'>";
            echo '<a href="#" onclick="return grid_btn_del(\'' . $id . '\')" class="btn btn-mini btn-danger"><i class="icon-remove icon-white"></i>ลบ</a>';
            echo "</td>";
            echo "</tr>";
        }
        if ($irow == 0) {
            echo "<tr><td colspan='5' class='center'>*** ไม่พบข้อมูล ***</td></tr>";
        }
        ?>
    </tbody>
</table>
<?php echo $pagination; ?>