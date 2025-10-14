<?php

class Database
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                'mysql:dbhost=' . DB_HOST . ';dbname=' . DB_NAME . '',
                DB_USER,
                DB_PASS
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getConn(){
        return $this->pdo;
    }
}