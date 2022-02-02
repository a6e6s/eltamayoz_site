<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

$model = new model();
$r_dir = '';
$submit = 'save';
if (isset($_POST['save'])) {
    $submit = 'save';
    $r_dir = 'settings/requests';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $request = array();
    // validate ...............................................
    foreach ($languages as $lang) {
        $page_title = $model->filtrate(str_replace(';', ' ', $_POST['title_' . $lang['alias']]));
        $info_title = $model->filtrate(str_replace(';', ' ', $_POST['info_title_' . $lang['alias']]));
        $address = $model->filtrate(str_replace(';', ' ', $_POST['address_' . $lang['alias']]));
        $work = $model->filtrate(str_replace(';', ' ', $_POST['work_' . $lang['alias']]));
        $holiday = $model->filtrate(str_replace(';', ' ', $_POST['holiday_' . $lang['alias']]));
        $services = $model->filtrate(str_replace(';', ' ', $_POST['services_' . $lang['alias']]));
        $request['page_title_' . $lang['alias']] = (isset($page_title) && !empty($page_title)) ? $page_title : '';
        $request['info_title_' . $lang['alias']] = (isset($info_title) && !empty($info_title)) ? $info_title : '';
        $request['address_' . $lang['alias']] = (isset($address) && !empty($address)) ? $address : '';
        $request['work_' . $lang['alias']] = (isset($work) && !empty($work)) ? $work : '';
        $request['holiday_' . $lang['alias']] = (isset($holiday) && !empty($holiday)) ? $holiday : '';
        $request['services_' . $lang['alias']] = (isset($services) && !empty($services)) ? $services : '';
    }
    $request['mobile'] = (isset($_POST['mobile']) && !empty($_POST['mobile'])) ? $model->filtrate(str_replace(';', ' ', $_POST['mobile'])) : '';
    $request['phone'] = (isset($_POST['phone']) && !empty($_POST['phone'])) ? $model->filtrate(str_replace(';', ' ', $_POST['phone'])) : '';
    $request['email'] = (isset($_POST['email']) && !empty($_POST['email'])) ? $model->filtrate(str_replace(';', ' ', $_POST['email'])) : '';
    $request['header_image'] = (isset($_POST['image']) && !empty($_POST['image'])) ?  $model->filtrate(str_replace(';', ' ', $_POST['image'])) : '';
    $request['header_image_opacity'] = (isset($_POST['opacity'])) ? $_POST['opacity']: 1;
    $requests_serialze = (!empty($request)) ? base64_encode(serialize($request)) : '';
    if (empty($errors)) {
        $coulmns = array(
            'settings_name' => 'requests settings',
            'settings_values' => $requests_serialze
        );
        $result = $model->NewUpdate('settings', $coulmns, " WHERE id = '9' ");
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
