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
    $r_dir = 'sites/edit_design/' . $id;
}
if (isset($_POST[$submit])) {
    $errors = array();
    $site_values = array();
    foreach ($languages as $lang) {
        $work_steps_title = $model->filtrate(str_replace(';', ' ', $_POST['work_steps_title_' . $lang['alias']]));
        $work_step_1_title = $model->filtrate(str_replace(';', ' ', $_POST['work_step_1_title_' . $lang['alias']]));
        $work_step_1_desc = $model->filtrate(str_replace(';', ' ', $_POST['work_step_1_desc_' . $lang['alias']]));
        $work_step_2_title = $model->filtrate(str_replace(';', ' ', $_POST['work_step_2_title_' . $lang['alias']]));
        $work_step_2_desc = $model->filtrate(str_replace(';', ' ', $_POST['work_step_2_desc_' . $lang['alias']]));
        $work_step_3_title = $model->filtrate(str_replace(';', ' ', $_POST['work_step_3_title_' . $lang['alias']]));
        $work_step_3_desc = $model->filtrate(str_replace(';', ' ', $_POST['work_step_3_desc_' . $lang['alias']]));
        $work_step_4_title = $model->filtrate(str_replace(';', ' ', $_POST['work_step_4_title_' . $lang['alias']]));
        $work_step_4_desc = $model->filtrate(str_replace(';', ' ', $_POST['work_step_4_desc_' . $lang['alias']]));
        $services_title = $model->filtrate(str_replace(';', ' ', $_POST['services_title_' . $lang['alias']]));
        $service_1_title = $model->filtrate(str_replace(';', ' ', $_POST['service_1_title_' . $lang['alias']]));
        $service_1_desc = $model->filtrate(str_replace(';', ' ', $_POST['service_1_desc_' . $lang['alias']]));
        $service_2_title = $model->filtrate(str_replace(';', ' ', $_POST['service_2_title_' . $lang['alias']]));
        $service_2_desc = $model->filtrate(str_replace(';', ' ', $_POST['service_2_desc_' . $lang['alias']]));
        $service_3_title = $model->filtrate(str_replace(';', ' ', $_POST['service_3_title_' . $lang['alias']]));
        $service_3_desc = $model->filtrate(str_replace(';', ' ', $_POST['service_3_desc_' . $lang['alias']]));
        $service_4_title = $model->filtrate(str_replace(';', ' ', $_POST['service_4_title_' . $lang['alias']]));
        $service_4_desc = $model->filtrate(str_replace(';', ' ', $_POST['service_4_desc_' . $lang['alias']]));
        $service_5_title = $model->filtrate(str_replace(';', ' ', $_POST['service_5_title_' . $lang['alias']]));
        $service_5_desc = $model->filtrate(str_replace(';', ' ', $_POST['service_5_desc_' . $lang['alias']]));
        
        $works_title = $model->filtrate(str_replace(';', ' ', $_POST['works_title_' . $lang['alias']]));
        $blog_title = $model->filtrate(str_replace(';', ' ', $_POST['blog_title_' . $lang['alias']]));
        $clients_title = $model->filtrate(str_replace(';', ' ', $_POST['clients_title_' . $lang['alias']]));

        $site_values['work_steps_title_' . $lang['alias']] = (isset($work_steps_title) && !empty($work_steps_title)) ? $work_steps_title : '';
        $site_values['work_step_1_title_' . $lang['alias']] = (isset($work_step_1_title) && !empty($work_step_1_title)) ? $work_step_1_title : '';
        $site_values['work_step_1_desc_' . $lang['alias']] = (isset($work_step_1_desc) && !empty($work_step_1_desc)) ? $work_step_1_desc : '';
        $site_values['work_step_2_title_' . $lang['alias']] = (isset($work_step_2_title) && !empty($work_step_2_title)) ? $work_step_2_title : '';
        $site_values['work_step_2_desc_' . $lang['alias']] = (isset($work_step_2_desc) && !empty($work_step_2_desc)) ? $work_step_2_desc : '';
        $site_values['work_step_3_title_' . $lang['alias']] = (isset($work_step_3_title) && !empty($work_step_3_title)) ? $work_step_3_title : '';
        $site_values['work_step_3_desc_' . $lang['alias']] = (isset($work_step_3_desc) && !empty($work_step_3_desc)) ? $work_step_3_desc : '';
        $site_values['work_step_4_title_' . $lang['alias']] = (isset($work_step_4_title) && !empty($work_step_4_title)) ? $work_step_4_title : '';
        $site_values['work_step_4_desc_' . $lang['alias']] = (isset($work_step_4_desc) && !empty($work_step_4_desc)) ? $work_step_4_desc : '';
        $site_values['services_title_' . $lang['alias']] = (isset($services_title) && !empty($services_title)) ? $services_title : '';
        $site_values['service_1_title_' . $lang['alias']] = (isset($service_1_title) && !empty($service_1_title)) ? $service_1_title : '';
        $site_values['service_1_desc_' . $lang['alias']] = (isset($service_1_desc) && !empty($service_1_desc)) ? $service_1_desc : '';
        $site_values['service_2_title_' . $lang['alias']] = (isset($service_2_title) && !empty($service_2_title)) ? $service_2_title : '';
        $site_values['service_2_desc_' . $lang['alias']] = (isset($service_2_desc) && !empty($service_2_desc)) ? $service_2_desc : '';
        $site_values['service_3_title_' . $lang['alias']] = (isset($service_3_title) && !empty($service_3_title)) ? $service_3_title : '';
        $site_values['service_3_desc_' . $lang['alias']] = (isset($service_3_desc) && !empty($service_3_desc)) ? $service_3_desc : '';
        $site_values['service_4_title_' . $lang['alias']] = (isset($service_4_title) && !empty($service_4_title)) ? $service_4_title : '';
        $site_values['service_4_desc_' . $lang['alias']] = (isset($service_4_desc) && !empty($service_4_desc)) ? $service_4_desc : '';
        $site_values['service_5_title_' . $lang['alias']] = (isset($service_5_title) && !empty($service_5_title)) ? $service_5_title : '';
        $site_values['service_5_desc_' . $lang['alias']] = (isset($service_5_desc) && !empty($service_5_desc)) ? $service_5_desc : '';
        
        $site_values['works_title_' . $lang['alias']] = (isset($works_title) && !empty($works_title)) ? $works_title : '';
        $site_values['blog_title_' . $lang['alias']] = (isset($blog_title) && !empty($blog_title)) ? $blog_title : '';
        $site_values['clients_title_' . $lang['alias']] = (isset($clients_title) && !empty($clients_title)) ? $clients_title : '';
    }
    $site_values['slideshow_status'] = (isset($_POST['slideshow_status']) && $_POST['slideshow_status'] == 'on') ? '1' : '0';
    $site_values['services_status'] = (isset($_POST['services_status']) && $_POST['services_status'] == 'on') ? '1' : '0';
    $site_values['work_steps_status'] = (isset($_POST['work_steps_status']) && $_POST['work_steps_status'] == 'on') ? '1' : '0';
    $site_values['works_status'] = (isset($_POST['works_status']) && $_POST['works_status'] == 'on') ? '1' : '0';
    $site_values['blog_status'] = (isset($_POST['blog_status']) && $_POST['blog_status'] == 'on') ? '1' : '0';
    $site_values['clients_status'] = (isset($_POST['clients_status']) && $_POST['clients_status'] == 'on') ? '1' : '0';
    $site_values['works_number'] = (isset($_POST['works_number'])) ? (int) $_POST['works_number'] : '0';
    $site_values['blog_number'] = (isset($_POST['blog_number'])) ? (int) $_POST['blog_number'] : '0';
    $site_values['services_image'] = (isset($_POST['services_image']) && !empty($_POST['services_image'])) ? $model->filtrate(str_replace(';', ' ', $_POST['services_image'])) : '';
    $site_values['service_1_url'] = (isset($_POST['service_1_url']) && !empty($_POST['service_1_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['service_1_url'])) : '';
    $site_values['service_2_url'] = (isset($_POST['service_2_url']) && !empty($_POST['service_2_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['service_2_url'])) : '';
    $site_values['service_3_url'] = (isset($_POST['service_3_url']) && !empty($_POST['service_3_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['service_3_url'])) : '';
    $site_values['service_4_url'] = (isset($_POST['service_4_url']) && !empty($_POST['service_4_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['service_4_url'])) : '';
    $site_values['service_5_url'] = (isset($_POST['service_5_url']) && !empty($_POST['service_5_url'])) ? $model->filtrate(str_replace(';', ' ', $_POST['service_5_url'])) : '';
    

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
