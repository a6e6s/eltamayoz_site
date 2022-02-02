<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Works extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {
        $this->view->render('works');
    }
    public function Project($alias='') 
    {
        $this->view->render_item('project', $alias);
    }

}

?>
