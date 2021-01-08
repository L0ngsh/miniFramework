<?php
class View {

    private function __construct() {}

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new View();
        }
        return $inst;
    }

    public function render($view, $data = array()) {
        if (file_exists('views/'.$view.'.php')) {
            require 'views/'.$view.'.php';
        }
    }
}
?>