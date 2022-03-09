<?php

header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../src/models/Pathologie.php';

$database = new Database();
$db = $database->connect();



$pathologie = new Pathologie($db);

$this->meridien = $_POST['meridien'];
$this->type = $_POST['type'];
$this->caracteristique = $_POST['caracteristique'];
$result = $pathologie->filtre();
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
