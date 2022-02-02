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
// footer menue
$footer_menu = $models->menus('*', $_SESSION['site_id'],'f');
$page_title = '';

if (is_array($menu)) {
    foreach ($menu as $m) {
        if ($m['page_alias'] == $alias) {
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
if (isset($alias) && !empty($alias)) {
    $result = $models->page('*', $models->filtrate($alias), $_SESSION['site_id']);
    if (is_array($result)) {
        foreach ($result as $item) {
            $_item_id = (isset($item['id'])) ? $item['id'] : 0;
            $_title_array = (isset($item['title'])) ? unserialize(base64_decode($item['title'])) : [];
            $_title = isset($_title_array[$_SESSION['language_alias']]) ? $_title_array[$_SESSION['language_alias']] : '';
            $_content_array = (isset($item['content'])) ? unserialize(base64_decode($item['content'])) : [];
            $_content = isset($_content_array[$_SESSION['language_alias']]) ? $_content_array[$_SESSION['language_alias']] : '';
            $_header_image = (isset($item['image'])) ? $item['image'] : false;
            $_header_image_path = PAGES_IMAGES_PATH . $_header_image;
            $_header_image_opacity = (isset($item['image_opacity'])) ? $item['image_opacity'] : 1;
            $_meta_desc_array = (isset($item['meta_desc'])) ? unserialize(base64_decode($item['meta_desc'])) : '';
            $_meta_key_array = (isset($item['meta_key'])) ? unserialize(base64_decode($item['meta_key'])) : '';
            $_meta_desc = isset($_meta_desc_array['meta_desc_'.$_SESSION['language_alias']]) ? $_meta_desc_array['meta_desc_'.$_SESSION['language_alias']] : '';
            $_meta_key = isset($_meta_key_array['meta_keys_'.$_SESSION['language_alias']]) ? $_meta_key_array['meta_keys_'.$_SESSION['language_alias']] : '';
            $_hits = (isset($item['hits'])) ? $item['hits'] : 0;
        }
    } else {
        $models->redirect_to(URL . $_SESSION['language_alias'] . '/error');
    }
} else {
    $models->redirect_to(URL . $_SESSION['language_alias'] . '/error');
}
$site_name = $site_settings->Site_Name;
$_page_title .= $_title.' - ' . $site_name . ' - ' . $_site_name;
$_site_desc .= ' ' . $_meta_desc;
$_site_keywords .= ',' . $_meta_key;
$_image_page_path = isset($_header_image_path) ? $_header_image_path : SITES_IMAGES_PATH . $site_settings->Logo;
$_page_url = URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'] . '/page/' . $alias;
//update hits ...
$models->update_page_hits($_hits, $_item_id);
?>
