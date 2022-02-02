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
    $model->redirect_to(ADMIN_URL . 'pages/items');
}
$sites = $model->Get('sites', 'id,name');
if (!is_array($sites)) {
    $session->message('sorry .. please create any Site Before create a new .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'sites');
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
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>pages/items">Pages</a></li>
                    <li class="active">New Page</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Pages <small> <i class="ace-icon fa fa-angle-double-right"></i> Create New Page </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/new_pages_model.php'; ?>
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Page Title" class="col-xs-12 col-sm-5" />
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
                                <div class="col-xs-12 col-sm-2"> Site </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="site" name="site_id" class="chosen-select form-control" data-placeholder="Choose Site ...">
                                        <?php
                                        $sites_ids_m = '';
                                        $sites_ids_f = '';
                                        if (is_array($sites)) {
                                            foreach ($sites as $site) {
                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                if ($site_id != 1) {
                                                    $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                    $sites_ids_m .= ' ' . $site_id . '\\m';
                                                    $sites_ids_f .= ' ' . $site_id . '\\f';
                                                    echo '<option value="' . $site_id . '">' . $site_name['site_name_en'] . '</option>';
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
                                    <div class="col-xs-12  btn  uploader-box">
                                        <div onclick="openKCFinder(this)">Click here to upload image</div>
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
                                            <span class="label label-inverse">1</span>
                                        </span>
                                        <input class="hidden col-xs-3" type="text" name="opacity" data-min="0.00" data-max="1.01" data-step="0.01" value="1" />
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
                                                    <textarea name="content_<?php echo $lang['alias']; ?>"></textarea>
                                                    <script>
                                                CKEDITOR.replace('content_<?php echo $lang['alias']; ?>', {
                                                    filebrowserBrowseUrl: '../plugins/kcfinder/browse.php?opener=ckeditor&type=files&dir=files/pages/',
                                                    extraPlugins: 'pricetable,headingcenter',
                                                    contentsCss: ['../plugins/ckeditor/bootstrap.min.css', '../plugins/ckeditor/my-widget.css']
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
                                                window.open('../plugins/kcfinder/browse.php?dir=files/pages/');
                                            }
</script>
