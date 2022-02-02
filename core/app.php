<?php

/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */

class App {

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];
    protected $error = false;

    public function __construct() {
        $controller = new Controller();
        $url = $this->parseUrl();

        if (!empty($url) && isset($url[0])) {
            $language_selected = $controller->select("alias,direction", "languages", " WHERE alias = '" . $controller->filtrate($url[0]) . "' ", null, null, "0", "1");
            if (is_array($language_selected)) {
                $_SESSION['language_alias'] = $language_selected[0]['alias'];
                $_SESSION['language_DIR'] = $language_selected[0]['direction'];
            } else {
                $this->error = true;
                $this->controller = 'error';
            }
            unset($url[0]);
        } elseif (isset($_SESSION['language_alias'])) {
            $language_selected = $controller->select("alias,direction", "languages", " WHERE alias = '{$controller->filtrate($_SESSION['language_alias'])}' ", null, null, "0", "1");
            if (is_array($language_selected)) {
                $_SESSION['language_alias'] = $language_selected[0]['alias'];
                $_SESSION['language_DIR'] = $language_selected[0]['direction'];
            } else {
                $this->error = true;
                $this->controller = 'error';
            }
        } else {
            $def_language = $controller->select('alias', 'languages', " WHERE is_default = '1' ", null, null, '0', '1');
            if (is_array($def_language)) {
                $_SESSION['language_alias'] = $def_language[0]['alias'];
            } else {
                $this->error = true;
                $this->controller = 'error';
            }
        }
        if (!$this->error) {
            if (isset($url[1]) && $url[1] == 'site_closed') {
                if (file_exists(PATH_BASE . DS . 'controllers/' . $url[1] . '.php')) {
                    $this->controller = $url[1];
                    unset($url[1]);
                    require_once PATH_BASE . DS . 'controllers/' . $this->controller . '.php';
                    $this->controller = new $this->controller;
                    if (isset($url[2])) {
                        if (method_exists($this->controller, $url[2])) {
                            $this->method = $url[2];
                            unset($url[2]);
                        }
                    }
                } else {
                    $this->controller = 'error';
                }
            } elseif (isset($url[1]) && $url[1] == 'blog') {
                if (file_exists(PATH_BASE . DS . 'controllers/' . $url[1] . '.php')) {
                    $this->controller = $url[1];

                    unset($url[1]);
                    require_once PATH_BASE . DS . 'controllers/' . $this->controller . '.php';
                    $this->controller = new $this->controller;
                    if (isset($url[2])) {
                        if (method_exists($this->controller, $url[2])) {
                            $this->method = $url[2];
                            unset($url[2]);
                        }
                    }
                } else {
                    $this->controller = 'error';
                }
            } elseif (isset($url[1]) && $url[1] == 'quiz') {
                if (file_exists(PATH_BASE . DS . 'controllers/' . $url[1] . '.php')) {
                    $this->controller = $url[1];
                    unset($url[1]);
                    require_once PATH_BASE . DS . 'controllers/' . $this->controller . '.php';
                    $this->controller = new $this->controller;
                    if (isset($url[2])) {
                        if (method_exists($this->controller, $url[2])) {
                            $this->method = $url[2];
                            unset($url[2]);
                        }
                    }
                } else {
                    $this->controller = 'error';
                }
            } elseif (isset($url[1]) && $url[1] == 'error') {
                if (file_exists(PATH_BASE . DS . 'controllers/' . $url[1] . '.php')) {
                    $this->controller = $url[1];
                    unset($url[1]);
                    require_once PATH_BASE . DS . 'controllers/' . $this->controller . '.php';
                    $this->controller = new $this->controller;
                    if (isset($url[2])) {
                        if (method_exists($this->controller, $url[2])) {
                            $this->method = $url[2];
                            unset($url[2]);
                        }
                    }
                }
            } else {
                if (isset($url[1])) {
                    $site = $controller->select("id,status", "sites", " WHERE alias = '{$controller->filtrate($url[1])}' ", null, null, "0", "1");
                    if (is_array($site)) {
                        if (file_exists(PATH_BASE . DS . 'controllers/' . $this->controller . '.php')) {
                            $_SESSION['site_id'] = $site[0]['id'];
                            $_SESSION['site_alias'] = $url[1];
                            $this->method = 'home';
                            unset($url[1]);
                            if (isset($url[2])) {
                                if (file_exists(PATH_BASE . DS . 'controllers/' . $url[2] . '.php')) {
                                    $this->controller = $url[2];
                                    $this->method = 'index';
                                    unset($url[2]);
                                } else {
                                    $this->controller = 'page';
                                    $this->method = 'index';
                                    unset($url[1]);
                                }
                            }
                        } else {
                            $this->controller = 'error';
                        }
                    } else {
                        $this->controller = 'error';
                    }
                }
                require_once PATH_BASE . DS . 'controllers/' . $this->controller . '.php';
                $this->controller = new $this->controller;
                if (isset($url[3])) {
                    if (method_exists($this->controller, $url[3])) {
                        $this->method = $url[3];
                        unset($url[3]);
                    }
                }
            }
            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->controller, $this->method], $this->params);
        } else {
            require_once PATH_BASE . DS . 'controllers/' . $this->controller . '.php';
            $this->controller = new $this->controller;
            call_user_func_array([$this->controller, $this->method], $this->params);
        }
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_STRING));
        }
    }

}
