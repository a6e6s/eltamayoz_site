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
    $r_dir = 'settings/blog';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $blog = array();
    $replaces = array(';', '"');
    // validate ...............................................
    $blog['header_image'] = (isset($_POST['image']) && !empty($_POST['image'])) ?  $model->filtrate(str_replace($replaces, ' ', $_POST['image'])) : '';
    $blog['per_page'] = (isset($_POST['per_page'])) ? (int)$_POST['per_page']: 0;
    $blog['header_image_opacity'] = (isset($_POST['opacity'])) ? $_POST['opacity']: 1;
    foreach ($languages as $lang) {
        $meta_desc = $model->filtrate(str_replace($replaces, ' ', $_POST['desc_' . $lang['alias']]));
        $meta_keys = $model->filtrate(str_replace($replaces, ' ', $_POST['keys_' . $lang['alias']]));
        $blog['meta_desc_' . $lang['alias']] = (isset($meta_desc) && !empty($meta_desc)) ? $meta_desc : '';
        $blog['meta_keys_' . $lang['alias']] = (isset($meta_keys) && !empty($meta_keys)) ? $meta_keys : '';
    }
    $blog_serialze = (!empty($blog)) ? base64_encode(serialize($blog)) : '';
    if (empty($errors)) {
        $coulmns = array(
            'settings_name' => 'blog settings',
            'settings_values' => $blog_serialze
        );
        $result = $model->NewUpdate('settings', $coulmns, " WHERE id = '8' ");
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
