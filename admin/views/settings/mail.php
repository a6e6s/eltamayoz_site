<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<?php
$model = new model();
$item = $model->Get('settings', '*', " WHERE id = '2'");
$_mail_array = (isset($item[0]['settings_values']) && !empty($item[0]['settings_values'])) ? unserialize(base64_decode($item[0]['settings_values'])) : array();
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
                    <li class="active">Mail</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Settings <small> <i class="ace-icon fa fa-angle-double-right"></i> Edit Mail Data </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/edit_mail_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Email From Name </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="email_from_name"  placeholder="Email From Name" class="col-xs-12 col-sm-5" value="<?php echo (isset($_mail_array['email_from_name'])) ? $_mail_array['email_from_name'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Email From Address </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="email_from_address"  placeholder="Email From Address" class="col-xs-12 col-sm-5" value="<?php echo (isset($_mail_array['email_from_address'])) ? $_mail_array['email_from_address'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> SMTP Authentication </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input name="auth" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo (isset($_mail_array['auth']) && $_mail_array['auth'] == 1) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-2"> SMTP Secure </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select name="secure" class="chosen-select form-control" data-placeholder="Choose Menu ...">
                                        <option value="none" <?php echo ($_mail_array['secure'] == 'none') ? 'selected' : null; ?> >None</option>
                                        <option value="tls" <?php echo ($_mail_array['secure'] == 'tls') ? 'selected' : null; ?> >TLS</option>
                                        <option value="ssl" <?php echo ($_mail_array['secure'] == 'ssl') ? 'selected' : null; ?> >SSL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> SMTP Server </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="server"  placeholder="SMTP Server" class="col-xs-12 col-sm-5" value="<?php echo (isset($_mail_array['server'])) ? $_mail_array['server'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> SMTP Port </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="port"  placeholder="SMTP Port" class="col-xs-12 col-sm-5" value="<?php echo (isset($_mail_array['port'])) ? $_mail_array['port'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> SMTP Username </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="username"  placeholder="SMTP Username" class="col-xs-12 col-sm-5" value="<?php echo (isset($_mail_array['username'])) ? $_mail_array['username'] : '' ; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> SMTP Password </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="password"  placeholder="SMTP Password" class="col-xs-12 col-sm-5" value="<?php echo (isset($_mail_array['password'])) ? $_mail_array['password'] : '' ; ?>" />
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
<script src="<?php echo ADMIN_URL ?>templates/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
$('.chosen-select').chosen({allow_single_deselect: true});
</script>
