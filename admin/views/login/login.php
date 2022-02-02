<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
ob_start();
session_start();
$session = new Session();
$controllers = new Controller();
if (isset($_SESSION['admin_Tamayoz_logged'])) {
    $session->message('You have already logged ...', 'success-message');
    $controllers->redirect_to(ADMIN_URL . 'dashboard');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Login Page - Tamayoz Admin</title>

        <meta name="description" content="User login page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/font-awesome/4.2.0/css/font-awesome.min.css" />

        <!-- text fonts -->
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/fonts/fonts.googleapis.com.css" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/ace.min.css" />

        <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/ace-ie.min.css" />
        <![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lt IE 9]>
        <script src="<?php echo ADMIN_URL; ?>templates/js/html5shiv.min.js"></script>
        <script src="<?php echo ADMIN_URL; ?>templates/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-layout light-login">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                <h1>
                                    <i class="ace-icon fa fa-leaf green"></i>
                                    <span class="white" id="id-text2">Tamayoz Admin</span>
                                </h1>
                            </div>

                            <div class="space-6"></div>

                            <div class="position-relative" id="fuelux-wizard-container">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header blue lighter bigger">
                                                <i class="ace-icon fa fa-coffee green"></i>
                                                Please Enter Your Information
                                            </h4>
                                            <div class="space-6"></div>
                                            <form action="<?php echo ADMIN_URL . 'login/run'; ?>" method="post" id="form">
                                                <fieldset>
                                                    <div class="form-group">
                                                        <div class="block clearfix">
                                                            <span class="block input-icon input-icon-right">
                                                                <input name="email"  type="text" class="form-control" placeholder="Email"/>
                                                                <i class="ace-icon fa fa-at"></i>
                                                            </span>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <div class="block clearfix">
                                                            <span class="block input-icon input-icon-right">
                                                                <input name="password" type="password" class="form-control" placeholder="Password" />
                                                                <i class="ace-icon fa fa-lock"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="space"></div>

                                                    <div class="clearfix">
<!--                                                        <label class="inline">
                                                            <input type="checkbox" class="ace" />
                                                            <span class="lbl"> Remember Me</span>
                                                        </label>-->

                                                        <label type="button" class="width-35 pull-right btn btn-sm btn-primary" for="submit">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110">Login</span>
                                                        </label>
                                                        <input type="submit" id="submit" name="login" />
                                                    </div>
                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>
                                        </div><!-- /.widget-main -->
                                            <?php
                                            if (!empty($session->message)) {
                                                echo $session->message;
                                            }
                                            ?>
                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->
                            </div><!-- /.position-relative -->
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="<?php echo ADMIN_URL; ?>templates/js/jquery.2.1.1.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery.1.11.1.min.js"></script>
<![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo ADMIN_URL; ?>templates/js/jquery.min.js'>" + "<" + "/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='<?php echo ADMIN_URL; ?>templates/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement)
                document.write("<script src='<?php echo ADMIN_URL; ?>templates/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <!--validated-->
        <script src="<?php echo ADMIN_URL; ?>templates/js/jquery.validate.min.js"></script>
        <script>
            jQuery(function($) {
                $('#form').validate({
                    errorElement: 'div',
                    errorClass: 'help-block',
                    focusInvalid: true,
                    ignore: "",
                    rules: {
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
                        email: {
                            required: "Please provide a valid email.",
                            email: "Please provide a valid email."
                        },
                        password: {
                            required: "Please specify a password.",
                            minlength: "Please specify a secure password."
                        }
                    },
                    highlight: function(e) {
                        $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
                    },
                    success: function(e) {
                        $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                        $(e).remove();
                    }
                });
            });
        </script>
    </body>
</html>
