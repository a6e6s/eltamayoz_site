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

if(is_array($menu))
{
    foreach ($menu as $m)
    {
        if($m['page_alias'] == 'blog')
        {
            $m_title = unserialize(base64_decode($m['title']));
            $page_title = $m_title[$_SESSION['language_alias']];
            break;
        }
    }
}
// seo ...
$_site_name = $site_settings->Site_Name;
$_site_desc = $site_settings->blog_desc;
$_site_keywords = $site_settings->blog_keys;

$_page_title = '';
$_page_title .= $page_title.' - '.$_site_name;

$_header_image = (!empty($site_settings->header_image)) ? $site_settings->header_image : false;
$_header_image_path = ARTICLES_IMAGES_PATH . $_header_image;
$_header_image_opacity = $site_settings->header_image_opacity;
// languages ..
$languages = $models->languages('name,alias,flag');

//articles data
$per_page = $site_settings->per_page;
$total_count = $models->count_articles();
$total_pages = $models->total_page($total_count, $per_page);
$current_page = ($current_page > $total_pages) ? $total_pages : $current_page;
$start = $models->start($current_page, $per_page);
$result = $models->articles_with_pagination($start, $per_page);

//articles_tags ...
$articles_tags = $models->articles_tags('id,name,alias');
//categories ...
$categories = $models->categories('name,alias');

//most popular articles..
$popular_articles = $models->most_popular_articles('5');

//search ...
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $keywords = $models->filtrate($_POST['search']);
    $models->redirect_to(URL . $_SESSION['language_alias'] . '/blog/search/' . $keywords);
}
$_image_page_path = SITES_IMAGES_PATH . $site_settings->Logo;
$_page_url = URL . $_SESSION['language_alias'] . '/blog/article';
?>
