<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Sites extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('sites/items');
    }
    public function Items() 
    {
        $this->view->render('sites/items');
    }
    public function New_Item() 
    {  
        $this->view->render('sites/new');
    }
    public function Edit_Item($id) 
    {
        $this->view->render_edit_page('sites/edit',$id);
    }
    public function Edit_Design($id) 
    {
        $this->view->render_edit_page('sites/edit_settings',$id);
    }
    public function Edit_Main_Site_Design($id) 
    {
        $this->view->render_edit_page('sites/main_site_design',$id);
    }
    
}

?>
