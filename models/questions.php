<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
//site settings
$site_settings->global_settings();
$_site_name = $site_settings->Site_Name;
$site_settings->site_settings($_SESSION['site_id']);
if ($site_settings->Main_Site_Status != 0) {
    if ($site_settings->Site_Status == 0) {
        $models->redirect_to(URL . $_SESSION['language_alias'] . '/site_closed');
    }
} else {
    $models->redirect_to(URL . $_SESSION['language_alias'] . '/site_closed');
}
$site_settings->contact_settings();
$site_settings->social_settings();
// main menue
$menu = $models->menus('*', $_SESSION['site_id']);
$page_title = '';

if (is_array($menu)) {
    foreach ($menu as $m) {
        if ($m['page_alias'] == 'questions') {
            $m_title = unserialize(base64_decode($m['title']));
            $page_title = $m_title[$_SESSION['language_alias']];
            break;
        }
    }
}
// seo...
$_page_title = '';
$_meta_desc = '';
$_meta_key = '';
$_page_title = '';
$_site_desc = '';
$_site_keywords = '';

// languages ..
$languages = $models->languages('name,alias,flag');
// page details .....
$que = FALSE;
$result = $models->questions('*');
if (isset($alias) && !empty($alias)) {
    if (is_array($result)) {
        foreach ($result as $qu) {
            if ($qu['alias'] == $alias) {
                $_item_id = (isset($qu['id'])) ? $qu['id'] : 0;
                $_title_array = (isset($qu['title'])) ? unserialize(base64_decode($qu['title'])) : [];
                $_title = isset($_title_array[$_SESSION['language_alias']]) ? $_title_array[$_SESSION['language_alias']] : '';
                $_item_alias = (isset($qu['alias'])) ? $qu['alias'] : '';
                $_options_array = (isset($qu['options'])) ? unserialize(base64_decode($qu['options'])) : [];
                $_meta_desc_array = (isset($qu['meta_desc'])) ? unserialize(base64_decode($qu['meta_desc'])) : [];
                $_meta_desc = isset($_meta_desc_array[$_SESSION['language_alias']]) ? $_meta_desc_array[$_SESSION['language_alias']] : 'gggggggg';
                $_meta_key_array = (isset($qu['meta_key'])) ? unserialize(base64_decode($qu['meta_key'])) : [];
                $_meta_key = isset($_meta_key_array[$_SESSION['language_alias']]) ? $_meta_key_array[$_SESSION['language_alias']] : 'fgfgfg';
//                $page_title = $_title;
                $que = TRUE;
                break;
            }
        }
    } else {
        $models->redirect_to(URL . $_SESSION['language_alias'] . '/error');
    }
}
$site_name = $site_settings->Site_Name;
$_page_title .= $que ? $_title .' - '. $page_title . ' - ' . $_site_name :  $page_title . ' - ' . $_site_name;
$_site_desc = $que ? $_meta_desc : $site_settings->SiteMetaDescription;
$_site_keywords = $que ?  $_meta_key : $site_settings->SiteMetaKey ;
$_image_page_path = isset($_header_image_path) ? $_header_image_path : SITES_IMAGES_PATH . $site_settings->Logo;
$_page_url = $que ? URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/questions/'.$alias : URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/questions';
?>
