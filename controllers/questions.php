<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Questions extends Controller {

    public function __construct() {
        parent::__construct();
    }
    public function Index($alias='') 
    {
        $this->view->render_item('questions',$alias);
    }

}

?>
