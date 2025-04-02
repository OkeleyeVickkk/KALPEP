<?php
// Add these headers at the top of bvn.php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow specific HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers
header("Content-Type: application/json");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include the initiate_bvn_lookup.php file
require_once __DIR__ . '/initiate_bvn_lookup.php'; // Adjust the path if necessary

$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestMethod == "POST") {
    try {
        // Decode the incoming JSON request
        $input = json_decode(file_get_contents('php://input'), true);

        // Validate BVN input
        if (empty($input['bvn']) || strlen($input['bvn']) !== 11 || !ctype_digit($input['bvn'])) {
            echo json_encode(['success' => false, 'message' => 'Invalid BVN. It must be 11 digits.']);
            exit();
        }

        // Pass the BVN to the initiate_bvn_lookup logic
        $userInput = ['bvnno' => $input['bvn']];
        $response = initiate_bvn_lookup($userInput); // Assuming initiate_bvn_lookup is a function in the included file

        // Return the response from initiate_bvn_lookup
        echo json_encode(['success' => true, 'data' => $response]);
    } catch (Exception $e) {
        // Handle errors
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    exit();
} else {
    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowed',
    ];
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}

?>
