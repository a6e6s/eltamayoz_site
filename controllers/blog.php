<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Blog 
{
    public function __construct() {
        $this->view = new View();
    }
    public function Index($current_page=1) 
    {
        $this->view->render_with_pagination('articles', $current_page);
    }
    public function Articles($current_page=1) 
    {
        $this->view->render_with_pagination('articles', $current_page);
    }
    public function Article($alias='') 
    {
        $this->view->render_item('article', $alias);
    }
    public function category($alias,$current_page=1) 
    {
        $this->view->render_with_alias_and_pagination('category',$alias, $current_page);
    }
    public function search($alias,$current_page=1) 
    {
        $this->view->render_with_alias_and_pagination('search_blog',$alias, $current_page);
    }
}

?>
