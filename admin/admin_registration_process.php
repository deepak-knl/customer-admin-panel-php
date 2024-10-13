<?php
session_start();
include('../db.php');

// Get form data
$email_address = $_POST['email_address'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

// Server-side validation
$emailPattern = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/'; // Corrected email pattern
if (!preg_match($emailPattern, $email_address)) {
    echo json_encode([
        'status' => 'error',
        'message' => ['invalid' => 'Invalid email address.']
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

if (empty($confirmPassword)) {
    echo json_encode([
        'status' => 'error',
        'message' => ['conf' => 'Please confirm your password']
    ]);
    exit();
} else if ($password !== $confirmPassword) {
    echo json_encode([
        'status' => 'error',
        'message' => ['noMatch' => 'Passwords do not match']
    ]);
    exit();
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_BCRYPT);

// Check if email exists
$query = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 's', $email_address);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo json_encode([
        'status' => 'error',
        'message' => ['already' => 'Email already registered!']
    ]);
} else {
    // Insert user into the database
    $query = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    $role = 'user';
    mysqli_stmt_bind_param($stmt, 'sss', $email_address, $hashed_password, $role);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['role'] = $role;
        $_SESSION['success_message'] = 'Registration successful! Please log in.';
        echo json_encode(['status' => 'success', 'role' => $user['role']]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => ['failed' => 'Registration failed.']
        ]);
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
