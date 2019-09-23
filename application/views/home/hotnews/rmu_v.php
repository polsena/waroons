<!DOCTYPE html>
<html lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <META NAME="Keywords" CONTENT="ระบบข่าวออนไลน์ มหาวิทยาลัยราชภัฎมหาสารคาม" />
    <meta name="stats-in-th" content="c318" />
    <title>ระบบข่าวออนไลน์ มหาวิทยาลัยราชภัฎมหาสารคาม</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>frontend/css/reset.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>frontend/css/font.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo base_url(); ?>frontend/bootstrap/css/bootstrap.css" type="text/css"/>

</head>
<body style="background:#F6F9FC;font-family:Arial;">
    <div class="well">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <ul class="media-list">
                    <li class="media">

                        <a class="media-left" href="#">

                            <iframe class="" width="250px" height="250px" src="//www.youtube.com/embed/UXI4RtdyB9g" frameborder="0" allowfullscreen></iframe>

                        </a>

                        <div class="media-body">

                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <span class="glyphicon glyphicon-th-list"> งานประชาสัมพันธ์/กิจกรรม</span>
                                </a>
                                <?php
                                $this->db->limit(4);
                                $this->db->order_by('id', 'desc');
                                $this->db->where('status',0);
                                $sql = $this->db->get('tbgallery')->result_array();
                                foreach ($sql as $rs):
                                    ?>
                                <a href="<?php echo base_url(); ?>welcome/gallery/<?php echo $rs['id']; ?>" target="_blank" class="list-group-item"><small> <span class="label label-success"><?php echo $this->mydate->dateThaiShortYear($rs['created']);?></span> <?php echo $rs['name']; ?></small></a>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                </ul>


            </div>
        </div>
    </div>



    <!-- Contact block  -->

</body>
</html>
