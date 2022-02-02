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
    $r_dir = 'slideshow/edit_item/'.$id;
}elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'slideshow/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'slideshow/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    $desc = array();
    // validate ...............................................
    foreach ($languages as $lang) {
        $post_name = $model->filtrate(str_replace(';', ' ', $_POST['title_' . $lang['alias']]));
        $post_desc = $model->filtrate(str_replace(';', ' ', $_POST['desc_' . $lang['alias']]));
        if (isset($post_name) && !empty($post_name)) {
            $title[$lang['alias']] = $post_name;
        }
        if (isset($post_desc) && !empty($post_desc)) {
            $desc[$lang['alias']] = $post_desc;
        }
    }
    $serialze_title = (!empty($title)) ? base64_encode(serialize($title)) : '';
    $serialze_desc = (!empty($desc)) ? base64_encode(serialize($desc)) : '';
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $link = (isset($_POST['link']) && $_POST['link'] == 'on') ? '1' : '0';
    $url_type = (isset($_POST['url_type'])) ? $model->filtrate($_POST['url_type']) : 'internal';
    $url = (isset($_POST['url'])) ? $model->filtrate($_POST['url']) : '';
    $image = (isset($_POST['image'])) ? $model->filtrate($_POST['image']) : '';
    $site_id = (isset($_POST['site_id'])) ? (int)$_POST['site_id'] : 0;

    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'description' => $serialze_desc,
            'image' => $image,
            'status' => $status,
            'link' => $link,
            'url_type' => $url_type,
            'url' => $url,
            'site_id' => $site_id,
            'created' => time()
        );
        $result = $model->NewUpdate('slideshow', $coulmns," WHERE id = '" . $id . "' ");
        if ($result === TRUE) {
            $session->message('update successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . 'slideshow/new_item');
        }
    } else {
        $all_error = "";
        foreach ($errors as $error) {
            $all_error .= $error . '<br/>';
        }
        $session->message($all_error, 'alert alert-danger');
    }
    $model->redirect_to(ADMIN_URL . 'slideshow/new_item');
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
