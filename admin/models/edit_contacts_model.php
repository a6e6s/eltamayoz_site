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
    $r_dir = 'settings/contacts';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $contact = array();
    // validate ...............................................
    foreach ($languages as $lang) {
        $page_title = $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['title_' . $lang['alias']]))));
        $info_title = $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['info_title_' . $lang['alias']]))));
        $address = $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['address_' . $lang['alias']]))));
        $work = $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['work_' . $lang['alias']]))));
        $holiday = $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['holiday_' . $lang['alias']]))));
        $contact['page_title_' . $lang['alias']] = (isset($page_title) && !empty($page_title)) ? $page_title : '';
        $contact['info_title_' . $lang['alias']] = (isset($info_title) && !empty($info_title)) ? $info_title : '';
        $contact['address_' . $lang['alias']] = (isset($address) && !empty($address)) ? $address : '';
        $contact['work_' . $lang['alias']] = (isset($work) && !empty($work)) ? $work : '';
        $contact['holiday_' . $lang['alias']] = (isset($holiday) && !empty($holiday)) ? $holiday : '';
    }
    $contact['mobile'] = (isset($_POST['mobile']) && !empty($_POST['mobile'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['mobile'])))) : '';
    $contact['phone'] = (isset($_POST['phone']) && !empty($_POST['phone'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['phone'])))) : '';
    $contact['email'] = (isset($_POST['email']) && !empty($_POST['email'])) ? $model->filtrate(strip_tags(trim(str_replace(';', ' ', $_POST['email'])))) : '';
    $contact['maplat'] = (isset($_POST['maplat']) && !empty($_POST['maplat'])) ? $_POST['maplat'] : 0;
    $contact['maplng'] = (isset($_POST['maplng']) && !empty($_POST['maplng'])) ? $_POST['maplng'] : 0;
    $contact['zoom'] = (isset($_POST['zoom']) && !empty($_POST['zoom'])) ? $_POST['zoom'] : 10;
    $contacts_serialze = (!empty($contact)) ? base64_encode(serialize($contact)) : '';
    if (empty($errors)) {
        $coulmns = array(
            'settings_name' => 'contacts settings',
            'settings_values' => $contacts_serialze
        );
        $result = $model->NewUpdate('settings', $coulmns, " WHERE id = '6' ");
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
