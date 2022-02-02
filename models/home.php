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
$site_settings->site_home_settings($_SESSION['site_id']);
$site_settings->contact_settings();
$site_settings->social_settings();
// main menue
$menu = $models->menus('*', $_SESSION['site_id']);
// footer menue
$footer_menu = $models->menus('*', $_SESSION['site_id'],'f');
$page_title = '';
$page_alias = '';
if (is_array($menu)) {
    foreach ($menu as $m) {
        if ($m['page_alias'] == '') {
            $m_title = unserialize(base64_decode($m['title']));
            $page_title = $m_title[$_SESSION['language_alias']];
            break;
        }
    }
}
//seo...
$_page_title = '';
$_site_desc = '';
$_site_keywords = '';
$_page_title .= $site_settings->Site_Name . ' - ' . $_site_name;
$_site_desc .= $site_settings->SiteMetaDescription;
$_site_keywords .= $site_settings->SiteMetaKey;
$_image_page_path = SITES_IMAGES_PATH . $site_settings->Logo;
$_header_image_path = $_image_page_path;
$_page_url = URL . $_SESSION['language_alias'] . '/' . $_SESSION['site_alias'];
// languages ..
$languages = $models->languages('name,alias,flag');
$slideshow = $models->slideshow('*', $_SESSION['site_id']); 
?>
