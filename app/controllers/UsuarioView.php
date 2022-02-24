<?php

class UsuarioView extends Controller{
    public function __construct(){
        $html = new THtmlRenderer('app/views/usuario_view.html');

        $usuario = new Usuario;
        $usuario = $usuario->find($_GET['id']);

        $html->enableSection('main', $usuario);
        $this->add($html->getContents());
    }
}