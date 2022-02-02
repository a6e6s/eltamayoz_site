<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<?php
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'pages/items');
} else {
    $languages = $model->Get('languages', 'name,alias,flag', null, 'id', 'ASC');
    if (!is_array($languages)) {
        $session->message('sorry .. please create any language Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'pages/items');
    }
    // get item details ...........
    $item = $model->Get('pages', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'pages/items');
    } else {
        $_title_array = (isset($item[0]['title'])) ? unserialize(base64_decode($item[0]['title'])) : array();
        $_alias = (isset($item[0]['alias'])) ? $item[0]['alias'] : '';
        $_content_array = (isset($item[0]['content'])) ? unserialize(base64_decode($item[0]['content'])) : array();
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_site = (isset($item[0]['site_id'])) ? $item[0]['site_id'] : 0;
        $_image = (isset($item[0]['image'])) ? $item[0]['image'] : '';
        $_image_opacity = (isset($item[0]['image_opacity'])) ? $item[0]['image_opacity'] : '1';
        $_desc_array = (isset($item[0]['meta_desc'])) ? unserialize(base64_decode($item[0]['meta_desc'])) : array();
        $_keys_array = (isset($item[0]['meta_key'])) ? unserialize(base64_decode($item[0]['meta_key'])) : array();
        $_created = (isset($item[0]['created']) && $item[0]['created'] != 0) ? date('d-m-Y   h:i A', $item[0]['created']) : 'No Date';
        $_modified = (isset($item[0]['modified']) && $item[0]['modified'] != 0) ? date('d-m-Y   h:i A', $item[0]['modified']) : 'Not Modified';
    }
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
                        <!--<a href="<?php // echo ADMIN_URL;    ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>pages/items">Pages</a></li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>pages/items">Items</a></li>
                    <li class="active">Edit Page</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Pages <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $model->Cut_Words($_title_array['en'],0,300); ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/edit_pages_model.php'; ?>
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Page Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_title_array[$lang['alias']])) ? $model->Cut_Words($_title_array[$lang['alias']],0,1000) : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Page Title in <?php echo $lang['name']; ?></span>
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
                                    <input type="text" name="alias" id="form-field-1" placeholder="Site Alias" class="col-xs-12 col-sm-5" value="<?php echo $_alias; ?>" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="middle">This Alias Appears in The Page Link, Please Writes English Characters Only, And There Are No Spaces EX : mylink , my_link </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> status </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input name="status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php $sites = $model->Get('sites', 'id,name') ?>
                                <div class="col-xs-12 col-sm-2"> Site </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select name="site_id" class="chosen-select form-control" data-placeholder="Choose Site ...">
                                        <?php
                                        if (is_array($sites)) {
                                            foreach ($sites as $site) {
                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                if ($site_id != 1) {
                                                    $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                    ?>
                                                    <option value="<?php echo $site_id; ?>" <?php echo ($site_id == $_site) ? 'selected' : null; ?> > <?php echo $site_name['site_name_en']; ?> </option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Header Image </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 btn btn-success  uploader-box">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_image)) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/pages/' . $_image; ?>" />
                                                <input name="image" type="hidden" value="<?php echo $_image; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Click here to upload image';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_image)) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/jquery-ui.custom.min.css" />
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Image Opacity </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 row" id="slider-eq">
                                        <span class="col-xs-10 col-sm-7 row">
                                            <span class="ui-slider-simple ui-slider-dark"></span>
                                        </span>
                                        <span class="help-inline col-xs-2">
                                            <span class="label label-inverse"><?php echo $_image_opacity; ?></span>
                                        </span>
                                        <input class="hidden col-xs-3" type="text" name="opacity" data-min="0.00" data-max="1.01" data-step="0.01" value="<?php echo $_image_opacity; ?>" />
                                    </div>
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
                                                    <textarea name="content_<?php echo $lang['alias']; ?>"><?php echo (isset($_content_array[$lang['alias']])) ? $_content_array[$lang['alias']] : ''; ?></textarea>
                                                    <script>
                                                CKEDITOR.replace('content_<?php echo $lang['alias']; ?>', {
                                                    filebrowserBrowseUrl: '../../plugins/kcfinder/browse.php?opener=ckeditor&type=files&dir=files/pages/',
                                                    extraPlugins: 'pricetable,headingcenter',
                                                    contentsCss: ['../../plugins/ckeditor/bootstrap.min.css', '../../plugins/ckeditor/my-widget.css']
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
                                                    <textarea name="meta_desc_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Here ..."><?php echo (isset($_desc_array['meta_desc_' . $lang['alias']])) ? $model->Delete_Lines($_desc_array['meta_desc_' . $lang['alias']]) : ''; ?></textarea>
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
                                                    <textarea name="meta_keys_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write ..."><?php echo (isset($_keys_array['meta_keys_' . $lang['alias']])) ? $model->Delete_Lines($_keys_array['meta_keys_' . $lang['alias']]) : ''; ?></textarea>
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
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Created </label>
                                <span class="help-inline col-xs-12 col-sm-7">
                                    <span class="middle"><?php echo $_created; ?></span>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Modified </label>
                                <span class="help-inline col-xs-12 col-sm-7">
                                    <span class="middle"><?php echo $_modified; ?></span>
                                </span>
                            </div>

                            <hr>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save">Save</label>
                                <input type="submit" id="save" name="save" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save-back">Save & Back</label>
                                <input type="submit" id="save-back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save-new">Save & New</label>
                                <input type="submit" id="save-new" name="save&new" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>pages/items">Cancel</a>

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
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery-ui.custom.min.js"></script>
<script type="text/javascript">
                                            $('.chosen-select').chosen({allow_single_deselect: true});
                                            $(document).ready(function () {
                                                $("#slider-eq .ui-slider-simple").css({'width': '90%', 'float': 'left', 'margin-top': '5px'}).each(function () {
                                                    // read initial values from markup and remove that
                                                    var $this = $("#slider-eq input[type=text]");
                                                    var $this2 = $("#slider-eq .label");
                                                    var value = $this.val();
                                                    $(this).empty().slider({
                                                        value: value,
                                                        range: "min",
                                                        animate: true,
                                                        min: parseFloat($this.attr('data-min')),
                                                        max: parseFloat($this.attr('data-max')),
                                                        step: parseFloat($this.attr('data-step')),
                                                        slide: function (event, ui) {
                                                            $this.val(ui.value);
                                                            $this2.text(ui.value);
                                                        }
                                                    });
                                                });

                                                $('[data-rel=tooltip]').tooltip();
                                            });
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
                                                window.open('../../plugins/kcfinder/browse.php?dir=files/pages/');
                                            }
</script>
