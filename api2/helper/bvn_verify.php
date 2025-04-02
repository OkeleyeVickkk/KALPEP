<?php
session_start();
$mono_secret_key = 'live_sk_t434z01lpijmabq27au5'; // Replace with your actual Mono secret key

if (isset($_SESSION['session_id'])) {
    $session_id = $_SESSION['session_id'];

    echo "Session ID: " . $session_id . "\n";
    echo "Verification Methods:\n";

    if (isset($_GET['otp'])) {
        $otp = $_GET['otp'];

        $url = 'https://api.withmono.com/v2/lookup/bvn/details';
        $payload = json_encode(['otp' => $otp]);

        $headers = [
            'Content-Type: application/json',
            'mono-sec-key: ' . $mono_secret_key,
            'x-session-id: ' . $session_id
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {


            //retrieve user details by id


            $user_id = $_SESSION['user_id'];
            print_r($response);

            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result) if ($result) {
                if ($result->num_rows > 0) {
                    $res = $result->fetch_assoc();
                    $_SESSION['email'] = $res['email'];
                    $_SESSION['phone'] = $res['phone'];
                    $_SESSION['first_name'] = $res['first_name'];
                    $_SESSION['last_name'] = $res['last_name'];
                    $_SESSION['nin'] = $res['nin'];
                    $_SESSION['state'] = $res['state'];
                    $_SESSION['account_type'] = $res['account_type'];
                }
            }

            $bvn = trim($_SESSION['bvn']);

            // Validate BVN format
            if (!preg_match('/^\d{10,20}$/', $bvn)) {
                echo json_encode(['status' => 400, 'message' => 'Invalid BVN format']);
                exit;
            }

            $query = "UPDATE users SET bvn = ?, status = 'make payment' WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $bvn, $user_id);

            if ($stmt->execute()) {
                echo json_encode(['status' => 201, 'message' => 'BVN verified Successfully']);
            } else {
                echo json_encode(['status' => 500, 'message' => 'Error updating BVN: ' . $stmt->error]);
            }


            //send payload for account number

            $payload = [

                "id" => $_SESSION['user_id'],
                "email" => $_SESSION['email'],
                "phone" => $_SESSION['phone'],
                "first_name" => $_SESSION['first_name'],
                "last_name" => $_SESSION['last_name'],
                "bvn" => $_SESSION['bvn'],
                "nin" => $_SESSION['nin'],
                "state" => $_SESSION['state'],
                "account_type" => $_SESSION['account_type'],
                "status" => "make payment"


            ];

            echo "\nPayload data: " . $payload;
            //sendUserDataToExternalAPI($payload);
        }

        function sendUserDataToExternalAPI($payload)
        {
            $apiUrl = "localhost/kalpep-api-test/users/signUp"; // Replace with actual API URL

            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer your_api_key_here' // If authentication is required
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200) {
                $responseData = json_decode($response, true);
                return $responseData['account_number'] ?? 'N/A';
            } else {
                return 'N/A'; // Return 'N/A' if the API request fails
            }
        }

        // echo "\nBVN Details Response: " . $response;
    } else {
        echo "\nNo OTP received.";
    }
}
?>

<!-- BVN Input -->
<div class="v-form-input">
    <label for="bvn" class="v-label">BVN</label>
    <input type="text" v-model="userAuth.bvn" class="form-control" id="bvn" placeholder="Enter your BVN" required />
</div>

<!-- Modal for OTP -->
<div id="otpModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" id="closeModal">&times;</span>
        <h2>Enter OTP</h2>
        <input type="text" id="otpInput" placeholder="Enter OTP" class="form-control" />
        <button id="submitOtp" class="btn btn-primary">Submit</button>
    </div>
</div>

<script>
    document.getElementById('bvn').addEventListener('input', function () {
        const bvn = this.value;

        // Check if BVN is 11 digits
        if (bvn.length === 11 && /^\d+$/.test(bvn)) {
            // Call BVN endpoint
            fetch('http://localhost:8000/api2/helper/bvn.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ bvn: bvn })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Open OTP modal
                        document.getElementById('otpModal').style.display = 'block';
                    } else {
                        alert('BVN validation failed. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    // Close modal functionality
    document.getElementById('closeModal').addEventListener('click', function () {
        document.getElementById('otpModal').style.display = 'none';
    });

    // Handle OTP submission
    document.getElementById('submitOtp').addEventListener('click', function () {
        const otp = document.getElementById('otpInput').value;

        if (otp) {
            alert('OTP submitted successfully!');
            document.getElementById('otpModal').style.display = 'none';
        } else {
            alert('Please enter the OTP.');
        }
    });
</script>
