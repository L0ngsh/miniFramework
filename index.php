<?php
// ************************
// DO NOT CHANGE THIS FILE.
// ************************
session_start();
require 'conf.php';

spl_autoload_register(function($class){
    if (file_exists('models/'.$class.'/'.$class.'.php')) {
        require 'models/'.$class.'/'.$class.'.php';
    }
});

Core::getInstance()->run($conf);
?>