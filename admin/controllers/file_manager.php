<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class File_Manager extends Controller 
{
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function Index() 
    {
        $this->view->render('file_manager/index');
    }
}

?>