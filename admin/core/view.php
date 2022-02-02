<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
class View {

    /**
     * default index ... 
     * @param string $name page name.
     * @param string $page_status index , publish unpublish , search .
     * @param integer $current_page Number page pagination .
     */
    public function render($name,$page_status=null,$current_page=1) {
        $current_page = ($current_page < 1 ) ? 1 : $current_page;
        require ADMIN_PATH . DS . 'views' . DS . 'header.php';
        require ADMIN_PATH . DS . 'views' . DS . $name . '.php';
        require ADMIN_PATH . DS . 'views' . DS . 'footer.php';
    }
    
    /**
     * edit page ...
     * @param string $name page name.
     * @param integer $id id of item .
     */
    public function render_edit_page($name,$id) {
        require ADMIN_PATH . DS . 'views' . DS . 'header.php';
        require ADMIN_PATH . DS . 'views' . DS . $name . '.php';
        require ADMIN_PATH . DS . 'views' . DS . 'footer.php';
    }
    
    /**
     * edit page ...
     * @param string $name page name.
     * @param integer $id id of item .
     */
    public function render_login($name) {
        require ADMIN_PATH . DS . 'views' . DS . $name . '.php';
    }
    /**
     * edit page ...
     * @param string $name page name.
     * @param integer $id id of item .
     */
    public function render_run_login($name,$emial,$pass) {
        require ADMIN_PATH . DS . 'views' . DS . $name . '.php';
    }
    

}
