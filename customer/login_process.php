<?php
session_start();
include('../db.php');

$mobile_number = $_POST['mobile_number'];
$password = $_POST['password'];

// Server-side validation
$phonePattern = '/^[0-9]{10,14}$/';
if (!preg_match($phonePattern, $mobile_number)) {
    echo json_encode([
        'status' => 'error',
        'message' => ['invalid' => 'Invalid phone number. Must be between 10-14 digits.']
    ]);
    exit();
}

if (empty($password)) {
    echo json_encode([
        'status' => 'error',
        'message' => ['passEmpty' => 'Password cannot be empty.']
    ]);
    exit();
}

// Check if mobile number exists
$query = "SELECT * FROM customers WHERE mobile_number = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $mobile_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $customer = mysqli_fetch_assoc($result);

    if (password_verify($password, $customer['password'])) {
        // Generate a unique session token
        $session_token = bin2hex(random_bytes(32));

        // Update session token in the database
        $update_query = "UPDATE customers SET session_token = ? WHERE id = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, 'si', $session_token, $customer['id']);
        mysqli_stmt_execute($update_stmt);

        // Store session details
        $_SESSION['customer_id'] = $customer['id'];
        $_SESSION['session_token'] = $session_token;

        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' =>
            ['invalidPass' => 'Invalid password!']
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' =>
        ['invalidMob' => 'Invalid mobile number!']
    ]);
}
