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
    $r_dir = 'blog/new_tag';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'blog/tags';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    // validate ...............................................
    foreach ($languages as $lang) {
        $post_name = $model->filtrate(strip_tags(trim(str_replace(';',' ',$_POST['title_' . $lang['alias']]))));
        if (isset($post_name) && !empty($post_name)) {
            $title[$lang['alias']] = $post_name;
//            if ($lang['alias'] == 'en') {
//                $alias = str_replace(' ', '_', $post_name);
//            }
        } else {
            if ($lang['alias'] == 'en') {
                $errors[] = 'Please Enter Tag Title .' . $lang['name'];
            }
        }
    }
    $serialze_title = serialize($title);
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';

    if (empty($errors)) {
        $coulmns = array(
            'name' => $serialze_title,
            'status' => $status,
            'created' => time()
        );
        $result = $model->NewInsert('articles_tags', $coulmns);
        if (is_numeric($result)) {
            $session->message('created successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . 'blog/new_tag');
        }
    } else {
        $all_error = "";
        foreach ($errors as $error) {
            $all_error .= $error . '<br/>';
        }
        $session->message($all_error, 'alert alert-danger');
    }
    $model->redirect_to(ADMIN_URL . 'blog/new_tag');
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
