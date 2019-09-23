<?php
$s_login = $this->session->userdata('s_login');
$login_type = $s_login['login_type'];

?>
<header class="header">  

    <div class="header-main container">
        <h1 class="logo col-md-5 col-sm-5">
            <a href="<?php echo base_url(); ?>home"><img id="logo" src="<?php echo base_url(); ?>assets/home/images/logo.png" alt="Logo"></a>
        </h1><!--//logo-->           
        <div class="info col-md-7 col-sm-7">
            <ul class="menu-top navbar-right hidden-xs">
                <?php if (@$s_login['login_status'] == '1'): ?>
                <li class="btn btn-default"><span class="glyphicon glyphicon-user"></span><a href="<?php echo base_url(); ?>" ><?php echo $s_login['login_code'];?></a></li>
                <li class="btn btn-default"><span class="glyphicon glyphicon-dashboard"></span><a href="<?php echo base_url(); ?>admin" class="">ประกาศข่าวที่นี่ </a></li>
                <?php else : ?>
                <li class="btn btn-default"><span class="glyphicon glyphicon-home"></span><a href="<?php echo base_url(); ?>home" >Home</a></li>
                <li class="btn btn-default"><span class="glyphicon glyphicon-log-in"></span><a href="<?php echo base_url(); ?>login" class="">เข้าระบบ </a></li>
                <?php endif; ?>
            </ul><!--//menu-top-->
         
            <div class="contact pull-right">
                <?php
                $ci = &get_instance();
                $ci->counter_m->showCounter();
                ?>
              
            </div><!--//contact-->
        </div><!--//info-->
    </div><!--//header-main-->
</header><!--//header-->

<!-- ******NAV****** -->
<nav class="main-nav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button><!--//nav-toggle-->
        </div><!--//navbar-header-->            
        <div class="navbar-collapse collapse" id="navbar-collapse">
            <ul class="nav navbar-nav pull-right">
                <li class="nav-item"><a href="<?php echo base_url(); ?>home">Home</a></li>
                <?php
                $this->db->order_by('id', 'asc');
                $type = $this->db->get('tbtype')->result_array();
                foreach ($type AS $rs) :
                    ?>
                    <li class="nav-item"><a href="<?php echo base_url(); ?>types/<?php echo $rs['type_name_en']; ?>"><?php echo $rs['type_name']; ?></a></li>
                    <?php endforeach ?>
            </ul><!--//nav-->
        </div><!--//navabr-collapse-->
    </div><!--//container-->
</nav><!--//main-nav-->
