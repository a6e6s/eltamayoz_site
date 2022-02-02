<?php

class Session {

    private $logged_in = false;
    public $message;
    public $msg_class = '';

    // open session and check if user logged in or not ..

    public function __construct() {

        $this->check_login();
        $this->check_message();
        if ($this->logged_in) {
            // actions to take right away if user is logged in .
        } else {
            // actions to take right away if user is not logged in .
        }
    }

    // check if user logged in or not ..
    public function is_logged_in() {
        return $this->logged_in;
    }

    public function login($id, $username,$email,$alias) {
        $_SESSION['admin_logged'] = 'yes';
        $_SESSION['admin_id'] = $id;
        $_SESSION['admin_alias'] = $alias;
        $_SESSION['admin_name'] = $username;
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_cl_r_e']['disabled'] = false;
        $_SESSION['admin_cl_r_e']['uploadURL'] = "../../../images/files/".$alias;
        $this->logged_in = true;
    }

    // checking for user_id or not ..
    private function check_login() {
        if (isset($_SESSION['admin_logged'])) {			
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }
    }

    // check if session message ..

    private function check_message() {
        if (isset($_SESSION['message'])) {
            if (isset($_SESSION['msg_type'])) {
                $this->msg_class = $_SESSION['msg_type'];
                unset($_SESSION['msg_type']);
            }
            $this->message  = '<div class="col-xs-12 '.$this->msg_class.' msg">';
            $this->message .= $_SESSION['message'];
            $this->message .= '</div>';
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    // creating the session message and send to message variable ..

    public function message($msg = "", $msg_type = null) {
        if (!empty($msg)) {
            $_SESSION['message'] = $msg;
            if ($msg_type != null) {
                $_SESSION['msg_type'] = $msg_type;
            }
        } else {
            return $this->message;
        }
    }

}
?>