<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once('../../config/Database.php');
include_once('../../models/User.php');

$db = new Database();
$conn = $db->connect();

$user = new User($conn);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

if($user->delete()) {
    echo json_encode(
        array('Message' => 'User Deleted')
    );
} else {
    echo json_encode(
        array('Message' => 'User Not Deleted')
    );
}

