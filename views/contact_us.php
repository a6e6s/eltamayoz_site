
<div id="page-content">
    <!--map-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script>
        function initialize() {
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var zz = parseInt($('#zoom').val());
            var myLatlng = new google.maps.LatLng(lat, lng);
            var mapOptions = {
                zoom: zz,
                center: myLatlng,
                scrollwheel: false
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: '../../templates/images/marker.png'
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <input type="hidden" id="lat" value="<?php echo $site_settings->maplat; ?>" />
    <input type="hidden" id="lng" value="<?php echo $site_settings->maplng; ?>" />
    <input type="hidden" id="zoom" value="<?php echo $site_settings->zoom; ?>" />
    <section class="row map" id="map"></section>
    <!--End map-->
    <!--contacts-->
    <section class="row page-content" id="contacts">
        <div class="container">
            <div class="heading2">
                <h1 class="wow zoomIn" data-wow-delay=".5s"><?php echo $site_settings->page_contacts_title; ?></h1>
                <div class="line"><span></span><span></span></div>
            </div>
            <?php
            $_email_from_name = $site_settings->email_from_name . '<br>';
            $_email_from_address = $site_settings->email_from_address . '<br>';
            $_email = (isset($site_settings->email) && !empty($site_settings->email)) ? explode(',', $site_settings->email) : array();
            $_SMTP_auth = $site_settings->SMTP_auth . '<br>';
            $_SMTP_secure = $site_settings->SMTP_secure . '<br>';
            $_SMTP_server = $site_settings->SMTP_server . '<br>';
            $_SMTP_port = $site_settings->SMTP_port . '<br>';
            $_SMTP_username = $site_settings->SMTP_username . '<br>';
            $_SMTP_password = $site_settings->SMTP_password . '<br>';

            if (isset($_POST['submit']) AND !empty($_POST['submit'])) {
                $errors = array();

                $f_name = (isset($_POST['full_name']) && !empty($_POST['full_name'])) ? $models->filtrate($_POST['full_name']) : $errors[] = $language->PLZ_Enter_Name;
                $se_email = (isset($_POST['email']) && !empty($_POST['email'])) ? $models->filtrate($_POST['email']) : $errors[] = $language->PLZ_Enter_Email;
                $se_phone = (isset($_POST['phone']) && !empty($_POST['phone'])) ? $models->filtrate($_POST['phone']) : '';
                $se_message = (isset($_POST['message']) && !empty($_POST['message'])) ? $models->filtrate($_POST['message']) : $errors[] = $language->PLZ_Enter_Message;
                (isset($_POST['verify']) && $_SESSION['verify'] == $_POST['verify']) ? null : $errors[] = $language->Captcha_Incorrect;
                if (empty($errors)) {
                    require PATH_BASE . DS . 'scripts/PHPMailer/class.phpmailer.php';
                    require PATH_BASE . DS . 'scripts/PHPMailer/class.smtp.php';
                    $mail = new PHPMailer();
                    $mail->CharSet = 'utf-8';
                    $mail->IsSMTP();
                    ($_SMTP_auth == 1) ? $mail->SMTPAuth = true : null;
                    $mail->Host = $_SMTP_server;
                    ($_SMTP_secure != 'none') ? $mail->SMTPSecure = $_SMTP_secure : null;
                    ($_SMTP_port != null) ? $mail->Port = $_SMTP_port : null;
                    ($_SMTP_username != null) ? $mail->Username = $_SMTP_username : null;
                    ($_SMTP_password != null) ? $mail->Password = $_SMTP_password : null;
                    $mail->SMTPDebug = 0;
                    $mail->SetFrom($_email_from_address, $_email_from_name);
                    $mail->Subject = $_email_from_name;
                    $body = '
                    <p dir="rtl">السلام عليكم ورحمه الله وبركاته&nbsp;</p>

<p dir="rtl">السيد مدير موقع الشبكة الاعلانية&nbsp;</p>

<p dir="rtl">تحية طيبة وبعد ,,</p>

<p dir="rtl">رسالة من موقعكم الشبكة الاعلانية ..</p>

<p dir="rtl">&nbsp;</p>

<p dir="rtl">الإسم : ' . $f_name . '</p>

<p dir="rtl">البريد الإلكترونى : ' . $se_email . '</p>

<p dir="rtl">رقم الجوال : ' . $se_phone . '</p>

<p dir="rtl">الرسالة : ' . $se_message . '</p>

<p dir="rtl">&nbsp;</p>

<p dir="rtl">شكرا ..</p>

<p dir="rtl">&nbsp;</p>

';
                    $mail->MsgHTML($body);
                    if (!empty($_email)) {
                        foreach ($_email as $_add) {
                            $mail->AddAddress($_add, $_email_from_name);
                        }
                    }
                    $mail->Send();
                    $coulmns = array('name' => $f_name, 'email' => $se_email, 'phone' => $se_phone, 'message' => $se_message,'created' => time());
                    if (!$models->send_contacts($coulmns)) {
                        $session->message($language->Error_Send_Message, 'alert alert-danger');
                    } else {
                        $session->message($language->Success_Send_Message, 'alert alert-success');
                    }
                } else {
                    $all_error = "";
                    foreach ($errors as $error) {
                        $all_error .= $error . '<br/>';
                    }
                    $session->message($all_error, 'alert alert-danger');
                }
                $models->redirect_to(URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/contact_us');
            }
            if (!empty($session->message)) {
                echo $session->message;
            }
            ?>
            <div class="col-xs-12 col-md-6 co-form">
                <form action="#" method="post">
                    <div class="input-group margin-bottom-sm col-xs-12 row wow zoomIn" data-wow-delay="1s">
                        <input name="full_name" class="form-control" type="text" placeholder="<?php echo $language->YourName; ?>">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="input-group margin-bottom-sm col-xs-12 row wow zoomIn" data-wow-delay="1.3s">
                        <input name="email" class="form-control" type="email" placeholder="<?php echo $language->YourEmail; ?>">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="input-group margin-bottom-sm col-xs-12 row wow zoomIn" data-wow-delay="1.6s">
                        <input name="phone" class="form-control" type="tel" placeholder="<?php echo $language->YourPhone; ?>">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="input-group margin-bottom-sm col-xs-12 row wow zoomIn" data-wow-delay="1.9s">
                        <textarea name="message" class="form-control" placeholder="<?php echo $language->Message; ?>"></textarea>
                        <i class="fa fa-pencil"></i>
                    </div>
                    <?php
                    $min = rand(1, 9);
                    $max = rand(1, 9);
                    $_SESSION['verify'] = $min + $max;
                    ?> 
                    <div class="form-group form-inline col-xs-12 wow zoomIn"  data-wow-delay="2.2s">
                        <label><?php echo $min . ' + ' . $max . ' = '; ?></label>
                        <input name="verify" class="form-control" type="number" min="0">
                    </div>
                    <label class="submit row wow zoomIn" for="submit" data-wow-delay="2.5s">
                        <?php echo $language->Send; ?>
                        <i class="fa fa-send"></i>
                        <input name="submit" type="submit" id="submit"/>
                    </label>
                </form>
            </div>
            <div class="col-xs-12 col-md-6 info">
                <h2 class="wow zoomIn" data-wow-delay="1s"><?php echo $site_settings->info_contacts_title; ?></h2>
                <h5 class="wow zoomIn" data-wow-delay="1s"><i class="fa fa-home"></i><?php echo $site_settings->address_contacts_title; ?></h5>
                <h5 class="wow zoomIn" data-wow-delay="1.3s"><i class="fa fa-envelope"></i><a href="mailto:<?php echo $site_settings->email; ?>"><?php echo $site_settings->email; ?></a></h5>
                <?php if(!empty($site_settings->mobile)){ ?><h5 class="wow zoomIn" data-wow-delay="1.3s"><i class="fa fa-phone"></i><a href="tel:<?php echo $site_settings->mobile; ?>"><?php echo $site_settings->mobile; ?></a></h5><?php } ?>
                <?php if(!empty($site_settings->phone)){ ?><h5 class="wow zoomIn" data-wow-delay="1.6s"><i class="fa fa-mobile"></i><a href="tel:<?php echo $site_settings->phone; ?>"><?php echo $site_settings->phone; ?></a></h5><?php } ?>
                
                <h5 class="wow zoomIn" data-wow-delay="1.6s"><i class="fa fa-calendar-check-o"></i><?php echo $site_settings->work_contacts; ?></h5>
                <h5 class="wow zoomIn" data-wow-delay="1.9s"><i class="fa fa-calendar-times-o"></i><?php echo $site_settings->holiday_contacts; ?></h5>
                <h5 class="wow zoomIn" data-wow-delay="1.9s"><i class=""></i></h5>
                <h5 class="wow zoomIn" data-wow-delay="1.9s"><i class=""></i></h5>
            </div>
        </div>
    </section>
</div>
<!--End contacts-->