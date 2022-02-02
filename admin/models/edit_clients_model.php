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
    $r_dir = 'clients/edit_item/'.$id;
}elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'clients/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'clients/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    // validate ...............................................
    foreach ($languages as $lang) {
        $post_name = $model->filtrate(strip_tags(trim(str_replace(';',' ',$_POST['title_' . $lang['alias']]))));
        if (isset($post_name) && !empty($post_name)) {
            $title[$lang['alias']] = strip_tags($post_name);
//            if ($lang['alias'] == 'en') {
//                $alias = str_replace(' ', '_', $post_name);
//            }
        } else {
            if ($lang['alias'] == 'en') {
                $errors[] = 'Please Enter Client Title in ' . $lang['name'];
            }
        }
    }
    $serialze_title = serialize($title);
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $image = (isset($_POST['image'])) ? $_POST['image'] : '';
    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'image' => $image,
            'status' => $status,
            'modified' => time()
        );
        $result = $model->NewUpdate('clients', $coulmns," WHERE id = '".$id."' ");
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
