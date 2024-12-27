<?php
// api for signUp POST REQUEST
require_once('./admin/projectDirectorFunction.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];

if ($requestMethod == "POST") {
   $userInput = json_decode(file_get_contents("php://input"), true);
   if (empty($userInput)) {
      $createProjectManager = createProjectManager($_POST);
   } else {
      $createProjectManager = createProjectManager($userInput);
   }
   echo $createProjectManager;
} else {
   $data = [
      'status' => 405,
      'message' => $requestMethod . 'Method Not Allowed',
   ];
   header("HTTP/1.0 405 Method Not Allowed");
   echo json_encode($data);
}
