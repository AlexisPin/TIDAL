<?php

class Database
{
    private $host = 'localhost';
    private $db_name = 'acudb';
    private $username = 'pgtidal';
    private $password = 'tidal';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('pgsql:host=' . $this->host . ';dbname=' . $this->db_name . ';user=' . $this->username . ';password=' . $this->password);
            require_once 'creatUserTable.php';
            //$this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error ' . $e->getMessage();
        }

        return $this->conn;
    }
}
