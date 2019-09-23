<?php

class script_m extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function calendar() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/calendar/calendarTLE.js\"></script>\n";
        $script .= "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/calendar/calendar-setup.js\"></script>\n";
        $script .= "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/calendar/lang/calendar-th.js\"></script>\n";
        $script .= "<style type=\"text/css\"> @import url(\"" . base_url() . "assets/js/calendar/calendar-win2k-cold-1.css\"); </style>\n";
        return $script;
    }

    function textformat() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/jquery.maskedinput.js\"></script>\n";
        return $script;
    }

    function textnumber() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/jquery.alphanumeric.js\"></script>\n";
        return $script;
    }

    function formatCurrency() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/formatCurrency.js\"></script>\n";
        return $script;
    }

    function modal_window() {
        $base_url = base_url();
        $script = <<<EOD
        <link rel="stylesheet" href="{$base_url}assets/js/modal-window/modal-window.css" type="text/css"/> \n
        <!--[if lte IE 6]><link href="{$base_url}assets/js/modal-window/modal-window-ie6.css" type="text/css" rel="stylesheet" /><![endif]-->
        <script type="text/javascript" src="{$base_url}assets/js/modal-window/modal-window.js"></script> \n
EOD;
        return $script;
    }

    function bootstrap_modal() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/admin/js/bootstrap/modal.js\"></script> \n";
        return $script;
    }

    function bootstrap_tab() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/bootstrap/bootstrap-tab.js\"></script> \n";
        return $script;
    }

    function bootstrap_tooltip() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/bootstrap/bootstrap-tooltip.js\"></script> \n";
        return $script;
    }

    function ajax_upload() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/ajaxfileupload.js\"></script> \n";
        return $script;
    }

    function mytab() {
        $script = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"" . base_url() . "assets/js/mytab/tabstyle.css\"/>\n";
        $script.= "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/mytab/my_tab.js\"></script>\n";
        return $script;
    }

    function lightbox() {
        $script = "<link rel=\"stylesheet\" type=\"text/css\" media=\"screen\" href=\"" . base_url() . "assets/js/lightbox/jquery.lightbox-0.5.css\"/>\n";
        $script.= "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/lightbox/jquery.lightbox-0.5.js\"></script>\n";
        return $script;
    }

    function highchart() {
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/highchart/highcharts.js\"></script>\n";
        $script.= "<script type=\"text/javascript\" src=\"" . base_url() . "assets/js/highchart/exporting.js\"></script>\n";
        return $script;
    }

    //แทรก javascript ckeditor
    function ckeditor() {
        $base_url = base_url();
        $script = "<script type=\"text/javascript\" src=\"" . base_url() . "assets/ckeditor/ckeditor.js\"></script>\n";

        $script.= "<script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shCore.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushBash.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushCpp.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushCSharp.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushCss.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushDelphi.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushDiff.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushGroovy.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushJava.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushJScript.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushPhp.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushPlain.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushPython.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushRuby.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushScala.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushSql.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushVb.js\"></script>
        <script type=\"text/javascript\" src=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/shBrushXml.js\"></script>
        <link type=\"text/css\" rel=\"stylesheet\" href=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/styles/shCore.css\"/>
        <link type=\"text/css\" rel=\"stylesheet\" href=\"" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/styles/shThemeDefault.css\"/>
        <script type=\"text/javascript\">
         SyntaxHighlighter.config.clipboardSwf = '" . $base_url . "assets/ckeditor/plugins/syntaxhighlight/scripts/clipboard.swf';
         SyntaxHighlighter.all();
        </script>";
        return $script;
    }

    //สำรหับนำไปใส่ textarea
    function get_ckeditor($obj_name) {
        $result = "<script type=\"text/javascript\">";
        $result.= "CKEDITOR.replace('" . $obj_name . "',{
            toolbar : 'Custom',
            filebrowserBrowseUrl : '" . base_url() . "assets/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '" . base_url() . "assets/ckfinder/ckfinder.html?Type=Images',
            filebrowserFlashBrowseUrl : '" . base_url() . "assets/ckfinder/ckfinder.html?Type=Flash',
            filebrowserUploadUrl : '" . base_url() . "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '" . base_url() . "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '" . base_url() . "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });";
        $result.= "</script>";
        return $result;
    }

}

?>
