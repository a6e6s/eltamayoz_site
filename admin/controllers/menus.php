<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Menus extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('menus/items');
    }
    public function Items() 
    {
        $this->view->render('menus/items');
    }
    public function New_Item() 
    {  
        $this->view->render('menus/new');
    }
    public function Edit_Item($id) 
    {
        $this->view->render_edit_page('menus/edit',$id);
    }
}

?>
