<?php

class Application{
    private $template;

    public function __construct(){
        $config = parse_ini_file('config/config.inc.php', true);

        $this->template = new Template( $config );
    }

    public function run(){
        $params = $_GET;
        $class = $params['class'] ?? 'Home';
        $method = $params['method'] ?? null;
        
        $controller = new $class;
        
        if($method){
            $controller->$method();
        }
        
        $content = $controller;

        $this->template->render($content);
    }
}