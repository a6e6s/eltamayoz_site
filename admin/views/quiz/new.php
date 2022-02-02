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
    $model->redirect_to(ADMIN_URL . 'quiz/items');
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
                        <!--<a href="<?php // echo ADMIN_URL;        ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>quiz/items">Quizzes</a></li>
                    <li class="active">New Page</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Quizzes <small> <i class="ace-icon fa fa-angle-double-right"></i> New </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/new_quiz_model.php'; ?>
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" class="col-xs-12" />
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
                                    <input type="text" name="alias" id="form-field-1" placeholder="" class="col-xs-12" value="" />
                                </div>
                                <div class="clearfix"></div>
                            </div>
<!--                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Degree </label>
                                <div class="col-xs-12 col-sm-5">
                                    <input type="text" name="per_page" id="spinner1" value="" />
                                </div>
                                <div class="clearfix"></div>
                            </div>-->
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> status </label>
                                <div class="col-xs-12 col-sm-5">
                                    <input name="status" class="ace ace-switch ace-switch-2" type="checkbox" />
                                    <span class="lbl"></span>
                                </div>
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
                                                    <textarea name="content_<?php echo $lang['alias']; ?>" rows="5" class="col-xs-12"></textarea>
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
                            <hr>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2">  </label>
                                <div class="col-xs-12 col-sm-10 row">
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
