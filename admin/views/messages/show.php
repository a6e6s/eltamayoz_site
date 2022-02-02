<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'messages/items');
} else {
    // get item details ...........
    $item = $model->Get('contacts', '*', " WHERE id = '" . $id . "' ");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'messages/items');
    } else {
        $_name = (isset($item[0]['name'])) ? $item[0]['name'] : '';
        $_email = (isset($item[0]['email'])) ? $item[0]['email'] : '';
        $_phone = (isset($item[0]['phone'])) ? $item[0]['phone'] : '';
        $_message = (isset($item[0]['message'])) ? $model->new_line($item[0]['message']) : '';
        $_readable = (isset($item[0]['readable'])) ? $item[0]['readable'] : 0;
        $_created = (isset($item[0]['created']) && $item[0]['created'] != 0) ? date('d-m-Y   h:i A', $item[0]['created']) : 'No Date';
    }
    $read = array('readable' => '1');
    $change_readable = $model->NewUpdate('messages', $read, " WHERE id = '" . $id . "' ");
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
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>messages">Contacts</a></li>
                    <li class="active">Message</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Contacts <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo 'Message From  ' . $_name; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="profile-user-info">
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Name </div>
                                <div class="profile-info-value">
                                    <span><?php echo $_name; ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Email </div>
                                <div class="profile-info-value">
                                    <span><?php echo $_email; ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Phone </div>
                                <div class="profile-info-value">
                                    <span><?php echo $_phone; ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Time </div>
                                <div class="profile-info-value">
                                    <span><?php echo $_created; ?></span>
                                </div>
                            </div>
                            <div class="profile-info-row">
                                <div class="profile-info-name"> Message </div>
                                <div class="profile-info-value">
                                    <span><?php echo $_message; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix space-18"></div>

                        <div class="col-xs-12 col-sm-2 clearfix">
                            <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>messages">Back</a>

                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
