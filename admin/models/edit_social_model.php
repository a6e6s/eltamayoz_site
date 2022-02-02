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
    $r_dir = 'settings/social';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $social = array();
    $replaces = array(';', '"');
    // validate ...............................................
    (isset($_POST['facebook']) && !empty($_POST['facebook'])) ? $social['facebook'] = $model->filtrate(str_replace($replaces, '', $_POST['facebook'])) : '';
    (isset($_POST['twitter']) && !empty($_POST['twitter'])) ? $social['twitter'] = $model->filtrate(str_replace($replaces, '', $_POST['twitter'])) : '';
    (isset($_POST['google']) && !empty($_POST['google'])) ? $social['google'] = $model->filtrate(str_replace($replaces, '', $_POST['google'])) : '';
    (isset($_POST['youtube']) && !empty($_POST['youtube'])) ? $social['youtube'] = $model->filtrate(str_replace($replaces, '', $_POST['youtube'])) : '';
    (isset($_POST['linkedin']) && !empty($_POST['youtube'])) ? $social['linkedin'] = $model->filtrate(str_replace($replaces, '', $_POST['linkedin'])) : '';
    $social_serialze = (!empty($social)) ? base64_encode(serialize($social)) : '';
    if (empty($errors)) {
        $coulmns = array(
            'settings_name' => 'social settings',
            'settings_values' => $social_serialze
        );
        $result = $model->NewUpdate('settings', $coulmns, " WHERE id = '7' ");
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
