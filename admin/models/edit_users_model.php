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
    $r_dir = 'users/edit_user/' . $id;
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'users/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    // validate ...............................................
    $F_name = (isset($_POST['F_name'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['F_name'])))) : '';
    $L_name = (isset($_POST['L_name'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['L_name'])))) : '';
    $gender = (isset($_POST['gender'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['gender'])))) : 'm';
    $birth = (isset($_POST['birth'])) ? strtotime($_POST['birth']) : '';
    $type = (isset($_POST['user_type'])) ? (int) $_POST['user_type'] : 1;
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $joined = (isset($_POST['joined'])) ? strtotime($_POST['joined']) : '';
    if (isset($_POST['email']) && $_POST['email'] != $_email) {
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            $email = $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['email']))));
            $check_email = $model->Get('users', 'id', " WHERE email = '" . $email . "' ", 'id', 'DESC', 0, 1);
            (is_array($check_email)) ? $errors[] = 'This Email Already Exists , Please Enter Another Email .' : null;
        } else {
            $errors[] = 'Please Enter Email .';
        }
    } else {
        $email = $_email;
    }
    $website = (isset($_POST['web'])) ? $_POST['web'] : '';
    $avatar = (isset($_POST['image'])) ? $_POST['image'] : '';
    $about = (isset($_POST['about'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['about'])))) : '';
    $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : '';
    $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : '';
    $google = (isset($_POST['google'])) ? $_POST['google'] : '';
    $alias = empty($_alias) ? str_replace(' ', '_', $_username) . '.' . rand(11111, 99999) : $_alias;

    if (empty($errors)) {
        $coulmns = array(
            'first_name' => $F_name,
            'last_name' => $L_name,
            'about_me' => $about,
            'alias' => $alias,
            'email' => $email,
            'status' => $status,
            'avatar' => $avatar,
            'gender' => $gender,
            'birth_date' => $birth,
            'register_date' => $joined,
            'admin' => $type,
            'website' => $website,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'google' => $google,
            'modified' => time()
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
