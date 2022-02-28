<?php

header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../models/Pathologie.php';

$request_method = $_SERVER["REQUEST_METHOD"];
$database = new Database();
$db = $database->connect();


$pathologie = new Pathologie($db);
