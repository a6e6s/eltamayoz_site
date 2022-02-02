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
    $r_dir = 'menus/edit_item/'.$id;
}elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'menus/new_item';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'menus/items';
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
    $serialze_title = base64_encode(serialize($title));
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    $parent_id = (isset($_POST['parent_id']) && $_POST['parent_id'] != 'm' && $_POST['parent_id'] != 'f') ? $_POST['parent_id'] : '0';
    $level = (isset($_POST['order'])) ? $_POST['order'] : '1';
    $site = (isset($_POST['site_id'])) ? $_POST['site_id'] : $errors[] = 'Please Choose Site';
    $type = (isset($_POST['type'])) ? $_POST['type'] : 'internal';
    $menu_site = (isset($_POST['menu_site'])) ? $_POST['menu_site'] : $errors[] = 'Please Choose Site';
    $page_alias = (isset($_POST['page'])) ? $_POST['page'] : '';
    $menu = (isset($_POST['menu'])) ? $_POST['menu'] : 'm';
    $link = (isset($_POST['link']) && !empty($_POST['link'])) ? $_POST['link'] : '' ;
    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'parent_id' => $parent_id,
            'level' => $level,
            'menu' => $menu,
            'status' => $status,
            'site_id' => $site,
            'type' => $type,
            'url' => $link,
            'menu_site_id' => $menu_site,
            'page_alias' => $page_alias,
            'modified' => time()
        );
        $result = $model->NewUpdate('menus', $coulmns," WHERE id = '".$id."' ");
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
