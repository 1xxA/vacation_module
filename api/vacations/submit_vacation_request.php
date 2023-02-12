<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once('../../config/Database.php');
include_once('../../models/Vacation.php');

$db = new Database();
$conn = $db->connect();

$vacation = new Vacation($conn, 'pending_vacation_requests');

$data = json_decode(file_get_contents('php://input'));

$vacation->user_id = $data->user_id;
$vacation->date_start = $data->date_start;
$vacation->date_end = $data->date_end;

$msg = $vacation->add() ? 'Vacation Request Submit Success' : 'Vacation Request Submit Fail';

echo json_encode(
    array('Message' => $msg)
);


