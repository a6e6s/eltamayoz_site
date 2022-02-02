<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<div id="page-content">
    <?php if ($site_settings->slideshow_status) { ?>
        <!--slideshow-->
        <link href="<?php echo URL; ?>templates/css/slider-pro.min.css" rel="stylesheet">
        <script src="<?php echo URL; ?>templates/js/jquery.sliderPro.min_<?php echo $_SESSION['language_DIR']; ?>.js"></script>
        <script>
            $(document).ready(function ($) {
                $('#slideshow').sliderPro({
                    width: 2000,
                    height: 900,
                    arrows: true,
                    buttons: false,
                    responsive: true,
                    waitForLayers: true,
                    loop: false,
                    autoplay: true,
                    autoScaleLayers: true,
                    touchSwipe: false
                });
            });
        </script>
        <?php $slideshow = $models->slideshow('*', $_SESSION['site_id']); ?>
        <?php if (is_array($slideshow)) { ?> 
            <section class="row" ><div id="slideshow" class="row slider-pro"><div class="sp-slides">
                        <?php
                        foreach ($slideshow as $slide) {
                            $_slide_title_array = (isset($slide['title'])) ? unserialize(base64_decode($slide['title'])) : [];
                            $_slide_title = isset($_slide_title_array[$_SESSION['language_alias']]) ? $_slide_title_array[$_SESSION['language_alias']] : '';
                            $_slide_title_summary = $models->Cut_Words($_slide_title, 50, 0);
                            $_slide_desc_array = (isset($slide['description'])) ? unserialize(base64_decode($slide['description'])) : [];
                            $_slide_desc = isset($_slide_desc_array[$_SESSION['language_alias']]) ? $_slide_desc_array[$_SESSION['language_alias']] : '';
                            $_slide_desc_summary = $models->Cut_Words($_slide_desc, 300, 0);
                            $_slide_link = (isset($slide['link'])) ? $slide['link'] : 0;
                            $_slide_url_type = (isset($slide['url_type'])) ? $slide['url_type'] : 'internal';
                            $_slide_url = (isset($slide['url'])) ? $slide['url'] : '';
                            $_slide_all_url = ($_slide_url_type == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/' . $_slide_url : $_slide_url;
                            $_slide_image = (isset($slide['image'])) ? $slide['image'] : '';
                            $_slide_large_image_path = SLIDESHOW_IMAGES_PATH . $_slide_image;
                            ?>
                            <div class="sp-slide">
                                <img class="sp-image" src="<?php echo $_slide_large_image_path; ?>"
                                     data-src="<?php echo $_slide_large_image_path; ?>"
                                     data-retina="<?php echo $_slide_large_image_path; ?>"/>

                                <h1 class="sp-layer sp-black sp-padding"
                                    data-horizontal="10%" data-vertical="70%"
                                    data-show-transition="up" data-hide-transition="down" data-show-delay="1000" data-hide-delay="200">
                                    <?php if ($_slide_link == 1) { ?><a href="<?php echo $_slide_all_url; ?>"><?php
                                        } echo $_slide_title;
                                        if ($_slide_link == 1) {
                                            ?></a><?php } ?>
                                </h1>

                                <p class="sp-layer sp-black sp-padding hide-small-screen"
                                   data-horizontal="10%" data-vertical="80%"
                                   data-show-transition="up" data-hide-transition="down" data-show-delay="1500" data-hide-delay="100">
                                       <?php echo $_slide_desc_summary; ?>
                                </p>

                            </div>
                        <?php } ?> 
                    </div>
                </div>
            </section>
        <?php } ?>
        <!--End slideshow-->
    <?php } ?>
    <?php if ($site_settings->work_steps_status) { ?>
        <!--work steps-->
        <section class="row" id="work-steps">
            <div class="container">
                <div class="heading">
                    <h2 class="wow zoomIn" data-wow-delay=".5s"><?php echo $site_settings->site_home_settings['work_steps_title_' . $_SESSION['language_alias']]; ?></h2>
                    <div class="line"><span></span><span></span></div>
                </div>
                <ul class="steps">
                    <!--step-1-->
                    <li class="col-xs-12 col-sm-6 col-md-3 step step-1">
                        <span class="i wow zoomIn" data-wow-delay="1s"><i class="fa fa-lightbulb-o fa-3x"></i></span>
                        <div class="title wow zoomIn" data-wow-delay=".5s">
                            <div class="title-con">
                                <h3><?php echo $site_settings->site_home_settings['work_step_1_title_' . $_SESSION['language_alias']] ?></h3>
                                <small><?php echo $site_settings->site_home_settings['work_step_1_desc_' . $_SESSION['language_alias']] ?></small>
                            </div>
                            <span class="bg"></span>
                        </div>
                        <span class="number wow zoomIn">1</span>
                    </li>
                    <!--step-2-->
                    <li class="col-xs-12 col-sm-6 col-md-3 step step-2">
                        <span class="i wow zoomIn" data-wow-delay="2.5s"><i class="fa fa-laptop fa-3x"></i></span>
                        <div class="title wow zoomIn" data-wow-delay="2s">
                            <div class="title-con">
                                <h3><?php echo $site_settings->site_home_settings['work_step_2_title_' . $_SESSION['language_alias']] ?></h3>
                                <small><?php echo $site_settings->site_home_settings['work_step_2_desc_' . $_SESSION['language_alias']] ?></small>
                            </div>
                            <span class="bg"></span>
                        </div>
                        <span class="number wow zoomIn" data-wow-delay="1.5s">2</span>
                    </li>
                    <!--step-3-->
                    <li class="col-xs-12 col-sm-6 col-md-3 step step-3">
                        <span class="i wow zoomIn" data-wow-delay="4s"><i class="fa fa-code fa-3x"></i></span>
                        <div class="title wow zoomIn" data-wow-delay="3.5s">
                            <div class="title-con">
                                <h3><?php echo $site_settings->site_home_settings['work_step_3_title_' . $_SESSION['language_alias']] ?></h3>
                                <small><?php echo $site_settings->site_home_settings['work_step_3_desc_' . $_SESSION['language_alias']] ?></small>
                            </div>
                            <span class="bg"></span>
                        </div>
                        <span class="number wow zoomIn" data-wow-delay="3s">3</span>
                    </li>
                    <!--step-4-->
                    <li class="col-xs-12 col-sm-6 col-md-3 step step-4">
                        <span class="i wow zoomIn" data-wow-delay="5.5s"><i class="fa fa-gift fa-3x"></i></span>
                        <div class="title wow zoomIn" data-wow-delay="5s">
                            <div class="title-con">
                                <h3><?php echo $site_settings->site_home_settings['work_step_4_title_' . $_SESSION['language_alias']] ?></h3>
                                <small><?php echo $site_settings->site_home_settings['work_step_4_desc_' . $_SESSION['language_alias']] ?></small>
                            </div>
                            <span class="bg"></span>
                        </div>
                        <span class="number wow zoomIn" data-wow-delay="4.5s">4</span>
                    </li>
                </ul>
            </div>
        </section>
        <!--End work steps-->
    <?php } ?>
    <?php if ($site_settings->services_status) { ?>
        <!--services-->
        <section class="row" id="services">
            <div class="container">
                <div class="heading">
                    <h2 class="wow zoomIn" data-wow-delay=".5s"><?php echo $site_settings->site_home_settings['services_title_' . $_SESSION['language_alias']]; ?></h2>
                    <div class="line"><span></span><span></span></div>
                </div>
                <div class="servicess">
                    <span class="col-xs-12 col-sm-12 col-md-8 img"><img class="wow slideInRight" data-wow-duration="1.8s" data-wow-delay=".5s" src="<?php echo SITES_IMAGES_PATH . $site_settings->services_image; ?>" /></span>
                    <div class="col-xs-12 col-sm-12 col-md-4 servicess-list">
                        <ul>
                            <?php if (isset($site_settings->site_home_settings['service_1_title_' . $_SESSION['language_alias']]) && !empty($site_settings->site_home_settings['service_1_title_' . $_SESSION['language_alias']])) { ?>
                                <li>
                                    <span class="i wow slideInLeft" data-wow-duration="1s" data-wow-delay=".5s"><i class="fa fa-laptop fa-2x"></i></span>
                                    <div class="col-xs-9 wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                                        <h3>
                                            <?php if (!empty($site_settings->site_home_settings['service_1_url'])) { ?><a href="<?php echo $site_settings->site_home_settings['service_1_url']; ?>"><?php } ?>
                                                <?php echo $site_settings->site_home_settings['service_1_title_' . $_SESSION['language_alias']]; ?>
                                                <?php if (!empty($site_settings->site_home_settings['service_1_url'])) { ?></a><?php } ?>
                                        </h3>
                                        <text><?php echo $site_settings->site_home_settings['service_1_desc_' . $_SESSION['language_alias']]; ?></text>
                                    </div>
                                </li>
                            <?php } ?>
                            <div class="clearfix"></div>
                            <?php if (isset($site_settings->site_home_settings['service_2_title_' . $_SESSION['language_alias']]) && !empty($site_settings->site_home_settings['service_2_title_' . $_SESSION['language_alias']])) { ?>
                                <li>
                                    <span class="i wow slideInLeft" data-wow-duration="1s" data-wow-delay=".5s"><i class="fa fa-code fa-2x"></i></span>
                                    <div class="col-xs-9 wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                                        <h3>
                                            <?php if (!empty($site_settings->site_home_settings['service_2_url'])) { ?><a href="<?php echo $site_settings->site_home_settings['service_2_url']; ?>"><?php } ?>
                                                <?php echo $site_settings->site_home_settings['service_2_title_' . $_SESSION['language_alias']]; ?>
                                                <?php if (!empty($site_settings->site_home_settings['service_2_url'])) { ?></a><?php } ?>
                                        </h3>
                                        <text><?php echo $site_settings->site_home_settings['service_2_desc_' . $_SESSION['language_alias']]; ?></text>
                                    </div>
                                </li>
                            <?php } ?>
                            <div class="clearfix"></div>
                            <?php if (isset($site_settings->site_home_settings['service_3_title_' . $_SESSION['language_alias']]) && !empty($site_settings->site_home_settings['service_3_title_' . $_SESSION['language_alias']])) { ?>
                                <li>
                                    <span class="i wow slideInLeft" data-wow-duration="1s" data-wow-delay=".5s"><i class="fa fa-ioxhost fa-2x"></i></span>
                                    <div class="col-xs-9 wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                                        <h3>
                                            <?php if (!empty($site_settings->site_home_settings['service_3_url'])) { ?><a href="<?php echo $site_settings->site_home_settings['service_3_url']; ?>"><?php } ?>
                                                <?php echo $site_settings->site_home_settings['service_3_title_' . $_SESSION['language_alias']]; ?>
                                                <?php if (!empty($site_settings->site_home_settings['service_3_url'])) { ?></a><?php } ?>
                                        </h3>
                                        <text><?php echo $site_settings->site_home_settings['service_3_desc_' . $_SESSION['language_alias']]; ?></text>
                                    </div>
                                </li>
                            <?php } ?>
                            <div class="clearfix"></div>
                            <?php if (isset($site_settings->site_home_settings['service_4_title_' . $_SESSION['language_alias']]) && !empty($site_settings->site_home_settings['service_4_title_' . $_SESSION['language_alias']])) { ?>
                                <li>
                                    <span class="i wow slideInLeft" data-wow-duration="1s" data-wow-delay=".5s"><i class="fa fa-mobile fa-2x"></i></span>
                                    <div class="col-xs-9 wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                                        <h3>
                                            <?php if (!empty($site_settings->site_home_settings['service_4_url'])) { ?><a href="<?php echo $site_settings->site_home_settings['service_4_url']; ?>"><?php } ?>
                                                <?php echo $site_settings->site_home_settings['service_4_title_' . $_SESSION['language_alias']]; ?>
                                                <?php if (!empty($site_settings->site_home_settings['service_4_url'])) { ?></a><?php } ?>
                                        </h3>
                                        <text><?php echo $site_settings->site_home_settings['service_4_desc_' . $_SESSION['language_alias']]; ?></text>
                                    </div>
                                </li>
                            <?php } ?>
                            <div class="clearfix"></div>
                            <?php if (isset($site_settings->site_home_settings['service_5_title_' . $_SESSION['language_alias']]) && !empty($site_settings->site_home_settings['service_5_title_' . $_SESSION['language_alias']])) { ?>
                                <li>
                                    <span class="i wow slideInLeft" data-wow-duration="1s" data-wow-delay=".5s"><i class="fa fa-gift fa-2x"></i></span>
                                    <div class="col-xs-9 wow zoomIn" data-wow-duration="1s" data-wow-delay=".5s">
                                        <h3>
                                            <?php if (!empty($site_settings->site_home_settings['service_5_url'])) { ?><a href="<?php echo $site_settings->site_home_settings['service_5_url']; ?>"><?php } ?>
                                                <?php echo $site_settings->site_home_settings['service_5_title_' . $_SESSION['language_alias']]; ?>
                                                <?php if (!empty($site_settings->site_home_settings['service_5_url'])) { ?></a><?php } ?>
                                        </h3>
                                        <text><?php echo $site_settings->site_home_settings['service_5_desc_' . $_SESSION['language_alias']]; ?></text>
                                    </div>
                                </li>
                            <?php } ?>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--End services-->
    <?php } ?>
    <?php if ($site_settings->works_status) { ?>
        <!--works-->
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo URL; ?>templates/js/jquery.magnific-popup.min.js"></script>
        <!-- Magnific Popup -->
        <script>
            $(document).ready(function () {
                $('.portfolio_zoom').magnificPopup({
                        //delegate: 'a.portfolio_zoom',
                        type: 'image',
                        disableOn: 400,
                        image: {
                            verticalFit: true,
                            titleSrc: function(item) {
                                return item.el.attr('title');
                            }
                        },
                        gallery: {
                            enabled: true
                        }

                    });
            });
        </script>
        <section class="row" id="works">
            <div class="container">
                <div class="heading">
                    <h2 class="wow zoomIn" data-wow-delay=".5s"><?php echo $site_settings->site_home_settings['works_title_' . $_SESSION['language_alias']]; ?></h2>
                    <div class="line"><span></span><span></span></div>
                </div>
                <?php
                $works = $models->works('*', $site_settings->works_number);
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
                                    <a href="<?php echo $_work_large_image_path; ?>" class="portfolio_zoom"><i class="fa fa-search-plus"></i></a>
                                    <a href="<?php echo URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'].'/works/project/'.$_work_alias; ?>" class="portfolio_view"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'].'/works/project/'.$_work_alias; ?>" alt="<?php echo $_work_title; ?>" title="<?php echo $_work_title; ?>" class="portfolio_title"><?php echo $_work_title_summary; ?></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?></div><?php
                }
                ?>
            </div>
        </section>
        <!--End works-->
    <?php } ?>
    <?php if ($site_settings->blog_status) { ?>
        <!--blog-->
        <section class="row" id="blog">
            <div class="container">
                <div class="heading">
                    <h2 class="wow zoomIn" data-wow-delay=".5s"><?php echo $site_settings->site_home_settings['blog_title_' . $_SESSION['language_alias']]; ?></h2>
                    <div class="line"><span></span><span></span></div>
                </div>
                <?php
                $articles = $models->articles_with_pagination(0, $site_settings->blog_number);
                if (is_array($articles)) {
                    ?><div class="blog"><?php
                    foreach ($articles as $article) {
                        $_article_title_array = (isset($article['title'])) ? unserialize(base64_decode($article['title'])) : [];
                        $_article_title = isset($_article_title_array[$_SESSION['language_alias']]) ? $models->Cut_Words($_article_title_array[$_SESSION['language_alias']], 600) : '';
                        $_article_title_summary = $models->Cut_Words($_article_title, 25, 0);
                        $_article_alias = (isset($article['alias'])) ? $article['alias'] : '';
                        $_article_content_array = (isset($article['content'])) ? unserialize(base64_decode($article['content'])) : [];
                        $_article_content = isset($_article_content_array[$_SESSION['language_alias']]) ? $_article_content_array[$_SESSION['language_alias']] : '';
                        $_article_content_summary = $models->Cut_Words($_article_content, 300, 0);
                        $_article_image = (isset($article['image'])) ? $article['image'] : '';
                        $_article_image_path = (file_exists(THUMBS_PATH_BASE . 'blog/' . $_article_image)) ? ARTICLES_IMAGES_THUMBS_PATH . $_article_image : ARTICLES_IMAGES_PATH . $_article_image;
                        ?>
                            <article class="col-xs-12 col-sm-6 col-md-3 wow zoomIn">
                                <a class="img" href="<?php echo URL . $_SESSION['language_alias'] . '/blog/article/' . $_article_alias; ?>" title="<?php echo $_article_title; ?>"><img src="<?php echo $_article_image_path; ?>" /></a>
                                <div class="cont">
                                    <h3><a href="<?php echo URL . $_SESSION['language_alias'] . '/blog/article/' . $_article_alias; ?>" title="<?php echo $_article_title; ?>"><?php echo $_article_title_summary; ?></a></h3>
                                    <text><?php echo $_article_content_summary; ?></text>
                                    <a class="readmore" href="<?php echo URL . $_SESSION['language_alias'] . '/blog/article/' . $_article_alias; ?>">
                                        <span><?php echo $language->Read_More; ?></span> 
                                        <i class="fa fa-angle-double-<?php echo ($_SESSION['language_DIR'] == 'LTR') ? 'right' : 'left'; ?>"></i>
                                    </a>
                                </div>
                            </article>
                            <?php
                        }
                        ?></div><?php
                }
                ?>
            </div>
        </section>
        <!--End blog-->
    <?php } ?>
    <?php if ($site_settings->clients_status) { ?>
        <!--clients-->
        <section class="row" id="clients">
            <link rel="stylesheet" href="<?php echo URL; ?>templates/css/slick.css"  />
            <div class="container">
                <div class="heading">
                    <h2 class="wow zoomIn" data-wow-delay=".5s"><?php echo $site_settings->site_home_settings['clients_title_' . $_SESSION['language_alias']]; ?></h2>
                    <div class="line"><span></span><span></span></div>
                </div>
                <?php
                $clients = $models->clients();
                if (is_array($clients)) {
                    ?><div class="clients"><?php
                        foreach ($clients as $client) {
                            $_client_image = (isset($client['image'])) ? $client['image'] : '';
                            $_client_image_path = (file_exists(THUMBS_PATH_BASE . 'clients/' . $_client_image)) ? CLIENTS_IMAGES_THUMBS_PATH . $_client_image : CLIENTS_IMAGES_PATH . $_client_image;
                            ?><div><span><img src="<?php echo $_client_image_path ?>" /></span></div><?php
                        }
                        ?></div>
                    <script type="text/javascript" src="<?php echo URL; ?>templates/js/slick.min.js"></script>
                    <script>
                $(document).ready(function () {
                    $('.clients').slick({
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 1000,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    dots: false
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            }
                            // You can unslick at a given breakpoint now by adding:
                            // settings: "unslick"
                            // instead of a settings object
                        ]
                    });
                });
                    </script>
                    <?php
                }
                ?>
            </div>
        </section>
        <!--End clients-->
    <?php } ?>
</div>