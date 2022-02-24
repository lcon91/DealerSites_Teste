<?php

abstract class Model{
    public function find($id = null){
        $pdo = new DBConnection;

        $table = $this->getTable();
        $pk = $this->getPK();
        $stmt = $pdo->prepare("select * from {$table} where {$pk} = :id");
        
        $stmt->bindValue(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPK(){
        $class = get_class($this);
        return constant("{$class}::pk");
    }

    public function getTable(){
        $class = get_class($this);
        return constant("{$class}::table");
    }
}