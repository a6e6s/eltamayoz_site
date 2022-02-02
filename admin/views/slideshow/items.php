<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
$model = new model();
$items = $model->Get('slideshow', 'id,title,image,status');
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
                    <li class="active">Clients</li>
                    <li class="active">Items</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1 class="col-xs-12 col-sm-10"> Clients
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List of Clients
                        </small>
                    </h1>
                    <a href="<?php echo ADMIN_URL; ?>slideshow/new_item" class="btn btn-success col-xs-12 col-sm-2 btn-sm">New </a>
                    <div class="clearfix"></div>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/colorbox.min.css" />
                        <?php
                        echo (!empty($session->message)) ? $session->message : null;
                        if (is_array($items)) {
                            ?>
                            <ul class="ace-thumbnails clearfix">
                                <?php
                                foreach ($items as $item) {
                                    $title_array = (isset($item['title'])) ? unserialize(base64_decode($item['title'])) : '';
                                    $title = (is_array($title_array)) ? $title_array['en'] : '';
                                    $summary_title = $model->Cut_Words($title, 0, 35, 'yes');
                                    $selected = "slideshow_tags.id,slideshow_tags.name,slideshow_relation_tags.tag_id";
                                    $where = " WHERE slideshow_relation_tags.work_id = '" . $item['id'] . "' AND slideshow_relation_tags.tag_id = slideshow_tags.id";
                                    $tags = $model->Get('slideshow_tags,slideshow_relation_tags', $selected, $where,'id', 'DESC','0','6');
                                    ?>
                                    <li class="col-xs-12 col-sm-3">
                                        <a href="<?php echo URL . 'images/files/slideshow/' . $item['image']; ?>" data-rel="colorbox" class="col-xs-12">
                                            <img alt="<?php echo $title; ?>" src="<?php echo URL . 'images/files/slideshow/' . $item['image']; ?>" />
                                        </a>
                                        <div class="tags">
                                            <?php
                                            if (is_array($tags)) {
                                                foreach ($tags as $tag) {
                                                    $tag_title_array = (isset($tag['name'])) ? unserialize($tag['name']) : array();
                                                    $tag_title = (is_array($tag_title_array)) ? $tag_title_array['en'] : '';
                                                    $summary_tag_title = $model->Cut_Words($tag_title, 0, 35, 'yes');
                                                    ?>
                                                    <span class="label-holder">
                                                        <a href="<?php echo ADMIN_URL.'slideshow/edit_tag/'.$tag['id']; ?>" class="label label-info arrowed"><?php echo $summary_tag_title; ?></a>
                                                    </span>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                        <div class="col-xs-12 title">
                                            <?php echo $summary_title; ?>
                                            <div class="tools tools-top">
                                                <i class="blue ace-icon fa fa-info-circle" data-rel="tooltip" data-placement="bottom" title="<?php echo $title; ?>"></i>
                                                <a href="#" value="<?php echo $item['id']; ?>" data-rel="tooltip" data-placement="bottom" title="<?php echo ($item['status'] == 0) ? 'UnPublished' : 'Published'; ?>" onclick="action(this)" status="<?php echo ($item['status'] == 0) ? 'publish' : 'unpublish'; ?>" >
                                                    <i class="ace-icon fa <?php echo ($item['status'] == 0) ? 'fa-minus-circle red' : 'fa-check green'; ?>"></i>
                                                </a>
                                                <a href="<?php echo ADMIN_URL . 'slideshow/edit_item/' . $item['id']; ?>" data-rel="tooltip" data-placement="bottom" title="Edit">
                                                    <i class="ace-icon fa fa-pencil green"></i>
                                                </a>
                                                <a href="#" onclick="action(this)" status="delete" value="<?php echo $item['id']; ?>"  data-rel="tooltip" data-placement="bottom" title="Delete">
                                                    <i class="ace-icon fa fa-trash-o red"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger">Sorry, There are no results.</div>
                            <?php
                        }
                        ?>


                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script src="<?php echo ADMIN_URL ?>templates/js/ace-elements.min.js"></script>
<script type="text/javascript">
                                                    jQuery(function($) {
                                                        var $overflow = '';
                                                        var colorbox_params = {
                                                            rel: 'colorbox',
                                                            reposition: true,
                                                            scalePhotos: true,
                                                            scrolling: false,
                                                            previous: '<i class="ace-icon fa fa-arrow-left"></i>',
                                                            next: '<i class="ace-icon fa fa-arrow-right"></i>',
                                                            close: '<i class="ace-icon fa fa-times-circle fa-lg"></i>',
                                                            current: '{current} of {total}',
                                                            maxWidth: '100%',
                                                            maxHeight: '100%',
                                                            onOpen: function() {
                                                                $overflow = document.body.style.overflow;
                                                                document.body.style.overflow = 'hidden';
                                                            },
                                                            onClosed: function() {
                                                                document.body.style.overflow = $overflow;
                                                            },
                                                            onComplete: function() {
                                                                $.colorbox.resize();
                                                            }
                                                        };

                                                        $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
                                                        $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon


                                                        $(document).one('ajaxloadstart.page', function(e) {
                                                            $('#colorbox, #cboxOverlay').remove();
                                                        });
                                                        $('[data-rel=tooltip]').tooltip();
                                                    });
//    actions ........
                                                    function action(anchor) {
                                                        var id = anchor.getAttribute('value');
                                                        var action = anchor.getAttribute('status');
                                                        if (action == 'delete')
                                                        {
                                                            var x = confirm(' Do you want to delete ? ');
                                                            if (x == true)
                                                            {
                                                                $.get("<?php echo ADMIN_URL ?>views/slideshow/action.php?status=1&action=" + action + "&id=" + id, function(dd) {
                                                                    location.reload();
                                                                });
                                                            }
                                                        } else
                                                        {
                                                            $.get("<?php echo ADMIN_URL ?>views/slideshow/action.php?status=1&action=" + action + "&id=" + id, function(dd) {
                                                                location.reload();
                                                            });
                                                        }
                                                    }
                                                    $(function() {
                                                        $('.action').click(function() {
                                                            var action = $(this).attr('action');
                                                            var val = [];
                                                            $(':checkbox:checked').each(function(i) {
                                                                val[i] = $(this).val();
                                                            });
                                                            var id = val;
                                                            if (id.length == 0)
                                                            {
                                                                alert('Please choose at least one element of the command is executed');
                                                            } else
                                                            {
                                                                if (action == 'delete')
                                                                {
                                                                    var x = confirm(' Do you want to delete ? ');
                                                                    if (x == true)
                                                                    {
                                                                        $.get("<?php echo ADMIN_URL ?>views/slideshow/action.php?action=" + action + "&id=" + id, function(dd) {
                                                                            location.reload();
                                                                        });
                                                                    }
                                                                } else
                                                                {
                                                                    $.get("<?php echo ADMIN_URL ?>views/slideshow/action.php?action=" + action + "&id=" + id, function(dd) {
                                                                        location.reload();
                                                                    });
                                                                }
                                                            }
                                                        });
                                                    });
</script>
