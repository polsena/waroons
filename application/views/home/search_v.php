
<script type="text/javascript">
    $(function () {

        $('#mytable').colorize({row: 'hover', oneClick: true});

    });
</script>
<script type="text/javascript">
    $(function () {
        $('#mytable').colorize({row: 'hover', oneClick: true});

        $('#txtsearch').keydown(function (e) {
            if ((e.keyCode == 13)) {
                $('#btnsearch').click();
                return false;
            }
        });

        $('#user_id').change(function () {

        })
    });



    function find_all() {
        $('#txtsearch').val('');
        $('#btnsearch').click();
    }
</script>
<div class="content container">
    <div class="page-wrapper">

        <div class="page-content">
            <div class="row page-row">
                <div class="pull-right">
                    <?php echo form_open('search', array('id' => 'myform_search')); ?>
                    <table celpadding="0" celspacing="0" border="0">
                        <tr valign="bottom">
                            <td>
                                <b>หน่วยงาน :</b>

                                <select id="user_id" name="user_id" style="padding: 2px;" class="form-control" title="เลือกหน่วยงาน !" validate="required:true">
                                    <option value="">*** เลือกทุกหน่วยงาน ***</option>
                                    <?php
                                    $user = $this->db->get('tbmember')->result_array();
                                    foreach ($user as $r):
                                         $selected = ($r['id']==$user_id) ? 'selected' : '';
                                        ?>
                                        <option value="<?php echo $r['id']; ?>"<?php echo $selected; ?>><?php echo "ประกาศจาก : " . $r['fac_short']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </td>

                            <td>
                                &nbsp;&nbsp;<input type="submit" name="btnsearch" class="btn btn-danger" value="ค้นหา"/>
                            </td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                </div>
                <div><h3 class="has-divider text-highlight"><span class="glyphicon glyphicon-th-list"></span> ค้นหารายการจากหน่วยงาน " <?php echo $name['faculity'];?> " พบ <?php echo $total;?> รายการ</h3>

                </div>

                <div class="table-responsive">                      
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width ='40'>No.</th>
                                <th width ="70">วันที่ประกาศ</th>
                                <th width="250">รายการข่าว</th>  
                                <th width ="50">ผู้ประกาศ</th>
                                <th width ="50">ประเภทข่าว</th>
                                <th width ="50">เปิดอ่าน</th>

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
                                echo "<td>" . $mydate->dateThaiLongShotfull($r['date']) . "</td>";
                                echo "<td>" . anchor("pages/" . $r['id'] . "", $r['topic']) . "</td>";
                                echo "<td>";
                                $user = $this->db->get_where('tbmember', array('id' => $r['user_id']))->result_array();
                                foreach ($user as $rs) {
                                    echo $rs['fac_short'] . '</td>';
                                }
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

                                echo "<td>" . $r['view'] . "</td>";

                                echo "</tr>";
                            }
                            if ($irow == 0) {
                                echo "<tr><td colspan='6' class='center'>*** ไม่พบข้อมูล ***</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div style="float:left"><?php echo $page_links; ?></div><div style="float:right"><b>จำนวนข่าวที่ค้นพบทั้งหมด  <?php echo $total; ?> รายการ</b></div>
                </div> <!-- /.span7 -->
            </div>
        </div>




    </div> 
</div>