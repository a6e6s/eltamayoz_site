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
$item = $model->Get('settings', '*', " WHERE id = '6'");
$_contacts_array = (isset($item[0]['settings_values']) && !empty($item[0]['settings_values'])) ? unserialize(base64_decode($item[0]['settings_values'])) : array();
$_lat = (isset($_contacts_array['maplat'])) ? $_contacts_array['maplat'] : 0;
$_lng = (isset($_contacts_array['maplng'])) ? $_contacts_array['maplng'] : 0;
$zoom = (isset($_contacts_array['zoom'])) ? $_contacts_array['zoom'] : 10;
?>
<div class="main-container" id="main-container">
    <?php require ADMIN_PATH . DS . 'views' . DS . 'sidebar.php'; ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <!--<a href="<?php // echo ADMIN_URL;   ?>dashboard">Dashboard</a>-->
                    </li>
                    <li class="active">Settings</li>
                    <li class="active">Contacts</li>
                </ul><!-- /.breadcrumb -->
            </div>
            <div class="page-content">
                <div class="page-header">
                    <h1> Settings <small> <i class="ace-icon fa fa-angle-double-right"></i> Edit Contacts Data </small></h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <?php require ADMIN_PATH . DS . 'models/edit_contacts_model.php'; ?>
                        <script src="https://maps.googleapis.com/maps/api/js?signed_in=true&libraries=places&key=AIzaSyDtkWcgAdiU3Ui7os8D6jz2WS0HPatT-mU"></script>
                        <form class="form-horizontal" action="#" method="post">
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Map </label>
                                <div class="col-xs-12 col-sm-10">
                                    <div id='output'>
                                        <input type="hidden" name="maplat" id="latbox" value="<?php echo $_lat; ?>" lat="<?php echo $_lat; ?>" />
                                        <input type="hidden" name="maplng" id="lngbox" value="<?php echo $_lng; ?>" lng="<?php echo $_lng; ?>" />
                                        <input type="hidden" id="zoom" value="<?php echo $zoom; ?>" />
                                    </div>
                                    <div class="map-search">
                                        <div id="map-canvas"></div>
                                        <input id="pac-input" class="controls col-xs-12 col-sm-6" type="text" placeholder="Search Box">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Map Zoom </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="number" min="0" name="zoom" placeholder="10" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['zoom'])) ? $_contacts_array['zoom'] : 10; ?>" />
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
                                                    <input type="text" name="title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Page Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['page_title_' . $lang['alias']])) ? $_contacts_array['page_title_' . $lang['alias']] : ''; ?>" />
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
                                                <div id="info_title_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="info_title_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Information Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['info_title_' . $lang['alias']])) ? $_contacts_array['info_title_' . $lang['alias']] : ''; ?>" />
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
                                                <div id="address_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="address_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Address Title" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['address_' . $lang['alias']])) ? $_contacts_array['address_' . $lang['alias']] : ''; ?>" />
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
                                                <div id="work_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="work_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Work Times" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['work_' . $lang['alias']])) ? $_contacts_array['work_' . $lang['alias']] : ''; ?>" />
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
                                                <div id="holiday_<?php echo $lang['alias']; ?>" class="tab-pane fade in <?php echo ($num == 1) ? 'active' : null; ?>">
                                                    <input type="text" name="holiday_<?php echo $lang['alias']; ?>" id="form-field-1" placeholder="Holiday Times" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['holiday_' . $lang['alias']])) ? $_contacts_array['holiday_' . $lang['alias']] : ''; ?>" />
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
                                    <input type="text" name="mobile"  placeholder="Mobile Number" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['mobile'])) ? $_contacts_array['mobile'] : ''; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Phone Number </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="phone"  placeholder="Phone Number" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['phone'])) ? $_contacts_array['phone'] : ''; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-xs-12 col-sm-2"> Email </label>
                                <div class="col-xs-12 col-sm-10">
                                    <input type="text" name="email"  placeholder="Email" class="col-xs-12 col-sm-5" value="<?php echo (isset($_contacts_array['email'])) ? $_contacts_array['email'] : ''; ?>" />
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
<script>

    function initialize() {

        var lat = $('#latbox').val();
        var lng = $('#lngbox').val();
        var zz = parseInt($('#zoom').val());
        var myLatlng = new google.maps.LatLng(lat, lng);
        var mapOptions = {
            zoom: zz,
            mapTypeControl: false,
            center: myLatlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            }
        };
        var markers = [];
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var mar = new google.maps.Marker({
            position: myLatlng,
            map: map,
            draggable: true
        });
        $("#latbox").val(mar.getPosition().lat());
        $("#lngbox").val(mar.getPosition().lng());
        google.maps.event.addListener(mar, 'dragend', function (event) {
            $("#latbox").val(mar.getPosition().lat());
            $("#lngbox").val(mar.getPosition().lng());
        });
        // Create the search box and link it to the UI element.
        var input = /** @type {HTMLInputElement} */(
                document.getElementById('pac-input'));
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var searchBox = new google.maps.places.SearchBox(
                /** @type {HTMLInputElement} */(input));
        // Listen for the event fired when the user selects an item from the
        // pick list. Retrieve the matching places for that item.
        google.maps.event.addListener(searchBox, 'places_changed', function () {
            mar.setMap(null);
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
            }
            // For each place, get the icon, place name, and location.
            markers = [];
            var bounds = new google.maps.LatLngBounds();
            for (var i = 0, place; place = places[i]; i++) {
                var image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                // Create a marker for each place.
                var marker = new google.maps.Marker({
                    map: map,
                    draggable: true,
                    title: place.name,
                    position: place.geometry.location,
                });
                markers.push(marker);
                bounds.extend(place.geometry.location);
                $("#latbox").val(marker.getPosition().lat());
                $("#lngbox").val(marker.getPosition().lng());
                google.maps.event.addListener(marker, 'dragend', function (event) {
                    $("#latbox").val(marker.getPosition().lat());
                    $("#lngbox").val(marker.getPosition().lng());
                });
            }
            map.fitBounds(bounds);
        });
        // Bias the SearchBox results towards places that are within the bounds of the
        // current map's viewport.
        google.maps.event.addListener(map, 'bounds_changed', function () {
            var bounds = map.getBounds();
            searchBox.setBounds(bounds);
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);

</script>