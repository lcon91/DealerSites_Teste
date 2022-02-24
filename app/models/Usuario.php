<?php

class Usuario extends Model{
    const table = 'usuario';
    const pk = 'id';

    public static function all(){
        $pdo = new DBConnection;

        return $pdo->query('SELECT * FROM usuario ORDER BY NOME')
                   ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nome, $email, $senha){
        $pdo = new DBConnection;

        $senha = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)');
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
    }

    public function update($id, $nome, $email, $senha){
        $pdo = new DBConnection;

        if(!empty($senha)){
            $senha = password_hash($senha, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare('UPDATE usuario  SET nome = :nome, email = :email, senha = :senha WHERE id = :id');
            $stmt->bindValue(':senha', $senha);
        }else{
            $stmt = $pdo->prepare('UPDATE usuario  SET nome = :nome, email = :email WHERE id = :id');
        }
        
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }

    public function findByLogin($login, $senha){
        $pdo = new DBConnection;

        $stmt = $pdo->prepare('SELECT id, senha FROM usuario WHERE email = :login');
        $stmt->bindValue(':login', $login);

        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if(empty($usuario) || !password_verify($senha, $usuario['senha'])){
            throw new Exception('Usuário e/ou Senha inválido(s)');
        }

        return $usuario;
    }
}