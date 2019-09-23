<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Dashboard Admin</title>

        <meta name="description" content="ระบบข่าวออนไลน์ มหาวิทยาลัยราชภัฏมหาสารคาม">
        <meta name="author" content="Leksoft Fei">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,800">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-responsive.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/ui-lightness/jquery-ui-1.8.21.custom.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/application.css">

        <script src="<?php echo base_url(); ?>assets/admin/js/libs/modernizr-2.5.3.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery-1.7.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery-ui-1.8.21.custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/admin/js/libs/jquery.ui.touch-punch.min.js"></script>


        <script src="<?php echo base_url(); ?>assets/admin/js/libs/bootstrap/bootstrap.min.js"></script>
     
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
        <?php if ($msg != ''): ?>
            <script type="text/javascript">
                $(function () {
                    $('#div_alert_text').text("<?php echo $msg; ?>");
                    $('#div_alert').show();
                });
            </script>

        <?php endif; ?>
        <script type="text/javascript">
            $(function () {
                $('#alert_frm').css('display', 'none');
                $("#myform").validate();

                $('#password').bind('keypress', function (e) {
                    if (e.keyCode == 13) {
                        login();
                    }
                });
            });

            function login() {
                $('#myform').submit();
            }
        </script>
    </head>

    <body class="login">
        <div class="account-container login stacked">

            <div class="content clearfix">

                <?php echo form_open('login/Authen', array('id' => 'myform', 'class' => 'form-horizontal')); ?>
                <input type="hidden" id="id" name="id" value="<?php echo @$row['id']; ?>"/>
                <h1>Waroon News@RMU</h1>
                <p></p>
                <div id="div_alert" class="alert alert-danger" hidden="true" >
                    <div id="div_alert_text"></div>
                </div>
                <div class="login-fields">


                    <div class="field">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo @$row['username']; ?>" placeholder="Username" class="login username-field required" />
                    </div> <!-- /field -->

                    <div class="field">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field required"/>
                    </div> <!-- /password -->
                    
                    <div class="field">
                        <label for="capcha">Spam code:</label>
                        <img id="siimage" style="margin:0 20px" src="<?php echo base_url(); ?>storage/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>">
                         <object type="application/x-shockwave-flash" data="<?php echo base_url(); ?>storage/captcha/securimage_play.swf?audio_file=<?php echo base_url(); ?>storage/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
                              <param name="movie" value="./securimage_play.swf?audio_file=<?php echo base_url(); ?>storage/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
                         </object>
                         &nbsp;
                         <a onclick="$('#siimage').attr('src', '<?php echo base_url(); ?>storage/captcha/securimage_show.php?sid=' + Math.random());
                                   this.blur();
                                   return false;" tabindex="-1" href="#" title="Refresh Image">
                              <img src="<?php echo base_url(); ?>storage/captcha/images/refresh.png" onclick="this.blur()"></a>
                              <input type="text" name="captcha" maxlength="4" class="required span1" placeholder="พิมพ์ตัวอักษรที่เห็น"/>
                    </div>

                </div> <!-- /login-fields -->

                <div class="login-actions">


                    <button onclick="return login();" class="button btn btn-primary btn-large">เข้าระบบ</button>

                </div> <!-- .actions -->

                <div class="login-social">
                    หากท่านเข้าระบบไม่ได้ ให้ติดต่อผู้พัฒนาระบบ (6202,6127)

                </div>

                <?php echo form_close(); ?>

            </div> <!-- /content -->

        </div> <!-- /account-container -->

        <!-- Text Under Box -->
        <div class="login-extra">
            ออกแบบและพัฒนาโดย <a href="#">นครินทร์ ม่วงอ่อน</a><br/>
            โทรศัพท์ <a href="#">06400 567 93</a> <br/> 
        </div> <!-- /login-extra -->


    </body>
</html>
