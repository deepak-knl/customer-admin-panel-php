<?php
session_start();
include('../db.php');

$email_address = $_POST['email_address'];
$password = $_POST['password'];

// Server-side validation
$emailPattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
if (!preg_match($emailPattern, $email_address)) {
    echo json_encode([
        'status' => 'error',
        'message' => ['invalid' => 'Invalid email.']
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

// Check if email exists
$query = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $email_address); // Use $email_address here
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        // Store session details
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        echo json_encode(['status' => 'success', 'role' => $user['role']]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => ['invalidPass' => 'Invalid password!']
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => ['invalidMail' => 'Invalid email address!']
    ]);
}
