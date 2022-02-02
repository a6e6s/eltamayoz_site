<?php

/*

 * @Developed by : Ahmed Abd Elhaliem .

 * @Developer Site: http//www.elmosamem.com 

 */

?>

<html>

    <head>

        <title><?php echo $_page_title; ?></title>

		<meta name="google-site-verification" content="lqCPfkwqXNlxwOjGeVc22fWg5Zrq6hxBuTWGsyuqGdA" />

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width">

        <meta name="description" content="<?php echo $_site_desc; ?>" >

        <meta name="keywords" content="<?php echo $_site_keywords; ?>" >

        <meta name="auther" content="<?php echo URL; ?>" >

        <meta name="robots" content="index,follow" />

        <!-- Schema.org markup for Google+ -->

        <meta itemprop="name" content="<?php echo $_page_title; ?>">

        <meta itemprop="description" content="<?php echo $_site_desc; ?>">

        <meta itemprop="keywords" content="<?php echo $_site_keywords; ?>">

        <meta itemprop="image" content="<?php echo $_image_page_path; ?>">

        <!--social meta tags-->

        <!--facebook-->

        <meta property="og:title" content="<?php echo $_page_title; ?>" >

        <meta property="og:site_name" content="<?php echo URL; ?>"/>

        <meta property="og:url" content="<?php echo $_page_url; ?>"/>

        <meta property="og:description" content="<?php echo $_site_desc; ?>"/>

        <meta property="og:type" content="article" />

        <meta property="og:image" content="<?php echo $_image_page_path; ?>" />

        <!--twitter-->

        <meta name="twitter:card" content="summary">

        <meta name="twitter:site" content="<?php echo URL; ?>">

        <meta name="twitter:url" content="<?php echo $_page_url; ?>" >

        <meta name="twitter:title" content="<?php echo $_page_title; ?>" >

        <meta name="twitter:description" content="<?php echo $_site_desc; ?>" >

        <meta name="twitter:creator" content="<?php echo $_site_name; ?>">

        <!--Twitter Summary card images must be at least 120x120px-->

        <meta name="twitter:image" content="<?php echo $_image_page_path; ?>">

        <link rel="icon" type="image/png" href="<?php echo TEMPLATE . 'images/favicon.png' ?>" />



        <!--CSS-->

        <!-- bootstrap CSS -->

        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/bootstrap.min.css">

        <!--templates style--> 

        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/style.css"  />

        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/style_<?php echo $_SESSION['language_DIR']; ?>.css"  />

        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/menu.css">

        <!--WOW scrol reveal-->

        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>templates/css/animate.css">

        <!--JS-->

        <script type="text/javascript" src="<?php echo URL; ?>templates/js/jquery-2.1.4.min.js"></script>

        <!-- header code -->

        <?php echo (isset($site_settings->HeaderCode)) ? $site_settings->HeaderCode : null; ?>

        <!-- End header code -->

        <!-- site script -->

        <script>

            $(document).ready(function () {

                if ($(window).width() > 768) {

                    $(".dropdown").hover(

                            function () {

                                $('.dropdown-menu', this).stop(true, true).slideDown("fast");

                                $(this).toggleClass('open');

                            },

                            function () {

                                $('.dropdown-menu', this).stop(true, true).slideUp("fast");

                                $(this).toggleClass('open');

                            }

                    );

                } else

                {

                    $('.navbar').attr("data-spy", false);

                }

            });

        </script>

        <!-- END site script -->

    </head>

    <body>

        <!--<div id="loader"></div>-->

        <div class="container-fluid">

            <!--header-->

            <section class="row header" id="header">

                <!--top-->

                <div class="top">

                    <div class="container">

                        <div class="col-xs-3 social">

                            <?php

                            if (is_array($languages)) {

                                foreach ($languages as $la) {

                                    if ($la['alias'] != $_SESSION['language_alias']) {

                                        ?>

                                        <a href="<?php echo URL . $la['alias'] . '/' . $_SESSION['site_alias']; ?>"><img src="<?php echo FLAGS_IMAGES_PATH . $la['flag']; ?>"></a>

                                        <?php

                                    }

                                }

                            }

                            ?>

                                <?php if (!empty($site_settings->facebook)) { ?><a href="<?php echo $site_settings->facebook; ?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a><?php } ?>

                            <?php if (!empty($site_settings->twitter)) { ?><a href="<?php echo $site_settings->twitter; ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a><?php } ?>

                            <?php if (!empty($site_settings->google)) { ?><a href="<?php echo $site_settings->google; ?>" target="_blank"><i class="fa fa-google-plus fa-lg"></i></a><?php } ?>

                            <?php if (!empty($site_settings->youtube)) { ?><a href="<?php echo $site_settings->youtube; ?>" target="_blank"><i class="fa fa-youtube fa-lg"></i></a><?php } ?>

                            <?php if (!empty($site_settings->linkedin)) { ?><a href="<?php echo $site_settings->linkedin; ?>" target="_blank"><i class="fa fa-linkedin fa-lg"></i></a><?php } ?>



                        </div>

                        <div class="col-xs-2"><i class="fa fa-envelope"></i><span><a href="#"><a href="mailto:<?php echo $site_settings->email; ?>"><?php echo $site_settings->email; ?></a></a></span></div>

                        <div class="col-xs-2"><i class="fa fa-phone-square"></i><span><a href="tel:<?php echo $site_settings->mobile; ?>"><?php echo $site_settings->mobile; ?></a></span></div>

                        <div class="col-xs-5"><i class="fa fa-map-marker"></i><span><?php echo $site_settings->address_contacts_title; ?></span></div>

                    </div>

                </div>

                <!--End top-->



                <nav class="navbar" role="navigation"  data-spy="affix" data-offset-top="30">

                    <div class="container">

                        <!--logo-->

                        <div class="logo col-xs-2">

                            <h1><a title="<?php echo $_site_name; ?>" href="<?php echo URL . $_SESSION['language_alias']; ?>"><img src="<?php echo SITES_IMAGES_PATH . $site_settings->Logo; ?>" /></a></h1>

                        </div>

                        <!--End logo-->

                        <!--main menu-->

                        <?php

                        if (is_array($menu)) {

                            ?>

                            <div class="container-fluid">

                                <!-- Brand and toggle get grouped for better mobile display -->

                                <div class="navbar-header">

                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-megadropdown-tabs">

                                        <i class="fa fa-bars fa-2x"></i>

                                    </button>

                                    <a class="navbar-brand" href="#"></a>

                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->

                                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">

                                    <ul class="nav navbar-nav">

                                        <?php

                                        foreach ($menu as $link) {

                                            $_link_menu_title_array = (isset($link['title'])) ? unserialize(base64_decode($link['title'])) : [];

                                            $_link_menu_title = isset($_link_menu_title_array[$_SESSION['language_alias']]) ? $_link_menu_title_array[$_SESSION['language_alias']] : '';

                                            $_link_menu_url_type = (isset($link['type'])) ? $link['type'] : 'internal';

                                            $_link_menu_url = isset($link['url']) ? $link['url'] : '';

                                            if ($_link_menu_url_type == 'internal') {

                                                $_link_menu_all_url = URL . $_SESSION['language_alias'] . '/' . $_link_menu_url;

                                            } else {

                                                $_link_menu_all_url = $_link_menu_url;

                                            }



                                            if ($link['parent_id'] == 0) {

                                                $link_parent_arrow = FALSE;

                                                $link_parent_id = $link['id'];

                                                foreach ($menu as $link2) {

                                                    if ($link2['parent_id'] == $link_parent_id) {

                                                        $link_parent_arrow = TRUE;

                                                        break;

                                                    }

                                                }

                                                $active = ($_link_menu_title == $page_title) ? 'class="active"' : '';

                                                ?>

                                                <li <?php echo ($link_parent_arrow) ? 'class="dropdown"' : null; ?> >

                                                    <a <?php echo $active; ?> href="<?php echo $_link_menu_all_url; ?>" <?php echo ($link_parent_arrow) ? 'class="dropdown-toggle" data-toggle="dropdown"' : null; ?>>

                                                        <?php echo $_link_menu_title; ?>

                                                        <?php echo ($link_parent_arrow) ? '<i class="fa fa-angle-down"></i>' : null; ?>

                                                    </a>

                                                    <?php

                                                    if ($link_parent_arrow) {

                                                        ?>

                                                        <ul class="dropdown-menu" role="menu">

                                                            <?php

                                                            foreach ($menu as $link2) {

                                                                $_link2_menu_title_array = (isset($link2['title'])) ? unserialize(base64_decode($link2['title'])) : [];

                                                                $_link2_menu_title = isset($_link2_menu_title_array[$_SESSION['language_alias']]) ? $_link2_menu_title_array[$_SESSION['language_alias']] : '';

                                                                $_link2_menu_url_type = (isset($link2['type'])) ? $link2['type'] : 'internal';

                                                                $_link2_menu_url = (isset($link2['url']) && !empty($link2['url']) && $link2['url'] != '#') ? $link2['url'] : '';

                                                                if ($_link2_menu_url_type == 'internal') {

                                                                    $_link2_menu_all_url = URL . $_SESSION['language_alias'] . '/' . $_link2_menu_url;

                                                                } else {

                                                                    $_link2_menu_all_url = $_link2_menu_url;

                                                                }

                                                                if ($link2['parent_id'] == $link_parent_id) {

                                                                    $link_parent_arrow = TRUE;

                                                                    ?>

                                                                    <li><a href="<?php echo $_link2_menu_all_url; ?>"> <?php echo $_link2_menu_title; ?></a></li>

                                                                    <?php

                                                                }

                                                            }

                                                            ?> 

                                                        </ul>

                                                        <?php

                                                    }

                                                    ?>

                                                </li>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </ul>

                                </div><!-- /.navbar-collapse -->

                            </div><!-- /.container-fluid -->



                        <?php } ?>

                        <!--End main menu-->

                    </div>

                </nav>

            </section>

            <!--End header-->

            <div class="clearfix"></div>

