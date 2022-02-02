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

$page_title = '';
$menu = $models->menus('*',1);
// footer menue
$footer_menu = $models->menus('*', 1,'f');
if (is_array($menu)) {
    foreach ($menu as $m) {
        if ($m['page_alias'] == 'blog') {
            $m_title = unserialize(base64_decode($m['title']));
            $page_title = $m_title[$_SESSION['language_alias']];
            break;
        }
    }
}
// seo ...
$_site_name = $site_settings->Site_Name;
$_site_desc = '';
$_site_keywords = '';
$_page_title = '';

// languages ..
$languages = $models->languages('name,alias,flag');

if (isset($alias) && !empty($alias)) {
    $result = $models->article($models->filtrate($alias));
    if (is_array($result)) {
        foreach ($result as $item) {
            $_item_id = (isset($item['id'])) ? $item['id'] : 0;
            $_title_array = (isset($item['title'])) ? unserialize(base64_decode($item['title'])) : [];
            $_title = isset($_title_array[$_SESSION['language_alias']]) ? $models->Cut_Words($_title_array[$_SESSION['language_alias']], 600) : '';
            $_title_alias = (isset($item['alias'])) ? $item['alias'] : '';
            $_content_array = (isset($item['content'])) ? unserialize(base64_decode($item['content'])) : [];
            $_content = isset($_content_array[$_SESSION['language_alias']]) ? $_content_array[$_SESSION['language_alias']] : '';
            $_image = (isset($item['image'])) ? $item['image'] : false;
            $_image_path = ARTICLES_IMAGES_PATH . $_image;
            $_author_name = (isset($item['username'])) ? $item['username'] : '';
            $_author_alias = (isset($item['user_alias'])) ? $item['user_alias'] : '';
            $_author_about = (isset($item['about_me'])) ? $models->Cut_Words($item['about_me'], 500) : '';
            $_author_avatar = (isset($item['user_avater'])) ? $item['user_avater'] : false;
            $_author_avatar_path = $_author_avatar ? USER_IMAGES_PATH . $_author_alias . '/' . $_author_avatar : USER_DEFAULT_IMAGES_PATH;
            $_category_name_array = (isset($item['category_name'])) ? unserialize(base64_decode($item['category_name'])) : [];
            $_category_name = isset($_category_name_array[$_SESSION['language_alias']]) ? $_category_name_array[$_SESSION['language_alias']] : '';
            $_category_alias = (isset($item['category_alias'])) ? $item['category_alias'] : '';
            $_date = (isset($item['created'])) ? date('d-m-Y', $item['created']) : 'No Date';
            $_count_comments = $models->count_comments($_item_id);
            $_hits = (isset($item['hits'])) ? $item['hits'] : 0;
            $_desc_array = (isset($item['meta_desc'])) ? unserialize(base64_decode($item['meta_desc'])) : [];
            $_keys_array = (isset($item['meta_key'])) ? unserialize(base64_decode($item['meta_key'])) : [];
            $_desc = isset($_desc_array['meta_desc_' . $_SESSION['language_alias']]) ? $models->Delete_Lines($_desc_array['meta_desc_' . $_SESSION['language_alias']]) : '';
            $_keys = isset($_keys_array['meta_keys_' . $_SESSION['language_alias']]) ? $models->Delete_Lines($_keys_array['meta_keys_' . $_SESSION['language_alias']]) : '';
        }
    } else {
        $models->redirect_to(URL . $_SESSION['language_alias'] . '/error');
    }
} else {
    $models->redirect_to(URL . $_SESSION['language_alias'] . '/error');
}
$_page_title .= $_title;
$_page_title .= ' - ' . $page_title . ' - ' . $_site_name;
//$_site_desc .= ' ' . $_meta_desc;
$_site_desc =  $_desc;
$_site_keywords = $_keys;
//update hits ...
$models->update_article_hits($_hits, $_item_id);
//categories ...
$categories = $models->categories('name,alias');
//comments ...
$comments = $models->comments($_item_id);
$count_comments = (is_array($comments)) ? count($comments) : 0;
//most popular articles..
$popular_articles = $models->most_popular_articles('5');
//articles_tags ...
$articles_tags = $models->articles_tags('id,name,alias');
$tags = $models->tags_in_article($_item_id);
//search ...
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $keywords = $models->filtrate($_POST['search']);
    $models->redirect_to(URL . $_SESSION['language_alias'] . '/blog/search/' . $keywords);
}
$_image_page_path = isset($_image_path) ? $_image_path : SITES_IMAGES_PATH . $site_settings->Logo;
$_header_image_path = $_image_page_path;
$_page_url = URL . $_SESSION['language_alias'] . '/blog/article/' . $alias;
?>
