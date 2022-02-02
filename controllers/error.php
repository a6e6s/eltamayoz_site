<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Error extends Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function Index() 
    {
        $this->view->render_no_header('404');
    }
}