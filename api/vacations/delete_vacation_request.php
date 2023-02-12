<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

include_once('../../config/Database.php');
include_once('../../models/Vacation.php');

$db = new Database();
$conn = $db->connect();

$vacation = new Vacation($conn, 'pending_vacation_requests');

$vacation->id = isset($_GET['id']) ? $_GET['id'] : die();

$msg = $vacation->delete() ? 'Vacation Request Delete Success' : 'Vacation Request Delete Fail';

echo json_encode(
    array('Message' => $msg)
);
