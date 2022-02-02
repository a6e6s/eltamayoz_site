<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<div id="page-content">
    <!--header-page-->
    <section class="row header-page" id="header-page">
        <!--<img  src="" />-->
        <div class="container">
            <div class="head-con">
                <div class="heading2">
                    <h1 class="wow zoomIn" data-wow-delay=".5s"><?php echo $page_title; ?></h1>
                    <div class="line"><span></span><span></span></div>
                </div>
            </div>
        </div>
    </section>
    <!--End header-page-->
    <!--page-content-->
    <section class="row page-content">
        <div class="container question">
            <?php
            if (!empty($session->message)) {
                echo $session->message;
            }
            if (!$que) {
                if (is_array($result)) {
                    foreach ($result as $item) {
                        $_item_id = (isset($item['id'])) ? $item['id'] : 0;
                        $_title_array = (isset($item['title'])) ? unserialize(base64_decode($item['title'])) : [];
                        $_title = isset($_title_array[$_SESSION['language_alias']]) ? $_title_array[$_SESSION['language_alias']] : '';
                        $_item_alias = (isset($item['alias'])) ? $item['alias'] : '';
                        ?>
                        <h2>
                            <i class="fa fa-chevron-<?php echo $_SESSION['language_DIR'] == 'RTL' ? 'left' : 'right'; ?>"></i>
                            <a href="<?php echo URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/questions/' . $_item_alias; ?>"><?php echo $_title; ?></a>
                        </h2>
                        <?php
                    }
                }
            } else {
                if (isset($_POST['submit']) AND ! empty($_POST['submit'])) {
                    $errors = array();
                    $f_name = (isset($_POST['full_name']) && !empty($_POST['full_name'])) ? $models->filtrate($_POST['full_name']) : $errors[] = $language->PLZ_Enter_Name;
                    $se_email = (isset($_POST['email']) && !empty($_POST['email'])) ? $models->filtrate($_POST['email']) : $errors[] = $language->PLZ_Enter_Email;
                    echo $qresult = $_POST['que'];
                    (isset($_POST['verify']) && $_SESSION['verify'] == $_POST['verify']) ? null : $errors[] = $language->Captcha_Incorrect;
                    if (empty($errors)) {
                        $coulmns = array('username' => $f_name, 'email' => $se_email, 'question_id' => $_item_id, 'result' => $qresult, 'created_date' => time());
                        if (!$models->send_examinees($coulmns)) {
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
                    $models->redirect_to(URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/questions/'.$_item_alias);
                }
                ?>
                <div class="heading2">
                    <h1 class="wow zoomIn" data-wow-delay=".5s"><?php echo $_title; ?></h1>
                    <div class="line"><span></span><span></span></div>
                </div>
                <?php
                if (is_array($_options_array)) {
                    ?>
                    <div class="col-xs-12">
                        <form action="#" method="post">
                            <?php
                            echo isset($_options_array['option_1_' . $_SESSION['language_alias']]) ? '<label><input name="que" type="radio" value="' . $_options_array['option_1_' . $_SESSION['language_alias']] . '" /> ' . $_options_array['option_1_' . $_SESSION['language_alias']] . '</label>' : null;
                            echo isset($_options_array['option_2_' . $_SESSION['language_alias']]) ? '<label><input name="que" type="radio" value="' . $_options_array['option_2_' . $_SESSION['language_alias']] . '" /> ' . $_options_array['option_2_' . $_SESSION['language_alias']] . '</label>' : null;
                            echo isset($_options_array['option_3_' . $_SESSION['language_alias']]) ? '<label><input name="que" type="radio" value="' . $_options_array['option_3_' . $_SESSION['language_alias']] . '" /> ' . $_options_array['option_3_' . $_SESSION['language_alias']] . '</label>' : null;
                            echo isset($_options_array['option_4_' . $_SESSION['language_alias']]) ? '<label><input name="que" type="radio" value="' . $_options_array['option_4_' . $_SESSION['language_alias']] . '" /> ' . $_options_array['option_4_' . $_SESSION['language_alias']] . '</label>' : null;
                            echo isset($_options_array['option_5_' . $_SESSION['language_alias']]) ? '<label><input name="que" type="radio" value="' . $_options_array['option_5_' . $_SESSION['language_alias']] . '" /> ' . $_options_array['option_5_' . $_SESSION['language_alias']] . '</label>' : null;
                            ?>
                            <hr/>
                            <div class="input-group margin-bottom-sm col-xs-12" data-wow-delay="1s">
                                <input name="full_name" class="form-control" type="text" placeholder="<?php echo $language->YourName; ?>">
                                <i class="fa fa-user"></i>
                            </div>
                            <div class="input-group margin-bottom-sm col-xs-12" data-wow-delay="1.3s">
                                <input name="email" class="form-control" type="email" placeholder="<?php echo $language->YourEmail; ?>">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <?php
                            $min = rand(1, 9);
                            $max = rand(1, 9);
                            $_SESSION['verify'] = $min + $max;
                            ?> 
                            <div class="form-group form-inline col-xs-12"  data-wow-delay="2.2s">
                                <label class="col-xs-12 col-sm-6 captcha">
                                    <?php echo $min . ' + ' . $max . ' = '; ?>
                                    <input name="verify" class="form-control" type="number" min="0">
                                </label>
                                <div class="col-xs-12 col-sm-6">
                                    <label class="submit" data-wow-delay="2.5s">
                                        <?php echo $language->Send; ?>
                                        <i class="fa fa-send"></i>
                                        <input name="submit" type="submit" />
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
    </section>
</div>
<!--End page-content-->



