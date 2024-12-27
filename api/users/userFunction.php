<?php

use OpenApi\Annotations as OA;



function error422($message)
{
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo json_encode($data);
}


function login($userInput)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $userInput['email']);
    $password = mysqli_real_escape_string($conn, $userInput['password']);

    if (empty(trim($email))) {
        return error422('Enter your email');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return error422('Enter a valid email address');
    } elseif (empty(trim($password))) {
        return error422('Enter a password');
    } else {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) if ($result) {
            if ($result->num_rows > 0) {
                $res = $result->fetch_assoc();
                
                if (password_verify($password, $res['password'])) {
                    
                        // Use JOIN to get the role-specific data in one query
                $query = "
                SELECT 
                    users.id as user_id, users.email, users.phone, users.role, 
                    {$res['role']}.* 
                FROM 
                    users 
                LEFT JOIN 
                    {$res['role']} 
                ON 
                    users.{$res['role']} = {$res['role']}.id 
                WHERE 
                    users.id = ?
                ";

                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $res['id']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                $userData = $result->fetch_assoc();

                $data = [
                    'status' => 200,
                    'message' => 'Login Successful',
                    'data' => [
                        'id' => $userData['user_id'],
                        'email' => $userData['email'],
                        'phone' => $userData['phone'],
                        'role' => $userData['role'],
                        "{$res['role']}_data" => [
                            'first_name' => $userData['first_name'], 
                            'last_name' => $userData['last_name'], 
                            'state' => $userData['state'], 
                            'lga' => $userData['lga'], 
                            'town' => $userData['town'], 
                            'date_created' => $userData['date_created'],
                            'date_updated' => $userData['date_updated']
                        ]
                    ],
                    'token' => generateJWT(['email' => $email]),
                ];
                header("HTTP/1.0 200 OK");
                return json_encode($data);
                } else {
                $data = [
                    'status' => 404,
                    'message' => ucfirst($res['role']) . ' Data Not Found',
                ];
                header("HTTP/1.0 404 Not Found");
                return json_encode($data);
                }

                    
                } else {
                    $data = [
                        'status' => 401,
                        'message' => 'Invalid Password',
                    ];
                    header("HTTP/1.0 401 Unauthorized");
                    return json_encode($data);
                }
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'User Not Found',
                ];
                header("HTTP/1.0 404 Not Found");
                return json_encode($data);
            }
        }
        
    }
}
function signUp($userInput)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $userInput['email']);
    $phone = mysqli_real_escape_string($conn, $userInput['phone']);
    $password = mysqli_real_escape_string($conn, $userInput['password']);

    if (empty(trim($email))) {
        return error422('Enter your email');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return error422('Enter a valid email address');
    } elseif (empty(trim($phone))) {
        return error422('Enter your phone');
    } elseif (empty(trim($password))) {
        return error422('Enter your password');
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        try {

            $query = "INSERT INTO users (email, phone, password) VALUES ('$email', '$phone', '$hashedPassword')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $body = "<p>Dear Agent ,</p><p>Thank you for registering for kalpep agency platform</p>";
                sendEmail($email, "User", $body);
    
                $data = [
                    'status' => 201,
                    'message' => 'User Created Successfully',
                    'token' => generateJWT(['email' => $email]),
                ];
                header("HTTP/1.0 201 Created");
                return json_encode($data);
            } else {
                if (mysqli_errno($conn) == 1062) {
                    $duplicateField = strpos(mysqli_error($conn), 'email') !== false ? 'Email' : 'Phone';
                    return error422("$duplicateField already in use");
                }
    
                $data = [
                    'status' => 500,
                    'message' => 'Internal Server Error',
                ];
                header("HTTP/1.0 500 Internal Server Error");
                return json_encode($data);
            }

        } catch(Exception $e) {
            if ($e->getMessage() == "Duplicate entry '$phone' for key 'phone'") {
                $data = [
                    'status' => 400,
                    'message' => "$phone already exists"
                ];
            } elseif ($e->getMessage() == "Duplicate entry '$email' for key 'email'") {
                $data = [
                    'status' => 400,
                    'message' => "$email already exists"
                ];
            } else {
                // Fallback for other exceptions
                $data = [
                    'status' => 400,
                    'message' => 'An unexpected error occurred'
                ];
            }
            
            header("HTTP/1.0 400 Bad Request");
            return json_encode($data);
            
        }
    }
}
 // function for forgetPassword
