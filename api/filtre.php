<?php

header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../src/models/Pathologie.php';

$database = new Database();
$db = $database->connect();



$pathologie = new Pathologie($db);

$pathologie->meridien = isset($_GET['meridien']) ? $_GET['meridien'] : false;
$pathologie->type = isset($_GET['type']) ? $_GET['type'] : false;
$pathologie->caracteristique = isset($_GET['caracteristique']) ? $_GET['caracteristique'] : false;

$result = $pathologie->filtre();
var_dump($result);
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
