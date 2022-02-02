<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<?php
$model = new model();
$languages = $model->Get('languages', 'name,alias,flag', null, 'id', 'ASC');
if (!is_array($languages)) {
    $session->message('sorry .. please create any language Before create a new .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'blog/articles');
}
?>
<div class="main-container" id="main-container">
    <?php require ADMIN_PATH . DS . 'views' . DS . 'sidebar.php'; ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <!--<a href="<?php // echo ADMIN_URL;   ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active">Blog</li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>blog/articles">Articles</a></li>
                    <li class="active">New Article</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Blog <small> <i class="ace-icon fa fa-angle-double-right"></i> Create New Article </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php require ADMIN_PATH . DS . 'models/new_article_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Title </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL . 'images/files/flags/' . $lang['flag']; ?>" />
                                                        <?php echo $lang['name']; ?>
                                                    </a>
                                                </li>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <div id="<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Article Title" class="col-xs-12 col-sm-5" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Article Title in <?php echo $lang['name']; ?></span>
                                                    </span>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Alias </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="alias" id="form-field-1" placeholder="Site Alias" class="col-xs-12 col-sm-5" value="" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="middle">This Alias Appears in The Page Link, Please Writes English Characters Only, And There Are No Spaces EX : mylink , my_link </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> status </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input name="status" class="ace ace-switch ace-switch-2" type="checkbox" />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Image </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 btn btn-success  uploader-box">
                                        <div onclick="openKCFinder(this)">Click here to upload image</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php $categories = $model->Get_Multilevel('categories', 'id,name,level'); ?>
                                <div class="col-xs-12 col-sm-2"> Category </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select name="cat_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose Category ...">
                                        <option value=""> </option>
                                        <?php
                                        if (is_array($categories)) {
                                            foreach ($categories as $category) {
                                                $_category_id = (isset($category['id'])) ? $category['id'] : 0;
                                                $_category_name_array = (isset($category['name'])) ? unserialize(base64_decode($category['name'])) : array();
                                                $_category_name = isset($_category_name_array['en']) ? $_category_name_array['en'] : '';
                                                $_category_level = (isset($category['level'])) ? $category['level'] : 1;
                                                ?>
                                                <option value="<?php echo $_category_id; ?>" ><?php echo str_repeat(' - ', $_category_level - 1) . ' ' . $_category_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Tags </label>
                                <div class="col-xs-12 col-sm-4">
                                    <link rel="stylesheet" href="<?php echo ADMIN_URL ?>templates/css/chosen.min.css" />
                                    <?php
                                    $tags = $model->Get('articles_tags', 'id,name');
                                    if (is_array($tags)) {
                                        ?>
                                        <select name="tags[]" multiple="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose a Tags...">
                                            <?php
                                            foreach ($tags as $tag) {
                                                $title_array = (isset($tag['name'])) ? unserialize($tag['name']) : array();
                                                $title = (is_array($title_array)) ? $title_array['en'] : '';
                                                ?>
                                                <option value="<?php echo $tag['id']; ?>"><?php echo $title; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    } else {
                                        echo 'No Tags, <a href="' . ADMIN_URL . 'blog/new_tag">Create Tags Now</a> ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Content </label>
                                <div class="col-xs-12 col-sm-10">
                                    <script src="<?php echo ADMIN_URL ?>plugins/ckeditor/ckeditor.js"></script>
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#<?php echo 'co_' . $lang['alias']; ?>">
                                                        <img src="<?php echo URL . 'images/files/flags/' . $lang['flag']; ?>" />
                                                        <?php echo $lang['name']; ?>
                                                    </a>
                                                </li>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <div id="<?php echo 'co_' . $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea name="content_<?php echo $lang['alias']; ?>"></textarea>
                                                    <script>
                                                CKEDITOR.replace('content_<?php echo $lang['alias']; ?>', {
                                                    filebrowserBrowseUrl: '../plugins/kcfinder/browse.php?opener=ckeditor&type=files'
                                                });
                                                    </script>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Meta Description </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#desc_<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL . 'images/files/flags/' . $lang['flag']; ?>" />
                                                        <?php echo $lang['name']; ?>
                                                    </a>
                                                </li>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <div id="desc_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea name="meta_desc_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Here ..."></textarea>
                                                    <span class="help-inline grey">
                                                        <span class="middle">Write Description Appropriate for This Page to Help Search Engines .</span>
                                                    </span>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Meta Keyes </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#keys_<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL . 'images/files/flags/' . $lang['flag']; ?>" />
                                                        <?php echo $lang['name']; ?>
                                                    </a>
                                                </li>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <div id="keys_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea name="meta_keys_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write ..."></textarea>
                                                    <span class="middle">Write Keywords Appropriate for This Page And Make Sure There Is A Comma Between Each Word to Help Search Engines .
                                                        <br/><strong>example: red, green, blue  </strong>
                                                    </span>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_back">Save & Back</label>
                                <input type="submit" id="save_back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_new">Save & New</label>
                                <input type="submit" id="save_new" name="save&new" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>blog/articles">Cancel</a>

                            </div>

                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script src="<?php echo ADMIN_URL ?>templates/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
//chosen-select ...............
                                            $('.chosen-select').chosen({allow_single_deselect: true});
//file manager .............................
                                            function delete_img(i) {
                                                $(i).parent().html('<div onclick="openKCFinder(this)">Click here to upload image</div>');
                                            }
                                            function openKCFinder(div) {
                                                window.KCFinder = {
                                                    callBack: function (url) {
                                                        window.KCFinder = null;
                                                        div.innerHTML = '<div style="margin:5px">Loading...</div>';
                                                        var img = new Image();
                                                        img.src = url;
                                                        var image_name = url.split("/").slice(-1);
                                                        img.onload = function () {
                                                            $(div).parent().append('<i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>');
                                                            div.innerHTML = '<img src="' + url + '" /><input name="image" type="hidden" value="' + image_name + '"/>';
                                                        };
                                                    }
                                                };
                                                window.open('../plugins/kcfinder/browse.php?dir=files/blog/');
                                            }
</script>
