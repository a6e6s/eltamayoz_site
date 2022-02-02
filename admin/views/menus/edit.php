<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<?php
$model = new model();
if (!isset($id) || empty($id) || !is_numeric($id)) {
    $session->message('sorry .. This page Not Found .', 'alert alert-danger');
    $model->redirect_to(ADMIN_URL . 'menus/items');
} else {
    $languages = $model->Get('languages', 'name,alias,direction,flag', null, 'id', 'ASC');
    if (!is_array($languages)) {
        $session->message('sorry .. please create any language Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'menus/items');
    }

    $sites = $model->Get('sites', 'id,name,alias', ' ', 'id', 'ASC');
    if (!is_array($sites)) {
        $session->message('sorry .. please create any Site Before create a new .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'sites');
    }
    $links = $model->Get_Multilevel('menus', 'id,title,menu,level,site_id', " WHERE parent_id = 0");
    $pages = $model->Get('pages', 'id,title,alias,site_id');
    // get item details ...........
    $item = $model->Get('menus', '*', " WHERE id = '" . $id . "'");
    if (!is_array($item)) {
        $session->message('sorry .. This page Not Found .', 'alert alert-danger');
        $model->redirect_to(ADMIN_URL . 'menus/items');
    } else {
        $_title_array = (isset($item[0]['title'])) ? unserialize(base64_decode($item[0]['title'])) : array();
        $_status = (isset($item[0]['status'])) ? $item[0]['status'] : 0;
        $_site_id = (isset($item[0]['site_id'])) ? $item[0]['site_id'] : 0;
        $_menu_site_id = (isset($item[0]['menu_site_id'])) ? $item[0]['menu_site_id'] : 0;
        $_menu = (isset($item[0]['menu'])) ? $item[0]['menu'] : 'm';
        $_type = (isset($item[0]['type'])) ? $item[0]['type'] : 'internal';
        $_url = (isset($item[0]['url'])) ? $item[0]['url'] : '';
        $_page_alias = (isset($item[0]['page_alias'])) ? $item[0]['page_alias'] : '';
        $_parent_id = isset($item[0]['parent_id']) ? $item[0]['parent_id'] : 0;
        $_level = isset($item[0]['level']) ? $item[0]['level'] : 1;
        $_created = (isset($item[0]['created']) && $item[0]['created'] != 0) ? date('d/m/Y   h:i A', $item[0]['created']) : 'No Date';
        $_modified = (isset($item[0]['modified']) && $item[0]['modified'] != 0) ? date('d/m/Y   h:i A', $item[0]['modified']) : 'Not Modified';
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
                        <!--<a href="<?php // echo ADMIN_URL;                          ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active"><a href="<?php echo ADMIN_URL; ?>menus/items">Menus</a></li>
                    <li class="active">Edit Link</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Menus <small> <i class="ace-icon fa fa-angle-double-right"></i> <?php echo $_title_array['en']; ?> </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/chosen.min.css" />
                        <?php require ADMIN_PATH . DS . 'models/edit_menu_model.php'; ?>
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
                                                <div id="<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?> <?php echo $lang['direction']; ?>">
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Link Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_title_array[$lang['alias']])) ? $_title_array[$lang['alias']] : ''; ?>" />
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
                                    <input name="status" class="ace ace-switch ace-switch-2" type="checkbox" <?php echo ($_status != 0) ? 'checked' : null; ?> />
                                    <span class="lbl"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12 col-sm-2"> Site </div>
                                <div class="col-xs-12 col-sm-4">
                                    <select id="site" name="site_id" class="chosen-select form-control" data-placeholder="Choose Site ...">
                                        <?php
                                        $sites_ids_m = '';
                                        $sites_ids_f = '';
                                        if (is_array($sites)) {
                                            foreach ($sites as $site) {
                                                $site_id = (isset($site['id'])) ? $site['id'] : '';
                                                $site_name = (isset($site['name'])) ? unserialize(base64_decode($site['name'])) : '';
                                                $site_alias = (isset($site['alias'])) ? $site['alias'] : '';
                                                $sites_ids_m .= ' ' . $site_id . '\\m';
                                                $sites_ids_f .= ' ' . $site_id . '\\f';
                                                ?>
                                                <option value="<?php echo $site_id; ?>" <?php echo ($site_id == $_site_id) ? 'selected' : null; ?>><?php echo $site_name['site_name_en']; ?></option>
                                                <?php
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
                                        <option value="m" <?php echo ($_menu == 'm') ? 'selected' : null; ?> >Main Menu</option>
                                        <option value="f" <?php echo ($_menu == 'f') ? 'selected' : null; ?> >Footer Menu</option>
                                    </select>
                                </div>
                            </div>
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
                                                if ($link_id == $id) {
                                                    continue;
                                                }
                                                ?>
                                                <option value="<?php echo $link_id; ?>" class="<?php echo $site_id . '\\' . $link_menu; ?>" <?php echo ($link_id == $_parent_id) ? 'selected' : null; ?> ><?php echo $link_name; ?></option>
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
                                        <input type="text" name="order" id="spinner1" value="<?php echo $_level; ?>" />
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
                                        <option value="internal" <?php echo ($_type == 'internal') ? 'selected' : null; ?>>Internal Link</option>
                                        <option value="external" <?php echo ($_type == 'external') ? 'selected' : null; ?> >External Link</option>
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
                                                            <option value="<?php echo $site_id; ?>" <?php echo ($site_id == $_menu_site_id) ? 'selected' : null; ?> alias="<?php echo $site_alias . '/'; ?>"><?php echo $site_name['site_name_en']; ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $site_id; ?>" <?php echo ($site_id == $_menu_site_id) ? 'selected' : null; ?> alias=""><?php echo $site_name['site_name_en']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="clearfix col-xs-12 space-10"></div>
                                        <div class="col-xs-12 col-sm-2"> Page </div>
                                        <div class="col-xs-12 col-sm-10">
                                            <select id="pages" name="page" class="chosen-select form-control"  data-placeholder="Choose Page ...">
                                                <option value="" class="1">Home</option>
                                                <option value="blog" class="1" <?php echo ($_page_alias == 'blog') ? 'selected' : null; ?>>Blog</option>
                                                <option value="quiz" class="1" <?php echo ($_page_alias == 'quiz') ? 'selected' : null; ?>>Quiz</option>
                                                <option value="requests" class="<?php echo $all_sites; ?>" <?php echo ($_page_alias == 'requests') ? 'selected' : null; ?>>Requests</option>
                                                <option value="contact_us" class="<?php echo $all_sites; ?>" <?php echo ($_page_alias == 'contact_us') ? 'selected' : null; ?>>Contact Us</option>
                                                <option value="works" class="<?php echo $all_sites; ?>" <?php echo ($_page_alias == 'works') ? 'selected' : null; ?>>Works</option>
                                                <?php
                                                if (is_array($pages)) {
                                                    foreach ($pages as $page) {
                                                        $page_id = (isset($page['id'])) ? $page['id'] : 0;
                                                        $page_site_id = (isset($page['site_id'])) ? $page['site_id'] : 0;
                                                        $page_alias = (isset($page['alias'])) ? $page['alias'] : '';
                                                        $page_title_array = (isset($page['title'])) ? unserialize(base64_decode($page['title'])) : array();
                                                        $page_title = isset($page_title_array['en']) ? $page_title_array['en'] : '';
                                                        ?>
                                                        <option value=<?php echo $page_alias; ?> class="<?php echo $page_site_id; ?>" <?php echo ($page_alias == $_page_alias ) ? 'selected' : null; ?> ><?php echo $page_title; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="clearfix col-xs-12 space-10"></div>
                                            <a class="add_new_link col-xs-12 col-sm-6" href="javascript:voide(0);">Add Link</a>
                                            <a class="old_link col-xs-12 col-sm-6" href="javascript:voide(0);" old="<?php echo $_url; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                    <div class="row col-xs-12 link">
                                        <div class="link_1_type internal_input">
                                            <h4 class="row col-xs-12 col-sm-3"><?php echo URL . 'ar/'; ?><span><?php echo $_url; ?></span></h4>
                                            <input type="hidden" name="link" placeholder="http://" class="col-xs-12 col-sm-10" value="<?php echo $_url; ?>" />
                                            <a class="old_link col-xs-12 col-sm-2" href="javascript:voide(0);" old="<?php echo $_url; ?>" >Old Link</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
