<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/User.php');

$db = new Database();
$conn = $db->connect();

$user = new User($conn);

$user->id = isset($_GET['id']) ? $_GET['id'] : die();

$user->read_single();

$user_arr = array(
    'id' => $user->id,
    'name' => $user->name,
    'vacation_days' => $user->vacation_days
);

echo json_encode($user_arr);


