<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

// Definitions .....
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('PATH_BASE', __DIR__);
define('ADMIN_PATH', PATH_BASE.DS.'admin');
define('ADMIN_PLUGINS_PATH', PATH_BASE.DS.'admin'.DS.'plugins');
define('URL','https://net-ads.org/');
define('ADMIN_URL',URL.'admin/');
define('TEMPLATE', URL.'templates/');
define('IMAGES_PATH_BASE', PATH_BASE.DS.'images/files/');
define('THUMBS_PATH_BASE', PATH_BASE.DS.'images/thumbs/files/');
define('IMAGES', URL.'images/');
define('IMAGES_PATH', IMAGES.'files/');
define('SLIDESHOW_IMAGES_PATH', IMAGES.'files/slideshow/');
define('SITES_IMAGES_PATH', IMAGES.'files/sites/');
define('WORKS_IMAGES_PATH', IMAGES.'files/works/');
define('CLIENTS_IMAGES_PATH', IMAGES.'files/clients/');
define('WORKS_IMAGES_THUMBS_PATH', IMAGES.'thumbs/files/works/');
define('CLIENTS_IMAGES_THUMBS_PATH', IMAGES.'thumbs/files/clients/');
define('ARTICLES_IMAGES_PATH', IMAGES.'files/blog/');
define('ARTICLES_IMAGES_THUMBS_PATH', IMAGES.'thumbs/files/blog/');
define('PAGES_IMAGES_PATH', IMAGES.'files/pages/');
define('REQUESTS_IMAGES_PATH', IMAGES.'files/requests/');
define('USER_DEFAULT_IMAGES_PATH', IMAGES.'files/users/profile-pic.jpg');
define('USER_IMAGES_PATH', IMAGES.'files/users/');
define('FLAGS_IMAGES_PATH', IMAGES.'files/flags/');
// Required Files .....