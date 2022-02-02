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
    $model->redirect_to(ADMIN_URL . 'languages/items');
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
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>languages/items">Languages</a></li>
                    <li class="active">New Language</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Languages <small> <i class="ace-icon fa fa-angle-double-right"></i> Create New Language </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/new_language_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">

                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Name </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="name" placeholder="Language Name" class="col-xs-12 col-sm-5" />

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Code </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="code" placeholder="Language Code" class="col-xs-12 col-sm-5" maxlength="2" />
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="middle">Two characters English Only.</span>
                                    </span>
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
                                <div class="col-xs-12 col-sm-2"> Direction </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="menu" name="direction" class="chosen-select form-control" data-placeholder="Choose Menu ...">
                                        <option value="LTR">left to right</option>
                                        <option value="RTL">Right to left</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Flag </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 col-sm-5 btn btn-success  uploader-box">
                                        <div onclick="openKCFinder(this)">Click here to upload image</div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save&back">Save & Back</label>
                                <input type="submit" id="save&back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save&new">Save & New</label>
                                <input type="submit" id="save&new" name="save&new" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>languages/items">Cancel</a>

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
                                                    //resize the chosen on window resize

                                                    $(window)
                                                            .off('resize.chosen')
                                                            .on('resize.chosen', function() {
                                                                $('.chosen-select').each(function() {
                                                                    var $this = $(this);
                                                                    $this.next().css({'width': $this.parent().width()});
                                                                });
                                                            }).trigger('resize.chosen');
                                                    //resize chosen on sidebar collapse/expand
                                                    $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                                                        if (event_name != 'sidebar_collapsed')
                                                            return;
                                                        $('.chosen-select').each(function() {
                                                            var $this = $(this);
                                                            $this.next().css({'width': $this.parent().width()});
                                                        });
                                                    });
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
                                                window.open('../plugins/kcfinder/browse.php?dir=files/flags/',
                                                        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                                                        'directories=0, resizable=1, scrollbars=0');
                                            }
</script>
