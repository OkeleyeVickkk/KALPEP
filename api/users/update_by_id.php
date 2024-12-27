<?php
 header('Access-Control-Allow-Origin:*');
 header('Content-Type: application/json');
 header('Access-Control-Allow-Method: PUT');
 header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, x-Request-with');
include('userFunction.php');


 $requestMethod = $_SERVER["REQUEST_METHOD"];
 
 if($requestMethod == "PUT"){

    if(isset($_GET['id'])){
        $user = getUser($_GET);
    }

    $userList = getUserList();
    echo $userList;
 }
 else
 {
    $data = [
        'status' => 405,
        'message' => $requestMethod. 'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}


?>