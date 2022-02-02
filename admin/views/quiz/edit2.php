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
    $model->redirect_to(ADMIN_URL . 'quiz/items');
} else {
    $languages = $model->Get('languages', 'name,alias,flag', null, 'id', 'ASC');
    if (!is_array($languages)) {
        $session->message('sorry .. please create any language Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'quiz/items');
    }
    // get item details ...........
    $item = $model->Get('questions', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'quiz/items');
    } else {
        $_title_array = (isset($item[0]['title'])) ? unserialize(base64_decode($item[0]['title'])) : array();
        $_alias = (isset($item[0]['alias'])) ? $item[0]['alias'] : '';
        $_degree = (isset($item[0]['degree'])) ? $item[0]['degree'] : '';
        $_content_array = (isset($item[0]['content'])) ? unserialize(base64_decode($item[0]['content'])) : array();
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_desc_array = (isset($item[0]['meta_desc'])) ? unserialize(base64_decode($item[0]['meta_desc'])) : array();
        $_keys_array = (isset($item[0]['meta_key'])) ? unserialize(base64_decode($item[0]['meta_key'])) : array();
        $_created = (isset($item[0]['created_date']) && $item[0]['created_date'] != 0) ? date('d-m-Y   h:i A', $item[0]['created_date']) : 'No Date';
        $_modified = (isset($item[0]['modified_date']) && $item[0]['modified_date'] != 0) ? date('d-m-Y   h:i A', $item[0]['modified_date']) : 'Not Modified';
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
                        <!--<a href="<?php // echo ADMIN_URL;      ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>quiz/items">Quizzes</a></li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>quiz/items">Items</a></li>
                    <li class="active">Edit</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Quizzes <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $model->Cut_Words($_title_array['en'], 0, 300); ?> </small></h1>
                    <div class="space-6"></div>
                    <small><srtong>CREATED IN : </srtong><?php echo $_created; ?></small><br/>
                    <small><srtong>MODIFIED IN : </srtong><?php echo $_modified; ?></small>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/edit_quiz_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Page Title" class="col-xs-12" value="<?php echo (isset($_title_array[$lang['alias']])) ? $model->Cut_Words($_title_array[$lang['alias']], 0, 1000) : ''; ?>" />
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
                                    <input type="text" name="alias" id="form-field-1" placeholder="Site Alias" class="col-xs-12" value="<?php echo $_alias; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> status </label>
                                <div class="col-xs-12 col-sm-5">
                                    <input name="status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Degree </label>
                                <div class="col-xs-12 col-sm-5">
                                    <input type="text" name="degree" id="spinner1" value="<?php echo $_degree; ?>" />
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Content </label>
                                <div class="col-xs-12 col-sm-5">
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
                                                    <textarea name="content_<?php echo $lang['alias']; ?>" rows="5" class="col-xs-12"><?php echo (isset($_content_array[$lang['alias']])) ? $_content_array[$lang['alias']] : ''; ?></textarea>
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
                            <hr>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Degree </label>
                                <div class="col-xs-12 col-sm-10 row">
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
                                        <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>quiz/items">Cancel</a>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
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
<script src="<?php echo ADMIN_URL ?>templates/js/chosen.jquery.min.js"></script>
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery-ui.custom.min.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        $('#spinner1').ace_spinner({value: 0, min: 0, max: 100000, step: 1, btn_up_class: 'btn-info', btn_down_class: 'btn-info'})
        $('.chosen-select').chosen({allow_single_deselect: true});
    });
</script>
