<?php
$s_login = $this->session->userdata('s_login');
$login_type = $s_login['login_type'];

//total จำนวนข่าวที่ประกาศ 
$total = $this->db->get_where('tbnews',array('user_id'=> $s_login['login_id']))->num_rows();

if (@$s_login['login_status'] == '1'):
?>
<div id="topbar">

    <div class="container">

        <a href="javascript:;" id="menu-trigger" class="dropdown-toggle" data-toggle="dropdown" data-target="#">
            <i class="icon-cog"></i>
        </a>

        <div id="top-nav">

            <ul>
                <li><a href="<?php echo base_url();?>home">ไปที่หน้าเว็บ</a></li>
            </ul>

            <ul class="pull-right">
                <li><a href="javascript:;"><i class="icon-user"></i> Logged in as <?php echo $s_login['login_code'];?> (<?php echo $s_login['login_fac'];?>)</a></li>
                <li><a href="javascript:;"><span class="badge badge-primary"><?php echo $total;?></span> ข่าวที่ประกาศแล้ว</a></li>
               <?php if($login_type == 1) : ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Settings						
                        <b class="caret"></b>
                    </a>

                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?php echo base_url(); ?>member">ผู้ใช้งานระบบ</a></li>
                        <li><a href="<?php echo base_url(); ?>member/news">เพิ่มผู้ใช้งานใหม่</a></li>

                    </ul> 
                </li>
                <?php endif;?>
                <li><a href="<?php echo base_url(); ?>login/logout">ออกจากระบบ</a></li>
            </ul>

        </div> <!-- /#top-nav -->

    </div> <!-- /.container -->

</div> <!-- /#topbar -->




<div id="header">

    <div class="container">

        <a href="<?php echo base_url(); ?>admin" class="brand">Dashboard Admind</a>

        <a href="javascript:;" class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <i class="icon-reorder"></i>
        </a>

        <div class="nav-collapse">
            <ul id="main-nav" class="nav pull-right">
                <li class="nav-icon active">
                    <a href="<?php echo base_url(); ?>admin">
                        <i class="icon-home"></i>
                        <span>Home</span>        					
                    </a>
                </li>

                <li><a href="<?php echo base_url(); ?>news/add"><i class="icon-bullhorn"></i><span>ประกาศข่าว</span></a></li>

                <li class="dropdown">					
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-th"></i>
                        <span>รายการข่าวทั้งหมด</span> 
                        <b class="caret"></b>
                    </a>	
                    <ul class="dropdown-menu">	
                        <?php
                        $this->db->order_by('id', 'asc');
                        $type = $this->db->get('tbtype')->result_array();
                        foreach ($type AS $rs) :
                            ?>
                            <li><a href="<?php echo base_url(); ?>news/index/<?php echo $rs['id'];?>"><?php echo $rs['type_name'];?></a></li>
                        <?php endforeach ?>
                    </ul>    				
                </li>
                <?php if($login_type == 1) : ?>
                <li><a href="<?php echo base_url();?>slide"><i class="icon-picture"></i><span>สไลด์หน้าเว็บ</span></a></li>
               
                <li class="dropdown">					
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-external-link"></i>
                        <span>เพิ่มเติม</span> 
                        <b class="caret"></b>
                    </a>	
                    <ul class="dropdown-menu">		
                         <li><a href="<?php echo base_url(); ?>intro">Intro Slider Homepage</a></li>
                        <li><a href="<?php echo base_url(); ?>typenews">ประเภทข่าว</a></li>

                    </ul>    				
                </li>
                 <?php endif;?>
            </ul>

        </div> <!-- /.nav-collapse -->

    </div> <!-- /.container -->

</div> <!-- /#header -->
<?php endif; ?>