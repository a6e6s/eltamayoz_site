<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
ob_start();
session_start();
$session = new Session();
$controllers = new Controller();
if (!isset($_SESSION['admin_Tamayoz_logged'])) {
    $session->message('Does not have permission to access,please Login', 'alert alert-danger');
    $controllers->redirect_to(ADMIN_URL . 'login');
}
$name_page = (isset($_GET['url'])) ? explode('/', filter_var(rtrim($_GET['url'], '/'))) : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Tamayoz Admin</title>

        <meta name="description" content="" />
        <meta name="robots" content="noindex,nofollow" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="icon" type="image/png" href="<?php echo TEMPLATE.'images/favicon.png' ?>" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/font-awesome/4.2.0/css/font-awesome.min.css" />
        <!-- page specific plugin styles -->
        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/fonts/fonts.googleapis.com.css" />
        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <!-- inline styles related to this page -->
        <script src="<?php echo ADMIN_URL; ?>templates/js/jquery.2.1.1.min.js"></script>
        <!-- ace settings handler -->
        <script src="<?php echo ADMIN_URL; ?>templates/js/ace-extra.min.js"></script>
    </head>
    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-container" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="<?php echo URL; ?>" class="navbar-brand" target="_blank">
                        <small>
                            <img class="" width="40" height="35" src="<?php echo ADMIN_URL . 'templates/images/logo-small.png'; ?>" alt="<?php echo $_SESSION['admin_name']; ?>" />
                            Tamayoz Admin 
                        </small>
                    </a>
                </div>
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" width="40" height="40" src="<?php echo URL . '/images/files/users/' . $_SESSION['admin_alias'] . '/' . $_SESSION['admin_avatar']; ?>" alt="<?php echo $_SESSION['admin_name']; ?>" />
                                <span class="user-info">
                                    <small><?php echo $_SESSION['admin_name']; ?></small>
                                </span>
                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>
                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                                <li>
                                    <a href="<?php echo ADMIN_URL . 'users/profile/' . $_SESSION['admin_id']; ?>">
                                        <i class="ace-icon fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo ADMIN_URL . 'users/edit_user/' . $_SESSION['admin_id']; ?>">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Edit Profile
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?php echo ADMIN_URL; ?>logout">
                                        <i class="ace-icon fa fa-power-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>