<!-- ******CONTENT****** --> 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h4 class="heading-title pull-left"><span class="glyphicon glyphicon-comment"></span> <?php echo $rs['topic']; ?></h4>

        </header> 
        <div class="page-content">
            <div class="row page-row">
                <div class="news-wrapper col-md-12 col-sm-12">                         
                    <article class="news-item">
                        <p class="meta text-muted">ผู้ประกาศ: <a href="#"><?php echo $user['fac_short']; ?></a> | วันที่ประกาศ: <?php echo $mydate->dateThaiLong($rs['date']); ?> | เปิดอ่าน <?php echo $rs['view'];?> | <?php echo $type['type_name'];?></p>
                         <?php if (!$rs['filename'] == "") { ?>
                            <div style="padding:10px;text-align:right">
                                
                                <div>
                                    <div id="fb-root"></div>
                                        <script>(function(d, s, id) {
                                          var js, fjs = d.getElementsByTagName(s)[0];
                                          if (d.getElementById(id)) return;
                                          js = d.createElement(s); js.id = id;
                                          js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.3&appId=486206698189831";
                                          fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));</script>
                                        <div class="fb-like" data-href="<?php echo current_url();?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                                    <span class="label label-danger">* หากมีปัญหาดูผ่านเว็บไม่ได้ให้ดาวน์โหลดไฟล์ที่นี่</span>
                                    <span class="label label-success"><?php echo $rs['filename']; ?><?php echo nbs(3).''.$rs['file_size']; ?> kb.</span>
                                    <a href="<?php echo base_url() . "assets/upload/file/" . $rs['filetmp']; ?> " class="btn btn-primary" target="_blank"><i class="fa fa-play-circle"></i> ดาวน์โหลด</a>

                                </div>
                            </div>
                            <?php
                        }
                        ?> 
                        <p class="box">
                            <?php echo $rs['detail'];?>
                        </p>

                        <?php if (!$rs['filename'] == "") { ?>
                        
                        <embed src="<?php echo base_url() . "assets/upload/file/" . $rs['filetmp']; ?>" width="100%" height="750px"></embed>
                                                        <?php
                        }
                        ?>

                       
                    </article><!--//news-item-->
                </div><!--//news-wrapper-->

            </div><!--//page-row-->
        </div><!--//page-content-->
    </div><!--//page--> 
</div><!--//content-->

