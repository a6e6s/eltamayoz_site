<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<!--footer-->
<section class="row" id="footer">
    <div class="totop">
        <a href="#">
            <i class="fa fa-chevron-up"></i>
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    <!--top-->
    <div class="top">
        <div class="container">
            <div class="col-xs-2 social">
                <?php if (!empty($site_settings->facebook)) { ?><a href="<?php echo $site_settings->facebook; ?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a><?php } ?>
                <?php if (!empty($site_settings->twitter)) { ?><a href="<?php echo $site_settings->twitter; ?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a><?php } ?>
                <?php if (!empty($site_settings->google)) { ?><a href="<?php echo $site_settings->google; ?>" target="_blank"><i class="fa fa-google-plus fa-lg"></i></a><?php } ?>
                <?php if (!empty($site_settings->youtube)) { ?><a href="<?php echo $site_settings->youtube; ?>" target="_blank"><i class="fa fa-youtube fa-lg"></i></a><?php } ?>
            </div>
            <div class="col-xs-3"><i class="fa fa-envelope"></i><span><a href="#"><a href="mailto:<?php echo $site_settings->email; ?>"><?php echo $site_settings->email; ?></a></a></span></div>
            <div class="col-xs-3"><i class="fa fa-phone-square"></i><span><a href="tel:<?php echo $site_settings->mobile; ?>"><?php echo $site_settings->mobile; ?></a></span></div>
            <div class="col-xs-4"><i class="fa fa-map-marker"></i><span><?php echo $site_settings->address_contacts_title; ?></span></div>
        </div>
    </div>
    <!--End top-->
    <div class="container">
        <div class="col-xs-10 col-sm-10 footer-menu">
            <ul>
                <?php
                if (is_array($footer_menu)) {
                    foreach ($footer_menu as $footer_links) {
                        $_footer_link_title_array = (isset($footer_links['title'])) ? unserialize(base64_decode($footer_links['title'])) : [];
                        $_footer_link_title = isset($_footer_link_title_array[$_SESSION['language_alias']]) ? $_footer_link_title_array[$_SESSION['language_alias']] : '';
                        $_footer_link_url_type = (isset($footer_links['type'])) ? $footer_links['type'] : 'internal';
                        $_footer_link_url = isset($footer_links['url']) ? $footer_links['url'] : '';
                        if ($_footer_link_url_type == 'internal') {
                            $_footer_link_all_url = URL . $_SESSION['language_alias'] . '/' . $_footer_link_url;
                        } else {
                            $_footer_link_all_url = $_footer_link_url;
                        }
                        ?>
                        <li><a href="<?php echo $_footer_link_all_url; ?>"><?php echo $_footer_link_title; ?></a></li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="col-xs-2 logo">
            <h1><a href="<?php echo URL; ?>"><img src="<?php echo SITES_IMAGES_PATH . $site_settings->Logo; ?>" /></a></h1>
        </div>
        <!--<div class="clearfix"></div>-->
        <div class="col-xs-12 copyright">
            <a href="<?php echo URL; ?>"><?php echo $language->CopyRight; ?></a>
        </div>
    </div>
</section>
<!--End footer-->
</div>
</body>
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo URL; ?>templates/js/bootstrap.min.js"></script>
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
<!--back to top-->
<script>
    if ($('.totop a').length) {
        var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('.totop a').addClass('show');
                    } else {
                        $('.totop a').removeClass('show');
                    }
                };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('.totop a').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
</script>

<!-- footer code -->
<?php echo (isset($site_settings->FooterCode)) ? $site_settings->FooterCode : null; ?>
<!-- END footer code -->

</html>
<?php
$models->db->close();
ob_end_flush();
?>
