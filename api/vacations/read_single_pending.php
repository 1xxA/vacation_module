<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Vacation.php');

$db = new Database();
$conn = $db->connect();

$vacation = new Vacation($conn, 'pending_vacation_requests');

$vacation->id = isset($_GET['id']) ? $_GET['id'] : die();

$vacation->read_single();

$vacation_arr = array(
    'id' => $vacation->id,
    'user_id' => $vacation->user_id,
    'date_start' => $vacation->date_start,
    'date_end' => $vacation->date_end
);

echo json_encode($vacation_arr);




