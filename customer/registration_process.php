<?php
session_start();
include('../db.php');

// Get form data
$mobile_number = $_POST['mobile_number'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Server-side validation
$phonePattern = '/^[0-9]{10,14}$/';                                             
if (!preg_match($phonePattern, $mobile_number)) {
    echo json_encode([
        'status' => 'error',
        'message' =>
        ['invalid' => 'Invalid phone number. Must be between 10-14 digits.']
    ]);
    exit();
}

if (empty($password)) {
    echo json_encode([
        'status' => 'error',
        'message' =>
        ['passEmpty' => 'Password cannot be empty.']
    ]);
    exit();
}

if (empty($confirmPassword)) {
    echo json_encode([
        'status' => 'error',
        'message' =>
        ['conf' => 'Please confirm your password']
    ]);
    exit();
} else if ($password !== $confirmPassword) {
    echo json_encode([
        'status' => 'error',
        'message' =>
        ['noMatch' => 'Passwords do not match']
    ]);
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
// Generate a unique session token
$session_token = bin2hex(random_bytes(32));

// Check if mobile number exists
$query = "SELECT * FROM customers WHERE mobile_number = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $mobile_number);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo json_encode([
        'status' => 'error',
        'message' =>
        ['already' => 'Mobile number already registered!']
    ]);
} else {
    // Insert customer into the database
    $query = "INSERT INTO customers (mobile_number, password, session_token) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $mobile_number, $hashed_password, $session_token);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['customer_id'] = mysqli_insert_id($conn);
        $_SESSION['session_token'] = $session_token;
        $_SESSION['success_message'] = 'Registration successful! Please log in.';
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' =>
            ['failed' => 'Registration failed.']
        ]);
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
