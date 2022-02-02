<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Users extends Controller 
{
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function Index($current_page=0) 
    {
        $this->view->render('users/items','index',$current_page);
    }

    public function New_User() 
    {
        $this->view->render('users/new','index');
    }
    
    public function Profile($id=0) 
    {
        $this->view->render_edit_page('users/profile',$id);
    }
    
    public function Edit_User($id=0) 
    {
        $this->view->render_edit_page('users/edit',$id);
    }
    
    public function Edit_User_pass($id=0) 
    {
        $this->view->render_edit_page('users/edit_pass',$id);
    }
}

?>