function forgetPassword($userInput)
{
    global $conn;

    $email = mysqli_real_escape_string($conn, $userInput['email']);

    if (empty(trim($email))) {
        return error422('Enter your email');
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return error422('Enter a valid email address');
    } else {
        // Check if the user exists
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            // Generate reset token and expiry
            $token = bin2hex(random_bytes(32));
            $expiresAt = date("Y-m-d H:i:s", strtotime("+1 hour"));

            // Store token in password_reset table
            $insertQuery = "INSERT INTO password_reset (email, token, expires_at) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("sss", $email, $token, $expiresAt);
            $insertStmt->execute();

            // Send reset email
            $resetLink = "https://enetworkstechnologiesltd.com/api/resetPassword?token=$token";
            $subject = "Password Reset Request";
            $message = "Click the following link to reset your password: $resetLink\nThis link will expire in 1 hour.";
            sendEmail($email, $subject, $message);

            $data = [
                'status' => 200,
                'message' => 'Password reset link sent to your email',
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No user found with this email',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    }
}

// Function for resetPassword
function resetPassword($userInput)
{
    global $conn;

    $token = mysqli_real_escape_string($conn, $userInput['token']);
    $newPassword = mysqli_real_escape_string($conn, $userInput['new_password']);

    if (empty(trim($token)) || empty(trim($newPassword))) {
        return error422('Token and new password are required');
    }

    // Validate token
    $query = "SELECT email, expires_at FROM password_reset WHERE token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $reset = $result->fetch_assoc();
        if (strtotime($reset['expires_at']) > time()) {
            // Update user's password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $updateQuery = "UPDATE users SET password = ? WHERE email = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ss", $hashedPassword, $reset['email']);
            $updateStmt->execute();

            // Delete the used reset token
            $deleteQuery = "DELETE FROM password_reset WHERE token = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("s", $token);
            $deleteStmt->execute();

            $data = [
                'status' => 200,
                'message' => 'Password reset successfully',
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 400,
                'message' => 'Invalid or expired token',
            ];
            header("HTTP/1.0 400 Bad Request");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 400,
            'message' => 'Invalid or expired token',
        ];
        header("HTTP/1.0 400 Bad Request");
        return json_encode($data);
    }
}


function getUser($user_id)
{
    global $conn;

    if (empty($user_id)) {
        return json_encode([
            'status' => 422,
            'message' => 'User ID is required',
        ]);
    }

    $user_id = mysqli_real_escape_string($conn, $user_id['id']);
    $query = "SELECT id, email, phone, date_created FROM users WHERE id = '$user_id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            $data = [
                'status' => 200,
                'message' => 'User Fetched Successfully',
                'data' => $user,
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No User Found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

function getUserProfile($user_email)
{
    global $conn;

    if (empty($user_email)) {
        return json_encode([
            'status' => 422,
            'message' => 'email is required',
        ]);
    }

    $user_id = mysqli_real_escape_string($conn, $user_email);

    
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) if ($result) {
            if ($result->num_rows > 0) {
                $res = $result->fetch_assoc();
                
                $profile_role = $res['role'];

                // Validate the role against a whitelist of allowed table names to prevent SQL injection
                $validRoles = ['admin', 'manager', 'editor']; // Add other valid roles as needed
                if (!in_array($profile_role, $validRoles)) {
                    die(json_encode([
                        'status' => 400,
                        'message' => 'Invalid role specified',
                    ]));
                }
                
                // Prepare the query dynamically based on the role
                $query = "
                    SELECT 
                        users.id as user_id, users.email, users.phone, users.role, 
                        $profile_role.* 
                    FROM 
                        users 
                    LEFT JOIN 
                        $profile_role 
                    ON 
                        users.role = $profile_role.id 
                    WHERE 
                        users.id = ?
                ";
                
                        
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $res['id']);
                        $stmt->execute();
                        $result = $stmt->get_result();
        
                        if ($result->num_rows > 0) {
                            $userData = $result->fetch_assoc();
                            
                            $data = [
                                'status' => 200,
                                'message' => 'Login Successful',
                                'data' => [
                                    'id' => $userData['user_id'],
                                    'email' => $userData['email'],
                                    'phone' => $userData['phone'],
                                    'role' => $userData['role'],
                                    'admin_data' => [
                                        'first_name' => $userData['first_name'], 
                                        'last_name' => $userData['last_name'], 
                                        'state' => $userData['state'], 
                                        'lga' => $userData['lga'], 
                                        'town' => $userData['town'], 
                                        'date_created' => $userData['date_created'],
                                        'date_updated' => $userData['date_updated']
                                        ]
                                ],
                               
                            ];
                            header("HTTP/1.0 200 OK");
                            return json_encode($data);
                        } else {
                            $data = [
                                'status' => 404,
                                'message' => 'Admin Data Not Found',
                            ];
                            header("HTTP/1.0 404 Not Found");
                            return json_encode($data);
                        }
                
            } else {
                $data = [
                    'status' => 404,
                    'message' => 'User Not Found',
                ];
                header("HTTP/1.0 404 Not Found");
                return json_encode($data);
            }
        }
        
    

}

function getUserList()
{
    global $conn;

    $query = "SELECT id, email, phone, date_created FROM users";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        if (mysqli_num_rows($query_run) > 0) {
            $users = mysqli_fetch_all($query_run, MYSQLI_ASSOC);

            $data = [
                'status' => 200,
                'message' => 'User List Fetched Successfully',
                'data' => $users,
            ];
            header("HTTP/1.0 200 OK");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No Users Found',
            ];
            header("HTTP/1.0 404 Not Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}
