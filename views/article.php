<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<div id="page-content">
    <!--header-page-->
    <section class="row header-page" id="header-page">
        <?php if ($_image) { ?><img alt="<?php echo $_title ?>" title="<?php echo $_title; ?>" src="<?php echo $_image_path; ?>" /><?php } ?>
        <div class="container">
            <div class="head-con">
                <div class="container">
                    <div class="heading2">
                        <h1 class="wow zoomIn" data-wow-delay=".5s"><?php echo $_title; ?></h1>
                        <div class="line"><span></span><span></span></div>
                    </div>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="<?php echo URL . $_SESSION['language_alias']; ?>"><?php echo $language->Home; ?></a></li>
                            <li class="sep"> - </li>
                            <li><a href="<?php echo URL . $_SESSION['language_alias'] . '/blog/articles'; ?>"><?php echo $page_title; ?></a></li>
                            <li class="sep"> - </li>
                            <li><a href="<?php echo URL . $_SESSION['language_alias'] . '/blog/category/' . $_category_alias; ?>"><?php echo $_category_name; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End header-page-->
    <!--page-content-->
    <!-- social share kit style -->
    <link rel="stylesheet" href="<?php echo URL; ?>templates/css/social-share-kit.css">
    <section class="row page-content">
        <div class="container">
            <post class=" col-xs-12 col-sm-9">
                <!--<img src="images/article1.jpg" />-->
                <div class="row info">
                    <ul>
                        <li>
                            <i class="fa fa-calendar"></i>
                            <span><?php echo $_date; ?></span>
                        </li>
                        <li>
                            <i class="fa fa-user"></i>
                            <span><?php echo $_author_name; ?></span>
                        </li>
                        <li>
                            <i class="fa fa-folder"></i>
                            <span><a href="<?php echo URL . $_SESSION['language_alias'] . '/blog/category/' . $_category_alias; ?>"><?php echo $_category_name; ?></a></span>
                        </li>
                        <li>
                            <i class="fa fa-comment"></i>
                            <span><?php echo $count_comments; ?> <?php echo $language->Comments; ?></span>
                        </li>
                    </ul>
                </div>
                <text><?php echo $_content; ?></text>

                <?php
                if (is_array($tags)) {
                    ?><div class="tags"><i class="fa fa-tag "></i><?php
                    $ttt = [];
                    foreach ($tags as $tag) {
                        $_tag_id = (isset($tag['id'])) ? $tag['id'] : 0;
                        $_tag_name_array = (isset($tag['name'])) ? unserialize($tag['name']) : [];
                        $_tag_name = isset($_tag_name_array[$_SESSION['language_alias']]) ? $_tag_name_array[$_SESSION['language_alias']] : '';
                        $ttt[] = $_tag_name;
                    }
                    echo implode(' - ', $ttt);
                    ?></div><?php
                }
                ?>
                <span class="col-xs-12 social"> 
                    <i class="fa fa-share-alt "></i>
                    <div class="ssk-group ssk-sm" data-url="" data-text="" >
                        <a href="" class="ssk ssk-icon ssk-google-plus"></a>
                        <a href="" class="ssk ssk-icon ssk-twitter" data-text=""></a>
                        <a href="" class="ssk ssk-icon ssk-facebook"></a>
                    </div>
                </span>
                <div class="clearfix"></div>
                <div class="col-xs-12 author">
                    <span class="row avatar col-xs-12 col-sm-3"><img src="<?php echo $_author_avatar_path; ?>" /></span>
                    <span class="info col-xs-12 col-sm-9">
                        <h3><?php echo $_author_name; ?></h3>
                        <p><?php echo $_author_about; ?></p>
                    </span>
                </div>
                <div class="col-xs-12  comments">
                    <?php
                    if (isset($_POST['submit']) AND ! empty($_POST['submit'])) {
                        $errors = array();

                        $f_name = (isset($_POST['full_name']) && !empty($_POST['full_name'])) ? $models->filtrate($_POST['full_name']) : $errors[] = $language->PLZ_Enter_Name;
                        $se_message = (isset($_POST['message']) && !empty($_POST['message'])) ? $models->filtrate($_POST['message']) : $errors[] = $language->PLZ_Enter_Comment;
                        (isset($_POST['verify']) && $_SESSION['verify'] == $_POST['verify']) ? null : $errors[] = $language->Captcha_Incorrect;
                        if (empty($errors)) {
                            $coulmns = array(
                                'comment' => $se_message,
                                'article_id' => $_item_id,
                                'username' => $f_name,
                                'status' => '0',
                                'readable' => '0',
                                'created' => time()
                            );
                            if (!$models->send_comment($coulmns)) {
                                $session->message($language->Error_Send_Message, 'alert alert-danger');
                            } else {
                                $session->message($language->Success_Send_Message, 'alert alert-success');
                            }
                        } else {
                            $all_error = "";
                            foreach ($errors as $error) {
                                $all_error .= $error . '<br/>';
                            }
                            $session->message($all_error, 'alert alert-danger');
                        }
                        $models->redirect_to(URL . $_SESSION['language_alias'] . '/blog/article/' . $alias);
                    }
                    if (!empty($session->message)) {
                        echo $session->message;
                    }
                    ?>
                    <div class="heading2">
                        <h1 class="wow zoomIn" data-wow-delay=".5s"><?php echo $language->Comments; ?></h1>
                        <div class="line"><span></span><span></span></div>
                    </div>
                    <div class="col-xs-12 ">
                        <?php
                        if (is_array($comments)) {
                            foreach ($comments as $comment) {
                                $_comment_id = (isset($comment['id'])) ? $comment['id'] : 0;
                                $_comment = (isset($comment['comment'])) ? $models->Create_Lines($comment['comment']) : '';
                                $_commenter = (isset($comment['username'])) ? $comment['username'] : '';
                                ?>
                                <h5><?php echo $_commenter; ?></h5>
                                <p><?php echo $_comment; ?></p>
                                <hr/>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="col-xs-12 ">
                        <form action="#" method="post" >
                            <div class="input-group col-xs-12 col-sm-6 " >
                                <input name="full_name" class="form-control" type="text" placeholder="<?php echo $language->YourName; ?>" required>
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="input-group col-xs-12 col-sm-10">
                                <textarea name="message" class="form-control" placeholder="<?php echo $language->Message; ?>" required></textarea>
                                <i class="fa fa-pencil"></i>
                            </div>
                            <?php
                            $min = rand(1, 9);
                            $max = rand(1, 9);
                            $_SESSION['verify'] = $min + $max;
                            ?> 
                            <div class="form-group form-inline col-xs-12">
                                <label><?php echo $min . ' + ' . $max . ' = '; ?></label>
                                <input name="verify" class="form-control" type="number" min="0" max="2" required>
                            </div>
                            <label class="submit" for="submit">
                                <?php echo $language->Send; ?> 
                                <i class="fa fa-send"></i>
                                <input name="submit" type="submit" id="submit"/>
                            </label>
                        </form>
                    </div>
                </div>
            </post>
            <side class="col-xs-12 col-md-3">
                <div class="input-group margin-bottom-sm search col-xs-12 wow zoomIn" data-wow-delay=".5s">
                    <form action="#" method="post">
                        <input class="form-control" type="text" name="search" placeholder="<?php echo $language->Search_In_Blog; ?>">
                        <i class="fa fa-search"></i>
                    </form>
                </div>
                <!--categories-->
                <div class="block">
                    <div class="heading2">
                        <h5 class="wow zoomIn" data-wow-delay=".5s"><?php echo $language->Categories; ?></h5>
                        <div class="line"><span></span><span></span></div>
                    </div>
                    <ul class="list">
                        <?php
                        if (is_array($categories)) {
                            foreach ($categories as $category) {
                                $category_name_array = (isset($category['name'])) ? unserialize(base64_decode($category['name'])) : [];
                                $category_name = isset($category_name_array[$_SESSION['language_alias']]) ? $category_name_array[$_SESSION['language_alias']] : '';
                                $category_name_summery = $models->Cut_Words($category_name, 20);
                                $category_alias = (isset($category['alias'])) ? $category['alias'] : '';
                                ?>
                                <li>
                                    <h3>
                                        <i class="fa fa-angle-<?php echo ($_SESSION['language_DIR'] == 'LTR') ? 'right' : 'left'; ?>"></i>
                                        <a href="<?php echo URL . $_SESSION['language_alias'] . '/blog/category/' . $category_alias; ?>"><?php echo $category_name_summery; ?></a>
                                    </h3>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!--popular posts-->
                <div class="block">
                    <div class="heading2">
                        <h5 class="wow zoomIn" data-wow-delay=".5s"><?php echo $language->Most_Watched; ?> </h5>
                        <div class="line"><span></span><span></span></div>
                    </div>
                    <ul class="list-articles row">
                        <?php
                        if (is_array($popular_articles)) {
                            foreach ($popular_articles as $popular_articles) {
                                $title_array = (isset($popular_articles['title'])) ? unserialize(base64_decode($popular_articles['title'])) : [];
                                $title = isset($title_array[$_SESSION['language_alias']]) ? $models->Cut_Words($title_array[$_SESSION['language_alias']], 600) : '';
                                $title_summery = $models->Cut_Words($title, 25);
                                $title_alias = (isset($popular_articles['alias'])) ? $popular_articles['alias'] : '';
                                $_category_name_array = (isset($item['category_name'])) ? unserialize(base64_decode($item['category_name'])) : [];
                                $_category_name = isset($_category_name_array[$_SESSION['language_alias']]) ? $_category_name_array[$_SESSION['language_alias']] : '';
                                $_category_name_summery = $models->Cut_Words($_category_name, 15);
                                $author_name = (isset($popular_articles['username'])) ? $popular_articles['username'] : '';
                                $author_name_summery = $models->Cut_Words($author_name, 10);
                                $image = (isset($popular_articles['image'])) ? $popular_articles['image'] : false;
                                $image_path = ARTICLES_IMAGES_THUMBS_PATH . $image;
                                ?>
                                <li class="clearfix">
                                    <?php if ($image) { ?><div class="col-xs-12 col-sm-4 img" ><img alt="<?php echo $title; ?>" title="<?php echo $title; ?>" src="<?php echo $image_path; ?>" /></div><?php } ?>
                                    <div class="col-xs-12 col-sm-8">
                                        <h4><a title="<?php echo $title; ?>" href="<?php echo URL . $_SESSION['language_alias'] . '/blog/article/' . $title_alias; ?>"><?php echo $title_summery; ?> </a></h4>
                                        <span><i class="fa fa-user"></i><?php echo $author_name_summery; ?></span>
                                        <span><i class="fa fa-tag"></i><?php echo $_category_name_summery; ?></span>
                                    </div>
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <!--subscribe-->
                <div class="block subscribe">
                    <div class="heading2">
                        <h5 class="wow zoomIn" data-wow-delay=".5s"><?php echo $language->Mailing_list; ?> </h5>
                        <div class="line"><span></span><span></span></div>
                    </div>
                    <!-- Begin MailChimp Signup Form -->
                    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
                    <div id="mc_embed_signup">
                        <form action="//net-ads.us14.list-manage.com/subscribe/post?u=2e2ff06a0d723fdea7f2c50db&amp;id=154e0e294c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                            <div id="mc_embed_signup_scroll">
                                <div class="mc-field-group">
                                    <label for="mce-EMAIL"><?php echo $language->YourEmail; ?> : </label>
                                    <input type="email" value="" name="EMAIL" class="required email form-control" id="mce-EMAIL">
                                </div>
                                <div class="mc-field-group">
                                    <label for="mce-FNAME"> <?php echo $language->YourName; ?> : </label>
                                    <input type="text" value="" name="FNAME" class="required form-control" id="mce-FNAME">
                                </div>
                                <div id="mce-responses" class="clear">
                                    <div class="response" id="mce-error-response" style="display:none"></div>
                                    <div class="response" id="mce-success-response" style="display:none"></div>
                                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                <!--<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_2e2ff06a0d723fdea7f2c50db_154e0e294c" tabindex="-1" value=""></div>-->
                                <div class="clear"><input type="submit" value="<?php echo $language->Subscribe; ?>" name="subscribe" id="mc-embedded-subscribe" class="submit readmore"></div>
                            </div>
                        </form>
                    </div>
                    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
                    <script type='text/javascript'>(function ($) {
                            window.fnames = new Array();
                            window.ftypes = new Array();
                            fnames[0] = 'EMAIL';
                            ftypes[0] = 'email';
                            fnames[1] = 'FNAME';
                            ftypes[1] = 'text'; /*
                             * Translated default messages for the jQuery validation plugin into arabic.
                             * Locale: AR
                             */
                            $.extend($.validator.messages, {
                                required: "هذا الحقل إلزامي",
                                remote: "يرجى تصحيح هذا الحقل للمتابعة",
                                email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
                                url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
                                date: "رجاء إدخال تاريخ صحيح",
                                dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
                                number: "رجاء إدخال عدد بطريقة صحيحة",
                                digits: "رجاء إدخال أرقام فقط",
                                creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
                                equalTo: "رجاء إدخال نفس القيمة",
                                accept: "رجاء إدخال ملف بامتداد موافق عليه",
                                maxlength: $.validator.format("الحد الأقصى لعدد الحروف هو {0}"),
                                minlength: $.validator.format("الحد الأدنى لعدد الحروف هو {0}"),
                                rangelength: $.validator.format("عدد الحروف يجب أن يكون بين {0} و {1}"),
                                range: $.validator.format("رجاء إدخال عدد قيمته بين {0} و {1}"),
                                max: $.validator.format("رجاء إدخال عدد أقل من أو يساوي (0}"),
                                min: $.validator.format("رجاء إدخال عدد أكبر من أو يساوي (0}")
                            });
                        }(jQuery));
                        var $mcj = jQuery.noConflict(true);
                    </script>
                    <!--End mc_embed_signup-->
                </div>
                <!--facebook-->
                <div class="block">
                    <script>
                        window.fbAsyncInit = function () {
                            FB.init({
                                appId: '2074844452741413',
                                xfbml: true,
                                version: 'v2.7'
                            });
                        };

                        (function (d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) {
                                return;
                            }
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//connect.facebook.net/en_US/sdk.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));
                    </script>

                    <div class="fb-page"
                         data-href="https://www.facebook.com/%D8%A7%D9%84%D8%AA%D9%85%D8%A7%D9%8A%D8%B2-%D8%A7%D9%84%D9%85%D8%AA%D8%B7%D9%88%D8%B1%D8%A9-197779553945811/"
                         data-tabs="timeline" 
                         data-height="300" 
                         data-small-header="false" 
                         data-adapt-container-width="true" 
                         data-hide-cover="false" 
                         data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/%D8%A7%D9%84%D8%AA%D9%85%D8%A7%D9%8A%D8%B2-%D8%A7%D9%84%D9%85%D8%AA%D8%B7%D9%88%D8%B1%D8%A9-197779553945811/" class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/%D8%A7%D9%84%D8%AA%D9%85%D8%A7%D9%8A%D8%B2-%D8%A7%D9%84%D9%85%D8%AA%D8%B7%D9%88%D8%B1%D8%A9-197779553945811/">الشبكة الاعلانية</a>
                        </blockquote>
                    </div>
                </div>
                <!--twitter-->
                <div class="block">
                    <a class="twitter-timeline" data-width="300" data-dnt="true" href="https://twitter.com/net-adscom">Tweets by net-adscom</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
                <!--google+-->
                <div class="block">
                    <!-- Place this tag where you want the widget to render. -->
                    <div class="g-person" data-href="https://plus.google.com/102888388331250764993" data-rel="author"></div>

                    <!-- Place this tag after the last widget tag. -->
                    <script type="text/javascript">
                                            (function () {
                                                var po = document.createElement('script');
                                                po.type = 'text/javascript';
                                                po.async = true;
                                                po.src = 'https://apis.google.com/js/platform.js';
                                                var s = document.getElementsByTagName('script')[0];
                                                s.parentNode.insertBefore(po, s);
                                            })();
                    </script>
                </div>
            </side>
        </div>
        <!-- social share kit JS -->
        <script type="text/javascript" src="<?php echo URL; ?>templates/js/social-share-kit.js"></script>
        <script type="text/javascript">
                        SocialShareKit.init();
        </script>
    </section>
</div>
<!--End page-content-->
<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function (L) {
                            L.start({"baseUrl": "mc.us14.list-manage.com", "uuid": "2e2ff06a0d723fdea7f2c50db", "lid": "154e0e294c"})
                        })</script>
