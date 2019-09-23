<script type="text/javascript">

    $(document).ready(function () {
        $('div.loadmsg').hide()  // hide it initially
                .ajaxStart(function () {
                    $(this).show();
                })
                .ajaxStop(function () {
                    $(this).hide();
                    //$(this).fadeOut('slow');
                });
    });

</script>
<div class="loadmsg">
    <p>กำลังประมวลผล...</p>
</div>
