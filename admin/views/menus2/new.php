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
    $model->redirect_to(ADMIN_URL . 'menus/items');
}
$sites = $model->Get('sites', 'id,name,alias');
if (!is_array($sites)) {
    $session->message('sorry .. please create any Site Before create a new .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'sites');
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
                        <!--<a href="<?php // echo ADMIN_URL;         ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>menus/items">Menus</a></li>
                    <li class="active">New Link</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Menus <small> <i class="ace-icon fa fa-angle-double-right"></i> Create New Link </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/new_menu_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Title </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL . 'images/files/flags/' . $lang['flag']; ?>" />
                                                        <?php echo $lang['name']; ?>
                                                    </a>
                                                </li>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <div id="<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Link Title" class="col-xs-12 col-sm-5" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Link Title in <?php echo $lang['name']; ?></span>
                                                    </span>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <?php
                                                $num++;
                                            }
                                            ?>
                                        </div>
                                    </div>
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
                                <?php $sites = $model->Get('sites', 'id,name,alias') ?>
                                <div class="col-xs-12 col-sm-2"> Site </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="site" name="site_id" class="chosen-select form-control" data-placeholder="Choose Site ...">
                                        <?php
                                        $sites_ids_m = '';
                                        $sites_ids_f = '';
                                        if (is_array($sites)) {
                                            foreach ($sites as $site) {
                                                if ($site['id'] != 1) {
                                                    $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                    $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                    $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                    $sites_ids_m .= ' ' . $site_id . '\\m';
                                                    $sites_ids_f .= ' ' . $site_id . '\\f';
                                                    ?>
                                                    <option value="<?php echo $site_id; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-2"> Menu </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="menu" name="menu" class="chosen-select form-control" data-placeholder="Choose Menu ...">
                                        <option value="m">Main Menu</option>
                                        <option value="f" >Footer Menu</option>
                                    </select>
                                </div>
                            </div>
                            <?php $links = $model->Get_Multilevel('menus', 'id,title,menu,level,site_id', " WHERE parent_id = 0"); ?>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-2"> Parent </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="parent" name="parent_id" class="chosen-select form-control"  data-placeholder="Choose Parent Link ...">
                                        <option value="m" class="<?php echo $sites_ids_m; ?>">This is Parent</option>
                                        <option value="f" class="<?php echo $sites_ids_f; ?>">This is Parent</option>
                                        <?php
                                        if (is_array($links)) {
                                            foreach ($links as $link) {
                                                $link_id = (isset($link['id'])) ? $link['id'] : 0;
                                                $link_title_array = (isset($link['title'])) ? unserialize(base64_decode($link['title'])) : array();
                                                $link_name = isset($link_title_array['en']) ? $link_title_array['en'] : '';
                                                $site_id = isset($link['site_id']) ? $link['site_id'] : null;
                                                $link_menu = (isset($link['menu'])) ? $link['menu'] : 'm';
                                                $sub_parent_levels[$link_id] = $model->Count_Rows('menus', " WHERE parent_id = '" . $link_id . "'");
                                                ?>
                                                <option value="<?php echo $link_id; ?>" class="<?php echo $site_id . '\\' . $link_menu; ?>" ><?php echo $link_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Order </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="row col-xs-12 col-sm-2">
                                        <input type="text" name="order" id="spinner1" value="1" />
                                    </div>
                                    <span class="help-inline col-xs-12 col-sm-7">
                                        <span class="middle">The Order of items </span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-2"> Type Link </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="link-type" name="type" class="chosen-select form-control link_type"  data-placeholder="Choose Type Link ...">
                                        <option value="internal" >Internal Link</option>
                                        <option value="external" >External Link</option>
                                    </select>
                                    <div class="clearfix"></div>
                                    <div class="clearfix col-xs-12 space-10"></div>
                                    <div class="pages">
                                        <div class="col-xs-12 col-sm-2"> Site </div>
                                        <div class="col-xs-12 col-sm-10">
                                            <select id="sites" name="menu_site" class="chosen-select form-control sites" data-placeholder="Choose Site ...">
                                                <?php
                                                $all_sites = '';
                                                if (is_array($sites)) {
                                                    foreach ($sites as $site) {
                                                        $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                        $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                        $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                        if ($site_id != 1) {
                                                            $all_sites .= $site_id . ' ';
                                                            ?>
                                                            <option value="<?php echo $site_id; ?>" alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $site_id; ?>" alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="clearfix col-xs-12 space-10"></div>
                                        <div class="col-xs-12 col-sm-2"> Page </div>
                                        <div class="col-xs-12 col-sm-10">
                                            <?php $pages = $model->Get('pages', 'id,title,alias,site_id'); ?>
                                            <select id="pages" name="page" class="chosen-select form-control"  data-placeholder="Choose Page ...">
                                                <option value="" class="1">Home</option>
                                                <option value="blog" class="1">Blog</option>
                                                <option value="quiz" class="1">Quiz</option>
                                                <option value="requests" class="<?php echo $all_sites; ?>">Requests</option>
                                                <option value="contact_us" class="<?php echo $all_sites; ?>">Contact Us</option>
                                                <option value="works" class="<?php echo $all_sites; ?>">Works</option>
                                                <?php
                                                if (is_array($pages)) {
                                                    foreach ($pages as $page) {
                                                        $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                        $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                        $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                        $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                        $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                        ?>
                                                        <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" ><?php echo $page_title; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                        </div>
                                    </div>
                                    <div class="row col-xs-12 link">
                                        <div class="link_1_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span></span></h4>
                                            <input type="hidden" name="link" placeholder="http://" class="col-xs-12 col-sm-10" value="" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_back">Save & Back</label>
                                <input type="submit" id="save_back" name="save&back" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save_new">Save & New</label>
                                <input type="submit" id="save_new" name="save&new" />    
                            </div>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <a class="btn  btn-danger col-xs-12" for="submit" href="<?php echo ADMIN_URL; ?>menus/items">Cancel</a>

                            </div>

                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script type="text/javascript" src="<?php echo ADMIN_URL ?>templates/js/chosen.jquery.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL; ?>templates/js/jquery.chained.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL; ?>templates/js/fuelux.spinner.min.js"></script>
<script type="text/javascript">
//chosen-select ...............
    jQuery(function ($) {
        $('#spinner1').ace_spinner({value: 0, min: 1, max: 1000, step: 1, btn_up_class: 'btn-info', btn_down_class: 'btn-info'})
    });
    $('.chosen-select').chosen({allow_single_deselect: true});

    $("#parent").chained("#menu,#site");
    $("#parent").trigger("chosen:updated");
    $("#pages").chained("#sites");
    $("#pages").trigger("chosen:updated");
    $("#menu,#site").on("change", function () {
        $("#parent").trigger("chosen:updated")
    });
    $("#sites").on("change", function () {
        $("#pages").trigger("chosen:updated")
    });
// link 1
    $('.link_type').change(function () {
        var link_type = $('#link-type').val();
        if (link_type === 'external')
        {
            $('.pages').slideUp();
            $('.link h4').hide();
            $('.link .old_link').show();
            $('.link input').prop('type', 'text');
            $('.link input').prop('readonly', false);
        } else
        {
            $('.pages').slideDown();
            $('.link h4').show();
            $('.link .old_link').hide();
            $('.link input').prop('type', 'hidden');
            $('.link input').prop('readonly', true);
        }
    });
    var link_type = $('#link-type').val();
    if (link_type === 'external')
    {
        $('.pages').slideUp();
        $('.link h4').hide();
        $('.link .old_link').show();
        $('.link input').prop('type', 'text');
        $('.link input').prop('readonly', false);
    } else
    {
        $('.pages').slideDown();
        $('.link h4').show();
        $('.link .old_link').hide();
        $('.link input').prop('type', 'hidden');
        $('.link input').prop('readonly', true);
    }
    var site = $("#sites option:selected").attr('alias');
    var page = $("#pages option:selected").val();
    $('#sites').change(function () {
        site = $("#sites option:selected").attr('alias');
    });
    $('#pages').change(function () {
        page = $("#pages option:selected").val();
    });
    $('a.add_new_link').click(function () {
        $('.link input').val(site + page);
        $('.link h4 span').text(site + page);
    });
    $('a.old_link').click(function () {
        var old_link = $(this).attr('old');
        $('.link input').val(old_link);
        $('.link h4 span').text(old_link);
    });

</script>
