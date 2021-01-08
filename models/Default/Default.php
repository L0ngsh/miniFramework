<?php

// Default example to create others models

class Defalut {

    private $pdo;

    private function __construct() {
        $core = Core::getInstance();
        $db = $core->loadModel('database');
        $this->pdo = $db->getPDO();
    }

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new Defalut();
        }
        return $inst;
    }
}
?>