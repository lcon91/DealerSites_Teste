<?php

class Application{
    private $template;

    public function __construct(){
        $config = parse_ini_file('config/config.inc.php', true);

        $this->template = new Template( $config );
    }

    public function run(){
        session_start();

        $params = $_GET;

        if(!isset($_SESSION['dealersite_user_id'])){
            $controller = new Login;
            $method = $params['method'] ?? null;
            
            if($method){
                $controller->$method();
            }

            $content = $controller;

            $this->template->renderLogin($content);
        }else{
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
}