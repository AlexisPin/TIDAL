<?php

class Pathologie
{
    private $conn;
    private $table = 'patho';

    public $keyword;
    public $meridien;
    public $type;
    public $caracteritique;


    public function __construct($db)
    {
        $this->conn  = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM " . $this->table;

        $sql = $this->conn->prepare($query);

        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_CLASS, 'Pathologie');

        return $sql;
    }

    public function search()
    {
        $query =  "SELECT DISTINCT t5.desc as pathologie, t6.nom as meridien, t3.desc as symptome FROM keywords t1 INNER JOIN keySympt t2 ON t1.idK = t2.idK INNER JOIN symptome t3 ON t2.idS=t3.idS 
        INNER JOIN symptPatho t4 ON t3.idS=t4.idS INNER JOIN patho t5 ON t4.idP=t5.idP INNER JOIN  meridien t6 ON t5.mer = t6.code WHERE t1.name LIKE :search";

        $sql = $this->conn->prepare($query);
        $this->keyword = "%" . $this->keyword . "%";
        $sql->bindParam(':search', $this->keyword);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Pathologie');

        return $sql;
    }

    public function filtre()
    {
        $query =  "SELECT DISTINCT t5.desc as pathologie, t6.nom as meridien, t3.desc as symptome FROM keywords t1 INNER JOIN keySympt t2 ON t1.idK = t2.idK INNER JOIN symptome t3 ON t2.idS=t3.idS 
        INNER JOIN symptPatho t4 ON t3.idS=t4.idS INNER JOIN patho t5 ON t4.idP=t5.idP INNER JOIN  meridien t6 ON t5.mer = t6.code WHERE t1.name LIKE :search";

        $sql = $this->conn->prepare($query);
        $this->keyword = "%" . $this->keyword . "%";
        $sql->bindParam(':search', $this->keyword);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Pathologie');

        return $sql;
    }
}
