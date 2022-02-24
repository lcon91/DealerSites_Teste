<?php

class Template{
    private $template_path;
    private $base;
    private $config;

    public function __construct($config){
        $this->config = $config;
        $this->template_path = 'templates/'.$this->config['template'];
        $this->base = file_get_contents("{$this->template_path}/base.html");
    }

    public function render($content){
        
        $this->render_app_configuration();
        
        $this->base = str_replace('{{CONTENT}}', $content, $this->base);

        echo $this->base;
    }

    private function render_app_configuration(){
        $app_lines = $this->config['app'];
        
        foreach($app_lines as $line => $value){
            $this->base = str_replace('{{'.$line.'}}', $value, $this->base);
        }
    }
}