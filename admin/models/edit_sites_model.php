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
    $r_dir = 'sites/edit_item/'.$id;
}elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'sites/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'sites/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $_site_name = array();
    $_site_closed_message = array();
    $_site_logo = array();
    $_site_meta_desc = array();
    $_site_meta_keys = array();
    $replaces = array(';', '"');
    foreach ($languages as $lang) {
        $site_name = $model->filtrate(str_replace($replaces, ' ', $_POST['site_name_' . $lang['alias']]));
        $site_closed_message = $model->filtrate(str_replace($replaces, ' ', $_POST['message_closed_' . $lang['alias']]));
        $site_logo = $model->filtrate(str_replace($replaces, ' ', $_POST['site_logo_' . $lang['alias']]));
        $site_desc = $model->filtrate(str_replace($replaces, ' ', $_POST['site_desc_' . $lang['alias']]));
        $site_keys = $model->filtrate(str_replace($replaces, ' ', $_POST['site_keys_' . $lang['alias']]));
        
        $_site_name['site_name_' . $lang['alias']] = (isset($site_name) && !empty($site_name)) ? $site_name : '';
        $_site_closed_message['message_closed_' . $lang['alias']] = (isset($site_closed_message) && !empty($site_closed_message)) ? $site_closed_message : '';
        $_site_logo['site_logo_' . $lang['alias']] = (isset($site_logo) && !empty($site_logo)) ? $site_logo : '';
        $_site_meta_desc['site_desc_' . $lang['alias']] = (isset($site_desc) && !empty($site_desc)) ? $site_desc : '';
        $_site_meta_keys['site_keys_' . $lang['alias']] = (isset($site_keys) && !empty($site_keys)) ? $site_keys : '';
    }
    $post_alias = $model->filtrate(str_replace($replaces, ' ', $_POST['alias']));
    if (isset($post_alias) && !empty($post_alias)) {
        if (!preg_match("/[a-zA-Z0-9_\-]/", $post_alias)) {
            $errors[] = 'Site Alias Should Be English Only Characters .';
        } else {
            $alias = str_replace(' ', '_', trim($post_alias));
        }
    } else {
        $errors[] = 'please enter the alias of Site. ';
    }
    $_name = (!empty($_site_name)) ? base64_encode(serialize($_site_name)) : '';
    $_message = (!empty($_site_closed_message)) ? base64_encode(serialize($_site_closed_message)) : '';
    $_logo = (!empty($_site_logo)) ? base64_encode(serialize($_site_logo)) : '';
    $_meta_desc = (!empty($_site_meta_desc)) ? base64_encode(serialize($_site_meta_desc)) : '';
    $_meta_keys = (!empty($_site_meta_keys)) ? base64_encode(serialize($_site_meta_keys)) : '';
    $_header_code = (isset($_POST['header_code']) && !empty($_POST['header_code'])) ? base64_encode(serialize($_POST['header_code'])) : '';
    $_footer_code = (isset($_POST['footer_code']) && !empty($_POST['footer_code'])) ? base64_encode(serialize($_POST['footer_code'])) : '';
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    if (empty($errors)) {
        $coulmns = array(
            'name' => $_name,
            'alias' => $alias,
            'status' => $status,
            'message_closed' => $_message,
            'logo' => $_logo,
            'meta_desc' => $_meta_desc,
            'meta_key' => $_meta_keys,
            'H_code' => $_header_code,
            'F_code' => $_footer_code,
            'modified' => time()
        );
        $result = $model->NewUpdate('sites', $coulmns," WHERE id = '".$id."' ");
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
