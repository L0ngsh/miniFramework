<?php
// Default configurations for rendering pages is /views/page.php
// You can change this configuration editing /model/View/View.php line 15 and 16

$this->get('/', function($params) {
    //$view = $this->core->loadModel('view');
    //$news = $this->core->loadModel('default');
    
    //$view->render('page')
});

$this->post('/', function($params) {
    //$news = $this->core->loadModel('news');
    
    //header("Location:/");
    //exit;
});
?>