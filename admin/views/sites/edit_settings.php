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
        $_slideshow_status = (isset($_values_array['slideshow_status'])) ? $_values_array['slideshow_status'] : 0;
        $_work_steps_status = (isset($_values_array['work_steps_status'])) ? $_values_array['work_steps_status'] : 0;
        $_services_status = (isset($_values_array['services_status'])) ? $_values_array['services_status'] : 0;
        $_works_status = (isset($_values_array['works_status'])) ? $_values_array['works_status'] : 0;
        $_blog_status = (isset($_values_array['blog_status'])) ? $_values_array['blog_status'] : 0;
        $_clients_status = (isset($_values_array['clients_status'])) ? $_values_array['clients_status'] : 0;
        $_works_number = (isset($_values_array['works_number'])) ? $_values_array['works_number'] : 0;
        $_blog_number = (isset($_values_array['blog_number'])) ? $_values_array['blog_number'] : 0;
        $_services_image = (isset($_values_array['services_image'])) ? $_values_array['services_image'] : '';
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
                        <?php require ADMIN_PATH . DS . 'models/edit_sites_settings_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <!--slideshow-->
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> SlideShow  </span>
                            </h3>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Show </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input name="slideshow_status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_slideshow_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <!--Work Steps-->
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> Work Steps   </span>
                            </h3>
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
                                                    <a data-toggle="tab" href="#work_steps_<?php echo $lang['alias']; ?>">
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
                                                <div id="work_steps_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="work_steps_title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Steps Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_values_array['work_steps_title_' . $lang['alias']])) ? $_values_array['work_steps_title_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Work Steps Title in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Show </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input name="work_steps_status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_work_steps_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2">Step 1 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#work_step_1_<?php echo $lang['alias']; ?>">
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
                                                <div id="work_step_1_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="work_step_1_title_<?php echo $lang['alias']; ?>" placeholder="work step Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_1_title_' . $lang['alias']])) ? $_values_array['work_step_1_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="col-xs-12 space-10"></div>
                                                    <input type="text" name="work_step_1_desc_<?php echo $lang['alias']; ?>" placeholder="work step description" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_1_desc_' . $lang['alias']])) ? $_values_array['work_step_1_desc_' . $lang['alias']] : ''; ?>" />
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
                                <label class="col-xs-12 col-sm-2">Step 2 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#work_step_2_<?php echo $lang['alias']; ?>">
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
                                                <div id="work_step_2_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="work_step_2_title_<?php echo $lang['alias']; ?>" placeholder="work step Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_2_title_' . $lang['alias']])) ? $_values_array['work_step_2_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="col-xs-12 space-10"></div>
                                                    <input type="text" name="work_step_2_desc_<?php echo $lang['alias']; ?>" placeholder="work step description" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_2_desc_' . $lang['alias']])) ? $_values_array['work_step_2_desc_' . $lang['alias']] : ''; ?>" />
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
                                <label class="col-xs-12 col-sm-2">Step 3 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#work_step_3_<?php echo $lang['alias']; ?>">
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
                                                <div id="work_step_3_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="work_step_3_title_<?php echo $lang['alias']; ?>" placeholder="work step Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_3_title_' . $lang['alias']])) ? $_values_array['work_step_3_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="col-xs-12 space-10"></div>
                                                    <input type="text" name="work_step_3_desc_<?php echo $lang['alias']; ?>" placeholder="work step description" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_3_desc_' . $lang['alias']])) ? $_values_array['work_step_3_desc_' . $lang['alias']] : ''; ?>" />
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
                                <label class="col-xs-12 col-sm-2">Step 4 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#work_step_4_<?php echo $lang['alias']; ?>">
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
                                                <div id="work_step_4_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="work_step_4_title_<?php echo $lang['alias']; ?>" placeholder="work step Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_4_title_' . $lang['alias']])) ? $_values_array['work_step_4_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="col-xs-12 space-10"></div>
                                                    <input type="text" name="work_step_4_desc_<?php echo $lang['alias']; ?>" placeholder="work step description" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['work_step_4_desc_' . $lang['alias']])) ? $_values_array['work_step_4_desc_' . $lang['alias']] : ''; ?>" />
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
                            <!--services -->
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> Services </span>
                            </h3>
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
                                                    <a data-toggle="tab" href="#services_<?php echo $lang['alias']; ?>">
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
                                                <div id="services_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="services_title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Steps Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_values_array['services_title_' . $lang['alias']])) ? $_values_array['services_title_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Work Steps Title in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Show </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input name="services_status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_services_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Image </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 btn btn-success  uploader-box">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_services_image)) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/sites/' . $_services_image; ?>" />
                                                <input name="services_image" type="hidden" value="<?php echo $_services_image; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Click here to upload image';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_services_image)) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <!--Services items-->
                            <div class="col-xs-12 space-10"></div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2">Service 1 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#service_1_<?php echo $lang['alias']; ?>">
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
                                                <div id="service_1_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="service_1_title_<?php echo $lang['alias']; ?>" placeholder="Service Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['service_1_title_' . $lang['alias']])) ? $_values_array['service_1_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="col-xs-12 space-10"></div>
                                                    <textarea name="service_1_desc_<?php echo $lang['alias']; ?>" class="col-xs-12 col-sm-6" placeholder="Service Description"> <?php echo (isset($_values_array['service_1_desc_' . $lang['alias']])) ? $model->Delete_Lines($_values_array['service_1_desc_' . $lang['alias']]) : ''; ?> </textarea>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 space-10"></div>
                                    <h4 class="row col-xs-12 col-sm-4"><?php echo URL . 'ar/'.$_name_array['site_name_en'].'/'; ?></h4><input type="text" name="service_1_url" placeholder="Service Link" class="col-xs-12 col-sm-3 url" value="<?php echo (isset($_values_array['service_1_url'])) ? $_values_array['service_1_url'] : ''; ?>" />
                                    <button type="button" class="btn btn-success btn-sm col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal">
                                        Choose URL Link
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
                                                            <td valign="top" class="" >
                                                                <h4>pages</h4>
                                                                <?php
                                                                $pages = $model->Get('pages', 'id,title,alias', " WHERE site_id = '" . $id . "' ");
                                                                if (is_array($pages)) {
                                                                    echo '<ul  class="links nav text-left" style="margin: 0">';
                                                                    foreach ($pages as $page) {
                                                                        $page_title_array = (isset($page['title']) && !empty($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                        $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                        $page_alias = (isset($page['alias'])) ? $page['alias'] : 0;
                                                                        echo '<li><a href="#" title="' . $page_alias . '" >' . $page_title . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }else
                                                                {
                                                                    echo 'Not Found Pages Related The '.$_name_array['site_name_en'].' Site';
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <script>
                                                        $('.links a').click(function () {
                                                            var alias = $(this).attr('title');
                                                            $('.url').val(alias);
                                                        })
                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 space-10"></div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2">Service 2 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#service_2_<?php echo $lang['alias']; ?>">
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
                                                <div id="service_2_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="service_2_title_<?php echo $lang['alias']; ?>" placeholder="Service Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['service_2_title_' . $lang['alias']])) ? $_values_array['service_2_title_' . $lang['alias']] : ''; ?>" /> 
                                                    <div class="col-xs-12 space-10"></div>
                                                    <textarea name="service_2_desc_<?php echo $lang['alias']; ?>" class="col-xs-12 col-sm-6" placeholder="Service Description"><?php echo (isset($_values_array['service_2_desc_' . $lang['alias']])) ? $model->Delete_Lines($_values_array['service_2_desc_' . $lang['alias']]) : ''; ?></textarea>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 space-10"></div>
                                    <h4 class="row col-xs-12 col-sm-4"><?php echo URL . 'ar/'.$_name_array['site_name_en'].'/'; ?></h4><input type="text" name="service_2_url" placeholder="Service Link" class="col-xs-12 col-sm-3 url2" value="<?php echo (isset($_values_array['service_2_url'])) ? $_values_array['service_2_url'] : ''; ?>" />
                                    <button type="button" class="btn btn-success btn-sm col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal2">
                                        Choose URL Link
                                    </button>
                                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Select Element</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table data-dismiss="modal">
                                                        <tr>
                                                            <td valign="top" class="" >
                                                                <h4>pages</h4>
                                                                <?php
                                                                if (is_array($pages)) {
                                                                    echo '<ul  class="links2 nav text-left" style="margin: 0">';
                                                                    foreach ($pages as $page) {
                                                                        $page_title_array = (isset($page['title']) && !empty($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                        $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                        $page_alias = (isset($page['alias'])) ? $page['alias'] : 0;
                                                                        echo '<li><a href="#" title="' . $page_alias . '" >' . $page_title . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }else
                                                                {
                                                                    echo 'Not Found Pages Related The '.$_name_array['site_name_en'].' Site';
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <script>
                                                        $('.links2 a').click(function () {
                                                            var alias = $(this).attr('title');
                                                            $('.url2').val(alias);
                                                        })
                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2">Service 3 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#service_3_<?php echo $lang['alias']; ?>">
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
                                                <div id="service_3_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="service_3_title_<?php echo $lang['alias']; ?>" placeholder="Service Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['service_3_title_' . $lang['alias']])) ? $_values_array['service_3_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="col-xs-12 space-10"></div>
                                                    <textarea name="service_3_desc_<?php echo $lang['alias']; ?>" class="col-xs-12 col-sm-6" placeholder="Service Description"><?php echo (isset($_values_array['service_3_desc_' . $lang['alias']])) ? $model->Delete_Lines($_values_array['service_3_desc_' . $lang['alias']]) : ''; ?></textarea>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 space-10"></div>
                                    <h4 class="row col-xs-12 col-sm-4"><?php echo URL . 'ar/'.$_name_array['site_name_en'].'/'; ?></h4><input type="text" name="service_3_url" placeholder="Service Link" class="col-xs-12 col-sm-3 url3" value="<?php echo (isset($_values_array['service_3_url'])) ? $_values_array['service_3_url'] : ''; ?>" />
                                    <button type="button" class="btn btn-success btn-sm col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal3">
                                        Choose URL Link
                                    </button>
                                    <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Select Element</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table data-dismiss="modal">
                                                        <tr>
                                                            <td valign="top" class="" >
                                                                <h4>pages</h4>
                                                                <?php
                                                                if (is_array($pages)) {
                                                                    echo '<ul  class="links3 nav text-left" style="margin: 0">';
                                                                    foreach ($pages as $page) {
                                                                        $page_title_array = (isset($page['title']) && !empty($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                        $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                        $page_alias = (isset($page['alias'])) ? $page['alias'] : 0;
                                                                        echo '<li><a href="#" title="' . $page_alias . '" >' . $page_title . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }else
                                                                {
                                                                    echo 'Not Found Pages Related The '.$_name_array['site_name_en'].' Site';
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <script>
                                                        $('.links3 a').click(function () {
                                                            var alias = $(this).attr('title');
                                                            $('.url3').val(alias);
                                                        })
                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 space-10"></div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2">Service 4 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#service_4_<?php echo $lang['alias']; ?>">
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
                                                <div id="service_4_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="service_4_title_<?php echo $lang['alias']; ?>" placeholder="Service Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['service_4_title_' . $lang['alias']])) ? $_values_array['service_4_title_' . $lang['alias']] : ''; ?>" /> 
                                                    <div class="col-xs-12 space-10"></div>
                                                    <textarea name="service_4_desc_<?php echo $lang['alias']; ?>" class="col-xs-12 col-sm-6" placeholder="Service Description"><?php echo (isset($_values_array['service_4_desc_' . $lang['alias']])) ? $model->Delete_Lines($_values_array['service_4_desc_' . $lang['alias']]) : ''; ?></textarea>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 space-10"></div>
                                    <h4 class="row col-xs-12 col-sm-4"><?php echo URL . 'ar/'.$_name_array['site_name_en'].'/'; ?></h4><input type="text" name="service_4_url" placeholder="Service Link" class="col-xs-12 col-sm-3 url4" value="<?php echo (isset($_values_array['service_4_url'])) ? $_values_array['service_4_url'] : ''; ?>" />
                                    <button type="button" class="btn btn-success btn-sm col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal4">
                                        Choose URL Link
                                    </button>
                                    <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Select Element</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table data-dismiss="modal">
                                                        <tr>
                                                            <td valign="top" class="" >
                                                                <h4>pages</h4>
                                                                <?php
                                                                if (is_array($pages)) {
                                                                    echo '<ul  class="links4 nav text-left" style="margin: 0">';
                                                                    foreach ($pages as $page) {
                                                                        $page_title_array = (isset($page['title']) && !empty($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                        $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                        $page_alias = (isset($page['alias'])) ? $page['alias'] : 0;
                                                                        echo '<li><a href="#" title="' . $page_alias . '" >' . $page_title . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }else
                                                                {
                                                                    echo 'Not Found Pages Related The '.$_name_array['site_name_en'].' Site';
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <script>
                                                        $('.links4 a').click(function () {
                                                            var alias = $(this).attr('title');
                                                            $('.url4').val(alias);
                                                        })
                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 space-10"></div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2">Service 5 </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#service_5_<?php echo $lang['alias']; ?>">
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
                                                <div id="service_5_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="service_5_title_<?php echo $lang['alias']; ?>" placeholder="Service Title" class="col-xs-12 col-sm-6" value="<?php echo (isset($_values_array['service_5_title_' . $lang['alias']])) ? $_values_array['service_5_title_' . $lang['alias']] : ''; ?>" />
                                                    <div class="col-xs-12 space-10"></div>
                                                    <textarea name="service_5_desc_<?php echo $lang['alias']; ?>" class="col-xs-12 col-sm-6" placeholder="Service Description"><?php echo (isset($_values_array['service_5_desc_' . $lang['alias']])) ? $model->Delete_Lines($_values_array['service_5_desc_' . $lang['alias']]) : ''; ?></textarea>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 space-10"></div>
                                    <h4 class="row col-xs-12 col-sm-4"><?php echo URL . 'ar/'.$_name_array['site_name_en'].'/'; ?></h4><input type="text" name="service_5_url" placeholder="Service Link" class="col-xs-12 col-sm-3 url5"  value="<?php echo (isset($_values_array['service_5_url'])) ? $_values_array['service_5_url'] : ''; ?>" />
                                    <button type="button" class="btn btn-success btn-sm col-xs-12 col-sm-2" data-toggle="modal" data-target="#myModal5">
                                        Choose URL Link
                                    </button>
                                    <div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Select Element</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <table data-dismiss="modal">
                                                        <tr>
                                                            <td valign="top" class="" >
                                                                <h4>pages</h4>
                                                                <?php
                                                                if (is_array($pages)) {
                                                                    echo '<ul  class="links5 nav text-left" style="margin: 0">';
                                                                    foreach ($pages as $page) {
                                                                        $page_title_array = (isset($page['title']) && !empty($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                                        $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                                        $page_alias = (isset($page['alias'])) ? $page['alias'] : 0;
                                                                        echo '<li><a href="#" title="' . $page_alias . '" >' . $page_title . '</a></li>';
                                                                    }
                                                                    echo '</ul>';
                                                                }else
                                                                {
                                                                    echo 'Not Found Pages Related The '.$_name_array['site_name_en'].' Site';
                                                                }
                                                                ?>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <script>
                                                        $('.links5 a').click(function () {
                                                            var alias = $(this).attr('title');
                                                            $('.url5').val(alias);
                                                        })
                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 space-10"></div>

                            <!--Works-->
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> Works   </span>
                            </h3>
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
                                                    <a data-toggle="tab" href="#works_<?php echo $lang['alias']; ?>">
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
                                                <div id="works_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="works_title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Steps Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_values_array['works_title_' . $lang['alias']])) ? $_values_array['works_title_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Work Steps Title in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Show </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input name="works_status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_works_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Number </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input type="text" name="works_number" id="spinner1" value="<?php echo $_works_number; ?>" />
                                </div>
                            </div>
                            <!--Blog-->
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> Blog   </span>
                            </h3>
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
                                                    <a data-toggle="tab" href="#blog_<?php echo $lang['alias']; ?>">
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
                                                <div id="blog_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="blog_title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Steps Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_values_array['blog_title_' . $lang['alias']])) ? $_values_array['blog_title_' . $lang['alias']] : ''; ?>" />
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
                                <label class="col-xs-12 col-sm-2"> Show </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input name="blog_status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_blog_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Number </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input type="text" name="blog_number" id="spinner2" value="<?php echo $_blog_number; ?>" />
                                </div>
                            </div>
                            <!--Clients-->
                            <h3 class="row header smaller lighter blue">
                                <span class="col-sm-6"> Clients   </span>
                            </h3>
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
                                                    <a data-toggle="tab" href="#clients_<?php echo $lang['alias']; ?>">
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
                                                <div id="clients_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="clients_title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Steps Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_values_array['clients_title_' . $lang['alias']])) ? $_values_array['clients_title_' . $lang['alias']] : ''; ?>" />
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
                                <label class="col-xs-12 col-sm-2"> Show </label>
                                <div class="col-xs-12 col-sm-1">
                                    <input name="clients_status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_clients_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
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
<script type="text/javascript">
//file manager .............................
                                                        jQuery(function ($) {
                                                            $('#spinner1').ace_spinner({value: 0, min: 0, max: 16, step: 1, btn_up_class: 'btn-info', btn_down_class: 'btn-info'})
                                                                    .closest('.ace-spinner')
                                                                    .on('changed.fu.spinbox', function () {
//                                                                    alert($('#spinner1').val())
                                                                        var c = $('#spinner1').val();
                                                                        $('#spinner1').val(c);
                                                                    });
                                                            $('#spinner2').ace_spinner({value: 0, min: 0, max: 16, step: 1, btn_up_class: 'btn-info', btn_down_class: 'btn-info'})
                                                                    .closest('.ace-spinner')
                                                                    .on('changed.fu.spinbox', function () {
//                                                                    alert($('#spinner1').val())
                                                                        var c = $('#spinner2').val();
                                                                        $('#spinner2').val(c);
                                                                    });
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
                                                                        div.innerHTML = '<img src="' + url + '" /><input name="services_image" type="hidden" value="' + image_name + '"/>';

                                                                    };
                                                                }
                                                            };
                                                            window.open('../../plugins/kcfinder/browse.php?dir=files/sites/');
                                                        }
</script>
