<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<?php
$model = new model();
$item = $model->Get('settings', '*', " WHERE id = '7'");
$_social_array = (isset($item[0]['settings_values']) && !empty($item[0]['settings_values'])) ? unserialize(base64_decode($item[0]['settings_values'])) : array();
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
                        <?php require ADMIN_PATH . DS . 'models/edit_social_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Facebook </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="facebook"  placeholder="Facebook" class="col-xs-12 col-sm-5" value="<?php echo (isset($_social_array['facebook'])) ? $_social_array['facebook'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Twitter </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="twitter"  placeholder="Twitter" class="col-xs-12 col-sm-5" value="<?php echo (isset($_social_array['twitter'])) ? $_social_array['twitter'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Google+ </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="google"  placeholder="Google" class="col-xs-12 col-sm-5" value="<?php echo (isset($_social_array['google'])) ? $_social_array['google'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> YouTube </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="youtube"  placeholder="YouTube" class="col-xs-12 col-sm-5" value="<?php echo (isset($_social_array['youtube'])) ? $_social_array['youtube'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> LinkedIn </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="linkedin"  placeholder="YouTube" class="col-xs-12 col-sm-5" value="<?php echo (isset($_social_array['linkedin'])) ? $_social_array['linkedin'] : '' ; ?>" />
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
