<?php

class Usuario extends Model{
    protected $table = 'usuario';
    protected $pk = 'id';

    public function __construct(){
        $this->addAttribute('id');
        $this->addAttribute('nome');
        $this->addAttribute('email');
        $this->addAttribute('senha');
    }

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
}