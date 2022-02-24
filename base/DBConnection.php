<?php
class DBConnection extends PDO{
    public function __construct(){
        $dbConfig = parse_ini_file('config/config.inc.php', true)['database'];
        $driver = $dbConfig['type'];
        $host = $dbConfig['host'];
        $name = $dbConfig['name'];
        $usr = $dbConfig['usr'];
        $psw = $dbConfig['psw'];
        parent::__construct("{$driver}:host={$host};dbname={$name}", $usr, $psw);
    }
}

/*
[database]
type = 'mysql'
host = 'localhost'
usr = 'root'
psw = 'udtqc'
*/