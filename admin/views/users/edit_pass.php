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
        $_password = (isset($item[0]['password'])) ? $item[0]['password'] : '';
        $_username = (isset($item[0]['username'])) ? $item[0]['username'] : '';
        $_image = (isset($item[0]['avatar'])) ? $item[0]['avatar'] : '';
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
                        <!--<a href="<?php // echo ADMIN_URL; ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>users/items">Users</a></li>
                    <li class="active"><a href="<?php echo ADMIN_URL.'users/profile/'.$id; ?>">Profile</a></li>
                    <li class="active"><a href="<?php echo ADMIN_URL.'users/edit_user/'.$id; ?>">Edit User</a></li>
                    <li class="active">Edit User Password</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Users <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $_username; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php require ADMIN_PATH . DS . 'models/edit_users_pass_model.php'; ?>
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
                                    <a href="<?php echo ADMIN_URL . 'users/edit_user/' . $id; ?>" class="btn btn-sm btn-block btn-success">
                                        <i class="ace-icon fa fa-reply bigger-110"></i>
                                        <span class="bigger-110">Back To Edit User</span>
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
                                            <div class="profile-info-name"> Old Password </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="password" name="old-pass" placeholder="Old Password" class=" col-xs-12" value="" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="profile-info-row">
                                            <div class="profile-info-name"> New Password </div>

                                            <div class="profile-info-value">
                                                <div class="row col-xs-12 col-sm-6">
                                                    <input type="password" name="pass" placeholder="New Password" class=" col-xs-12" value="" />
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
                                    </div>

                                </div><!-- /.col -->
                                
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
