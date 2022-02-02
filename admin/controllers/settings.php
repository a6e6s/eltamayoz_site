<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Settings extends Controller 
{
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function Index() 
    {
        $this->view->render('settings/contacts');
    }
    
    public function Contacts() 
    {
        $this->view->render('settings/contacts');
    }
    
    public function Requests() 
    {
        $this->view->render('settings/requests');
    }
    
    public function Mail() 
    {
        $this->view->render('settings/mail');
    }
    
    public function Social() 
    {
        $this->view->render('settings/social');
    }
    
    public function Blog() 
    {
        $this->view->render('settings/blog');
    }
}

?>