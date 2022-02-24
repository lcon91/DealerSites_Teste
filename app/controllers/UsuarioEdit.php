<?php

class UsuarioEdit extends Controller{
    public function __construct(){
        $html = new THtmlRenderer('app/views/usuario_edit.html');
        $html->enableSection('main');
        $this->add($html->getContents());
    }

    public function save(){
        $post = $_POST;
        try {
            if( ($post['senha'] != '' && $post['senha2'] != '') $post['senha'] != $post['senha2']){
                throw new Exception('As senhas informadas não são idênticas. Por favor, digite a senha corretamente nos dois campos.');
            }

            $usuario = new Usuario;
            $usuario->insert($post['nome'], $post['email'], $post['senha']);
            header('location: ?class=Home');
        } catch (Exception $e) {
            $this->add(Alert::send('danger', $e->getMessage()));
        }
    }
}