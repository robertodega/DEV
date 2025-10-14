<?php

class Dbman
{
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME . '', DB_USER, DB_PWD);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }

    public function getConn()
    {
        return $this->conn;
    }
}
