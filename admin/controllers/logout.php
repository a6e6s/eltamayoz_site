<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class LogOut extends Controller 
{
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function Index() 
    {
        require ADMIN_PATH . DS . 'models/login_model.php';
        $this->view->render_login('login/logout');
    }
    
    public function Run($email='',$pass='') 
    {
        require ADMIN_PATH . DS . 'models/login_model.php';
        $this->view->render_run_login('login/run','index',$email,$pass);
    }
}

?>