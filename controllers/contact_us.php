<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class Contact_Us extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Index() {
        $this->view->render('contact_us');
    }

}

?>
