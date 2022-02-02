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

    public function login($id, $username,$alias,$avatar) {
        $_SESSION['admin_Tamayoz_logged'] = 'yes';
        $_SESSION['admin_id'] = $id;
        $_SESSION['admin_name'] = $username;
        $_SESSION['admin_alias'] = $alias;
        $_SESSION['admin_avatar'] = $avatar;
        $_SESSION['admin_TamayoZ']['disabled'] = false;
        $_SESSION['admin_TamayoZ']['uploadURL'] = "../../../images/";
        if (!is_dir(PATH_BASE.DS.'images/files/users/'.$alias)) {
            mkdir(PATH_BASE.DS.'images/files/users/'.$alias, 0777,true);
            mkdir(PATH_BASE.DS.'images/thumbs/files/users/'.$alias, 0777,true);
        }
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
            $this->message = '<div class="'.$this->msg_class.'"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>'.$_SESSION['message'].'</div>';
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