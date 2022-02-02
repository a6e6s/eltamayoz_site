<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Requests extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {
        $this->view->render('requests');
    }

}

?>
