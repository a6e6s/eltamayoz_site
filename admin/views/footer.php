 </body>
<!-- basic scripts -->
<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo ADMIN_URL; ?>templates/js/jquery.min.js'>" + "<" + "/script>");
</script>
<!-- <![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement)
        document.write("<script src='<?php echo ADMIN_URL; ?>templates/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<!-- page specific plugin scripts -->
<script src="<?php echo ADMIN_URL; ?>templates/js/bootstrap.min.js"></script>
<!-- ace scripts -->
<script src="<?php echo ADMIN_URL; ?>templates/js/ace-elements.min.js"></script>
<script src="<?php echo ADMIN_URL; ?>templates/js/ace.min.js">
</script><script src="<?php echo ADMIN_URL; ?>templates/js/jquery.colorbox.min.js"></script>


<!-- inline scripts related to this page -->
</html>
<?php
$controllers->db->close();
ob_end_flush();
?>