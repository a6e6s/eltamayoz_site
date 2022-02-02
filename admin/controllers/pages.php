<?php

/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

class Pages extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('pages/items');
    }
    public function Items() 
    {
        $this->view->render('pages/items');
    }
    public function New_Item() 
    {  
        $this->view->render('pages/new');
    }
    public function Edit_Item($id) 
    {
        $this->view->render_edit_page('pages/edit',$id);
    }
}

?>
