<?php

/*
 * @package Engazz Project .
 * @Engazz Web Solution .
 * @http://engazz.com 
 * @Developed by : engazz team .
 * @Developer Site: http//engazz.com 
 */

class App {

    protected $controller = 'dashboard';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        $url = $this->parseUrl();
        if (!empty($url)) {
            $url[0] = ($url[0] == 'index') ? 'dashboard': $url[0];
            if (file_exists(ADMIN_PATH . DS . 'controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                $this->controller = 'error';
            }
        }
        require_once ADMIN_PATH . DS . 'controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /*
     * 
     */

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
