<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<div id="page-content">
    <!--header-page-->
    <section class="row header-page" id="header-page">
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
    <link rel="stylesheet" href="<?php echo URL; ?>templates/css/lightslider.min.css">
    <link rel="stylesheet" href="<?php echo URL; ?>templates/css/lightgallery.css">
    <section class="row page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-xs-12 rtl_port">
                    <ul id="imageGallery"> 
                        <li data-thumb="<?php echo $_work_image_path; ?>" data-src="<?php echo $_work_large_image_path; ?>">
                            <img src="<?php echo $_work_large_image_path; ?>" />
                        </li>
                        <?php
                        if (!empty($_work_gallery)) {
                            foreach ($_work_gallery as $wimage) {
                                $_work_image_path2 = (file_exists(THUMBS_PATH_BASE . 'works/' . $wimage)) ? WORKS_IMAGES_THUMBS_PATH . $wimage : WORKS_IMAGES_PATH . $wimage;
                                $_work_large_image_path2 = WORKS_IMAGES_PATH . $wimage;
                                ?>
                                <li data-thumb="<?php echo $_work_image_path2; ?>" data-src="<?php echo $_work_large_image_path2; ?>">
                                    <img src="<?php echo $_work_large_image_path2; ?>" />
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#imageGallery').lightSlider({
                                gallery: true,
                                item: 1,
                                rtl: true,
                                loop: true,
                                slideMargin: 10,
                                enableDrag: false,
                                currentPagerPosition: 'left',
                                onSliderLoad: function (el) {
                                    el.lightGallery({
                                        selector: '#imageGallery .lslide'
                                    });
                                }
                            });
                        });
                    </script>
                    <script src="<?php echo URL; ?>templates/js/lightslider.min.js"></script>
                    <script src="<?php echo URL; ?>templates/js/lightgallery.min.js"></script>
                    <script src="<?php echo URL; ?>templates/js/lg-autoplay.min.js"></script>
                    <script src="<?php echo URL; ?>templates/js/lg-fullscreen.min.js"></script>
                    <script src="<?php echo URL; ?>templates/js/lg-zoom.min.js"></script>
                    <script src="<?php echo URL; ?>templates/js/lg-thumbnail.min.js"></script>
                    <!--//////////////////////////-->
                    <br>
                    <!--                    <div class="heading2">
                                            <h3>Project Description</h3>
                                            <div class="line"><span></span><span></span></div>
                                        </div>end heading2
                                        <br>
                                        <div class="port_desc">
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                        </div>-->
                </div><!--end col-xs-12-->
                <div class="col-md-4 col-xs-12">
                    <div class="heading">
                        <h3><?php echo $language->Project_Info; ?></h3>
                        <div class="line"><span></span><span></span></div>
                    </div><!--end heading-->
                    <br>
                    <dl class="row prot_item">
                        <dt class="col-md-1"><i class="fa fa-user"></i></dt>
                        <dd class="col-md-10"><p><strong><?php echo $language->Client; ?> : </strong> <?php echo $_client; ?></p></dd>
                    </dl>
                    <dl class="row prot_item">
                        <dt class="col-md-1"><i class="fa fa-star"></i></dt>
                        <dd class="col-md-10"><p><strong><?php echo $language->Skills; ?> : </strong> <?php echo implode(',', $wtags); ?> </p></dd>
                    </dl>
                    <dl class="row prot_item">
                        <dt class="col-md-1"><i class="fa fa-calendar"></i></dt>
                        <dd class="col-md-10"><p><strong><?php echo $language->Date; ?> : </strong> <?php echo $_done_date; ?></p></dd>
                    </dl>
                    <dl class="row prot_item" >
                        <dt class="col-md-1"><i class="fa fa-map-o"></i></dt>
                        <dd class="col-md-10"><p><strong><?php echo $language->Location; ?> : </strong> <?php echo $_location; ?></p></dd>
                    </dl>
                    <br>
                    <?php
                    if ($_demo_URL) {
                        ?>
                        <a class="readmore" target="_blank" href="<?php echo $_demo_URL; ?>">
                            <span><?php echo $language->View_Demo; ?></span> 
                        </a>
                        <?php
                    }
                    ?>
                    <br>
                    <a class="readmore" href="<?php echo URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/contact_us'; ?>">
                        <span><?php echo $language->Contact_Us; ?></span> 
                    </a>
                    <br>
                    <a class="readmore" href="<?php echo URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/requests'; ?>">
                        <span><?php echo $language->Requests; ?></span> 
                    </a>
                </div><!--end col-xs-12-->
            </div><!--end row-->
            <div class="row">
                <div class="col-xs-12"><hr><br></div>
                <div class="heading m-b-3">
                    <h3><?php echo $language->See_Also; ?></h3>
                    <div class="line"><span></span><span></span></div><br/>
                </div><!--end heading--> 
                <?php
                $works = $models->works_RAND('*', 4);
                if (is_array($works)) {
                    ?><div class="works"><?php
                    foreach ($works as $work) {
                        $_work_title_array = (isset($work['title'])) ? unserialize(base64_decode($work['title'])) : [];
                        $_work_title = isset($_work_title_array[$_SESSION['language_alias']]) ? $_work_title_array[$_SESSION['language_alias']] : '';
                        $_work_title_summary = $models->Cut_Words($_work_title, 50, 0);
                        $_work_alias = (isset($work['alias'])) ? $work['alias'] : '';
                        $_work_image = (isset($work['image'])) ? $work['image'] : '';
                        $_work_image_path = (file_exists(THUMBS_PATH_BASE . 'works/' . $_work_image)) ? WORKS_IMAGES_THUMBS_PATH . $_work_image : WORKS_IMAGES_PATH . $_work_image;
                        $_work_large_image_path = WORKS_IMAGES_PATH . $_work_image;
                        ?>
                            <div class="w1 portfolio_item col-xs-12 col-sm-6 col-md-3 wow zoomIn element-item" style="background-image:url(<?php echo $_work_image_path; ?>);">
                                <div class="portfolio_det">
                                    <a href="<?php echo URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/works/project/' . $_work_alias; ?>" alt="<?php echo $_work_title; ?>" title="<?php echo $_work_title; ?>" class="portfolio_title"><?php echo $_work_title_summary; ?></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?></div><?php
                }
                ?>
                <div class="col-xs-12"><br><hr></div>
            </div><!--end row-->
        </div><!--end container-->
    </section>
</div>
<!--End page-content-->



