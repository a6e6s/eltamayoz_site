<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
//site settings
$site_settings->global_settings();
$site_settings->main_site_links();
($site_settings->Main_Site_Status == 0) ? $models->redirect_to(URL . $_SESSION['language_alias'] . '/site_closed') : null;
?>
<html>
    <head>
        <title><?php echo $site_settings->Site_Name; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <meta name="description" content="<?php echo $site_settings->SiteMetaDescription; ?>" >
        <meta name="keywords" content="<?php echo $site_settings->SiteMetaKey; ?>" >
        <meta name="auther" content="<?php echo URL; ?>" >
        <meta name="robots" content="index,follow" />
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="<?php echo $site_settings->Site_Name; ?>">
        <meta itemprop="description" content="<?php echo $site_settings->SiteMetaDescription; ?>">
        <meta itemprop="keywords" content="<?php echo $site_settings->SiteMetaKey; ?>">
        <meta itemprop="image" content="<?php echo SITES_IMAGES_PATH . $site_settings->Logo; ?>">
        <!--social meta tags-->
        <!--facebook-->
        <meta property="og:title" content="<?php echo $site_settings->Site_Name; ?>" >
        <meta property="og:site_name" content="<?php echo URL; ?>"/>
        <meta property="og:url" content="<?php echo URL; ?>"/>
        <meta property="og:description" content="<?php echo $site_settings->SiteMetaDescription; ?>"/>
        <meta property="og:type" content="article" />
        <meta property="og:image" content="<?php echo SITES_IMAGES_PATH . $site_settings->Logo; ?>" />
        <!--twitter-->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="<?php echo URL; ?>">
        <meta name="twitter:url" content="<?php echo URL; ?>" >
        <meta name="twitter:title" content="<?php echo $site_settings->Site_Name; ?>" >
        <meta name="twitter:description" content="<?php echo $site_settings->SiteMetaDescription; ?>" >
        <meta name="twitter:creator" content="<?php echo $site_settings->Site_Name; ?>">
        <!--Twitter Summary card images must be at least 120x120px-->
        <meta name="twitter:image" content="<?php echo SITES_IMAGES_PATH . $site_settings->Logo; ?>">
        <link rel="icon" type="image/png" href="<?php echo TEMPLATE . 'images/favicon.png' ?>" />
        <!--CSS-->
        <!-- bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/bootstrap.min.css">
        <!-- templates style -->
        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/main.css"  />
        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/font-awesome.min.css">
        <!--WOW scrol reveal-->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>templates/css/animate.css">
        <!-- header code -->
        <?php echo (isset($site_settings->HeaderCode)) ? $site_settings->HeaderCode : null; ?>
        <!-- End header code -->

    </head>
    <body>
        <div id="loader"></div>
        <div id="header">
            <video autoplay loop poster="<?php echo URL; ?>templates/images/polina.jpg" class="bgvid">
                <source src="<?php echo URL; ?>templates/images/stock-video.mp4" type="video/mp4">
            </video>
            <div class="he-content"></div>
            <div class="services">
                <h1 class="col-xs-12 col-sm-6 logo wow bounceIn" data-wow-delay="1s" ><a href="<?php echo URL; ?>" title="<?php echo $site_settings->Site_Name; ?>" ><img src="<?php echo SITES_IMAGES_PATH . $site_settings->Logo; ?>" title="<?php echo $site_settings->Site_Name; ?>" alt="<?php echo $site_settings->Site_Name; ?>" /></a></h1>
                <div class="col-xs-12 row-1">
                    <span class="serv-1">
                        <a href="<?php echo ($site_settings->Site_Link_type_1 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_1 : $site_settings->Site_Link_url_1; ?>"  title="<?php echo $site_settings->Site_Link_title_1; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_1; ?>" title="<?php echo $site_settings->Site_Link_title_1; ?>" alt="<?php echo $site_settings->Site_Link_title_1; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_1; ?></h2>
                        </a>
                    </span>
                </div>
                <div class="col-xs-12 row-2">
                    <span class="serv-2">
                        <a href="<?php echo ($site_settings->Site_Link_type_8 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_8 : $site_settings->Site_Link_url_8; ?>"  title="<?php echo $site_settings->Site_Link_title_8; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_8; ?>" title="<?php echo $site_settings->Site_Link_title_8; ?>" alt="<?php echo $site_settings->Site_Link_title_8; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_8; ?></h2>
                        </a>
                    </span>
                    <span class="serv-3">
                        <a href="<?php echo ($site_settings->Site_Link_type_2 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_2 : $site_settings->Site_Link_url_2; ?>"  title="<?php echo $site_settings->Site_Link_title_2; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_2; ?>" title="<?php echo $site_settings->Site_Link_title_2; ?>" alt="<?php echo $site_settings->Site_Link_title_2; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_2; ?></h2>
                        </a>
                    </span>
                </div>
                <div class="col-xs-12 row-3">
                    <span class="serv-4">
                        <a href="<?php echo ($site_settings->Site_Link_type_7 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_7 : $site_settings->Site_Link_url_7; ?>"  title="<?php echo $site_settings->Site_Link_title_7; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_7; ?>" title="<?php echo $site_settings->Site_Link_title_7; ?>" alt="<?php echo $site_settings->Site_Link_title_7; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_7; ?></h2>
                        </a>
                    </span>
                    <span class="serv-5">
                        <a href="<?php echo ($site_settings->Site_Link_type_3 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_3 : $site_settings->Site_Link_url_3; ?>"  title="<?php echo $site_settings->Site_Link_title_3; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_3; ?>" title="<?php echo $site_settings->Site_Link_title_3; ?>" alt="<?php echo $site_settings->Site_Link_title_3; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_3; ?></h2>
                        </a>
                    </span>
                </div>
                <div class="col-xs-12 row-4">
                    <span class="serv-6">
                        <a href="<?php echo ($site_settings->Site_Link_type_6 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_6 : $site_settings->Site_Link_url_6; ?>"  title="<?php echo $site_settings->Site_Link_title_6; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_6; ?>" title="<?php echo $site_settings->Site_Link_title_6; ?>" alt="<?php echo $site_settings->Site_Link_title_6; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_6; ?></h2>
                        </a>
                    </span>
                    <span class="serv-7">
                        <a href="<?php echo ($site_settings->Site_Link_type_4 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_4 : $site_settings->Site_Link_url_4; ?>"  title="<?php echo $site_settings->Site_Link_title_4; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_4; ?>" title="<?php echo $site_settings->Site_Link_title_4; ?>" alt="<?php echo $site_settings->Site_Link_title_4; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_4; ?></h2>
                        </a>
                    </span>
                </div>
                <div class="col-xs-12 row-5">
                    <span class="serv-8">
                        <a href="<?php echo ($site_settings->Site_Link_type_5 == 'internal') ? URL . $_SESSION['language_alias'] . '/' . $site_settings->Site_Link_url_5 : $site_settings->Site_Link_url_5; ?>"  title="<?php echo $site_settings->Site_Link_title_5; ?>" class=" wow bounceIn" data-wow-delay="1.2s">
                            <img src="<?php echo SITES_IMAGES_PATH . $site_settings->Site_Link_icon_5; ?>" title="<?php echo $site_settings->Site_Link_title_5; ?>" alt="<?php echo $site_settings->Site_Link_title_5; ?>" />
                            <h2 lang="<?php echo $_SESSION['language_alias'] ?>"> <?php echo $site_settings->Site_Link_title_5; ?></h2>
                        </a>
                    </span>
                </div>
            </div>

        </div>
    </body>
    <!--JS-->
    <script type="text/javascript" src="<?php echo URL; ?>templates/js/jquery-2.1.4.min.js"></script>
    <!--page load-->
    <script>
        $(window).load(function () {
            $("#loader").fadeOut("slow");
        });
    </script>
    <!--WOW scroll reveal-->
    <script type="text/javascript" src="<?php echo URL; ?>templates/js/wow.min.js"></script>
    <script>
        $(document).ready(function () {
            new WOW().init();
        });
    </script>
    <!-- footer code -->
    <?php echo (isset($site_settings->FooterCode)) ? $site_settings->FooterCode : null; ?>
    <!-- END footer code -->
</html>


