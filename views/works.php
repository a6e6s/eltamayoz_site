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
                    <h1 class="wow zoomIn" data-wow-delay=".5s"><?php echo $page_title; ?></h1>
                    <div class="line"><span></span><span></span></div>
                </div>
            </div>
        </div>
    </section>
    <!--End header-page-->
    <!--page-content-->
    <link rel="stylesheet" href="<?php echo URL; ?>templates/css/magnific-popup.css">
    <section class="row page-content">
        <div class="container">
            <div class="button-group filters-button-group">
                <?php
                if (is_array($works_tags)) {
                    ?><a class="button is-checked" data-filter="*"><?php echo $language->Show_All; ?></a><?php
                    foreach ($works_tags as $works_tag) {
                        $works_tag_name_array = isset($works_tag['name']) ? unserialize($works_tag['name']) : [];
                        $works_tag_name = isset($works_tag_name_array[$_SESSION['language_alias']]) ? $works_tag_name_array[$_SESSION['language_alias']] : '';
                        ?>
                        <a class="button" data-filter=".<?php echo $works_tag_name; ?>"><?php echo $works_tag_name; ?></a>
                        <?php
                    }
                }
                ?>
            </div>
            <div class="grid">
                <?php
                if (is_array($works)) {
                    ?><div class="works"><?php
                    foreach ($works as $work) {
                        $_work_id = (isset($work['id'])) ? $work['id'] : 0;
                        $_work_title_array = (isset($work['title'])) ? unserialize(base64_decode($work['title'])) : [];
                        $_work_title = isset($_work_title_array[$_SESSION['language_alias']]) ? $_work_title_array[$_SESSION['language_alias']] : '';
                        $_work_title_summary = $models->Cut_Words($_work_title, 50, 0);
                        $_work_alias = (isset($work['alias'])) ? $work['alias'] : '#';
                        $_work_image = (isset($work['image'])) ? $work['image'] : '';
                        $_work_image_path = (file_exists(THUMBS_PATH_BASE . 'works/' . $_work_image)) ? WORKS_IMAGES_THUMBS_PATH . $_work_image : WORKS_IMAGES_PATH . $_work_image;
                        $_work_large_image_path = WORKS_IMAGES_PATH . $_work_image;
                        // tags ..
                        $work_tags = $models->work_tags($_work_id);
                        $ttt = [];
                        if (is_array($work_tags)) {
                            foreach ($work_tags as $tag) {
                                $_tag_id = (isset($tag['id'])) ? $tag['id'] : 0;
                                $_tag_name_array = (isset($tag['name'])) ? unserialize($tag['name']) : [];
                                $_tag_name = isset($_tag_name_array[$_SESSION['language_alias']]) ? $_tag_name_array[$_SESSION['language_alias']] : '';
                                $ttt[] = $_tag_name;
                            }
                        }
                        ?>
                            <div class="w1 portfolio_item col-xs-12 col-sm-6 col-md-3 wow zoomIn element-item <?php echo implode(' - ', $ttt); ?>" style="background-image:url(<?php echo $_work_image_path; ?>);">
                                <div class="portfolio_det">
                                    <a href="<?php echo $_work_large_image_path; ?>" class="portfolio_zoom"><i class="fa fa-search-plus"></i></a>
                                    <a href="<?php echo $_page_url.'/project/'.$_work_alias; ?>" class="portfolio_view"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo $_page_url.'/project/'.$_work_alias; ?>" alt="<?php echo $_work_title; ?>" title="<?php echo $_work_title; ?>" class="portfolio_title"><?php echo $_work_title_summary; ?></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?></div><div class="clearfix"></div><?php
                    }
                    ?>
            </div>
            <script src="<?php echo URL; ?>templates/js/jquery.magnific-popup.min.js"></script>
            <script src="<?php echo URL; ?>templates/js/isotope.pkgd.min.js"></script>
            <script>
                $(document).ready(function () {
                    //                popup
                    $('.portfolio_zoom').magnificPopup({
                        //delegate: 'a.portfolio_zoom',
                        type: 'image',
                        disableOn: 400,
                        image: {
                            verticalFit: true,
                            titleSrc: function (item) {
                                return item.el.attr('title');
                            }
                        },
                        gallery: {
                            enabled: true
                        }

                    });
                    // filter ...
                    $(function () {
                        // init Isotope
                        var $grid = $('.grid').isotope({
                            itemSelector: '.element-item',
                            layoutMode: 'fitRows'
                        });
                        // filter functions
                        var filterFns = {
                            // show if number is greater than 50
                            numberGreaterThan50: function () {
                                var number = $(this).find('.number').text();
                                return parseInt(number, 10) > 50;
                            },
                            // show if name ends with -ium
                            ium: function () {
                                var name = $(this).find('.name').text();
                                return name.match(/ium$/);
                            }
                        };
                        // bind filter button click
                        $('.filters-button-group').on('click', 'a', function () {
                            var filterValue = $(this).attr('data-filter');
                            // use filterFn if matches value
                            filterValue = filterFns[ filterValue ] || filterValue;
                            $grid.isotope({filter: filterValue});
                        });
                        // change is-checked class on buttons
                        $('.button-group').each(function (i, buttonGroup) {
                            var $buttonGroup = $(buttonGroup);
                            $buttonGroup.on('click', 'a', function () {
                                $buttonGroup.find('.is-checked').removeClass('is-checked');
                                $(this).addClass('is-checked');
                            });
                        });


                    });
                });

            </script>
        </div>
    </section>
</div>
<!--End page-content-->



