<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Messages extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('messages/items');
    }
    public function Items() 
    {
        $this->view->render('messages/items');
    }
    public function Show($id) 
    {
        $this->view->render_edit_page('messages/show',$id);
    }
}

?>
