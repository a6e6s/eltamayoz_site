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
$sites = $model->Get('sites', 'id,name,alias', ' ', 'id', 'ASC');
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
                        <!--<a href="<?php // echo ADMIN_URL;                  ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>works/items">Works</a></li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>works/items">Items</a></li>
                    <li class="active">New Work</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Works <small> <i class="ace-icon fa fa-angle-double-right"></i> Create New Work </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL ?>templates/css/chosen.min.css" />
                        <link rel="stylesheet" href="<?php echo ADMIN_URL ?>templates/css/datepicker.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/new_work_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> Basic INFO ... </span>
                            </h3>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Title </label>
                                <div class="col-xs-12 col-sm-5">
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Title" class="col-xs-12" />
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
                                <div class="col-xs-12 col-sm-5">
                                    <input type="text" name="alias" id="form-field-1" placeholder="Alias" class="col-xs-12" value="" />
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
                                    <select id="sites" name="site_id" class="chosen-select form-control" data-placeholder="Choose Site ...">
                                        <?php
                                        if (is_array($sites)) {
                                            ?>
                                            <option value=""></option>
                                            <?php
                                            foreach ($sites as $site) {
                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                if ($site_id != 1) {
                                                    $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                    ?>
                                                    <option value="<?php echo $site_id; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Tags </label>
                                <div class="col-xs-12 col-sm-4">
                                    <?php
                                    $tags = $model->Get('works_tags', 'id,name,site_id');
                                    if (is_array($tags)) {
                                        ?>
                                        <select id="tags" name="tags[]" multiple="" class="chosen-select form-control" id="form-field-select-4" data-placeholder="Choose Tags...">
                                            <?php
                                            foreach ($tags as $tag) {
                                                $title_array = (isset($tag['name'])) ? unserialize($tag['name']) : array();
                                                $title = (is_array($title_array)) ? $title_array['en'] : '';
                                                ?>
                                                <option value="<?php echo $tag['id']; ?>" class="<?php echo $tag['site_id']; ?>"><?php echo $title; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    } else {
                                        echo 'No Tags, <a href="' . ADMIN_URL . 'works/new_tag">Create Tags Now</a> ';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Image </label>
                                <div class="col-xs-12 col-sm-5">
                                    <div class=" btn btn-success  uploader-box">
                                        <div onclick="openKCFinder(this)">Click here To Upload Image</div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Gallery </label>
                                <div class="col-xs-12 col-sm-9 " id="gallery">
                                    <div class="col-xs-12 col-sm-2 btn btn-success  uploader-box">
                                        <div onclick="openKCFinder2(this)">upload image</div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-1">
                                    <a href="javascript:void()" class="space-18 padding-14 margin-20"><i class="ace-icon fa fa-plus-circle fa-2x add-image green "></i></a><br/>
                                    <a href="javascript:void()" class=""><i class="ace-icon fa fa-minus-circle fa-2x minus-image red2"></i></a>
                                </div>
                            </div>
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> PROJECT INFO ... </span>
                            </h3>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Client </label>
                                <div class="col-xs-12 col-sm-5">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#cl_<?php echo $lang['alias']; ?>">
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
                                                <div id="cl_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="client_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="client Name" class="col-xs-12" />
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
                                <label class="col-xs-12 col-sm-2"> Location </label>
                                <div class="col-xs-12 col-sm-5">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#loc_<?php echo $lang['alias']; ?>">
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
                                                <div id="loc_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="location_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Location" class="col-xs-12" />
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
                                <label class="col-xs-12 col-sm-2"> Date </label>
                                <div class="col-xs-12 col-sm-5">
                                    <input class="form-control date-picker" id="id-date-picker-1" type="text" name="date" data-date-format="dd-mm-yyyy" placeholder="22-08-2017">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Demo URL  </label>
                                <div class="col-xs-12 col-sm-5">
                                    <input type="url" name="demo" id="form-field-1" placeholder="http://www.google.com" class="col-xs-12" value="" />
                                </div>
                            </div>                           
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Description </label>
                                <div class="col-xs-12 col-sm-5">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#PRdesc_<?php echo $lang['alias']; ?>">
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
                                                <div id="PRdesc_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea name="PR_desc_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Here ..."></textarea>
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
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> SEO INFO ... </span>
                            </h3>                            
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Meta Description </label>
                                <div class="col-xs-12 col-sm-5">
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
                                <div class="col-xs-12 col-sm-5">
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
                            <div class="space-32"></div>
                            <h5 class="row header smaller lighter blue"></h5>
                            <div class="space-32"></div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_back">Save & Back</label>
                                <input type="submit" id="save_back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_new">Save & New</label>
                                <input type="submit" id="save_new" name="save&new" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>works/items">Cancel</a>
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
<script type="text/javascript" src="<?php echo ADMIN_URL; ?>templates/js/jquery.chained.min.js"></script>
<script src="<?php echo ADMIN_URL ?>templates/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
//chosen-select ...............
                                            jQuery(function ($) {
                                                $('.chosen-select').chosen({allow_single_deselect: true});
                                                $("#tags").chained("#sites");
                                                $("#tags").trigger("chosen:updated");
                                                $("#sites").on("change", function () {
                                                    $("#tags").trigger("chosen:updated")
                                                });
                                                $('.date-picker').datepicker({
                                                    autoclose: true,
                                                    todayHighlight: true
                                                });

                                                $('.add-image').click(function () {
                                                    var div = '<div class="col-xs-2 btn btn-success uploader-box"><div onclick="openKCFinder2(this)">upload image</div></div>';
                                                    $('#gallery').append(div);
                                                });
                                                $('.minus-image').click(function () {
                                                    $('#gallery .uploader-box:last').remove();
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
                                                window.open('<?php echo ADMIN_URL; ?>plugins/kcfinder/browse.php?dir=files/works/');
                                            }
                                            function openKCFinder2(div) {
                                                window.KCFinder = {
                                                    callBack: function (url) {
                                                        window.KCFinder = null;
                                                        div.innerHTML = '<div style="margin:5px">Loading...</div>';
                                                        var img = new Image();
                                                        img.src = url;
                                                        var image_name = url.split("/").slice(-1);
                                                        img.onload = function () {
                                                            $(div).parent().append('<i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>');
                                                            div.innerHTML = '<img src="' + url + '" /><input name="gallery[]" type="hidden" value="' + image_name + '"/>';
                                                        };
                                                    }
                                                };
                                                window.open('<?php echo ADMIN_URL; ?>plugins/kcfinder/browse.php?dir=files/works');
                                            }
</script>
