<?php

header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Pathologie.php';

$database = new Database();
$db = $database->connect();


$pathologie = new Pathologie($db);

if (!empty($_GET["query"])) {
    $pathologie->keyword = $_GET["query"];
    $result = $pathologie->searchByKeyword();
    $num = count($result);
    if ($num > 0) {
        $row = $result;
        $pathologies_array = array();
        $pathologies_array['data'] = array();
        array_push($pathologies_array['data'], ...$row);
        echo json_encode($pathologies_array);
    } else {
        echo json_encode(
            array('message' => 'No pathologies found', 'res' => -1)
        );
    }
} else {
    $result = $pathologie->read();
    $num = count($result);
    if ($num > 0) {
        $row = $result;
        $pathologies_array = array();
        $pathologies_array['data'] = array();
        array_push($pathologies_array['data'], ...$row);
        echo json_encode($pathologies_array);
    } else {
        echo json_encode(
            array('message' => 'No pathologies found', 'res' => -1)
        );
    }
}
