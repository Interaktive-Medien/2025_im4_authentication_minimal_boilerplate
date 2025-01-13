<?php
// protected.php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Not authorized
    http_response_code(401);
    echo json_encode(["message" => "Unauthorized"]);
    exit;
}

// Authorized — return user info
$response = [
    "email" => $_SESSION['email'],
    "message" => "You have access"
];
echo json_encode($response);
