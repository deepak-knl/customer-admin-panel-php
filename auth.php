<?php
session_start();

// Function to check if the user is logged in
function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

// Function to restrict access to a page
function restrictAccess()
{
    if (!isLoggedIn()) {
        $_SESSION['error_message']='You can not access the dashboard without login!';
        header('Location: ../admin/admin_login.php');
    }
}

// Function to restrict access to login/register pages
function restrictLoginRegisterAccess()
{
    if (isLoggedIn()) {
        header('Location: ../pages/dashboard.php');
        exit();
    }
}

// Logout function
function logout()
{
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header('Location: ../admin/admin_login.php'); // Redirect to the login page after logout
    exit();
}

// Check if the logout action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    logout();
}


// Function to check if the user is logged in
function isCustomerLoggedIn()
{
    return isset($_SESSION['customer_id']);
}

// Function to restrict access to a page
function customerRestrictAccess()
{
    if (!isCustomerLoggedIn()) {
        $_SESSION['error_message']='You can not access the customer profile without login!';
        header('Location: ../customer/customer_login.php');
    }
}

// Function to restrict access to login/register pages
function customerRestrictLoginRegisterAccess()
{
    if (isCustomerLoggedIn()) {
        header('Location: ../pages/profile.php');
        exit();
    }
}

function customerLogout()
{
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header('Location: ../customer/customer_login.php'); // Redirect to the login page after logout
    exit();
}

// Check if the logout action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'customer-logout') {
    customerLogout();
}
