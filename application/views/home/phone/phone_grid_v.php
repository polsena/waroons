<table class="table table-hover" cellspacing="0" cellpadding="0" border="0">
    <thead>
        <tr>
            <th width="120">ชื่อ-สกุล</th>
            <th width="120">สังกัดหน่วยงาน</th>
            <th width="120">เบอร์โทรภายใน</th>
            <th width="120">เบอร์โทรสำนักงาน</th>
            <th width="120">เบอร์มือถือ</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $irow = 0;
        foreach ($query as $r) {
            $irow++;
            $id = $r['id'];

            echo "<tr>";
            echo "<td>" . $r['name'] . "</td>";
            echo "<td>" . $r['fuculty'] . "</td>";
            echo "<td>" . $r['phonein'] . "</td>";
            echo "<td>" . $r['home_office'] . "</td>";
            echo "<td>" . $r['mobile'] . "</td>";
            echo "</tr>";
        }
        if ($irow == 0) {
            echo "<tr><td colspan='5' class='center'>*** ไม่พบข้อมูล ***</td></tr>";
        }
        ?>
    </tbody>
</table>
<?php
echo $pagination;
