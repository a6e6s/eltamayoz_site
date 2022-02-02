<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Home extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {
        $this->view->render_no_header('index');
    }

    public function Home() {
        $this->view->render('home');
    }

}

?>
