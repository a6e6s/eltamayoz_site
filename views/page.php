<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<div id="page-content">
    <!--header-page-->
    <section class="row header-page" id="header-page">
        <?php if ($_header_image) { ?><img style="opacity: <?php echo $_header_image_opacity; ?>" src="<?php echo $_header_image_path; ?>" /><?php } ?>
        <div class="container">
            <div class="head-con">
                <div class="heading2">
                    <h1 class="wow zoomIn" data-wow-delay=".5s"><?php echo $_title; ?></h1>
                    <div class="line"><span></span><span></span></div>
                </div>
            </div>
        </div>
    </section>
    <!--End header-page-->
    <!--page-content-->
    <section class="row page-content">
        <div class="container">
            <text><?php echo $_content ?></text>
        </div>
    </section>
</div>
<!--End page-content-->



