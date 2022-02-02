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
    $r_dir = 'quiz/edit_question/' . $id;
} elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'quiz/new_question/'.$_quiz_id;
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'quiz/questions/' . $_quiz_id;
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    $options = array();
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
        $options['option_1_' . $lang['alias']] = (isset($_POST['option_1_' . $lang['alias']]) && !empty($_POST['option_1_' . $lang['alias']])) ? $model->filtrate($_POST['option_1_' . $lang['alias']]) : null;
        $options['option_2_' . $lang['alias']] = (isset($_POST['option_2_' . $lang['alias']]) && !empty($_POST['option_2_' . $lang['alias']])) ? $model->filtrate($_POST['option_2_' . $lang['alias']]) : null;
        $options['option_3_' . $lang['alias']] = (isset($_POST['option_3_' . $lang['alias']]) && !empty($_POST['option_3_' . $lang['alias']])) ? $model->filtrate($_POST['option_3_' . $lang['alias']]) : null;
        $options['option_4_' . $lang['alias']] = (isset($_POST['option_4_' . $lang['alias']]) && !empty($_POST['option_4_' . $lang['alias']])) ? $model->filtrate($_POST['option_4_' . $lang['alias']]) : null;
        $options['option_5_' . $lang['alias']] = (isset($_POST['option_5_' . $lang['alias']]) && !empty($_POST['option_5_' . $lang['alias']])) ? $model->filtrate($_POST['option_5_' . $lang['alias']]) : null;
    }
//    $correct_option = (isset($_POST['correct'])) ? $model->filtrate($_POST['correct']) : '0';
    $serialze_title = base64_encode(serialize($title));
    $serialze_options = base64_encode(serialize($options));
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'status' => $status,
            'quiz_id' => $_quiz_id,
            'options' => $serialze_options,
            'created_date' => time()
        );
        $result = $model->NewUpdate('quiz_questions', $coulmns, " WHERE id = '" . $id . "' ");
        if ($result === TRUE) {
            $session->message('Update Successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . 'quiz/edit_question/' . $id);
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
