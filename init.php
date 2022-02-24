<?php

spl_autoload_register(function ($class_name) {
    $dirs = ['base', 'app/controllers', 'app/models'];
    foreach($dirs as $dir){
        if(is_file("{$dir}/{$class_name}.php")){
            require_once "{$dir}/{$class_name}.php";
        }
    }
});

function view($view, $data = null, $loop = false){
    $content = file_get_contents("app/views/{$view}.html");
    
    if($data){
        if($loop){
            $_content = '';
            foreach($data as $_data){
                $_content .= str_replace(array_map(function($k){
                    return '{{'.$k.'}}';
                }, array_keys($_data)), array_values($_data), $content);
            }
            return $_content;
        }
        $content = str_replace(array_map(function($k){
            return '{{'.$k.'}}';
        }, array_keys($data)), array_values($data), $content);
    }

    return $content;
}