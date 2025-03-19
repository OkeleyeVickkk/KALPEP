<?php
include_once('userFunction.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "GET") {

    if (isset($_GET['id'])) {
        $user = getUser($_GET);
        echo $user;
        die();
    }else if (isset($_GET['role'])) {
        $getUserByRole = getUserByRole($_GET);
        echo $getUserByRole;
        die();
    } 

    $userList = getUserList();
    echo $userList;
    
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
