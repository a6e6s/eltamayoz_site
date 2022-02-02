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
    $r_dir = 'languages/edit_language/'.$id;
}elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'languages/new_language';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'languages/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    // validate ...............................................
    $post_name = $model->filtrate(strip_tags(trim(str_replace(';',' ',$_POST['name']))));
    $post_image = $model->filtrate(strip_tags(trim(str_replace(';',' ',$_POST['image']))));
    $name = (isset($post_name) && !empty($post_name)) ? $post_name : $errors[] = 'Please Enter Name.';
    $image = (isset($post_image) && !empty($post_image)) ? $post_image : $errors[] = 'Please Choose Image.';
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $direction = (isset($_POST['direction'])) ? $_POST['direction'] : 'LTR';

    if (empty($errors)) {
        $coulmns = array(
            'name' => $name,
            'status' => $status,
            'direction' => $direction,
            'flag' => $image,
            'modified' => time()
        );
        $result = $model->NewUpdate('languages', $coulmns," WHERE id = '".$id."' ");
        if ($result === TRUE) {
            $session->message('created successfully .', 'alert alert-success');
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
    $model->redirect_to(ADMIN_URL .$r_dir);
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
