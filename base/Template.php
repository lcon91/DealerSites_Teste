<?php

class Template{
    private $template_path;
    private $base;
    private $config;

    public function __construct($config){
        $this->config = $config;
        $this->template_path = 'templates/'.$this->config['template'];
        $this->base = file_get_contents("{$this->template_path}/base.html");
        $this->login = file_get_contents("{$this->template_path}/login.html");
    }

    public function render($content){
        
        $this->base = $this->renderAppConfiguration($this->base);
        
        $this->base = str_replace('{{CONTENT}}', $content, $this->base);

        echo $this->base;
    }

    private function renderAppConfiguration($layout){
        $app_lines = $this->config['app'];
        
        foreach($app_lines as $line => $value){
            $layout = str_replace('{{'.$line.'}}', $value, $layout);
        }

        return $layout;
    }

    public function renderLogin($content){
        
        $this->login = $this->renderAppConfiguration($this->login);
        
        $this->login = str_replace('{{CONTENT}}', $content, $this->login);

        echo $this->login;
    }
}