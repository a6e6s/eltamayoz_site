<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class languages extends Controller 
{
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function Index() 
    {
        $this->view->render('languages/items','index');
    }

    public function Items() 
    {
        $this->view->render('languages/items','index');
    }

    public function New_Language() 
    {
        $this->view->render('languages/new','index');
    }
    
    public function Edit_Language($id) 
    {
        $this->view->render_edit_page('languages/edit',$id);
    }
}

?>