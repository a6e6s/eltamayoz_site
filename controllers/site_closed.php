<?php
/* 
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Site_Closed extends Controller
{
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function Index() 
    {
        $this->view->render_no_header('site_closed');
    }
}