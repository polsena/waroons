<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <title>Dashboard Admin</title>

        <meta charset="utf-8">

        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,800">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-responsive.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/ui-lightness/jquery-ui-1.8.21.custom.css">	
        <link href="<?php echo base_url(); ?>assets/admin/js/plugins/msgGrowl/css/msgGrowl.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/application.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/pages/dashboard.css">

        <script src="<?php echo base_url(); ?>assets/admin/js/libs/modernizr-2.5.3.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery-1.7.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery-ui-1.8.21.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery.ui.touch-punch.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/admin/js/libs/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugins/msgGrowl/js/msgGrowl.js"></script>

        <script src="<?php echo base_url(); ?>assets/admin/js/Theme.js"></script>

        <!-- validation -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/admin/js/plugins/validation/css/screen.css"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/validation/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/validation/jquery.metadata.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/plugins/validation/localization/messages_th.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/jquery.maskedinput.js"></script>
        <?php
        if (isset($extraHeadContent)) {
            echo $extraHeadContent;
        }
        ?>

    </head>

    <body>

        <div id="wrapper">

            <?php $this->view('admin/topbar_v'); ?>



            <?php $this->view($content); ?>
        </div>

        <?php $this->view('admin/footer_v'); ?>





    </body>
</html>