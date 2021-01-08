<?php
class Router {

    private $core;
    private $get;
    private $post;

    private function __construct() {}

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new Router();
        }
        return $inst;
    }

    public function load() {
        $this->core = Core::getInstance();
        $this->loadRoutesFile();
        return $this;
    }

    public function loadRoutesFile() {
        if (file_exists('routes.php')) {
            require 'routes.php';
        }
    }

    public function match() {
        $url = (isset($_GET['url']) ? $_GET['url'] : '');
        
        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET':
            default:
                $type = $this->get;
                break;

            case 'POST':
                $type = $this->post;
                break;
        }
    
        // Search by compable patterns netween url and routes
        $found = 0;
        foreach($type as $pt => $func) {
            // Change params by regex
            $pattern = preg_replace('(\{[a-z0-9]{0,}\})', '([a-z0-9]{0,})', $pt);

            // Find wich pattern is compatible with url
            if (preg_match('#^('.$pattern.')*$#i', $url, $matches) === 1) {
                $found = 1;
                array_shift($matches);
                array_shift($matches);
            
                $items = array();
                if (preg_match_all('(\{[a-z0-9]{0,}\})', $pt, $m)) {
                    $items = preg_replace('(\{|\})', '', $m[0]);
                }

                $params = array();
                foreach ($matches as $key => $match) {
                    $params[$items[$key]] = $match;  
                }
                
                $func($params);
                break;
            }
        }
        
        // If routes do not match with the url render default 404 page
        if ($found === 0) {
            $view = $this->core->loadModel('view');
            $view->render('404');
        }
    }

    public function get($pattern, $function) {
        $this->get[$pattern] = $function;
    }

    public function post($pattern, $function) {
        $this->post[$pattern] = $function;
    }
}
?>