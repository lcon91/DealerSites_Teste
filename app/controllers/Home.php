<?php

class Home extends Controller{
    public function __construct(){
        $html = new THtmlRenderer('app/views/lista_usuarios.html');
        $html->enableSection('main');
        try {
            $usuarios = Usuario::all();
            
            $html->enableSection('usuarios', $usuarios, true);
        } catch (Exception $e) {
            $this->add('Houve um erro na execução da listagem de usuários: ' . $e->getMessage());
        }
        //$this->add( view('home', [['teste' => 'vixe'], ['teste' => 'Teste2']], true) );
        $this->add($html->getContents());
    }
}