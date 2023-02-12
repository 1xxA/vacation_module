<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once('../../config/Database.php');
include_once('../../models/Vacation.php');

$db = new Database();
$conn = $db->connect();

$pending = new Vacation($conn, 'pending_vacation_requests');
$approved = new Vacation($conn, 'approved_vacation_requests');

$pending->id = isset($_GET['id']) ? $_GET['id'] : die();

$pending->read_single();

$approved->user_id = $pending->user_id;
$approved->date_start = $pending->date_start;
$approved->date_end = $pending->date_end;

$pending->delete();

$msg = $approved->add() ? 'Vacation Request Approve Success' : 'Vacation Request Approve Fail';
echo json_encode(
    array('Message' => $msg)
);



