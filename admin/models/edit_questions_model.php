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
    $r_dir = 'questions/edit_item/' . $id;
} elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'questions/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'questions/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    $options = array();
    $replaces = array(';');
    $alias_replace = array(' ', ';', '"', "'",'/');
    // validate ...............................................
    foreach ($languages as $lang) {
        $post_name = $model->filtrate(str_replace($replaces, ' ', $_POST['title_' . $lang['alias']]));
        if (isset($post_name) && !empty($post_name)) {
            $title[$lang['alias']] = strip_tags($post_name);
        } else {
            if ($lang['alias'] == 'en') {
                $errors[] = 'Please Enter Title in ' . $lang['name'];
            }
        }
        $options['option_1_' . $lang['alias']] = (isset($_POST['option_1_' . $lang['alias']]) && !empty($_POST['option_1_' . $lang['alias']])) ? $model->filtrate($_POST['option_1_' . $lang['alias']]) : null;
        $options['option_2_' . $lang['alias']] = (isset($_POST['option_2_' . $lang['alias']]) && !empty($_POST['option_2_' . $lang['alias']])) ? $model->filtrate($_POST['option_2_' . $lang['alias']]) : null;
        $options['option_3_' . $lang['alias']] = (isset($_POST['option_3_' . $lang['alias']]) && !empty($_POST['option_3_' . $lang['alias']])) ? $model->filtrate($_POST['option_3_' . $lang['alias']]) : null;
        $options['option_4_' . $lang['alias']] = (isset($_POST['option_4_' . $lang['alias']]) && !empty($_POST['option_4_' . $lang['alias']])) ? $model->filtrate($_POST['option_4_' . $lang['alias']]) : null;
        $options['option_5_' . $lang['alias']] = (isset($_POST['option_5_' . $lang['alias']]) && !empty($_POST['option_5_' . $lang['alias']])) ? $model->filtrate($_POST['option_5_' . $lang['alias']]) : null;
        $DESC_array[$lang['alias']] = (isset($_POST['meta_desc_'. $lang['alias']]) && !empty($_POST['meta_desc_'. $lang['alias']])) ? $model->filtrate($_POST['meta_desc_'. $lang['alias']]) : null;
        $KEYS_array[$lang['alias']] = (isset($_POST['meta_keys_'. $lang['alias']]) && !empty($_POST['meta_keys_'. $lang['alias']])) ? $model->filtrate($_POST['meta_keys_'. $lang['alias']]) : null;
    }
    $serialze_title = base64_encode(serialize($title));
    $serialze_options = base64_encode(serialize($options));
    $desc = base64_encode(serialize($DESC_array)) ;
    $keys = base64_encode(serialize($KEYS_array)) ;
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $alias = isset($_POST['alias']) ? str_replace($alias_replace, '_', $model->filtrate($_POST['alias'])) : $errors[] = 'Please Enter Alias';
    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'status' => $status,
            'alias' => $alias,
            'options' => $serialze_options,
            'meta_desc' => $desc,
            'meta_key' => $keys,
            'modified_date' => time()
        );
        $result = $model->NewUpdate('questions', $coulmns, " WHERE id = '" . $id . "' ");
        if ($result === TRUE) {
            $session->message('Update Successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . 'question/' . $id);
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
