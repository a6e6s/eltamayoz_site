<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Works extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('works/items');
    }
    public function Items() 
    {
        $this->view->render('works/items');
    }
    public function New_Item() 
    {  
        $this->view->render('works/new');
    }
    public function Edit_Item($id) 
    {
        $this->view->render_edit_page('works/edit',$id);
    }
    public function Tags() 
    {
        $this->view->render('works/tags');
    }
    public function New_Tag() 
    {  
        $this->view->render('works/new_tag');
    }
    public function Edit_tag($id) 
    {
        $this->view->render_edit_page('works/edit_tag',$id);
    }
}

?>
