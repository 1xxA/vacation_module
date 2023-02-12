<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once('../../config/Database.php');
include_once('../../models/User.php');

$db = new Database();
$conn = $db->connect();

$user = new User($conn);

$data = json_decode(file_get_contents("php://input"));

$user->name = $data->name;
$user->vacation_days = $data->vacation_days;

if($user->add()) {
    echo json_encode(
        array('Message' => 'User Add Success')
    );
} else {
    echo json_encode(
        array('Message' => 'User Add Fail')
    );
}



