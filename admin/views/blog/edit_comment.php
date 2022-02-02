<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'comments/items');
} else {
    // get item details ...........
    $where = " WHERE comments.id = '" . $id . "' AND comments.article_id = articles.id ";
    $select = " comments.*,articles.title ";
    $item = $model->Get('articles,comments', $select, $where);
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'comments/items');
    } else {
        $_comment = (isset($item[0]['comment'])) ? $model->filtrate($model->Delete_Lines($item[0]['comment'])) : '';
        $_author_id = (isset($item[0]['user_id'])) ? $item[0]['user_id'] : 0;
        $_author_name = (isset($item[0]['username'])) ? $item[0]['username'] : '';
        $_article_id = (isset($item[0]['article_id'])) ? $item[0]['article_id'] : 0;
        $_article_array = (isset($item[0]['title'])) ? unserialize($item[0]['title']) : array();
        $_article = (is_array($_article_array)) ? $_article_array['en'] : '';
        $_readable = (isset($item[0]['readable'])) ? $item[0]['readable'] : 0;
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_created = (isset($item[0]['created']) && $item[0]['created'] != 0) ? date('d-m-Y   h:i A', $item[0]['created']) : 'No Date';
        $_modified = (isset($item[0]['modified']) && $item[0]['modified'] != 0) ? date('d-m-Y   h:i A', $item[0]['modified']) : 'Not Modified';
    }
    $read = array('readable' => '1');
    $change_readable = $model->NewUpdate('comments', $read, " WHERE id = '".$id."' ");
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
                    <li class="active">Blog</li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>blog/comments">Comments</a></li>
                    <li class="active">Edit Comment</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Blog <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo 'Comment related to '.$_author_name; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php require ADMIN_PATH . DS . 'models/edit_comment_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Article </label>
                                <div class="col-xs-12 col-sm-10">
                                    <a href="<?php echo ADMIN_URL . 'blog/edit_article/' . $_article_id; ?>"><?php echo $_article; ?></a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Author </label>
                                <div class="col-xs-12 col-sm-10">
                                    <?php
                                    if ($_author_id == 0) {
                                        echo $_author_name;
                                    } else {
                                        ?>
                                        <a href="<?php echo ADMIN_URL . 'users/profile/' . $_author_id; ?>"><?php echo $_author_name; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Comment </label>
                                <div class="col-xs-12 col-sm-10">
                                    <textarea name="comment" rows="10" cols="10" class="form-control" placeholder="Write Comment Here ..."><?php echo $_comment; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> status </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input name="status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Created </label>
                                <span class="help-inline col-xs-12 col-sm-7">
                                    <span class="middle"><?php echo $_created; ?></span>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Modified </label>
                                <span class="help-inline col-xs-12 col-sm-7">
                                    <span class="middle"><?php echo $_modified; ?></span>
                                </span>
                            </div>

                            <hr>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save">Save</label>
                                <input type="submit" id="save" name="save" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save&back">Save & Back</label>
                                <input type="submit" id="save&back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>blog/comments">Cancel</a>

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
                    var img = document.getElementById('img');
                    var o_w = img.offsetWidth;
                    var o_h = img.offsetHeight;
                    var f_w = div.offsetWidth;
                    var f_h = div.offsetHeight;
                    if ((o_w > f_w) || (o_h > f_h)) {
                        if ((f_w / f_h) > (o_w / o_h))
                            f_w = parseInt((o_w * f_h) / o_h);
                        else if ((f_w / f_h) < (o_w / o_h))
                            f_h = parseInt((o_h * f_w) / o_w);
                        img.style.width = f_w + "px";
                        img.style.height = f_h + "px";
                    } else {
                        f_w = o_w;
                        f_h = o_h;
                    }
                    img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                    img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                    img.style.visibility = "visible";
                };
            }
        };
        window.open('../../plugins/kcfinder/browse.php?dir=files/comments/',
                'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                'directories=0, resizable=1, scrollbars=0');
    }
</script>
