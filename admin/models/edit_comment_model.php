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
    $r_dir = 'blog/edit_comment/'.$id;
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'blog/comments';
}
if (isset($_POST[$submit])) {
    $errors = array();
    // validate ...............................................
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $comment = (isset($_POST['comment']) && !empty($_POST['comment'])) ? $model->filtrate($_POST['comment']) : $errors[] = 'Please Write Comment.';
    
    if (empty($errors)) {
        $coulmns = array(
            'comment' => $comment,
            'status' => $status,
            'modified' => time()
        );
        $result = $model->NewUpdate('comments', $coulmns," WHERE id = '".$id."' ");
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
