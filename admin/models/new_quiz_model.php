<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

$model = new model();
$r_dir = '';
$submit = 'save&new';
if (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'quiz/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'quiz/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    $content_array = array();
    $DESC_array = array();
    $KEYS_array = array();
    $replaces = array(';');
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
        $content_array[$lang['alias']] = (isset($_POST['content_'. $lang['alias']]) && !empty($_POST['content_'. $lang['alias']])) ? $_POST['content_'. $lang['alias']] : null;
        $DESC_array['meta_desc_'.$lang['alias']] = (isset($_POST['meta_desc_'. $lang['alias']]) && !empty($_POST['meta_desc_'. $lang['alias']])) ? $model->filtrate($_POST['meta_desc_'. $lang['alias']]) : null;
        $KEYS_array['meta_keys_'.$lang['alias']] = (isset($_POST['meta_keys_'. $lang['alias']]) && !empty($_POST['meta_keys_'. $lang['alias']])) ? $model->filtrate($_POST['meta_keys_'. $lang['alias']]) : null;
    }
    $post_alias = $model->filtrate(str_replace($replaces, ' ', $_POST['alias']));
    if (isset($post_alias) && !empty($post_alias)) {
        $alias = str_replace(' ', '_', trim($post_alias));
    } else {
        $errors[] = 'Please Enter the Alias of Page. ';
    }
    $serialze_title = base64_encode(serialize($title));
    $content = base64_encode(serialize($content_array));
    $desc = base64_encode(serialize($DESC_array)) ;
    $keys = base64_encode(serialize($KEYS_array)) ;
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'alias' => $alias,
            'content' => $content,
            'status' => $status,
            'meta_desc' => $desc,
            'meta_key' => $keys,
            'created_date' => time()
        );
        $result = $model->NewInsert('quiz', $coulmns);
        if (is_numeric($result)) {
            $session->message('created successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . 'quiz/new_item');
        }
    } else {
        $all_error = "";
        foreach ($errors as $error) {
            $all_error .= $error . '<br/>';
        }
        $session->message($all_error, 'alert alert-danger');
    }
    $model->redirect_to(ADMIN_URL . 'quiz/new_item');
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
