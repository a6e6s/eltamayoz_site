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
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'sites/items');
} else {
    // get item details ...........
    $item = $model->Get('sites', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'sites/items');
    } else {
        $_name_array = (isset($item[0]['name']) && !empty($item[0]['name'])) ? unserialize(base64_decode($item[0]['name'])) : array();
        $_alias = (isset($item[0]['alias'])) ? $item[0]['alias'] : '';
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_message_closed_array = (isset($item[0]['message_closed']) && !empty($item[0]['message_closed'])) ? unserialize(base64_decode($item[0]['message_closed'])) : array();
        $_logo_array = (isset($item[0]['logo']) && !empty($item[0]['logo'])) ? unserialize(base64_decode($item[0]['logo'])) : array();
        $_meta_desc_array = (isset($item[0]['meta_desc']) && !empty($item[0]['meta_desc'])) ? unserialize(base64_decode($item[0]['meta_desc'])) : array();
        $_meta_key_array = (isset($item[0]['meta_key']) && !empty($item[0]['meta_key'])) ? unserialize(base64_decode($item[0]['meta_key'])) : array();
        $_header_code = (isset($item[0]['H_code']) && !empty($item[0]['H_code'])) ? unserialize(base64_decode($item[0]['H_code'])) : '';
        $_footer_code = (isset($item[0]['F_code']) && !empty($item[0]['F_code'])) ? unserialize(base64_decode($item[0]['F_code'])) : '';
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
                        <!--<a href="<?php // echo ADMIN_URL;        ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>sites/items">Sites</a></li>
                    <li class="active">Edit Site</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Sites <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo (isset($_name_array['site_name_en'])) ? $_name_array['site_name_en'] : ''; ?> </small></h1>
                    <small><strong>Created : </strong> <?php echo $_created; ?></small><br/><small><strong>Modified : </strong> <?php echo $_modified; ?></small>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php require ADMIN_PATH . DS . 'models/edit_sites_model.php'; ?>
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
                                                    <a data-toggle="tab" href="#site_name_<?php echo $lang['alias']; ?>">
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
                                                <div id="site_name_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="site_name_<?php echo $lang['alias']; ?>" placeholder="Site Name" class="col-xs-12 col-sm-6" value="<?php echo (isset($_name_array['site_name_' . $lang['alias']])) ? $_name_array['site_name_' . $lang['alias']] : ''; ?>" />
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
                                <label class="col-xs-12 col-sm-2"> Open Site </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input name="status" class="ace ace-switch ace-switch-3" type="checkbox" <?php echo ($_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                                <span class="help-inline col-xs-12 col-sm-7">
                                    <span class="middle">This Site is Closed or Open ? <strong>( Closed = OFF , Open = ON ) .</strong></span>
                                </span>
                            </div>
                            <div class="form-group meesage_closure">
                                <label class="col-xs-12 col-sm-2"> Message Closure  </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#m_cl_<?php echo $lang['alias']; ?>">
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
                                                <div id="m_cl_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea id="message_closed_<?php echo $lang['alias']; ?>" name="message_closed_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Message  ..."><?php echo (isset($_message_closed_array['message_closed_' . $lang['alias']])) ? $model->Delete_Lines($_message_closed_array['message_closed_' . $lang['alias']]) : ''; ?></textarea>
                                                    <span class="help-inline grey">
                                                        <span class="middle">Write Message closure  of This Site .</span>
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
                                <label class="col-xs-12 col-sm-2"> Logo </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#logo_<?php echo $lang['alias']; ?>">
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
                                                <div id="logo_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <div class="col-xs-12 col-sm-5 btn btn-success  uploader-box">
                                                        <div onclick="openKCFinder(this)">
                                                            <?php
                                                            if (!empty($_logo_array['site_logo_' . $lang['alias']])) {
                                                                ?>
                                                                <img src="<?php echo URL . 'images/files/sites/' . $_logo_array['site_logo_' . $lang['alias']]; ?>" />
                                                                <input name="site_logo_<?php echo $lang['alias']; ?>" type="hidden" value="<?php echo $_logo_array['site_logo_' . $lang['alias']]; ?>"/>
                                                                <?php
                                                            } else {
                                                                echo 'Click here to upload image';
                                                                echo '<input name="site_logo_' . $lang['alias'] . '" type="hidden"/>';
                                                            }
                                                            ?>
                                                        </div>
                                                        <?php
                                                        if (!empty($_logo_array['site_logo_' . $lang['alias']])) {
                                                            ?>
                                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
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
                                                    <a data-toggle="tab" href="#site_desc_<?php echo $lang['alias']; ?>">
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
                                                <div id="site_desc_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea id="site_desc_<?php echo $lang['alias']; ?>" name="site_desc_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Description Here ..."><?php echo (isset($_meta_desc_array['site_desc_' . $lang['alias']])) ? $model->Delete_Lines($_meta_desc_array['site_desc_' . $lang['alias']]) : ''; ?></textarea>
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
                                                    <a data-toggle="tab" href="#site_keys_<?php echo $lang['alias']; ?>">
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
                                                <div id="site_keys_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <textarea id="site_keys_<?php echo $lang['alias']; ?>" name="site_keys_<?php echo $lang['alias']; ?>" rows="5" cols="10" class="autosize-transition form-control" placeholder="Write Description Here ..."><?php echo (isset($_meta_key_array['site_keys_' . $lang['alias']])) ? $model->Delete_Lines($_meta_key_array['site_keys_' . $lang['alias']]) : ''; ?></textarea>
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
                                <label class="col-xs-12 col-sm-2"> Header Code </label>
                                <div class="col-xs-12 col-sm-10"><textarea name="header_code" rows="15" cols="10" class="autosize-transition form-control" placeholder="Write ..."><?php echo $_header_code ; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Footer Code </label>
                                <div class="col-xs-12 col-sm-10"><textarea name="footer_code" rows="15" cols="10" class="autosize-transition form-control" placeholder="Write ..."><?php echo $_footer_code ; ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save">Save</label>
                                <input type="submit" id="save" name="save" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_back">Save & Back</label>
                                <input type="submit" id="save_back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_new">Save & New</label>
                                <input type="submit" id="save_new" name="save&new" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>sites/items">Cancel</a>

                            </div>

                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script type="text/javascript">
    if ($('input[name="status"]').is(':checked'))
    {
        $('.meesage_closure').slideUp();
    }
    $('input[name="status"]').change(function () {
        if (this.checked) {
            $('.meesage_closure').slideUp();
        } else
        {
            $('.meesage_closure').slideDown();
        }
    });
    //file manager ......
    function delete_img(i) {
        $(i).parent().html('<div onclick="openKCFinder(this)">Upload Icon</div>');
    }
    function openKCFinder(div) {
        var name = $(div).find('input[type="hidden"]').attr('name');
        window.KCFinder = {
            callBack: function (url) {
                window.KCFinder = null;
                div.innerHTML = '<div style="margin:5px">Loading...</div>';
                var img = new Image();
                img.src = url;
                var image_name = url.split("/").slice(-1);
                img.onload = function () {
                    $(div).parent().append('<i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>');
                    div.innerHTML = '<img src="' + url + '" /><input name="' + name + '" type="hidden" value="' + image_name + '"/>';
                };
            }
        };
        window.open('../../plugins/kcfinder/browse.php?type=files&dir=files/sites/',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                'directories=0, resizable=1, scrollbars=0, width=800, height=600');
    }
</script>
