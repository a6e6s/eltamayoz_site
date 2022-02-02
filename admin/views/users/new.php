<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
$model = new model();
?>
<div class="main-container" id="main-container">
    <?php require ADMIN_PATH . DS . 'views' . DS . 'sidebar.php'; ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <!--<a href="<?php // echo ADMIN_URL;  ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>users/items">Users</a></li>
                    <li class="active">Edit User</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Users <small> <i class="ace-icon fa fa-angle-double-right"></i> Create New User </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/new_users_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="profile-user-info">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> UserName </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="U_name" placeholder="UserName" class="col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Email </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="email" placeholder="First Name" class=" col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Password </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="password" name="pass" placeholder="Password" class=" col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Re-Password </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="password" name="re-pass" placeholder="Re-Password" class=" col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> First Name </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="F_name" placeholder="First Name" class="col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Last Name </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="L_name" placeholder="Last Name" class="col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Gender </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <select name="gender" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose Gender...">
                                                        <option value=""> </option>
                                                        <option value="m" >Male</option>
                                                        <option value="f" >Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Birth Date </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input name="birth" class="form-control input-mask-date" type="text" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Type </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <select name="user_type" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose type user...">
                                                        <option value=""> </option>
                                                        <option value="2" >Admin</option>
                                                        <option value="1" >User</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Status </div>

                                            <div class="profile-info-value">
                                                <input name="status" class="ace ace-switch ace-switch-3 col-xs-12 col-sm-5" type="checkbox" />
                                                <span class="lbl"></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Website </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="web" placeholder="First Name" class="col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> 
                                                Facebook
                                            </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <span class="input-icon block">
                                                        <input class="col-xs-12" type="text" name="facebook" value="" />
                                                        <i class="ace-icon fa fa-facebook blue"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> 
                                                Twitter
                                            </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <span class="input-icon block">
                                                        <input class="col-xs-12" type="text" name="twitter" value="" />
                                                        <i class="ace-icon fa fa-twitter light-blue"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> 
                                                Google
                                            </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <span class="input-icon block">
                                                        <input class="col-xs-12" type="text" name="google" value="" />
                                                        <i class="ace-icon fa fa-google-plus red"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-20"></div>
                                    <div class="widget-box transparent">
                                        <div class="widget-header widget-header-small">
                                            <h4 class="widget-title smaller">
                                                <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                                                Little About Me
                                            </h4>
                                        </div>

                                        <div class="widget-body">
                                            <textarea name="about" rows="10" class="autosize-transition form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="space-20"></div>
                                </div>
                            </div><!-- /.col -->
                    </div><!-- /.row -->
                    <hr>
                    <div class="col-xs-12 col-sm-2 clearfix">
                        <label class="btn  btn-primary col-xs-12" for="save_back">Save & Back</label>
                        <input type="submit" id="save_back" name="save&back" />    
                    </div>
                    <div class="col-xs-12 col-sm-2 clearfix">
                        <label class="btn  btn-primary col-xs-12" for="save_new">Save & New</label>
                        <input type="submit" id="save_back" name="save&new" />    
                    </div>
                    <div class="col-xs-12 col-sm-2 clearfix">
                        <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>users/items">Cancel</a>
                    </div>
                    </form>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
</div><!-- /.main-container -->
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery.maskedinput.min.js"></script>
<script src="<?php echo ADMIN_URL; ?>templates/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        if (!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect: true});
            //resize the chosen on window resize

            $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function () {
                        $('.chosen-select').each(function () {
                            var $this = $(this);
                            $this.next().css({'width': $this.parent().width()});
                        })
                    }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function (e, event_name, event_val) {
                if (event_name != 'sidebar_collapsed')
                    return;
                $('.chosen-select').each(function () {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });
        }


        $('.input-mask-date').mask('99/99/9999');
    });
</script>
