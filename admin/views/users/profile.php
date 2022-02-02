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
    $model->redirect_to(ADMIN_URL . 'users/items');
} else {
    $languages = $model->Get('languages', 'name,alias,flag', null, 'id', 'ASC');
    if (!is_array($languages)) {
        $session->message('Sorry .. Please Create any Language Before Create a New .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'users/items');
    }
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
        $_facebook = (isset($item[0]['facebook'])) ? $item[0]['facebook'] : '';
        $_twitter = (isset($item[0]['twitter'])) ? $item[0]['twitter'] : '';
        $_google = (isset($item[0]['google'])) ? $item[0]['google'] : '';
        $_email = (isset($item[0]['email'])) ? $item[0]['email'] : '';
        $_type = (isset($item[0]['admin']) && $item[0]['admin'] == '2') ? 'Admin' : 'User';
        $_status = (isset($item[0]['status']) && $item[0]['status'] != 0 ) ? 'Active' : 'Block';
        $_gender = (isset($item[0]['gender']) && $item[0]['gender'] == 'm') ? 'Male' : 'Female';
        $_website = (isset($item[0]['website'])) ? $item[0]['website'] : '';
        $_birth_date = (isset($item[0]['birth_date']) && $item[0]['birth_date'] != 0) ? date('d-m-Y', $item[0]['birth_date']) : 0;
        $_image = (isset($item[0]['avatar'])) ? $item[0]['avatar'] : '';
        $_register_date = (isset($item[0]['register_date']) && $item[0]['register_date'] != 0) ? date('d-m-Y', $item[0]['register_date']) : 'No Date';
        $_last_login = (isset($item[0]['last_login']) && $item[0]['last_login'] != 0) ? date('d-m-Y  h:i:s A', $item[0]['last_login']) : null;
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
                    <li class="active">Profile</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Users <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $_username; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 center">
                                <span class="profile-picture">
                                    <?php
                                    if (!empty($_image)) {
                                        ?>
                                        <img class="img-responsive" alt="<?php echo $_username; ?>"  src="<?php echo URL . 'images/files/users/' . $_alias . '/' . $_image; ?>" />
                                        <?php
                                    } else {
                                        echo '<img class="img-responsive" alt="" src="' . URL . 'images/files/users/profile-pic.jpg" />';
                                    }
                                    ?>
                                </span>

                                <div class="space space-4"></div>

<!--                                <a href="#" class="btn btn-sm btn-block btn-primary">
                                    <i class="ace-icon fa fa-envelope-o bigger-110"></i>
                                    <span class="bigger-110">Send a message</span>
                                </a>-->
                                <a href="<?php echo ADMIN_URL . 'users/edit_user/' . $id; ?>" class="btn btn-sm btn-block btn-success">
                                    <i class="ace-icon fa fa-pencil bigger-110"></i>
                                    <span class="bigger-110">Edit User Data</span>
                                </a>
                                <a href="<?php echo ADMIN_URL; ?>users/items" class="btn btn-sm btn-block btn-danger">
                                    <i class="ace-icon fa fa-reply bigger-110"></i>
                                    <span class="bigger-110">Back To Users</span>
                                </a>
                            </div><!-- /.col -->

                            <div class="col-xs-12 col-sm-9">
                                <h4 class="blue">
                                    <span class="middle"><?php echo $_username; ?></span>
                                </h4>

                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> First Name </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_first_name; ?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Last Name </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_last_name; ?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Gender </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_gender; ?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Birth Date </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_birth_date; ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Age </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_birth_date != 0 ? date_diff(date_create($_birth_date), date_create('today'))->y . ' Year' : 'No Date'; ?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Type </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_type; ?></span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Status </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_status; ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Joined </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_register_date; ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Last Online </div>

                                        <div class="profile-info-value">
                                            <span>
                                                <?php
                                                $interval = 'just now';
                                                if ($_last_login != null) {
                                                    $time = date_diff(date_create($_last_login), date_create('now'));
                                                    if ($time->y != '0') {
                                                        $interval = $time->y . ' Year/s Ago';
                                                    } elseif ($time->m != '0') {
                                                        $interval = $time->m . ' Month/s Ago';
                                                    } elseif ($time->d != '0') {
                                                        $interval = $time->d . ' day/s Ago';
                                                    } elseif ($time->h != '0') {
                                                        $interval = $time->h . ' hours/s Ago';
                                                    } elseif ($time->i != '0') {
                                                        $interval = $time->i . ' minute/s Ago';
                                                    }
                                                    echo $interval;
                                                } else {
                                                    echo 'Not logged in';
                                                }
                                                ?> 
                                            </span>
                                        </div>
                                    </div>
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Email </div>

                                        <div class="profile-info-value">
                                            <span><?php echo $_email; ?></span>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Website </div>

                                        <div class="profile-info-value">
                                            <a href="<?php echo 'http://' . $_website; ?>" target="_blank"><?php echo $_website; ?></a>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> 
                                            Social
                                        </div>

                                        <div class="profile-info-value">
                                            <?php
                                            echo!empty($_facebook) ? '<a href="http://facebook.com/' . $_facebook . '" target="_blank" class="social"  data-rel="tooltip" data-placement="top" title="facebook"><i class="middle ace-icon fa fa-facebook  fa-lg blue"></i></a>' : null;
                                            echo!empty($_twitter) ? '<a href="http://twitter.com/' . $_twitter . '" target="_blank" class="social"  data-rel="tooltip" data-placement="top" title="twitter" ><i class="middle ace-icon fa fa-twitter  fa-lg light-blue"></i></a>' : null;
                                            echo!empty($_google) ? '<a href="http://twitter.com/' . $_google . '" target="_blank" class="social"  data-rel="tooltip" data-placement="top" title="google+" ><i class="middle ace-icon fa fa-google-plus fa-lg red "></i></a>' : null;
                                            ?>
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
                                        <div class="widget-main"><?php echo $_about_me; ?></div>
                                    </div>
                                </div>
                                    <div class="space-20"></div>
<!--                                <div class="widget-box transparent">
                                    <div class="widget-header widget-header-small header-color-blue2">
                                        <h4 class="widget-title smaller">
                                            <i class="ace-icon fa fa-lightbulb-o bigger-120"></i>
                                            My Skills
                                        </h4>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main padding-16 skills">
                                            <div class="clearfix">
                                                <div class="col-xs-12 col-sm-2 center skill">
                                                    <div class="easy-pie-chart percentage" data-percent="90" data-color="#428bca">
                                                        <span class="percent">90</span>%
                                                    </div>

                                                    <div class="space-2"></div>
                                                    PHP
                                                </div>

                                                <div class="col-xs-12 col-sm-2 center skill">
                                                    <div class="center easy-pie-chart percentage" data-percent="45" data-color="#CA5952">
                                                        <span class="percent">45</span>%
                                                    </div>

                                                    <div class="space-2"></div>
                                                    Graphic Design
                                                </div>

                                                <div class="col-xs-12 col-sm-2 center skill">
                                                    <div class="center easy-pie-chart percentage" data-percent="70" data-color="#FF9800">
                                                        <span class="percent">30</span>%
                                                    </div>

                                                    <div class="space-2"></div>
                                                    HTML5 & CSS3
                                                </div>

                                                <div class="col-xs-12 col-sm-2 center skill">
                                                    <div class="center easy-pie-chart percentage" data-percent="80" data-color="#CA42AD">
                                                        <span class="percent">80</span>%
                                                    </div>

                                                    <div class="space-2"></div>
                                                    HTML5 & CSS3
                                                </div>

                                                <div class="col-xs-12 col-sm-2 center skill">
                                                    <div class="center easy-pie-chart percentage" data-percent="60" data-color="#394557">
                                                        <span class="percent">60</span>%
                                                    </div>

                                                    <div class="space-2"></div>
                                                    HTML5 & CSS3
                                                </div>

                                                <div class="col-xs-12 col-sm-2 center skill">
                                                    <div class="center easy-pie-chart percentage" data-percent="80" data-color="#9585BF">
                                                        <span class="percent">80</span>%
                                                    </div>

                                                    <div class="space-2"></div>
                                                    Javascript/jQuery
                                                </div>
                                            </div>
                                            <div class="hr hr-16"></div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div><!-- /.row -->
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery.easypiechart.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var oldie = /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase());
        $('.easy-pie-chart.percentage').each(function() {
            $(this).easyPieChart({
                barColor: $(this).data('color'),
                trackColor: '#EEEEEE',
                scaleColor: false,
                lineCap: 'butt',
                lineWidth: 8,
                animate: oldie ? false : 1000,
                size: 75
            }).css('color', $(this).data('color'));
        });
        //        tooltip .........
        $('[data-rel=tooltip]').tooltip();
    });
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
        window.open('../../plugins/kcfinder/browse.php?dir=files/users/',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                'directories=0, resizable=1, scrollbars=0');
    }
</script>
