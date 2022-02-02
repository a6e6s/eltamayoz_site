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
    $model->redirect_to(ADMIN_URL . 'languages');
}
$item = $model->Get('settings', '*', " WHERE id = '8'");
$_blog_array = (isset($item[0]['settings_values']) && !empty($item[0]['settings_values'])) ? unserialize(base64_decode($item[0]['settings_values'])) : array();
$_per_page = isset($_blog_array['per_page']) ? $_blog_array['per_page'] : 1;
$_header_image = isset($_blog_array['header_image']) ? $_blog_array['header_image'] : '';
$_header_image_opacity = isset($_blog_array['header_image_opacity']) ? $_blog_array['header_image_opacity'] : 1;
?>
<div class="main-container" id="main-container">
    <?php require ADMIN_PATH . DS . 'views' . DS . 'sidebar.php'; ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <!--<a href="<?php // echo ADMIN_URL;  ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active">Settings</li>
                    <li class="active">Social</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Settings <small> <i class="ace-icon fa fa-angle-double-right"></i> Edit Social Data </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php require ADMIN_PATH . DS . 'models/edit_setting_blog_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Header Image </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 btn btn-success  uploader-box">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_header_image)) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/blog/' . $_header_image; ?>" />
                                                <input name="image" type="hidden" value="<?php echo $_header_image; ?>"/>
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
                                            <span class="label label-inverse"><?php echo $_header_image_opacity; ?></span>
                                        </span>
                                        <input class="hidden col-xs-3" type="text" name="opacity" data-min="0.00" data-max="1.01" data-step="0.01" value="<?php echo $_header_image_opacity; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Number </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 col-sm-2">
                                        <input type="text" name="per_page" id="spinner1" value="<?php echo $_per_page; ?>" />
                                    </div>
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="middle">The number of items per page</span>
                                    </span>
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
                                                    <a data-toggle="tab" href="#blog_desc_<?php echo $lang['alias']; ?>">
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
                                                <div id="blog_desc_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea name="desc_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Description Here ..."><?php echo (isset($_blog_array['meta_desc_' . $lang['alias']])) ? $model->Delete_Lines($_blog_array['meta_desc_' . $lang['alias']]) : ''; ?></textarea>
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
                                                    <a data-toggle="tab" href="#blog_keys_<?php echo $lang['alias']; ?>">
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
                                                <div id="blog_keys_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea name="keys_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Description Here ..."><?php echo isset($_blog_array['meta_keys_' . $lang['alias']]) ? $model->Delete_Lines($_blog_array['meta_keys_' . $lang['alias']]) : ''; ?></textarea>
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
                                <label class="btn  btn-primary col-xs-12" for="save">Save</label>
                                <input type="submit" id="save" name="save" />    
                            </div>
                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script src="<?php echo ADMIN_URL; ?>templates/js/fuelux.spinner.min.js"></script>
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery-ui.custom.min.js"></script>
<script>
                                                jQuery(function ($) {
                                                    $('#spinner1').ace_spinner({value: 0, min: 0, max: 16, step: 1, btn_up_class: 'btn-info', btn_down_class: 'btn-info'})
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
                                                    window.open('../plugins/kcfinder/browse.php?dir=files/blog/',
                                                            'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                                                            'directories=0, resizable=1, scrollbars=0');
                                                }
</script>
