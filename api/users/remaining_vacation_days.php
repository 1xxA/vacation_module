<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/User.php');
include_once('../../models/Vacation.php');

$db = new Database();
$conn = $db->connect();

$user = new User($conn);
$vacation = new Vacation($conn, 'approved_vacation_requests');

$user->id = isset($_GET['id']) ? $_GET['id'] : die();
$user->read_single();
$total_days = $user->vacation_days;

$vacation->user_id = $user->id;
$vacation->count_days_of_vacation();
$used_days = $vacation->days_of_vacation;

echo json_encode(
    array('Message' => 'User has ' . $total_days-$used_days . ' days of vacation left')
);





