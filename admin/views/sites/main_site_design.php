<?php
/*
 * Package net-ads Project .
 * net-ads Web Solution .
 * http://net-ads.org 
 * Developed by : Ahmed mosa .
 * Developed Site : http://elmosamem.com
 */
?>
<?php
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'sites/items');
} else {

    $languages = $model->Get('languages', 'name,alias,flag', null, 'id', 'ASC');
    if (!is_array($languages)) {
        $session->message('sorry .. please create any language Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'pages/items');
    }
    // get item details ...........
    $item = $model->Get('sites', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'sites/items');
    } else {
        $_name_array = (isset($item[0]['name']) && !empty($item[0]['name'])) ? unserialize(base64_decode($item[0]['name'])) : array();
        $_values_array = (isset($item[0]['settings_values']) && !empty($item[0]['settings_values'])) ? unserialize(base64_decode($item[0]['settings_values'])) : array();
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
                        <a href="<?php echo ADMIN_URL; ?>dashboard">Dashboard</a>
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>sites/items">Sites</a></li>
                    <li class="active">Edit Site Design</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Sites <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo (isset($_name_array['site_name_en'])) ? $_name_array['site_name_en'] : ''; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/main_site_design_model.php'; ?>

                        <form class="form-horizontal" action="#" method="post">
                            <!-- link 1 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 1 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success  uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_1'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_1']; ?>" />
                                                <input name="icon_1" type="hidden" value="<?php echo $_values_array['icon_1']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_1" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_1'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_1_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_1_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_1_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_1_title_' . $lang['alias']])) ? $_values_array['link_1_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_1" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_1_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_1_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_1_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_1_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <?php $sites = $model->Get('sites', 'id,name,alias') ?>
                                                    <select name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <?php $pages = $model->Get('pages', 'id,title,alias,site_id'); ?>
                                                    <select name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_1_url'])) ? $_values_array['link_1_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_1_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_1_url'])) ? $_values_array['link_1_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_1_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_1_url'])) ? $_values_array['link_1_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_1_url'])) ? $_values_array['link_1_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- End Link 1 -->
                            <div class="col-xs-12 space-10"></div>
                            <!-- link 2 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 2 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success   uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_2'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_2']; ?>" />
                                                <input name="icon_2" type="hidden" value="<?php echo $_values_array['icon_2']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_2" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_2'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_2_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_2_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_2_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_2_title_' . $lang['alias']])) ? $_values_array['link_2_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_2" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_2_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_2_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_2_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_2_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_2_url'])) ? $_values_array['link_2_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_2_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_2_url'])) ? $_values_array['link_2_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_2_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_2_url'])) ? $_values_array['link_2_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_2_url'])) ? $_values_array['link_2_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- End Link 2 -->
                            <div class="col-xs-12 space-10"></div>
                            <!-- link 3 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 3 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success   uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_3'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_3']; ?>" />
                                                <input name="icon_3" type="hidden" value="<?php echo $_values_array['icon_3']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_3" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_3'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_3_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_3_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_3_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_3_title_' . $lang['alias']])) ? $_values_array['link_3_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_3" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_3_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_3_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_3_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_3_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_3_url'])) ? $_values_array['link_3_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_3_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_3_url'])) ? $_values_array['link_3_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_3_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_3_url'])) ? $_values_array['link_3_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_3_url'])) ? $_values_array['link_3_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- End Link 3 -->
                            <div class="col-xs-12 space-10"></div>
                            <!-- link 4 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 4 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success   uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_4'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_4']; ?>" />
                                                <input name="icon_4" type="hidden" value="<?php echo $_values_array['icon_4']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_4" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_4'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_4_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_4_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_4_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_4_title_' . $lang['alias']])) ? $_values_array['link_4_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_4" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_4_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_4_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_4_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_4_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>

                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_4_url'])) ? $_values_array['link_4_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_4_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_4_url'])) ? $_values_array['link_4_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_4_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_4_url'])) ? $_values_array['link_4_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_4_url'])) ? $_values_array['link_4_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- End Link 4 -->
                            <div class="col-xs-12 space-10"></div>
                            <!-- link 5 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 5 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success   uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_5'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_5']; ?>" />
                                                <input name="icon_5" type="hidden" value="<?php echo $_values_array['icon_5']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_5" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_5'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_5_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_5_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_5_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_5_title_' . $lang['alias']])) ? $_values_array['link_5_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_5" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_5_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_5_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_5_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_5_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>

                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_5_url'])) ? $_values_array['link_5_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_5_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_5_url'])) ? $_values_array['link_5_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_5_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_5_url'])) ? $_values_array['link_5_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_5_url'])) ? $_values_array['link_5_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- End Link 5 -->
                            <!-- link 6 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 6 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success   uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_6'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_6']; ?>" />
                                                <input name="icon_6" type="hidden" value="<?php echo $_values_array['icon_6']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_6" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_6'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_6_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_6_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_6_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_6_title_' . $lang['alias']])) ? $_values_array['link_6_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_6" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_6_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_6_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_6_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_6_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select id="sites" name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>

                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select id="pages" name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_6_url'])) ? $_values_array['link_6_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_6_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_6_url'])) ? $_values_array['link_6_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_6_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_6_url'])) ? $_values_array['link_6_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_6_url'])) ? $_values_array['link_6_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- End Link 6 -->
                            <div class="col-xs-12 space-10"></div>
                            <!-- link 7 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 7 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success   uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_7'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_7']; ?>" />
                                                <input name="icon_7" type="hidden" value="<?php echo $_values_array['icon_7']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_7" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_7'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_7_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_7_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_7_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_7_title_' . $lang['alias']])) ? $_values_array['link_7_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_7" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_7_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_7_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_7_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_7_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select id="sites" name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>

                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select id="pages" name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_7_url'])) ? $_values_array['link_7_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_7_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_7_url'])) ? $_values_array['link_7_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_7_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_7_url'])) ? $_values_array['link_7_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_7_url'])) ? $_values_array['link_7_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <!-- End Link 7 -->

                            <div class="col-xs-12 space-10"></div>
                            <!-- link 8 -->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2 ">Link 8 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class=" btn btn-success   uploader-box col-xs-12 col-sm-6">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_values_array['icon_8'])) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_values_array['icon_8']; ?>" />
                                                <input name="icon_8" type="hidden" value="<?php echo $_values_array['icon_8']; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Upload Icon';
                                                echo '<input name="icon_8" type="hidden"/>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_values_array['icon_8'])) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="tabbable col-xs-12 col-sm-6">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#link_8_<?php echo $lang['alias']; ?>">
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
                                                <div id="link_8_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="link_8_title_<?php echo $lang['alias']; ?>" placeholder="Link Title" class="col-xs-12" value="<?php echo (isset($_values_array['link_8_title_' . $lang['alias']])) ? $_values_array['link_8_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div id="link_8" class="row col-xs-12">
                                        <div class="row col-xs-12 col-sm-6">
                                            <label class="col-xs-12 col-sm-3 ">Link Type </label>
                                            <div class="col-xs-12 col-sm-9 ">
                                                <select name="link_8_type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                                    <option value="internal" <?php echo ($_values_array['link_8_type'] == 'internal' ) ? 'selected' : null; ?> >Internal Link</option>
                                                    <option value="external" <?php echo ($_values_array['link_8_type'] == 'external') ? 'selected' : null; ?> >External Link</option>
                                                </select>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <div id="link_8_type" class="internal_content">
                                                <label class="col-xs-12 col-sm-3 ">Site </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="site_id" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                        <?php
                                                        $all_sites = '';
                                                        if (is_array($sites)) {
                                                            foreach ($sites as $site) {
                                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                                if ($site_id != 1) {
                                                                    $all_sites .= $site_id . ' ';
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>

                                                <label class="col-xs-12 col-sm-3 ">Page </label>
                                                <div class="col-xs-12 col-sm-9 ">
                                                    <select name="parent_id" class="chosen-select form-control pages"  data-placeholder="Choose Page ...">
                                                        <option value="" class="1">Home</option>
                                                        <option value="blog/articles" class="1">Blog</option>
                                                        <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                        <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                        <?php
                                                        if (is_array($pages)) {
                                                            foreach ($pages as $page) {
                                                                $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                                $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                                $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                                $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                ?>
                                                                <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="clearfix col-xs-12 space-10"></div>
                                                <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                                <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_8_url'])) ? $_values_array['link_8_url'] : ''; ?>" >Old Link</a>
                                            </div>
                                            <div class="clearfix col-xs-12 space-10"></div>

                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="link_8_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo (isset($_values_array['link_8_url'])) ? $_values_array['link_8_url'] : ''; ?></span></h4>
                                            <input type="hidden" name="link_8_url" placeholder="http://" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['link_8_url'])) ? $_values_array['link_8_url'] : ''; ?>" />
                                            <a class="old_link col-xs-12 col-sm-3" href="javascript:voide(0);" old="<?php echo (isset($_values_array['link_8_url'])) ? $_values_array['link_8_url'] : ''; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-xs-12 space-10"></div>
                            <hr>
                            <!-- End Link 8 -->
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
<script type="text/javascript" src="<?php echo ADMIN_URL ?>templates/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL; ?>templates/js/jquery.chained.min.js"></script>
<script type="text/javascript">
                                            //chosen......
                                            $('.chosen-select').chosen({allow_single_deselect: true});
                                            // changed ...
                                            $('.link_type').change(function () {
                                                var id = $(this).attr('name');
                                                var link_type = $(this).val();
                                                if (link_type === 'external')
                                                {
                                                    $('#' + id).slideUp();
                                                    $('.' + id + ' h4').hide();
                                                    $('.' + id + ' .old_link').show();
                                                    $('.' + id + ' input').prop('type', 'text');
                                                    $('.' + id + ' input').prop('readonly', false);
                                                } else
                                                {
                                                    $('#' + id).slideDown();
                                                    $('.' + id + ' h4').show();
                                                    $('.' + id + ' .old_link').hide();
                                                    $('.' + id + ' input').prop('type', 'hidden');
                                                    $('.' + id + ' input').prop('readonly', true);
                                                }

                                            });

                                            // link 1
                                            $("#link_1 .pages").chained("#link_1 .sites");
                                            $("#link_1 .pages").trigger("chosen:updated");
                                            $("#link_1 .sites").on("change", function () {
                                                $("#link_1 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_1 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_1 .internal_content').slideUp();
                                                $('#link_1 .internal_input h4').hide();
                                                $('#link_1 .internal_input .old_link').show();
                                                $('#link_1 .internal_input input').prop('type', 'text');
                                                $('#link_1 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_1 .internal_content').slideDown();
                                                $('#link_1 .internal_input h4').show();
                                                $('#link_1 .internal_input .old_link').hide();
                                                $('#link_1 .internal_input input').prop('readonly', true);
                                            }
                                            var site_1 = $("#link_1_type .sites option:selected").attr('alias');
                                            var page_1 = $("#link_1_type .pages option:selected").val();
                                            $('#link_1_type .sites').change(function () {
                                                site_1 = $("#link_1_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_1_type .pages').change(function () {
                                                page_1 = $("#link_1_type .pages option:selected").val();
                                            });
                                            $('#link_1_type a.add_new_link').click(function () {
                                                $('#link_1 .internal_input input').val(site_1 + page_1);
                                                $('#link_1 .internal_input h4 span').text(site_1 + page_1);
                                            });
                                            $('#link_1 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_1 .internal_input input').val(old_link);
                                                $('#link_1 .internal_input h4 span').text(old_link);
                                            });

                                            // link 2
                                            $("#link_2 .pages").chained("#link_2 .sites");
                                            $("#link_2 .pages").trigger("chosen:updated");
                                            $("#link_2 .sites").on("change", function () {
                                                $("#link_2 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_2 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_2 .internal_content').slideUp();
                                                $('#link_2 .internal_input h4').hide();
                                                $('#link_2 .internal_input .old_link').show();
                                                $('#link_2 .internal_input input').prop('type', 'text');
                                                $('#link_2 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_2 .internal_content').slideDown();
                                                $('#link_2 .internal_input h4').show();
                                                $('#link_2 .internal_input .old_link').hide();
                                                $('#link_2 .internal_input input').prop('readonly', true);
                                            }
                                            var site_2 = $("#link_2_type .sites option:selected").attr('alias');
                                            var page_2 = $("#link_2_type .pages option:selected").val();
                                            $('#link_2_type .sites').change(function () {
                                                site_2 = $("#link_2_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_2_type .pages').change(function () {
                                                page_2 = $("#link_2_type .pages option:selected").val();
                                            });
                                            $('#link_2_type a.add_new_link').click(function () {
                                                $('#link_2 .internal_input input').val(site_2 + page_2);
                                                $('#link_2 .internal_input h4 span').text(site_2 + page_2);
                                            });
                                            $('#link_2 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_2 .internal_input input').val(old_link);
                                                $('#link_2 .internal_input h4 span').text(old_link);
                                            });

                                            // link 3
                                            $("#link_3 .pages").chained("#link_3 .sites");
                                            $("#link_3 .pages").trigger("chosen:updated");
                                            $("#link_3 .sites").on("change", function () {
                                                $("#link_3 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_3 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_3 .internal_content').slideUp();
                                                $('#link_3 .internal_input h4').hide();
                                                $('#link_3 .internal_input .old_link').show();
                                                $('#link_3 .internal_input input').prop('type', 'text');
                                                $('#link_3 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_3 .internal_content').slideDown();
                                                $('#link_3 .internal_input h4').show();
                                                $('#link_3 .internal_input .old_link').hide();
                                                $('#link_3 .internal_input input').prop('readonly', true);
                                            }
                                            var site_3 = $("#link_3_type .sites option:selected").attr('alias');
                                            var page_3 = $("#link_3_type .pages option:selected").val();
                                            $('#link_3_type .sites').change(function () {
                                                site_3 = $("#link_3_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_3_type .pages').change(function () {
                                                page_3 = $("#link_3_type .pages option:selected").val();
                                            });
                                            $('#link_3_type a.add_new_link').click(function () {
                                                $('#link_3 .internal_input input').val(site_3 + page_3);
                                                $('#link_3 .internal_input h4 span').text(site_3 + page_3);
                                            });
                                            $('#link_3 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_3 .internal_input input').val(old_link);
                                                $('#link_3 .internal_input h4 span').text(old_link);
                                            });

                                            // link 4
                                            $("#link_4 .pages").chained("#link_4 .sites");
                                            $("#link_4 .pages").trigger("chosen:updated");
                                            $("#link_4 .sites").on("change", function () {
                                                $("#link_4 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_4 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_4 .internal_content').slideUp();
                                                $('#link_4 .internal_input h4').hide();
                                                $('#link_4 .internal_input .old_link').show();
                                                $('#link_4 .internal_input input').prop('type', 'text');
                                                $('#link_4 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_4 .internal_content').slideDown();
                                                $('#link_4 .internal_input h4').show();
                                                $('#link_4 .internal_input .old_link').hide();
                                                $('#link_4 .internal_input input').prop('readonly', true);
                                            }
                                            var site_4 = $("#link_4_type .sites option:selected").attr('alias');
                                            var page_4 = $("#link_4_type .pages option:selected").val();
                                            $('#link_4_type .sites').change(function () {
                                                site_4 = $("#link_4_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_4_type .pages').change(function () {
                                                page_4 = $("#link_4_type .pages option:selected").val();
                                            });
                                            $('#link_4_type a.add_new_link').click(function () {
                                                $('#link_4 .internal_input input').val(site_4 + page_4);
                                                $('#link_4 .internal_input h4 span').text(site_4 + page_4);
                                            });
                                            $('#link_4 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_4 .internal_input input').val(old_link);
                                                $('#link_4 .internal_input h4 span').text(old_link);
                                            });

                                            // link 5
                                            $("#link_5 .pages").chained("#link_5 .sites");
                                            $("#link_5 .pages").trigger("chosen:updated");
                                            $("#link_5 .sites").on("change", function () {
                                                $("#link_5 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_5 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_5 .internal_content').slideUp();
                                                $('#link_5 .internal_input h4').hide();
                                                $('#link_5 .internal_input .old_link').show();
                                                $('#link_5 .internal_input input').prop('type', 'text');
                                                $('#link_5 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_5 .internal_content').slideDown();
                                                $('#link_5 .internal_input h4').show();
                                                $('#link_5 .internal_input .old_link').hide();
                                                $('#link_5 .internal_input input').prop('readonly', true);
                                            }
                                            var site_5 = $("#link_5_type .sites option:selected").attr('alias');
                                            var page_5 = $("#link_5_type .pages option:selected").val();
                                            $('#link_5_type .sites').change(function () {
                                                site_5 = $("#link_5_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_5_type .pages').change(function () {
                                                page_5 = $("#link_5_type .pages option:selected").val();
                                            });
                                            $('#link_5_type a.add_new_link').click(function () {
                                                $('#link_5 .internal_input input').val(site_5 + page_5);
                                                $('#link_5 .internal_input h4 span').text(site_5 + page_5);
                                            });
                                            $('#link_5 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_5 .internal_input input').val(old_link);
                                                $('#link_5 .internal_input h4 span').text(old_link);
                                            });

                                            // link 6
                                            $("#link_6 .pages").chained("#link_6 .sites");
                                            $("#link_6 .pages").trigger("chosen:updated");
                                            $("#link_6 .sites").on("change", function () {
                                                $("#link_6 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_6 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_6 .internal_content').slideUp();
                                                $('#link_6 .internal_input h4').hide();
                                                $('#link_6 .internal_input .old_link').show();
                                                $('#link_6 .internal_input input').prop('type', 'text');
                                                $('#link_6 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_6 .internal_content').slideDown();
                                                $('#link_6 .internal_input h4').show();
                                                $('#link_6 .internal_input .old_link').hide();
                                                $('#link_6 .internal_input input').prop('readonly', true);
                                            }
                                            var site_6 = $("#link_6_type .sites option:selected").attr('alias');
                                            var page_6 = $("#link_6_type .pages option:selected").val();
                                            $('#link_6_type .sites').change(function () {
                                                site_6 = $("#link_6_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_6_type .pages').change(function () {
                                                page_6 = $("#link_6_type .pages option:selected").val();
                                            });
                                            $('#link_6_type a.add_new_link').click(function () {
                                                $('#link_6 .internal_input input').val(site_6 + page_6);
                                                $('#link_6 .internal_input h4 span').text(site_6 + page_6);
                                            });
                                            $('#link_6 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_6 .internal_input input').val(old_link);
                                                $('#link_6 .internal_input h4 span').text(old_link);
                                            });
                                            // link 7
                                            $("#link_7 .pages").chained("#link_7 .sites");
                                            $("#link_7 .pages").trigger("chosen:updated");
                                            $("#link_7 .sites").on("change", function () {
                                                $("#link_7 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_7 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_7 .internal_content').slideUp();
                                                $('#link_7 .internal_input h4').hide();
                                                $('#link_7 .internal_input .old_link').show();
                                                $('#link_7 .internal_input input').prop('type', 'text');
                                                $('#link_7 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_7 .internal_content').slideDown();
                                                $('#link_7 .internal_input h4').show();
                                                $('#link_7 .internal_input .old_link').hide();
                                                $('#link_7 .internal_input input').prop('readonly', true);
                                            }
                                            var site_7 = $("#link_7_type .sites option:selected").attr('alias');
                                            var page_7 = $("#link_7_type .pages option:selected").val();
                                            $('#link_7_type .sites').change(function () {
                                                site_7 = $("#link_7_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_7_type .pages').change(function () {
                                                page_7 = $("#link_7_type .pages option:selected").val();
                                            });
                                            $('#link_7_type a.add_new_link').click(function () {
                                                $('#link_7 .internal_input input').val(site_7 + page_7);
                                                $('#link_7 .internal_input h4 span').text(site_7 + page_7);
                                            });
                                            $('#link_7 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_7 .internal_input input').val(old_link);
                                                $('#link_7 .internal_input h4 span').text(old_link);
                                            });

                                            // link 8
                                            $("#link_8 .pages").chained("#link_8 .sites");
                                            $("#link_8 .pages").trigger("chosen:updated");
                                            $("#link_8 .sites").on("change", function () {
                                                $("#link_8 .pages").trigger("chosen:updated")
                                            });
                                            var link_type = $('#link_8 .link_type').val();
                                            if (link_type === 'external')
                                            {
                                                $('#link_8 .internal_content').slideUp();
                                                $('#link_8 .internal_input h4').hide();
                                                $('#link_8 .internal_input .old_link').show();
                                                $('#link_8 .internal_input input').prop('type', 'text');
                                                $('#link_8 .internal_input input').prop('readonly', false);
                                            } else
                                            {
                                                $('#link_8 .internal_content').slideDown();
                                                $('#link_8 .internal_input h4').show();
                                                $('#link_8 .internal_input .old_link').hide();
                                                $('#link_8 .internal_input input').prop('readonly', true);
                                            }
                                            var site_8 = $("#link_8_type .sites option:selected").attr('alias');
                                            var page_8 = $("#link_8_type .pages option:selected").val();
                                            $('#link_8_type .sites').change(function () {
                                                site_8 = $("#link_8_type .sites option:selected").attr('alias');
                                            });
                                            $('#link_8_type .pages').change(function () {
                                                page_8 = $("#link_8_type .pages option:selected").val();
                                            });
                                            $('#link_8_type a.add_new_link').click(function () {
                                                $('#link_8 .internal_input input').val(site_8 + page_8);
                                                $('#link_8 .internal_input h4 span').text(site_8 + page_8);
                                            });
                                            $('#link_8 a.old_link').click(function () {
                                                var old_link = $(this).attr('old');
                                                $('#link_8 .internal_input input').val(old_link);
                                                $('#link_8 .internal_input h4 span').text(old_link);
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
                                                window.open('../../plugins/kcfinder/browse.php?type=files&dir=files/sites/');
                                            }
</script>