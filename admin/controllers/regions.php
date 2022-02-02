<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class Regions extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function Index($current_page = 1) {
        require ADMIN_PATH . DS . 'models/regions_model.php';
        require ADMIN_PATH . DS . 'models/countries_model.php';
        $this->view->render('regions/index', 'index', $current_page);
    }

    public function NewRegion() {
        require ADMIN_PATH . DS . 'models/regions_model.php';
        require ADMIN_PATH . DS . 'models/countries_model.php';
        require ADMIN_PATH . DS . 'models/languages_model.php';
        $this->view->render('regions/new', 'index');
    }

    public function EditRegion($id) {
        require ADMIN_PATH . DS . 'models/regions_model.php';
        require ADMIN_PATH . DS . 'models/countries_model.php';
        require ADMIN_PATH . DS . 'models/languages_model.php';
        $this->view->render_edit_page('regions/edit', $id);
    }

    public function Published($current_page = 1) {
        require ADMIN_PATH . DS . 'models/regions_model.php';
        require ADMIN_PATH . DS . 'models/countries_model.php';
        $this->view->render('regions/index', 'published', $current_page);
    }

    public function Unpublished($current_page = 1) {
        require ADMIN_PATH . DS . 'models/regions_model.php';
        require ADMIN_PATH . DS . 'models/countries_model.php';
        $this->view->render('regions/index', 'unpublished', $current_page);
    }

    public function Search($current_page = 1) {
        require ADMIN_PATH . DS . 'models/regions_model.php';
        require ADMIN_PATH . DS . 'models/countries_model.php';
        $this->view->render('regions/index', 'search', $current_page);
    }

}

?>