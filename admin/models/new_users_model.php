<?php

/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

$model = new model();
$r_dir = '';
$submit = 'save&new';
if (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'users/new_user';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'users/items';
}
if (isset($_POST[$submit])) {
    $errors = array();
    // validate ...............................................
    $U_name = (isset($_POST['U_name']) && !empty($_POST['U_name'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['U_name'])))) : $errors[] = 'Please Enter UserName.';
    $F_name = (isset($_POST['F_name']) && !empty($_POST['F_name'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['F_name'])))) : $errors[] = 'Please Enter First Name.';
    $L_name = (isset($_POST['L_name']) && !empty($_POST['L_name'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['L_name'])))) : $errors[] = 'Please Enter Last Name.';
    $gender = (isset($_POST['gender']) && !empty($_POST['gender'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['gender'])))) : $errors[] = 'Please Chosoe Gender.';
    if (isset($_POST['birth']) && !empty($_POST['birth'])) {
        $dtime = DateTime::createFromFormat("d/m/Y", $_POST['birth']);
        $birth = $dtime->getTimestamp();
    } else {
        $errors[] = 'Please Enter Birth Date.';
    }

    $pass = (isset($_POST['pass']) && !empty($_POST['pass'])) ? trim($_POST['pass']) : $errors[] = 'Please Enter Password .';
    if (!empty($_POST['pass'])) {
        if (!empty($_POST['re-pass'])) {
            $repass = trim($_POST['re-pass']);
            ($repass != $pass) ? $errors[] = 'Password And Re-Password Does Not Match .' : null;
        } else {
            $errors[] = 'Please Enter Re-Password .';
        }
    }
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['email']))));
        $check_email = $model->Get('users', 'id', " WHERE email = '" . $email . "' ",'id', 'DESC',0,1);
        (is_array($check_email)) ? $errors[] = 'This Email Already Exists , Please Enter Another Email .' : null;
    } else {
        $errors[] = 'Please Enter Email .';
    }
    $type = (isset($_POST['user_type']) && !empty($_POST['user_type'])) ? (int) $_POST['user_type'] : $errors[] = 'Please Choose User Type.';
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : $errors[] = 'Please Enter Email.';
    $website = (isset($_POST['web'])) ? $_POST['web'] : '';
    $about = (isset($_POST['about'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['about'])))) : '';
    $facebook = (isset($_POST['facebook'])) ? $_POST['facebook'] : '';
    $twitter = (isset($_POST['twitter'])) ? $_POST['twitter'] : '';
    $google = (isset($_POST['google'])) ? $_POST['google'] : '';
    $alias = str_replace(' ', '_', $U_name) . '.' . rand(11111, 99999);

    if (empty($errors)) {
        $coulmns = array(
            'username' => $U_name,
            'first_name' => $F_name,
            'last_name' => $L_name,
            'about_me' => $about,
            'alias' => $alias,
            'password' => sha1($pass),
            'email' => $email,
            'status' => $status,
            'gender' => $gender,
            'birth_date' => $birth,
            'admin' => $type,
            'website' => $website,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'google' => $google,
            'register_date' => time(),
            'last_login' => time()
        );
        $result = $model->NewInsert('users', $coulmns);
        if (is_numeric($result)) {
            if (!is_dir(PATH_BASE . DS . 'images/files/users/' . $alias)) {
                mkdir(PATH_BASE . DS . 'images/files/users/' . $alias, 0777, true);
                mkdir(PATH_BASE . DS . 'images/thumbs/files/users/' . $alias, 0777, true);
            }
            $session->message('created successfully .', 'alert alert-success');
            $model->redirect_to(ADMIN_URL . $r_dir);
        } else {
            $session->message($result, 'alert alert-danger');
            $model->redirect_to(ADMIN_URL . 'users/new_user');
        }
    } else {
        $all_error = "";
        foreach ($errors as $error) {
            $all_error .= $error . '<br/>';
        }
        $session->message($all_error, 'alert alert-danger');
    }
    $model->redirect_to(ADMIN_URL . 'users/new_user');
}
if (!empty($session->message)) {
    echo $session->message;
}
?>
