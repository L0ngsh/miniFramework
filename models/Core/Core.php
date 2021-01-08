<?php
// ************************
// DO NOT CHANGE THIS FILE.
// ************************
class Core {
    
    private $conf;

    private function __construct() {}

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new Core();
        }
        return $inst;
    }

    public function run($cfg) {
        $this->conf = $cfg;
        $this->loadModel('router')->load()->match();
    }

    public function getConf($param) {
        return $this->conf[$param];
    }

    public function loadModel($mod) {
        try {
            $mod = ucfirst(strtolower($mod));
            $model = $mod::getInstance();
            return $model;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}
?>