<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */
ob_start();
@session_start();
unset($_SESSION['admin_Tamayoz_logged']);
unset($_SESSION['admin_TamayoZ']);
$controller = new Controller();
$controller->redirect_to(ADMIN_URL.'login');

?>
