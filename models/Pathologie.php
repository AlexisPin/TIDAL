<?php

class Pathologie
{
    private $conn;

    public $keyword;
    public $meridien;
    public $type;
    public $caracteritique;
    public $id;


    public function __construct($db)
    {
        $this->conn  = $db;
    }

    public function read()
    {
        $query = "SELECT t1.nom as meridien, t2.desc as pathologie, t2.idP as id FROM meridien t1 LEFT JOIN patho t2 ON t2.mer = t1.code ";

        $sql = $this->conn->prepare($query);

        $sql->execute();

        $sql->setFetchMode(PDO::FETCH_CLASS, 'Pathologie');
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function read_single()
    {
        $query = "SELECT   t1.nom as meridien, t2.desc as pathologie, string_agg(t4.desc, ',') AS symptome FROM meridien t1 LEFT JOIN patho t2 ON t2.mer = t1.code 
        LEFT JOIN symptPatho t3 ON t2.idP = t3.idP LEFT JOIN symptome t4 ON t3.idS = t4.idS WHERE t2.idP = :id GROUP BY pathologie,meridien ";

        $sql = $this->conn->prepare($query);
        $sql->bindParam(':id', $this->id);
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    public function searchByKeyword()
    {
        $query =  "SELECT DISTINCT t5.desc as pathologie, t5.idP as id,t6.nom as meridien FROM keywords t1 INNER JOIN keySympt t2 ON t1.idK = t2.idK INNER JOIN symptome t3 ON t2.idS=t3.idS 
        INNER JOIN symptPatho t4 ON t3.idS=t4.idS INNER JOIN patho t5 ON t4.idP=t5.idP INNER JOIN  meridien t6 ON t5.mer = t6.code WHERE t1.name LIKE :search";

        $sql = $this->conn->prepare($query);
        $this->keyword = "%" . $this->keyword . "%";
        $sql->bindParam(':search', $this->keyword);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_CLASS, 'Pathologie');
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function filtre()
    {
        $query = "SELECT   t1.nom as meridien, t2.desc as pathologie FROM meridien t1 LEFT JOIN patho t2 ON t2.mer = t1.code ";
        $current_condition = [isset($_POST['meridien']), isset($_POST['type']), isset($_POST['caracteristique'])];
        $conditions = [[false, false, true], [false, true, false], [false, true, true], [true, false, false], [true, false, true], [true, true, false], [true, true, true]];
        switch ($current_condition) {
            case $conditions[0]:
                $filterChecked = $_POST['caracteristique'];
                $specified_query =  "WHERE t2.type LIKE :caract GROUP BY pathologie,meridien;";
                $query .= $specified_query;
                foreach ($filterChecked as $type_filter) {

                    $pathos_meridiens = $this->conn->prepare($query);
                    $pathos_meridiens->execute(array(':caract' => "%$type_filter%"));
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();

                    return $pathos_meridiens_data;
                }
                break;
            case $conditions[1]:
                $filterChecked = $_POST['type'];
                $specified_query =  "WHERE t2.type LIKE (:types) GROUP BY pathologie,meridien;";
                $query .= $specified_query;
                foreach ($filterChecked as $type_filter) {

                    $pathos_meridiens = $this->conn->prepare($query);
                    $pathos_meridiens->execute(array(':types' => "$type_filter%"));
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();

                    return $pathos_meridiens_data;
                }
                break;
            case $conditions[2]:
                $specified_query = "WHERE t2.type LIKE (:comb) GROUP BY pathologie,meridien;";
                $query .= $specified_query;
                $combinaisons = array();
                $data = [];
                foreach ($_POST['type'] as $each_types) {
                    for ($i = 0; $i < sizeof($_POST['caracteristique']); $i++) {
                        $combinaisons[] = $each_types . $_POST['caracteristique'][$i];
                    }
                }
                foreach ($combinaisons as $combinaison) {
                    $pathos_meridiens = $this->conn->prepare($query);
                    $pathos_meridiens->execute(array(':comb' => "$combinaison%"));
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                    $data = array_merge($pathos_meridiens_data, $data);
                }
                return $data;
                break;
            case $conditions[3]:
                $filterChecked = $_POST['meridien'];
                $specified_query =  " WHERE t2.mer IN (:meridiens) GROUP BY pathologie,meridien;";
                $query .= $specified_query;
                foreach ($filterChecked as $type_filter) {
                    $pathos_meridiens = $this->conn->prepare($query);
                    $pathos_meridiens->execute([':meridiens' => "$type_filter"]);
                    $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                    return $pathos_meridiens_data;
                }
                break;
            case $conditions[4]:
                $filterChecked = [$_POST['meridien'], $_POST['caracteristique']];
                $specified_query = "WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:caract) GROUP BY pathologie,meridien;";
                $query .= $specified_query;
                $data = [];
                foreach ($filterChecked[0] as $each_meridien) {
                    foreach ($filterChecked[1] as $each_caract) {
                        $pathos_meridiens = $this->conn->prepare($query);
                        $pathos_meridiens->execute(array(':meridiens' => "$each_meridien", ':caract' => "%$each_caract%"));
                        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                        $data = array_merge($pathos_meridiens_data, $data);
                    }
                }
                return $data;
                break;
            case $conditions[5]:

                $filterChecked = [$_POST['meridien'], $_POST['type']];
                $specified_query = "WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:types)  GROUP BY pathologie,meridien;";
                $query .= $specified_query;
                $data = [];
                foreach ($filterChecked[0] as $each_meridien) {
                    foreach ($filterChecked[1] as $each_type) {

                        $pathos_meridiens = $this->conn->prepare($query);
                        $pathos_meridiens->execute(array(':meridiens' => "$each_meridien", ':types' => "%$each_type%"));
                        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                        $data = array_merge($pathos_meridiens_data, $data);
                    }
                }
                return $data;
                break;
            case $conditions[6]:
                $filterChecked = [$_POST['meridien'], $_POST['type'], $_POST['caracteristique']];
                $specified_query = "WHERE t2.mer IN (:meridiens) AND t2.type LIKE (:comb)  GROUP BY pathologie,meridien;";
                $query .= $specified_query;
                $combinaisons = [];
                $data = [];
                foreach ($_POST['type'] as $each_types) {
                    for ($i = 0; $i < sizeof($_POST['caracteristique']); $i++) {
                        $combinaisons[] = $each_types . $_POST['caracteristique'][$i];
                    }
                }
                foreach ($filterChecked[0] as $each_meridien) {
                    foreach ($combinaisons as $combinaison) {

                        $pathos_meridiens = $this->conn->prepare($query);
                        $pathos_meridiens->execute(array(':meridiens' => "$each_meridien", ':comb' => "%$combinaison%"));
                        $pathos_meridiens_data = $pathos_meridiens->fetchAll();
                        $data = array_merge($pathos_meridiens_data, $data);
                    }
                }
                return $data;
                break;
        }
    }
    public function getMeridiens()
    {
        $query = "SELECT * FROM public.meridien;";
        $meridiens = $this->conn->prepare($query);
        $meridiens->execute();
        $meridiens_names = $meridiens->fetchAll();
        return $meridiens_names;
    }
}
