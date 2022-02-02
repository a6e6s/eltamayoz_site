<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
//site settings
$site_settings->global_settings();
($site_settings->Main_Site_Status == 0) ? $models->redirect_to(URL . $_SESSION['language_alias'] . '/site_closed') : null ;
$site_settings->contact_settings();
$site_settings->blog_settings();
$site_settings->social_settings();
// main menue
$menu = $models->menus('*',1);
// footer menue
$footer_menu = $models->menus('*',1,'f');
$page_title = '';

if (is_array($menu)) {
    foreach ($menu as $m) {
        if ($m['page_alias'] == 'quiz') {
            $m_title = unserialize(base64_decode($m['title']));
            $page_title = $m_title[$_SESSION['language_alias']];
            break;
        }
    }
}
// seo...
$_site_name = $site_settings->Site_Name;
$_page_title = '';
$_meta_desc = '';
$_meta_key = '';
$_site_desc = '';
$_site_keywords = '';

// languages ..
$languages = $models->languages('name,alias,flag');
// page details .....
$que = FALSE;
$quizzes = $models->quiz('*');
if (isset($alias) && !empty($alias)) {
    if (is_array($quizzes)) {
        foreach ($quizzes as $quiz) {
            if ($quiz['alias'] == $alias) {
                $_quiz_id = (isset($quiz['id'])) ? $quiz['id'] : 0;
                $_quiz_title_array = (isset($quiz['title'])) ? unserialize(base64_decode($quiz['title'])) : [];
                $_quiz_title = isset($_quiz_title_array[$_SESSION['language_alias']]) ? $_quiz_title_array[$_SESSION['language_alias']] : '';
                $_meta_desc_array = (isset($quiz['meta_desc'])) ? unserialize(base64_decode($quiz['meta_desc'])) : [];
                $_meta_desc = isset($_meta_desc_array[$_SESSION['language_alias']]) ? $_meta_desc_array[$_SESSION['language_alias']] : '';
                $_meta_key_array = (isset($quiz['meta_key'])) ? unserialize(base64_decode($quiz['meta_key'])) : [];
                $_meta_key = isset($_meta_key_array[$_SESSION['language_alias']]) ? $_meta_key_array[$_SESSION['language_alias']] : '';
                $questions = $models->quiz_questions('*', $_quiz_id);
//        $page_title = $_quiz_title;
                $que = TRUE;
            }
        }
    } else {
        $models->redirect_to(URL . $_SESSION['language_alias'] . '/error');
    }
}
$site_name = $site_settings->Site_Name;
$_page_title .= $que ? $_quiz_title . ' - ' . $page_title . ' - ' . $_site_name : $page_title . ' - ' . $_site_name;
$_site_desc = $que ? $_meta_desc : $site_settings->SiteMetaDescription;
$_site_keywords = $que ? $_meta_key : $site_settings->SiteMetaKey;
$_image_page_path = isset($_header_image_path) ? $_header_image_path : SITES_IMAGES_PATH . $site_settings->defult_header_image;
$_header_image_path = $_image_page_path;
$_page_url = $que ? URL . $_SESSION['language_alias'] . '/quiz/' . $alias : URL . $_SESSION['language_alias'] . '/quiz';
?>
