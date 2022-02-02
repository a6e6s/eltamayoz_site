<?php

/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */

class LogIn_model extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Authenticate($email, $password) {
        $where = " WHERE email = '" . $email . "' AND password = '" . $password . "' AND admin= '2' LIMIT 1 ";
        $result = $this->select('*','users',$where);
        return ($result) ? $result : FALSE;
    }

}
