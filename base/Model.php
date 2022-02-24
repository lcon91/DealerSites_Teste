<?php

class Model{
    protected $table;
    protected $pk;
    protected $attributes;
    protected $data;

    protected function addAttribute($attribute){
        $this->attributes[] = $attribute;
    }

    public function __set($name, $value){
        if(in_array($name, $this->attributes)){
            $this->data[$name] = $value;
        }
    }

    public function __get($name){
        if(in_array($name, $this->attributes)){
            return $this->data[$name];
        }
    }

    public function save(){

    }
}