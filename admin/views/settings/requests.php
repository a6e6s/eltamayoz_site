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
    $model->redirect_to(ADMIN_URL . 'languages/items');
}
$item = $model->Get('settings', '*', " WHERE id = '9'");
$_requests_array = (isset($item[0]['settings_values']) && !empty($item[0]['settings_values'])) ? unserialize(base64_decode($item[0]['settings_values'])) : array();
$_header_image = isset($_requests_array['header_image']) ? $_requests_array['header_image'] : '';
$_header_image_opacity = isset($_requests_array['header_image_opacity']) ? $_requests_array['header_image_opacity'] : 1;
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
                    <li class="active">Settings</li>
                    <li class="active">Requests</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Settings <small> <i class="ace-icon fa fa-angle-double-right"></i> Edit Requests Data </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php require ADMIN_PATH . DS . 'models/edit_requests_model.php'; ?>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Header Image </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 btn btn-success  uploader-box">
                                        <div onclick="openKCFinder(this)">
                                            <?php
                                            if (!empty($_header_image)) {
                                                ?>
                                                <img src="<?php echo URL . 'images/files/requests/' . $_header_image; ?>" />
                                                <input name="image" type="hidden" value="<?php echo $_header_image; ?>"/>
                                                <?php
                                            } else {
                                                echo 'Click here to upload image';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if (!empty($_image)) {
                                            ?>
                                            <i onclick="delete_img(this)" class="delete_img fa fa-times fa-lg" title="delete this photo"></i>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                            <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>templates/css/jquery-ui.custom.min.css" />
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Image Opacity </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="col-xs-12 row" id="slider-eq">
                                        <span class="col-xs-10 col-sm-7 row">
                                            <span class="ui-slider-simple ui-slider-dark"></span>
                                        </span>
                                        <span class="help-inline col-xs-2">
                                            <span class="label label-inverse"><?php echo $_header_image_opacity; ?></span>
                                        </span>
                                        <input class="hidden col-xs-3" type="text" name="opacity" data-min="0.00" data-max="1.01" data-step="0.01" value="<?php echo $_header_image_opacity; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Page Title </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL. 'images/files/flags/' . $lang['flag']; ?>" />
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Page Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['page_title_' . $lang['alias']])) ? $_requests_array['page_title_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Page Title in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Services </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#services_<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL. 'images/files/flags/' . $lang['flag']; ?>" />
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
                                                <div id="services_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="services_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="ex: Design , Development , Mobile App" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['services_' . $lang['alias']])) ? $_requests_array['services_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Services in <?php echo $lang['name'].'<br/> Make sure there is a comma (,) between each service <br/> <strong>ex: Design , Development , Mobile App</strong>'; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Info Title </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#info_title_<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL. 'images/files/flags/' . $lang['flag']; ?>" />
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
                                                <div id="info_title_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="info_title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Information Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['info_title_' . $lang['alias']])) ? $_requests_array['info_title_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Information Title in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Address </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#address_<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL. 'images/files/flags/' . $lang['flag']; ?>" />
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
                                                <div id="address_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="address_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Address Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['address_' . $lang['alias']])) ? $_requests_array['address_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Address in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Work Times </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#work_<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL. 'images/files/flags/' . $lang['flag']; ?>" />
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
                                                <div id="work_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="work_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Times" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['work_' . $lang['alias']])) ? $_requests_array['work_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Work Times in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Holiday Times </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div class="tabbable">
                                        <ul class="nav nav-tabs" id="myTab">
                                            <?php
                                            $num = 1;
                                            foreach ($languages as $lang) {
                                                ?>
                                                <li class="<?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <a data-toggle="tab" href="#holiday_<?php echo $lang['alias']; ?>">
                                                        <img src="<?php echo URL. 'images/files/flags/' . $lang['flag']; ?>" />
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
                                                <div id="holiday_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="holiday_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Holiday Times" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['holiday_' . $lang['alias']])) ? $_requests_array['holiday_' . $lang['alias']] : ''; ?>" />
                                                    <span class="help-inline col-xs-12 col-sm-7">
                                                        <span class="middle">Enter Holiday Times in <?php echo $lang['name']; ?></span>
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
                                <label class="col-xs-12 col-sm-2"> Mobile Number </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="mobile"  placeholder="Mobile Number" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['mobile'])) ? $_requests_array['mobile'] : ''; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Phone Number </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="phone"  placeholder="Phone Number" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['phone'])) ? $_requests_array['phone'] : ''; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Email </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="email"  placeholder="Email" class="col-xs-12 col-sm-5" value="<?php echo (isset($_requests_array['email'])) ? $_requests_array['email'] : ''; ?>" />
                                </div>
                            </div>
                            <hr>
                            <div class="col-xs-12 col-sm-2 clearfix">
                                <label class="btn  btn-primary col-xs-12" for="save">Save</label>
                                <input type="submit" id="save" name="save" />    
                            </div>
                        </form>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
</div><!-- /.main-container -->
<script src="<?php echo ADMIN_URL; ?>templates/js/jquery-ui.custom.min.js"></script>
<script>
                                                jQuery(function($) {
                                                    
//
                                                    $("#slider-eq .ui-slider-simple").css({'width': '90%', 'float': 'left', 'margin-top': '5px'}).each(function() {
                                                        // read initial values from markup and remove that
                                                        var $this = $("#slider-eq input[type=text]");
                                                        var $this2 = $("#slider-eq .label");
                                                        var value = $this.val();
                                                        $(this).empty().slider({
                                                            value: value,
                                                            range: "min",
                                                            animate: true,
                                                            min: parseFloat($this.attr('data-min')),
                                                            max: parseFloat($this.attr('data-max')),
                                                            step: parseFloat($this.attr('data-step')),
                                                            slide: function(event, ui) {
                                                                $this.val(ui.value);
                                                                $this2.text(ui.value);
                                                            }
                                                        });
                                                    });
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
                                                    window.open('../plugins/kcfinder/browse.php?dir=files/requests/',
                                                            'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                                                            'directories=0, resizable=1, scrollbars=0');
                                                }
</script>