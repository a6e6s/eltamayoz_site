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
    $model->redirect_to(ADMIN_URL . 'slideshow/items');
} else {
    $languages = $model->Get('languages', 'name,alias,flag', null, 'id', 'ASC');
    if (!is_array($languages)) {
        $session->message('sorry .. please create any language Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'slideshow/items');
    }
    $sites = $model->Get('sites', 'id,name');
    if (!is_array($sites)) {
        $session->message('sorry .. please create any Site Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'sites');
    }
    // get item details ...........
    $item = $model->Get('slideshow', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'slideshow/items');
    } else {
        $_title_array = (isset($item[0]['title'])) ? unserialize(base64_decode($item[0]['title'])) : array();
        $_desc_array = (isset($item[0]['description'])) ? unserialize(base64_decode($item[0]['description'])) : array();
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_link = (isset($item[0]['link'])) ? $item[0]['link'] : 0;
        $_url_type = (isset($item[0]['url_type'])) ? $item[0]['url_type'] : 'internal';
        $_url = (isset($item[0]['url'])) ? $item[0]['url'] : '';
        $_site_id = (isset($item[0]['site_id'])) ? $item[0]['site_id'] : '';
        $_image = (isset($item[0]['image'])) ? $item[0]['image'] : '';
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
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>slideshow/items">Slideshow</a></li>
                    <li class="active">Edit item</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Slideshow <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $_title_array['en']; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/edit_slideshow_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Image </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 btn btn-success uploader-box">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_image)) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/slideshow/' . $_image; ?>" />
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
                            <div class="form-group">
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
                                                    <option value="<?php echo $site_id; ?>" <?php echo ($site_id == $_site_id) ? 'selected' : null; ?>><?php echo $site_name['site_name_en']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Item Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_title_array[$lang['alias']])) ? $_title_array[$lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-4">
                                                        <span class="middle">Enter Item Title in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Description </label>
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
                                                    <textarea rows="3" name="desc_<?php echo $lang['alias']; ?>" class="col-xs-12 col-sm-5" maxlength="300"><?php echo (isset($_desc_array[$lang['alias']])) ? $model->Delete_Lines($_desc_array[$lang['alias']]) : ''; ?></textarea>
                                                    <span class="help-inline col-xs-12 col-sm-4">
                                                        <span class="middle">Enter Description Title in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Link </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input id="link" name="link" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_link != 0) ? 'checked' : null; ?>/>
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group type-link">
                                <div class="col-xs-12 col-sm-2"> Type Link </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="link-type" name="url_type" class="chosen-select form-control"  data-placeholder="Choose Type Link ...">
                                        <option value="internal" <?php echo ($_url_type == 'internal') ? 'selected' : null; ?> >Internal Link</option>
                                        <option value="external" <?php echo ($_url_type == 'external') ? 'selected' : null; ?> >External Link</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group url-link">
                                <div class="col-xs-12 col-sm-2"> URL Link </div>
                                <div id="url-link" class="col-xs-12 col-sm-4">
                                    <input type="text" name="url" class="col-xs-12 url" placeholder="Enter Url Link" value="<?php echo $_url; ?>" />
                                </div>
                                <button id="button" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
                                    Choose URL Internal Link
                                </button>
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Select Element</h4>
                                            </div>
                                            <div class="modal-body">
                                                <table data-dismiss="modal">
                                                    <tr>
                                                        <td valign="top">
                                                            <strong>Default Pages</strong>
                                                            <ul class="links nav text-left" style="margin: 0">
                                                                <li><a href="#" title="index" >Home</a></li>
                                                                <li><a href="#" title="blog/articles" >Blog</a></li>
                                                                <li><a href="#" title="works" >Our Works</a></li>
                                                                <li><a href="#" title="contact_us" >Contact us</a></li> 
                                                                <li><a href="#" title="requests" >Request Service</a></li>                      
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td valign="top" width="100%" >
                                                            <strong>Other pages</strong>
                                                            <?php $pages = $model->Get('pages', 'id,title,alias'); ?>
                                                            <?php
                                                            if (is_array($pages)) {
                                                                echo '<ul  class="links nav text-left" style="margin: 0">';
                                                                foreach ($pages as $page) {
                                                                    $page_alias = (isset($page['alias'])) ? $page['alias'] : 0;
                                                                    $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                    $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                    echo '<li><a href="#" title="page/' . $page_alias . '" >' . $page_title . '</a></li>';
                                                                }
                                                                echo '</ul>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                            <script>
                                                $('.links a').click(function () {
                                                    var alias = $(this).attr('title');
                                                    $('.url').val(alias);
                                                })
                                            </script>
                                        </div>
                                    </div>
                                </div>
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
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>slideshow/items">Cancel</a>

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
<script src="<?php echo ADMIN_URL ?>templates/js/jquery.inputlimiter.1.3.1.min.js"></script>
<script type="text/javascript">
//file manager .............................
                                                $('.chosen-select').chosen({allow_single_deselect: true});
                                                var link_type = $('#link-type').val();
                                                $('#url-link input').prop('readonly', true);

                                                if ($('#link').is(":checked")) {
                                                    $('.type-link').slideDown();
                                                    $('.url-link').slideDown();
                                                } else
                                                {
                                                    $('.type-link').slideUp();
                                                    $('.url-link').slideUp();
                                                }
                                                $('#link').change(function () {
                                                    if ($('#link').is(":checked")) {
                                                        $('.type-link').slideDown();
                                                        $('.url-link').slideDown();
                                                    } else
                                                    {
                                                        $('.type-link').slideUp();
                                                        $('.url-link').slideUp();
                                                    }
                                                });
                                                $('#link-type').change(function () {

                                                    var link_type = $(this).val();
                                                    if (link_type === 'external')
                                                    {
                                                        $('#button').hide();
                                                        $('#url-link input').prop('readonly', false);
                                                    } else
                                                    {
                                                        $('#button').show();
                                                        $('#url-link input').prop('readonly', true);
                                                    }
                                                });
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
                                                    window.open('../../plugins/kcfinder/browse.php?dir=files/slideshow/');
                                                }
</script>
