<?php

/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

class Questions extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('questions/items');
    }
    public function Items() 
    {
        $this->view->render('questions/items');
    }
    public function New_Item() 
    {  
        $this->view->render('questions/new');
    }
    public function Edit_Item($id) 
    {
        $this->view->render_edit_page('questions/edit',$id);
    }
    public function Examinees($id) 
    {
        $this->view->render_edit_page('questions/examinees',$id);
    }
    
}

?>
