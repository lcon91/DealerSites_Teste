<?php

class Login extends Controller{

    public function onLogin(){
        $post = $_POST;
        try{
            $usuarioModel = new Usuario;
            $usuario = $usuarioModel->findByLogin($post['login'], $post['senha']);

            $_SESSION['dealersite_user_id'] = $usuario['id'];
            
            header('location: ?class=Home');

        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function logout(){
        unset($_SESSION['dealersite_user_id']);

        header('location: ?class=Login');
    }
}