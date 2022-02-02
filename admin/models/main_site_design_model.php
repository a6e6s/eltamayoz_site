<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

$model = new model();
$r_dir = '';
$submit = 'save&new';
if (isset($_POST['save'])) {
    $submit = 'save';
    $r_dir = 'sites/edit_main_site_design/' . $id;
}
if (isset($_POST[$submit])) {
    $errors = array();
    $site_values = array();
    foreach ($languages as $lang) {
        $link_1_title = $model->filtrate(str_replace(';', ' ', $_POST['link_1_title_' . $lang['alias']]));
        $link_2_title = $model->filtrate(str_replace(';', ' ', $_POST['link_2_title_' . $lang['alias']]));
        $link_3_title = $model->filtrate(str_replace(';', ' ', $_POST['link_3_title_' . $lang['alias']]));
        $link_4_title = $model->filtrate(str_replace(';', ' ', $_POST['link_4_title_' . $lang['alias']]));
        $link_5_title = $model->filtrate(str_replace(';', ' ', $_POST['link_5_title_' . $lang['alias']]));
        $link_6_title = $model->filtrate(str_replace(';', ' ', $_POST['link_6_title_' . $lang['alias']]));
        $link_7_title = $model->filtrate(str_replace(';', ' ', $_POST['link_7_title_' . $lang['alias']]));
        $link_8_title = $model->filtrate(str_replace(';', ' ', $_POST['link_8_title_' . $lang['alias']]));

        $site_values['link_1_title_' . $lang['alias']] = (isset($link_1_title) && !empty($link_1_title)) ? $link_1_title : '';
        $site_values['link_2_title_' . $lang['alias']] = (isset($link_2_title) && !empty($link_2_title)) ? $link_2_title : '';
        $site_values['link_3_title_' . $lang['alias']] = (isset($link_3_title) && !empty($link_3_title)) ? $link_3_title : '';
        $site_values['link_4_title_' . $lang['alias']] = (isset($link_4_title) && !empty($link_4_title)) ? $link_4_title : '';
        $site_values['link_5_title_' . $lang['alias']] = (isset($link_5_title) && !empty($link_5_title)) ? $link_5_title : '';
        $site_values['link_6_title_' . $lang['alias']] = (isset($link_6_title) && !empty($link_6_title)) ? $link_6_title : '';
        $site_values['link_7_title_' . $lang['alias']] = (isset($link_7_title) && !empty($link_7_title)) ? $link_7_title : '';
        $site_values['link_8_title_' . $lang['alias']] = (isset($link_8_title) && !empty($link_8_title)) ? $link_8_title : '';
    }
//    $site_values['background_image'] = (isset($_POST['background_image']) && !empty($_POST['background_image'])) ? $model->filtrate(str_replace(';', ' ', $_POST['background_image'])) : '';
    $site_values['icon_1'] = (isset($_POST['icon_1']) && !empty($_POST['icon_1'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_1'])) : '';
    $site_values['icon_2'] = (isset($_POST['icon_2']) && !empty($_POST['icon_2'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_2'])) : '';
    $site_values['icon_3'] = (isset($_POST['icon_3']) && !empty($_POST['icon_3'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_3'])) : '';
    $site_values['icon_4'] = (isset($_POST['icon_4']) && !empty($_POST['icon_4'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_4'])) : '';
    $site_values['icon_5'] = (isset($_POST['icon_5']) && !empty($_POST['icon_5'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_5'])) : '';
    $site_values['icon_6'] = (isset($_POST['icon_6']) && !empty($_POST['icon_6'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_6'])) : '';
    $site_values['icon_7'] = (isset($_POST['icon_7']) && !empty($_POST['icon_7'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_7'])) : '';
    $site_values['icon_8'] = (isset($_POST['icon_8']) && !empty($_POST['icon_8'])) ? $model->filtrate(str_replace(';', ' ', $_POST['icon_8'])) : '';

    $site_values['link_1_type'] = (isset($_POST['link_1_type'])) ? $_POST['link_1_type'] : 'internal';
    $site_values['link_2_type'] = (isset($_POST['link_2_type'])) ? $_POST['link_2_type'] : 'internal';
    $site_values['link_3_type'] = (isset($_POST['link_3_type'])) ? $_POST['link_3_type'] : 'internal';
    $site_values['link_4_type'] = (isset($_POST['link_4_type'])) ? $_POST['link_4_type'] : 'internal';
    $site_values['link_5_type'] = (isset($_POST['link_5_type'])) ? $_POST['link_5_type'] : 'internal';
    $site_values['link_6_type'] = (isset($_POST['link_6_type'])) ? $_POST['link_6_type'] : 'internal';
    $site_values['link_7_type'] = (isset($_POST['link_7_type'])) ? $_POST['link_7_type'] : 'internal';
    $site_values['link_8_type'] = (isset($_POST['link_8_type'])) ? $_POST['link_8_type'] : 'internal';

    $site_values['link_1_url'] = (isset($_POST['link_1_url']) && !empty($_POST['link_1_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_1_url'])) : '';
    $site_values['link_2_url'] = (isset($_POST['link_2_url']) && !empty($_POST['link_2_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_2_url'])) : '';
    $site_values['link_3_url'] = (isset($_POST['link_3_url']) && !empty($_POST['link_3_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_3_url'])) : '';
    $site_values['link_4_url'] = (isset($_POST['link_4_url']) && !empty($_POST['link_4_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_4_url'])) : '';
    $site_values['link_5_url'] = (isset($_POST['link_5_url']) && !empty($_POST['link_5_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_5_url'])) : '';
    $site_values['link_6_url'] = (isset($_POST['link_6_url']) && !empty($_POST['link_6_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_6_url'])) : '';
    $site_values['link_7_url'] = (isset($_POST['link_7_url']) && !empty($_POST['link_7_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_7_url'])) : '';
    $site_values['link_8_url'] = (isset($_POST['link_8_url']) && !empty($_POST['link_8_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['link_8_url'])) : '';

    $site_values['site_status'] = (isset($_POST['site_status']) && $_POST['site_status'] == 'on') ? '1' : '0';

    $site_values_serialize = (!empty($site_values)) ? base64_encode(serialize($site_values)) : '';
    if (empty($errors)) {
        $coulmns = array(
            'settings_values' => $site_values_serialize
        );
        $result = $model->NewUpdate('sites', $coulmns, " WHERE id = '" . $id . "' ");
        if ($result === TRUE) {
            $session->message('Update Successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . $r_dir);
        }
    } else {
        $all_error = "";
        foreach ($errors as $error) {
            $all_error .= $error . '<br/>';
        }
        $session->message($all_error, 'alert alert-danger');
    }
    $model->redirect_to(ADMIN_URL . $r_dir);
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
