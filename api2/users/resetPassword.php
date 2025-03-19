<?php
// api for resetPassword POST REQUEST
include_once('userFunction.php');
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "POST") {
    $inputData = json_decode(file_get_contents("php://input"), true);
    if (empty($inputData)) {
        $resetPassword = resetPassword($_POST);
    } else {
        $resetPassword = resetPassword($inputData);
    }
    echo $resetPassword;
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>