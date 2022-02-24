<?php

class Controller{
    private $contents;
    public function __construct(){
        $this->contents = [];
    }

    public function add($content){
        $this->contents[] = $content;
    }

    public function __toString()
    {
        $content = '';
        foreach($this->contents as $element){
            $content .= $element;
        }

        return $content;
    }
}