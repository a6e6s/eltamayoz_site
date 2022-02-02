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
    $r_dir = 'pages/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'pages/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    $content_array = array();
    $DESC_array = array();
    $KEYS_array = array();
    $replaces = array(';','"');
    // validate ...............................................
    foreach ($languages as $lang) {
        $post_name = $model->filtrate(str_replace($replaces, ' ', $_POST['title_' . $lang['alias']]));
        if (isset($post_name) && !empty($post_name)) {
            $title[$lang['alias']] = strip_tags($post_name);
        } else {
            if ($lang['alias'] == 'en') {
                $errors[] = 'Please Enter Page Title in ' . $lang['name'];
            }
        }
        $content_array[$lang['alias']] = (isset($_POST['content_'. $lang['alias']]) && !empty($_POST['content_'. $lang['alias']])) ? $_POST['content_'. $lang['alias']] : null;
        $DESC_array['meta_desc_'.$lang['alias']] = (isset($_POST['meta_desc_'. $lang['alias']]) && !empty($_POST['meta_desc_'. $lang['alias']])) ? $model->filtrate($_POST['meta_desc_'. $lang['alias']]) : null;
        $KEYS_array['meta_keys_'.$lang['alias']] = (isset($_POST['meta_keys_'. $lang['alias']]) && !empty($_POST['meta_keys_'. $lang['alias']])) ? $model->filtrate($_POST['meta_keys_'. $lang['alias']]) : null;
    }
    $post_alias = $model->filtrate(str_replace($replaces, ' ', $_POST['alias']));
    if (isset($post_alias) && !empty($post_alias)) {
        if (!preg_match("/[a-zA-Z0-9_\-]/", $post_alias)) {
            $errors[] = 'The Alias Should Be English Only Characters .';
        } else {
            $alias = str_replace(' ', '_', trim($post_alias));
        }
    } else {
        $errors[] = 'Please Enter the Alias of Page. ';
    }
    $serialze_title = base64_encode(serialize($title));
    $content = base64_encode(serialize($content_array));
    $desc = base64_encode(serialize($DESC_array)) ;
    $keys = base64_encode(serialize($KEYS_array)) ;
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $site = (isset($_POST['site_id'])) ? $_POST['site_id'] : $errors[] = 'Please Choose Site';
    $image = (isset($_POST['image'])) ? $_POST['image'] : '';
    $opacity = (isset($_POST['opacity'])) ? $_POST['opacity'] : '1';

    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'alias' => $alias,
            'content' => $content,
            'image' => $image,
            'image_opacity' => $opacity,
            'status' => $status,
            'site_id' => $site,
            'meta_desc' => $desc,
            'meta_key' => $keys,
            'created' => time()
        );
        $result = $model->NewInsert('pages', $coulmns);
        if (is_numeric($result)) {
            $session->message('created successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . 'pages/new_item');
        }
    } else {
        $all_error = "";
        foreach ($errors as $error) {
            $all_error .= $error . '<br/>';
        }
        $session->message($all_error, 'alert alert-danger');
    }
    $model->redirect_to(ADMIN_URL . 'pages/new_item');
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
