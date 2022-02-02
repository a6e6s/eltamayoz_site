<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<?php
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'blog/categories');
} else {
    $languages = $model->Get('languages', 'name,alias,flag', null, 'id', 'ASC');
    if (!is_array($languages)) {
        $session->message('sorry .. please create any language Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'blog/categories');
    }
    // get item details ...........
    $item = $model->Get('categories', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'blog/categories');
    } else {
        $_title_array = (isset($item[0]['name'])) ? unserialize(base64_decode($item[0]['name'])) : array();
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_parent_id = isset($item[0]['parent_id']) ? $item[0]['parent_id'] : 0;
        $_level = isset($item[0]['level']) ? $item[0]['level'] : 0;
        $_created = (isset($item[0]['created']) && $item[0]['created'] != 0) ? date('d/m/Y   h:i A', $item[0]['created']) : 'No Date';
        $_modified = (isset($item[0]['modified']) && $item[0]['modified'] != 0) ? date('d/m/Y   h:i A', $item[0]['modified']) : 'Not Modified';
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
                        <!--<a href="<?php // echo ADMIN_URL; ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active">Blog</li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>blog/categories">Categories</a></li>
                    <li class="active">Edit Category</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Blog <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $_title_array['en']; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/edit_category_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Name </label>
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Category Name" class="col-xs-12 col-sm-5" value="<?php echo (isset($_title_array[$lang['alias']])) ? $_title_array[$lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Category Name in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> status </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input name="status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php $categories = $model->Get_Multilevel('categories', 'id,name,level'); ?>
                                <div class="col-xs-12 col-sm-2"> Parent </div>
                                <div class="row col-xs-12 col-sm-4">
                                    <select name="parent_id" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose Category ...">
                                        
                                        <option value="0,0" <?php echo ($_parent_id == 0) ? 'selected' : null; ?> >Parent</option>
                                        <?php
                                        if (is_array($categories)) {
                                            foreach ($categories as $category) {
                                                $_category_id = (isset($category['id'])) ? $category['id'] : 0;
                                                $_category_name_array = (isset($category['name'])) ? unserialize(base64_decode($category['name'])) : array();
                                                $_category_name = isset($_category_name_array['en']) ? $_category_name_array['en'] : '';
                                                $_category_level = (isset($category['level'])) ? $category['level'] : 1;
                                                if($_category_id == $id) continue ;
                                                ?>
                                                <option value="<?php echo $_category_id . ',' . $_category_level; ?>" <?php echo ($_category_id == $_parent_id) ? 'selected' : null; ?> ><?php echo str_repeat(' - ', $_category_level - 1) . ' ' . $_category_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
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
                                <label class="btn  btn-primary col-xs-12" for="save&back">Save & Back</label>
                                <input type="submit" id="save&back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save&new">Save & New</label>
                                <input type="submit" id="save&new" name="save&new" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>blog/categories">Cancel</a>

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
    if (!ace.vars['touch']) {
        $('.chosen-select').chosen({allow_single_deselect: true});
    }
//file manager .............................
    function delete_img(i) {
        $(i).parent().html('<div onclick="openKCFinder(this)">Click here to upload image</div>');
    }
    function openKCFinder(div) {
        window.KCFinder = {
            callBack: function(url) {
                window.KCFinder = null;
                div.innerHTML = '<div style="margin:5px">Loading...</div>';
                var img = new Image();
                img.src = url;
                var image_name = url.split("/").slice(-1);
                img.onload = function() {
                    $(div).parent().append('<i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>');
                    div.innerHTML = '<img src="' + url + '" /><input name="image" type="hidden" value="' + image_name + '"/>';
                    
                };
            }
        };
        window.open('../../plugins/kcfinder/browse.php?dir=files/blog/',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                'directories=0, resizable=1, scrollbars=0');
    }
</script>
