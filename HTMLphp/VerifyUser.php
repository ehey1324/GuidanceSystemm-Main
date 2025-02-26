<?php
session_start(); // Start session at the very top

$conn = new mysqli("localhost", "sungjinwoo", "Kaizel1324", "guidance_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verify user is logged in and authenticated
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: LoginAdmin&Counselor.php");
    exit();
}

// Get current user's data using session user_id
$current_user = null;
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']); // Use the user's unique ID
$stmt->execute();
$result = $stmt->get_result();
$current_user = $result->fetch_assoc();
$stmt->close();

// If user not found, destroy session and redirect
if (!$current_user) {
    session_destroy();
    header("Location: LoginAdmin&Counselor.php");
    exit();
}
?>