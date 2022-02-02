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
    $r_dir = 'blog/edit_article/' . $id;
} elseif (isset($_POST['save&new'])) {
    $submit = 'save&new';
    $r_dir = 'blog/new_article';
} elseif (isset($_POST['save&back'])) {
    $submit = 'save&back';
    $r_dir = 'blog/articles';
}
if (isset($_POST[$submit])) {
    $errors = array();
    $title = array();
    $tags_insert = array();
    $tags_delete = array();
    $content_array = array();
    $DESC_array = array();
    $KEYS_array = array();
    $replaces = array(';','"');
    // validate ...............................................
    foreach ($languages as $lang) {
        $post_name = $model->filtrate(str_replace($replaces, ' ', $_POST['title_' . $lang['alias']]));
        if (isset($post_name) && !empty($post_name)) {
            $title[$lang['alias']] = strip_tags($post_name);
        } else {
            if ($lang['alias'] == 'en') {
                $errors[] = 'Please Enter Article Title in ' . $lang['name'];
            }
        }
        $content_array[$lang['alias']] = (isset($_POST['content_' . $lang['alias']]) && !empty($_POST['content_' . $lang['alias']])) ? $_POST['content_' . $lang['alias']] : null;
        $DESC_array['meta_desc_' . $lang['alias']] = (isset($_POST['meta_desc_' . $lang['alias']]) && !empty($_POST['meta_desc_' . $lang['alias']])) ? $model->filtrate($_POST['meta_desc_' . $lang['alias']]) : null;
        $KEYS_array['meta_keys_' . $lang['alias']] = (isset($_POST['meta_keys_' . $lang['alias']]) && !empty($_POST['meta_keys_' . $lang['alias']])) ? $model->filtrate($_POST['meta_keys_' . $lang['alias']]) : null;
    }
    $post_alias = $model->filtrate(str_replace($replaces, ' ', $_POST['alias']));
    if (isset($post_alias) && !empty($post_alias)) {
        if (!preg_match("/[a-zA-Z0-9_\-]/", $post_alias)) {
            $errors[] = 'The Alias Should Be English Only Characters .';
        } else {
            $alias = str_replace(' ', '_', trim($post_alias));
        }
    } else {
        $errors[] = 'Please Enter the Alias of Item. ';
    }
    $serialze_title = base64_encode(serialize($title));
    $content = (!empty($content_array)) ? base64_encode(serialize($content_array)) : '';
    $image = (isset($_POST['image'])) ? $_POST['image'] : '';
    $status = (isset($_POST['status']) && $_POST['status'] == 'on') ? '1' : '0';
    (isset($_POST['cat_id']) && !empty($_POST['cat_id'])) ? $cat_id = $_POST['cat_id'] : $errors[] = 'Please Choose Category .';
    $tags = (isset($_POST['tags']) && is_array($_POST['tags'])) ? $_POST['tags'] : array();
    $desc = base64_encode(serialize($DESC_array));
    $keys = base64_encode(serialize($KEYS_array));

    foreach ($tags as $tag) {
        if (!in_array($tag, $_tags_array)) {
            $tags_insert[] = $tag;
        }
    }
    foreach ($_tags_array as $taga) {
        if (!in_array($taga, $tags)) {
            $tags_delete[] = $taga;
        }
    }
    if (empty($errors)) {
        $coulmns = array(
            'title' => $serialze_title,
            'alias' => $alias,
            'image' => $image,
            'status' => $status,
            'content' => $content,
            'user_id' => $_SESSION['admin_id'],
            'category_id' => $cat_id,
            'meta_desc' => $desc,
            'meta_key' => $keys,
            'modified' => time()
        );
        $result = $model->NewUpdate('articles', $coulmns, " WHERE id = '" . $id . "' ");
        if ($result === TRUE) {
            if (!empty($tags_insert)) {
                foreach ($tags_insert as $tag) {
                    $tags_insert2 .= "(" . "'" . $id . "','" . $tag . "'),";
                }
                $re_values = rtrim($tags_insert2, ',');
                $re_coulmns = "article_id,tag_id";
                $model->New_Multi_Insert('articles_relation_tags', $re_coulmns, $re_values);
            }
            if (!empty($tags_delete)) {
                $tags_delete_string = implode("','", $tags_delete);
                $ids_delete = $model->Get('articles_relation_tags', 'id', " WHERE article_id IN('" . $id . "') AND tag_id IN('" . $tags_delete_string . "') ");
                $ids = array();
                foreach ($ids_delete as $id_delete) {
                    $ids[] = $id_delete['id'];
                }
                $model->Wipe('articles_relation_tags', $ids);
            }
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
