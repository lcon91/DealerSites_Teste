<?php

class Alert{
    public static function send($type = 'danger', $msg){
        $msg = addslashes($msg);
        return "<script>$(\"#content\").prepend('<div class=\"alert alert-{$type}\">{$msg}</div>');</script>";
    }
}