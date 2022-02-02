<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class View {
    
    public function render($name) {
        $models = new model();
        $session = new Session();
        $site_settings = new Front_Settings;
        require_once PATH_BASE.DS.'core/language_'.$_SESSION['language_alias'].'.php';
        require_once PATH_BASE . DS . 'models/'.$name.'.php';
        require PATH_BASE . DS . 'views' . DS . 'header.php';
        require PATH_BASE . DS . 'views' . DS . $name . '.php';
        require PATH_BASE . DS . 'views' . DS . 'footer.php';
    }

    public function render_no_header($name) {
        $models = new model();
        $site_settings = new Front_Settings;
        require_once PATH_BASE.DS.'core/language_'.$_SESSION['language_alias'].'.php';
        require PATH_BASE . DS . 'views' . DS . $name . '.php';
    }

    public function render_with_pagination($name,$current_page) {
        $models = new model();
        $session = new Session();
        $site_settings = new Front_Settings;
        require_once PATH_BASE.DS.'core/language_'.$_SESSION['language_alias'].'.php';
        require_once PATH_BASE . DS . 'models/'.$name.'.php';
        require PATH_BASE . DS . 'views' . DS . 'header.php';
        require PATH_BASE . DS . 'views' . DS . $name . '.php';
        require PATH_BASE . DS . 'views' . DS . 'footer.php';
    }
    public function render_with_alias_and_pagination($name,$alias,$current_page) {
        $models = new model();
        $session = new Session();
        $site_settings = new Front_Settings;
        require_once PATH_BASE.DS.'core/language_'.$_SESSION['language_alias'].'.php';
        require_once PATH_BASE . DS . 'models/'.$name.'.php';
        require PATH_BASE . DS . 'views' . DS . 'header.php';
        require PATH_BASE . DS . 'views' . DS . $name . '.php';
        require PATH_BASE . DS . 'views' . DS . 'footer.php';
    }

    public function render_item($name, $alias) {
        $models = new model();
        $session = new Session();
        $site_settings = new Front_Settings;
        require_once PATH_BASE.DS.'core/language_'.$_SESSION['language_alias'].'.php';
        require_once PATH_BASE . DS . 'models/'.$name.'.php';
        require PATH_BASE . DS . 'views' . DS . 'header.php';
        require PATH_BASE . DS . 'views' . DS . $name . '.php';
        require PATH_BASE . DS . 'views' . DS . 'footer.php';
    }
}
