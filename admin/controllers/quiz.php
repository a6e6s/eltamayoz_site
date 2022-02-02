<?php

/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

class Quiz extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    public function Index() 
    {
        $this->view->render('quiz/items');
    }
    public function Items() 
    {
        $this->view->render('quiz/items');
    }
    public function New_Item() 
    {  
        $this->view->render('quiz/new');
    }
    public function Edit_Item($id) 
    {
        $this->view->render_edit_page('quiz/edit',$id);
    }
    public function Questions($id) 
    {
        $this->view->render_edit_page('quiz/questions',$id);
    }
    public function New_Question($id) 
    {
        $this->view->render_edit_page('quiz/new_question',$id);
    }
    public function Edit_Question($id) 
    {
        $this->view->render_edit_page('quiz/edit_question',$id);
    }
    public function Examinees($id) 
    {
        $this->view->render_edit_page('quiz/examinees',$id);
    }
}

?>
