<?php
header("Content-Type: application/json");
error_reporting(0); // Hide errors from output
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'error.log');

include_once('userFunction.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];

$response = [];

try {
    if ($requestMethod == "POST") {
        $input = json_decode(file_get_contents('php://input'), true);

        if (empty($input)) {
            $input = $_POST;
        }

        // Validate required fields
        if (empty($input['email']) || empty($input['password']) || empty($input['bvn'])) {
            throw new Exception("Missing required fields: email, password, or BVN.");
        }

        // Validate BVN (11 digits)
        if (strlen($input['bvn']) !== 11 || !ctype_digit($input['bvn'])) {
            throw new Exception("Invalid BVN. It must be 11 digits.");
        }

        // Save user data (replace with actual database logic)
        $userSaved = saveUser($input); // Replace with your actual database logic

        if (!$userSaved) {
            throw new Exception("Failed to save user data. Please try again.");
        }

        // Success response
        $response['success'] = true;
        $response['message'] = "Registration successful!";
    } else {
        $data = [
            'status' => 405,
            'message' => $requestMethod . ' Method Not Allowed',
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo json_encode($data);
        exit;
    }
} catch (Exception $e) {
    // Handle errors properly
    $response['success'] = false;
    $response['message'] = $e->getMessage();
}

// Always return JSON-encoded response
echo json_encode($response);
exit;

// Example function to save user data (replace with actual implementation)
function saveUser($data) {
    // Replace this with your database logic
    // Example: Insert user data into the database
    return true; // Return true if successful, false otherwise
}
