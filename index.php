<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
ob_start();
session_start();
require_once 'init.php';

// Required Files .....
require_once PATH_BASE.DS.'config.php';
require_once PATH_BASE.DS.'core/app.php';
require_once PATH_BASE.DS.'core/controller.php';
require_once PATH_BASE.DS.'core/view.php';
require_once PATH_BASE.DS.'core/model.php';
require_once PATH_BASE.DS.'core/session.php';
require_once PATH_BASE.DS.'core/settings.php';

$app = new App;

