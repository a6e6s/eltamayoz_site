<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'users/items');
} else {
    // get item details ...........
    $item = $model->Get('users', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('Sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'users/items');
    } else {
        $_alias = (isset($item[0]['alias'])) ? $item[0]['alias'] : '';
        $_first_name = (isset($item[0]['first_name'])) ? $item[0]['first_name'] : '';
        $_last_name = (isset($item[0]['last_name'])) ? $item[0]['last_name'] : '';
        $_username = (isset($item[0]['username'])) ? $item[0]['username'] : '';
        $_about_me = (isset($item[0]['about_me'])) ? strip_tags($model->new_line($item[0]['about_me'])) : '';
        $_email = (isset($item[0]['email'])) ? $item[0]['email'] : '';
        $_type = (isset($item[0]['admin'])) ? $item[0]['admin'] : 1;
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_gender = (isset($item[0]['gender'])) ? $item[0]['gender'] : 'm';
        $_website = (isset($item[0]['website'])) ? $item[0]['website'] : '';
        $_facebook = (isset($item[0]['facebook'])) ? $item[0]['facebook'] : '';
        $_twitter = (isset($item[0]['twitter'])) ? $item[0]['twitter'] : '';
        $_google = (isset($item[0]['google'])) ? $item[0]['google'] : '';
        $_birth_date = (isset($item[0]['birth_date']) && $item[0]['birth_date'] != 0) ? date('d/m/Y', $item[0]['birth_date']) : null;
        $_image = (isset($item[0]['avatar'])) ? $item[0]['avatar'] : '';
        $_register_date = (isset($item[0]['register_date']) && $item[0]['register_date'] != 0) ? date('d/m/Y', $item[0]['register_date']) : null;
        $_last_login = (isset($item[0]['last_login']) && $item[0]['last_login'] != 0) ? date('d-m-Y', $item[0]['last_login']) : null;
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
                        <!--<a href="<?php // echo ADMIN_URL;  ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>users/items">Users</a></li>
                    <li class="active"><a href="<?php echo ADMIN_URL . 'users/profile/' . $id; ?>">Profile</a></li>
                    <li class="active">Edit User</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Users <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $_username; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/edit_users_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3 center">
                                    <span class="profile-picture">
                                        <?php
                                        if (!empty($_image)) {
                                            ?>
                                            <img class="img-responsive" alt="<?php echo $_username; ?>"  src="<?php echo URL . 'images/files/users/' . $_alias . '/' . $_image; ?>" />
                                            <input name="image" type="hidden" value="<?php echo $_image; ?>"/>
                                            <?php
                                        } else {
                                            echo '<img class="img-responsive" alt="" src="' . URL . 'images/files/users/profile-pic.jpg" />';
                                        }
                                        ?>
                                    </span>

                                    <div class="space space-4"></div>

                                    <a href="#" class="btn btn-sm btn-block btn-primary" onclick="openKCFinder(this)">
                                        <i class="ace-icon fa fa-upload bigger-110"></i>
                                        <span class="bigger-110">Upload Avatar</span>
                                    </a>
                                    <a href="<?php echo ADMIN_URL . 'users/edit_user_pass/' . $id; ?>" class="btn btn-sm btn-block btn-success">
                                        <i class="ace-icon fa fa-pencil bigger-110"></i>
                                        <span class="bigger-110">Edit Password</span>
                                    </a>
                                    <a href="<?php echo ADMIN_URL . 'users/profile/' . $id; ?>" class="btn btn-sm btn-block btn-danger">
                                        <i class="ace-icon fa fa-reply bigger-110"></i>
                                        <span class="bigger-110">Back To Profile</span>
                                    </a>
                                </div><!-- /.col -->

                                <div class="col-xs-12 col-sm-9">
                                    <h4 class="blue">
                                        <span class="middle"><?php echo $_username; ?></span>
                                    </h4>

                                    <div class="profile-user-info">
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Email </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="email" placeholder="First Name" class=" col-xs-12" value="<?php echo $_email; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> First Name </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="F_name" placeholder="First Name" class="col-xs-12" value="<?php echo $_first_name; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Last Name </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="L_name" placeholder="Last Name" class="col-xs-12" value="<?php echo $_last_name; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Gender </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <select name="gender" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose Gender...">
                                                        <option value=""> </option>
                                                        <option value="m" <?php echo $_gender == 'm' ? 'selected' : '' ?>>Male</option>
                                                        <option value="f" <?php echo $_gender == 'f' ? 'selected' : '' ?>>Female</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Birth Date </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input name="birth" class="form-control input-mask-date" type="text" value="<?php echo $_birth_date; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Type </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <select name="user_type" class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose type user...">
                                                        <option value=""> </option>
                                                        <option value="2" <?php echo $_type == '2' ? 'selected' : '' ?>>Admin</option>
                                                        <option value="1" <?php echo $_type == '1' ? 'selected' : '' ?>>User</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Status </div>

                                            <div class="profile-info-value">
                                                <input name="status" class="ace ace-switch ace-switch-3 col-xs-12 col-sm-5" type="checkbox" <?php echo ($_status != 0) ? 'checked' : null; ?> />
                                                <span class="lbl"></span>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Joined </div>
                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input name="joined" class="form-control input-mask-date" type="text" value="<?php echo $_register_date; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> Website </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="text" name="web" placeholder="First Name" class="col-xs-12" value="<?php echo $_website; ?>" />
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
                                                        <input class="col-xs-12" type="text" name="facebook" value="<?php echo $_facebook; ?>" />
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
                                                        <input class="col-xs-12" type="text" name="twitter" value="<?php echo $_twitter; ?>" />
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
                                                        <input class="col-xs-12" type="text" name="google" value="<?php echo $_google; ?>" />
                                                        <i class="ace-icon fa fa-google-plus red"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- /.col -->
                                <div class="col-xs-12">
                                    <div class="space-20"></div>
                                    <div class="widget-box transparent">
                                        <div class="widget-header widget-header-small">
                                            <h4 class="widget-title smaller">
                                                <i class="ace-icon fa fa-check-square-o bigger-110"></i>
                                                Little About Me
                                            </h4>
                                        </div>

                                        <div class="widget-body">
                                            <textarea name="about" rows="10" class="autosize-transition form-control"><?php echo $_about_me; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="space-20"></div>
                                </div>
                            </div>
                    </div><!-- /.row -->
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
                                            ;
                                            $('.input-mask-date').mask('99/99/9999');
                                        });
//file manager .............................
                                        function delete_img(i) {
                                            $(i).parent().html('<div onclick="openKCFinder(this)">Click here to upload image</div>');
                                        }
                                        function openKCFinder(div) {
                                            window.KCFinder = {
                                                callBack: function (url) {
                                                    window.KCFinder = null;
                                                    $('.profile-picture').html('<div style="margin:5px">Loading...</div>');
                                                    var img = new Image();
                                                    img.src = url;
                                                    var image_name = url.split("/").slice(-1);
                                                    img.onload = function () {
                                                        $('.profile-picture').html('<img class="img-responsive" src="' + url + '" /><input name="image" type="hidden" value="' + image_name + '"/>');
                                                    };
                                                }
                                            };
                                            window.open('../../plugins/kcfinder/browse.php?dir=files/users/<?php echo $_alias; ?>',
                                                    'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                                                    'directories=0, resizable=1, scrollbars=0');
                                        }

</script>
