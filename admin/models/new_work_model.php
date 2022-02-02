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
    $r_dir = 'works/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'works/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    $client = array();
    $location = array();
    $replaces = array(';');
    $cut_replace = array(';', '"', "'");
    $alias_replace = array(' ', ';', '"', "'");
    $tags_insert = "";
    $PR_DESC_array = array();
    $DESC_array = array();
    $KEYS_array = array();
    $alias = '';
    // validate ...............................................
    foreach ($languages as $lang) {
        $post_name = $model->filtrate(str_replace($replaces, ' ', trim($_POST['title_' . $lang['alias']])));
        $post_client = $model->filtrate(str_replace($replaces, ' ', trim($_POST['client_' . $lang['alias']])));
        $post_location = $model->filtrate(str_replace($replaces, ' ', trim($_POST['location_' . $lang['alias']])));
        if (isset($post_name) && !empty($post_name)) {
            $title[$lang['alias']] = strip_tags($post_name);
            if ($lang['alias'] == 'en') {
                $alias = str_replace(' ', '_', $post_name);
            }
        } else {
            if ($lang['alias'] == 'en') {
                $errors[] = 'Please Enter Work Title .' . $lang['name'];
            }
        }
        (isset($post_client) && !empty($post_client)) ? $client[$lang['alias']] = strip_tags($post_client) : null;
        (isset($post_location) && !empty($post_location)) ? $location[$lang['alias']] = strip_tags($post_location) : null;
        $PR_DESC_array[$lang['alias']] = (isset($_POST['PR_desc_'. $lang['alias']]) && !empty($_POST['PR_desc_'. $lang['alias']])) ? $model->filtrate($_POST['PR_desc_'. $lang['alias']]) : null;
        $DESC_array[$lang['alias']] = (isset($_POST['meta_desc_'. $lang['alias']]) && !empty($_POST['meta_desc_'. $lang['alias']])) ? $model->filtrate($_POST['meta_desc_'. $lang['alias']]) : null;
        $KEYS_array[$lang['alias']] = (isset($_POST['meta_keys_'. $lang['alias']]) && !empty($_POST['meta_keys_'. $lang['alias']])) ? $model->filtrate($_POST['meta_keys_'. $lang['alias']]) : null;
    }
    $post_alias = $model->filtrate(str_replace($alias_replace, '_', str_replace($cut_replace, '', trim($_POST['alias']))));
    (isset($post_alias) && !empty($post_alias)) ? $alias = $post_alias : null;

    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $site = (isset($_POST['site_id']) && $_POST['site_id'] != 0) ? $_POST['site_id'] : $errors[] = 'Please Choose Site';
    $image = (isset($_POST['image'])) ? $_POST['image'] : '';
    $gallery_array = (isset($_POST['gallery']) && !empty($_POST['gallery'])) ?  $_POST['gallery'] : '';
    $gallery = !empty($gallery_array) ? implode(',', $gallery_array) : '' ;
    $tags = (is_array($_POST['tags'])) ? $_POST['tags'] : $errors[] = 'Please Choose Tag';
    $done_date = (isset($_POST['date']) && !empty($_POST['date'])) ? $model->filtrate($_POST['date']) : '';
    $demo_URL = (isset($_POST['demo']) && !empty($_POST['demo'])) ? $model->filtrate($_POST['demo']) : '';

    $serialze_title = base64_encode(serialize($title));
    $serialze_client = !empty($client) ? base64_encode(serialize($client)) : '';
    $serialze_location = !empty($location) ? base64_encode(serialize($location)) : '';
    $pr_desc = base64_encode(serialize($PR_DESC_array));
    $desc = base64_encode(serialize($DESC_array)) ;
    $keys = base64_encode(serialize($KEYS_array)) ;

    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'image' => $image,
            'gallery' => $gallery,
            'status' => $status,
            'site_id' => $site,
            'alias' => $alias,
            'client' => $serialze_client,
            'location' => $serialze_location,
            'done_date' => $done_date,
            'demo_URL' => $demo_URL,
            'PR_DESC' => $pr_desc,
            'meta_desc' => $desc,
            'meta_key' => $keys,
            'created' => time()
        );
        $result = $model->NewInsert('works', $coulmns);
        if (is_numeric($result)) {
            if (!empty($tags)) {
                foreach ($tags as $tag) {
                    $tags_insert .= "(" . "'" . $result . "','" . $tag . "'),";
                }
                $re_values = rtrim($tags_insert, ',');
                $re_coulmns = "work_id,tag_id";
                $model->New_Multi_Insert('works_relation_tags', $re_coulmns, $re_values);
            }
            $session->message('created successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
        }
    } else {
        $all_error = "";
        foreach ($errors as $error) {
            $all_error .= $error . '<br/>';
        }
        $session->message($all_error, 'alert alert-danger');
    }
    $model->redirect_to(ADMIN_URL . 'works/new_item');
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
