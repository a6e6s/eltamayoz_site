<?php

/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

$model = new model();
$r_dir = '';
$submit = 'save&new';
if (isset($_POST['save'])) {
    $submit = 'save';
    $r_dir = 'users/edit_user_pass/' . $id;
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'users/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    // validate ...............................................
    if(isset($_POST['old-pass']) && !empty($_POST['old-pass']))
    {
        $old_pass = sha1(trim($_POST['old-pass']));
        ($old_pass != $_password) ? $errors[] = 'The Old Password Does not Match With User Data' : null;
    }else
    {
        $errors[] = 'Please Enter Old Password .';
    }
    $pass = (isset($_POST['pass']) && !empty($_POST['pass'])) ? trim($_POST['pass']) : $errors[] = 'Please Enter Password .';
    if (isset($_POST['pass']) && !empty($_POST['pass'])) {
        if (!empty($_POST['re-pass'])) {
            $repass = trim($_POST['re-pass']);
            ($repass != $pass) ? $errors[] = 'Password And Re-Password Does Not Match .' : null;
        } else {
            $errors[] = 'Please Enter Re-Password .';
        }
    }

    if (empty($errors)) {
        $coulmns = array(
            'password' => sha1($pass),
        );
        $result = $model->NewUpdate('users', $coulmns, " WHERE id = '" . $id . "' ");
        if ($result === TRUE) {
            if (!is_dir(PATH_BASE . DS . 'images/files/users/' . $_alias)) {
                mkdir(PATH_BASE . DS . 'images/files/users/' . $_alias, 0777, true);
                mkdir(PATH_BASE . DS . 'images/thumbs/files/users/' . $_alias, 0777, true);
            }
            $session->message('update successfully .', 'alert alert-success');
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
