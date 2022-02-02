<?php

/* 
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Blog extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('blog/articles');
    }
    public function Articles() 
    {
        $this->view->render('blog/articles');
    }
    public function New_Article() 
    {  
        $this->view->render('blog/new_article');
    }
    public function Edit_Article($id) 
    {
        $this->view->render_edit_page('blog/edit_article',$id);
    }
    public function Tags() 
    {
        $this->view->render('blog/tags');
    }
    public function New_Tag() 
    {  
        $this->view->render('blog/new_tag');
    }
    public function Edit_tag($id) 
    {
        $this->view->render_edit_page('blog/edit_tag',$id);
    }
    public function Categories() 
    {
        $this->view->render('blog/categories');
    }
    public function New_Category() 
    {  
        $this->view->render('blog/new_category');
    }
    public function Edit_Category($id) 
    {
        $this->view->render_edit_page('blog/edit_category',$id);
    }
    public function Comments() 
    {
        $this->view->render('blog/comments');
    }
    public function Edit_comment($id) 
    {
        $this->view->render_edit_page('blog/edit_comment',$id);
    }
}

?>
