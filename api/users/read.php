<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../../config/Database.php');
include_once('../../models/User.php');

$db = new Database();
$conn = $db->connect();

$user = new User($conn);
$res = $user->read();

$num = $res->rowCount();

if($num == 0) {
    echo json_encode(
        array('message' => 'No Users Found')
    );
} else {
    $users_arr = array();
    $users_arr['data'] = array();

    while($row = $res->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $user_item = array(
            'id' => $id,
            'name' => $name,
            'vacation_days' => $vacation_days
        );
        array_push($users_arr['data'], $user_item);

    }

    echo json_encode($users_arr);

}

