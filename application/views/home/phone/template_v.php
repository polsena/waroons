<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
    <head>
        <title>ระบบสมุดโทรศัพท์ มหาวิทยาลัยราชภัฏมหาสารคาม</title>
        <!-- Meta -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="ระบบข่าวออนไลน์,วรุณออนไลน์ มหาวิทยาลัยราชภัฏมหาสารคาม">
        <meta name="author" content="Leksoft Fei,นครินทร์ ม่วงอ่อน">    
        <link rel="shortcut icon" href="favicon.ico">  
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>     
        <!-- Global CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/plugins/bootstrap/css/bootstrap.min.css">   
        <!-- Plugins CSS -->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/plugins/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="assets/plugins/flexslider/flexslider.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/home/plugins/pretty-photo/css/prettyPhoto.css">    
        <!-- Theme CSS -->  
        <link id="theme-style" rel="stylesheet" href="<?php echo base_url(); ?>assets/home/css/styles.css">

        <!-- Javascript -->          
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/bootstrap/js/bootstrap.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/bootstrap-hover-dropdown.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/back-to-top.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/jquery-placeholder/jquery.placeholder.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/pretty-photo/js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/flexslider/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/plugins/jflickrfeed/jflickrfeed.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/home/js/main.js"></script>  
        <?php
        if (isset($extraHeadContent)) {
            echo $extraHeadContent;
        }
        ?>
    </head> 

    <body>
        <div class="wrapper">
            <!-- ******HEADER****** --> 
            <!-- ******CONTENT****** --> 
            <?php $this->view($content); ?>
        </div><!--//wrapper-->

    </body>
</html> 

