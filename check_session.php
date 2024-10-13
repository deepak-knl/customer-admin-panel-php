<?php
session_start();
include('../db.php');

if (!isset($_SESSION['customer_id'])) {
    header('Location: customer_login.php');
    exit();
}

$customer_id = $_SESSION['customer_id'];
$session_token = $_SESSION['session_token'];

// Check if session token in database matches
$query = "SELECT session_token FROM customers WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $customer_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$customer = mysqli_fetch_assoc($result);

if ($customer['session_token'] !== $session_token) {
    // Session token mismatch, logout the customer
    session_destroy();
    header('Location: customer_login.php');
    exit();
}
?>
