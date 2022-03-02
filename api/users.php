<?php

header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../config/Database.php';
include_once '../src/models/User.php';

$request_method = $_SERVER["REQUEST_METHOD"];
$database = new Database();
$db = $database->connect();


$user = new User($db);

switch ($request_method) {
    case 'GET':
        if (!empty($_GET["id"])) {

            $user->userid = intval($_GET["id"]);
            $result = $user->read_single();
            if ($result) {
                $user_array = array();
                $user_array['data'] = array();
                $user_data = array(
                    'userid' => $user->userid,
                    'username' => $user->username,
                    'email' => $user->email,
                    'useruniqueid' => $user->useruniqueid,
                    'password' => $user->password
                );
                array_push($user_array['data'], $user_data);
                echo json_encode($user_array);
            } else {
                echo json_encode(
                    array('message' => 'No users found', 'res' => -1)
                );
            }
        } else {

            $result = $user->read();
            $num = $result->rowCount();

            if ($num > 0) {
                $row = $result->fetchAll(PDO::FETCH_ASSOC);
                $users_array = array();
                $users_array['data'] = array();
                array_push($users_array['data'], ...$row);
                echo json_encode($users_array);
            } else {
                echo json_encode(
                    array('message' => 'No users found', 'res' => -1)
                );
            }
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));

        $user->username = $data->username;
        $user->email = $data->email;
        $user->useruniqueid = $data->useruniqueid;
        $user->password = $data->password;
        if ($user->create()) {
            echo json_encode(
                array('message' => 'user created', 'res' => 1)
            );
        } else {
            echo json_encode(
                array('message' => 'email already exist', 'res' => -1)
            );
        }
        break;
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));

        $user->userid = intval($_GET["id"]);
        $user->username = $data->username;
        $user->email = $data->email;
        $user->password = $data->password;
        if ($user->update()) {
            echo json_encode(
                array('message' => 'user updated', 'res' => 1)
            );
        } else {
            echo json_encode(
                array('message' => 'user not updated', 'res' => -1)
            );
        }
        break;
    case 'DELETE':
        $user->userid = intval($_GET["id"]);
        if ($user->delete()) {
            echo json_encode(
                array('message' => 'user delete', 'res' => 1)
            );
        } else {
            echo json_encode(
                array('message' => 'user not delete', 'res' => -1)
            );
        }
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
