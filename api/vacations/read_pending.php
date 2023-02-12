<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/Vacation.php');

$db = new Database();
$conn = $db->connect();

$vacation = new Vacation($conn, 'pending_vacation_requests');

$res = $vacation->read();

$num = $res->rowCount();

if($num == 0) {
    echo json_encode(
        array('Message' => 'No Pending Vacations Found')
    );
} else {
    $pending_vacations_arr = array();
    $pending_vacations_arr['data'] = array();

    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $vacation = array(
            'id' => $id,
            'user_id' => $user_id,
            'date_start' => $date_start,
            'date_end' => $date_end
        );

        array_push($pending_vacations_arr['data'], $vacation);
    }

    echo json_encode($pending_vacations_arr);
}


