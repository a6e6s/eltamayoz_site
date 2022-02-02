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
    $r_dir = 'settings/mail';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $mail = array();
    // validate ...............................................
    $mail['email_from_name'] = (isset($_POST['email_from_name']) && !empty($_POST['email_from_name'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['email_from_name'])))) : '';
    $mail['email_from_address'] = (isset($_POST['email_from_address']) && !empty($_POST['email_from_address'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['email_from_address'])))) : '';
    $mail['auth'] = (isset($_POST['auth']) && $_POST['auth'] == 'on') ? 1 : 0;
    $mail['secure'] = (isset($_POST['secure']) && !empty($_POST['secure'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['secure'])))) : 'none';
    $mail['server'] = (isset($_POST['server']) && !empty($_POST['server'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['server'])))) : '';
    $mail['port'] = (isset($_POST['port']) && !empty($_POST['port'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['port'])))) : '';
    $mail['username'] = (isset($_POST['username']) && !empty($_POST['username'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['username'])))) : '';
    $mail['password'] = (isset($_POST['password']) && !empty($_POST['password'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['password'])))) : '';
    $mail_serialze = (!empty($mail)) ? base64_encode(serialize($mail)) : '';
    if (empty($errors)) {
        $coulmns = array(
            'settings_name' => 'mail settings',
            'settings_values' => $mail_serialze
        );
        $result = $model->NewUpdate('settings', $coulmns, " WHERE id = '2' ");
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
