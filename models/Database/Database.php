<?php
// ************************
// DO NOT CHANGE THIS FILE.
// ************************
class Database {

    private $pdo;

    private function __construct() {
        $core = Core::getInstance();
        $db = $core->getConf('db');

        try {
            $this->pdo = new PDO('mysql:dbname='.$db['dbname'].';host='.$db['host'].';', $db['user'], $db['passwd']);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            exit;
        }
    }

    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new Database();
        }
        return $inst;
    }

    public function getPDO() {
        return $this->pdo;
    }
}
?>