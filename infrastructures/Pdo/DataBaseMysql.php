<?php

namespace Infrastructures\Pdo;

use PDO;

class DataBase{

    protected string $localhost='localhost';
    protected string $dataBase='PostgreSQLdb';
    protected string $user='quitus';
    protected string $password='admin';
    protected string $port;
    protected string $charset='utf8';
    protected PDO $pdo;

    public function getConnexion(){
        $conn = null;
        try {
            $conn = new PDO("mysql:host=$this->localhost;dbname=$this->dataBase;charset=$this->charset;",$this->user,$this->password,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        } catch (\PDOException $e) {
            echo "Erreur de connexion : ".$e->getMessage();
        }
        return $conn;
    }


}