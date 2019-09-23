<!DOCTYPE HTML>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <title>มหาวิทยาลัยราชภัฏมหาสารคาม</title>

        <link rel="stylesheet" href="css/sti_style.css" type="text/css" media="screen">

        <style>
            body { margin:0; }

            .text_animate1 { background:#3eb1bb; color:#ffffff; padding:10px; font-size:18px; display:none; position:absolute; }
            .text_animate2 { background:#a1cb0f; color:#ffffff; padding:10px; font-size:18px; display:none; position:absolute; }
            .text_animate3 { background:#e3841d; color:#ffffff; padding:10px; font-size:18px; display:none; position:absolute; }
            .text_animate4 { background:#000000; color:#dddddd; padding:10px; font-size:14px; display:none; position:absolute; }
            .text_animate5 { background:#ffffff; color:#222222; padding:10px; font-size:14px; display:none; position:absolute; text-align:center }
            .leaf_animate { background:url(img/assets/leaf.png) no-repeat; width:287px; height:143px; display:none; position:absolute; }
            .painting_animate { background:url(img/assets/picture.png) no-repeat; width:117px; height:133px; display:none; position:absolute; }

            @media (max-width: 640px) {	

                .leaf_animate { display:none !important; }
                .painting_animate { display:none !important; }

                .text_animate1 { font-size:14px; padding:4px; width:100%; left:0 !important; display:none !important; }
                .text_animate2 { font-size:14px; padding:4px; width:100%; left:0 !important; display:none !important; }
                .text_animate3 { font-size:14px; padding:4px; width:100%; left:0 !important; display:none !important; }
                .text_animate4 { font-size:12px; padding:4px; width:100%; left:0 !important; display:none !important; }
                .text_animate5 { font-size:12px; padding:4px; width:100%; left:0 !important; display:none !important; }
            }

        </style>

        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>
        <script type="text/javascript" src="js/jquery.versatileTouchSlider.min.js"></script>

        <script>

            jQuery(document).ready(function () {

                $.versatileTouchSlider('#banner', {
                    slideWidth: 880, //some number. ex: 650 or '100%'
                    slideHeight: 340, //some number. ex: 400 or 'auto'
                    showPreviousNext: true,
                    currentSlide: 0,
                    scrollSpeed: 600,
                    autoSlide: true,
                    autoSlideDelay: 5000,
                    showPlayPause: true,
                    showPagination: true,
                    alignPagination: 'center',
                    alignMenu: 'left',
                    swipeDrag: true,
                    sliderType: 'image_banner',
                    pageStyle: 'numbers', // numbers, bullets, thumbnails
                    orientation: 'horizontal', // horizontal, vertical (if vertical, the "slideHeight" option must be a number, not 'auto')
                    onScrollEvent: function (slideNum) {
                        textAnimate(slideNum)
                    },
                    ajaxEvent: function () {
                    }
                }
                );

                var numCurrent, sld = $('.sti_slide');

                function textAnimate(slideNum) {

                    if (numCurrent == slideNum)
                        return;

                    for (var i = 0; i < sld.length; i++) {
                        sld.eq(i).children().not('img').hide();
                    }

                    switch (slideNum) {

                        case 0:
                            sld.eq(0).find('.text_animate1').css({display: 'block', opacity: 0, bottom: 40, left: 150}).stop().delay(100).animate({opacity: .8, left: 150}, {duration: 800});
                            sld.eq(0).find('.text_animate2').css({display: 'block', opacity: 0, bottom: 78, left: 120}).stop().delay(300).animate({opacity: .8, left: 120}, {duration: 800});
                            sld.eq(0).find('.text_animate3').css({display: 'block', opacity: 0, bottom: 116, left: 200}).stop().delay(500).animate({opacity: .8, left: 200}, {duration: 800});
                            sld.eq(0).find('.leaf_animate').css({display: 'block', opacity: 0, top: 0, right: 0}).stop().delay(900).animate({opacity: 1, top: 0}, {duration: 700});
                            break;

                        case 1:
                            sld.eq(1).find(':nth-child(2)').css({display: 'block', opacity: 0, bottom: 208, left: 70}).stop().delay(0).animate({opacity: .8, left: 70, width: 'auto'}, {duration: 800});
                            sld.eq(1).find(':nth-child(3)').css({display: 'block', opacity: 0, bottom: 248, left: 70}).stop().delay(100).animate({opacity: .8, left: 70, width: 'auto'}, {duration: 800});
                            sld.eq(1).find(':nth-child(4)').css({display: 'block', opacity: 0, bottom: 288, left: 70}).stop().delay(200).animate({opacity: .8, left: 70, width: 'auto'}, {duration: 800});
                            sld.eq(1).find(':nth-child(5)').css({display: 'block', opacity: 0, bottom: 328, left: 70}).stop().delay(300).animate({opacity: .8, left: 70, width: 'auto'}, {duration: 800});
                            break;

                        case 2:
                            sld.eq(2).find('.text_animate4').css({display: 'block', opacity: 0, bottom: 40, left: 70, width: 'auto'}).stop().delay(0).animate({opacity: .7, left: 90, width: 560}, {duration: 800});

                            sld.eq(2).find('.text_animate4').stop().delay(3000).animate({opacity: 0, left: 0, width: 'auto'}, {duration: 400});
                            break;

                        case 3:
                            sld.eq(3).find('.text_animate5').css({display: 'block', opacity: 0, bottom: 50, left: 0, width: 'auto'}).stop().delay(0).animate({opacity: .9, left: 0, width: 630}, {duration: 800});
                            break;

                        case 4:
                            sld.eq(4).find('.painting_animate').css({display: 'block', opacity: 0, top: 18, left: 195}).stop().delay(200).animate({opacity: .9, top: 18, left: 195}, {duration: 800});
                            sld.eq(4).find('.text_animate1').css({display: 'block', opacity: 0, bottom: 65, left: 30, fontSize: 14, letterSpacing: 2, padding: 6, backgroundColor: '#4198c1'}).stop().delay(500).animate({opacity: .8, left: 25}, {duration: 800});
                            break;

                        default:
                            //none
                    }

                    numCurrent = slideNum;
                }

            });//ready

        </script>
        <script language="JavaScript1.2">
            function disableselect(e) {
                return false
            }
            function reEnable() {
                return true
            }
            //if IE4+
            document.onselectstart = new Function("return false")
            //if NS6
            if (window.sidebar) {
                document.onmousedown = disableselect
                document.onclick = reEnable
            }
        </script>
        <script language=JavaScript>
<!--
            var message = "Disabled!";
///////////////////////////////////
            function clickIE() {
                if (document.all) {
                    alert(message);
                    return false;
                }
            }
            function clickNS(e) {
                if
                        (document.layers || (document.getElementById && !document.all)) {
                    if (e.which == 2 || e.which == 3) {
                        alert(message);
                        return false;
                    }
                }
            }
            if (document.layers)
            {
                document.captureEvents(Event.MOUSEDOWN);
                document.onmousedown = clickNS;
            }
            else {
                document.onmouseup = clickNS;
                document.oncontextmenu = clickIE;
            }
            document.oncontextmenu = new Function("return false")
// --> 
        </script>

    </head>

    <body>

        <div class="sti_container" id="banner" style="margin-top:10px;">

            <div class=""><img src="<?php echo base_url();?>assets/intro/img/logo.png"></div>

            <!-- slider -->

            <div class="sti_slider" style="background-image: url('../img/1524.jpg')">


                <div class="sti_items">  


                    <a href ="http://waroon.rmu.ac.th/pages/1511.html" target="_blank">	
                        <div class="sti_slide">
                            <img class="main_image" src="img/0011_2558.png" alt="">
                        </div>
                    </a>

                    <div class="sti_slide">
                        <img class="main_image" src="img/19062558.jpg" alt="">
                    </div>
                    <a href ="http://202.29.22.28/reguser/ent58passr2/student_ent58_pass_r2list.php" target="_blank">	
                        <div class="sti_slide">
                            <img class="main_image" src="img/pass2.png" alt="">
                        </div>
                    </a>
                    <a href ="http://grad.rmu.ac.th" target="_blank">	
                        <div class="sti_slide">
                            <img class="main_image" src="img/gs001.png" alt="">
                        </div>
                    </a>
                    <a href ="http://202.29.22.73/reg_register" target="_blank">	
                        <div class="sti_slide">
                            <img class="main_image" src="img/0006.png" alt="">
                        </div>
                    </a>

                    <!--<a href ="http://202.29.22.73/payment" target="_blank">	
                        <div class="sti_slide">					
                            <img class="main_image" src="img/0001.png" alt="">
                        </div>
                    </a>-->

                   <!-- <div class="sti_slide">
                        <img class="main_image" src="img/0022.png" alt="" usemap="#Map">
                        <map name="Map" id="Map2">
                            <area shape="rect" coords="99,21,796,116" href="http://202.29.22.73/payment/" target="_blank" />
                            <area shape="rect" coords="583,244,830,325" href="http://202.29.22.73/rereg/" target="_blank" />
                        </map>
                    </div>-->

                    <div class="sti_slide">
                        <img class="main_image" src="img/003.jpg" alt="">
                    </div>

                    <a href ="http://human.rmu.ac.th/ichs2015.php" target="_blank">
                        <div class="sti_slide">
                            <img class="main_image" src="img/002.jpg" alt="">
                        </div>
                    </a>

                    <!--<div class="sti_slide">
                        <img class="main_image" src="img/004.jpg" alt="">
                    </div>-->

                    <!--<a href ="http://qa.rmu.ac.th/survey_degree" target="_blank">
                        <div class="sti_slide">
                            <img class="main_image" src="img/survey.jpg" alt="">
                        </div>
                    </a>-->

                    <a href ="http://qa.rmu.ac.th/pollUniv" target="_blank">
                        <div class="sti_slide">
                            <img class="main_image" src="img/poll.jpg" alt="">
                        </div>
                    </a>

                </div><!-- sti_items -->
            </div><!-- sti_slider -->

            <div class="sti_paginate">

                <div class="sti_page">
                </div>

                <div class="sti_control">
                    <a href="http://www.rmu.ac.th/rmu2013" class="button button-green" style="color: #ffffff;">เข้าสู่เว็บไซต์</a>
					
                </div>
            </div>
            <div class="sti_clear"></div>
            <div id="" style= "width:880px; padding:2px; font-size:12px; margin:2px auto 0 auto; text-align:center;">
                <a href="http://waroon.rmu.ac.th/pages/1504.html" target="_blank" class="button button-red" style="color: #ffffff;"> กำหนดการเข้ารับพระราชทานปริญญาบัตร ประจำปี 2558</a>
                <a href="http://202.29.22.73/ksbp58/" target="_blank" class="button button-pink" style="color: #ffffff;"> รับสมัครนักศึกษารอบ กศบป. ปีการศึกษา 2558</a>

            </div>
            <div id="shadow_extra" style="margin-top:10px;"><img src="img/divider_extra.png" alt="" width="100%" height="6" style="border:none !important;"></div>
           

        </div><!-- sti_container -->

    </body>
</html>
