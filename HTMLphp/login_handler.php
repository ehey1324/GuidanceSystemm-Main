<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database configuration
$servername = "localhost";
$username = "sungjinwoo"; // Replace with your database username
$password = "Kaizel1324"; // Replace with your database password
$dbname = "guidance_system"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$userType = $_POST['user_type']; // User type (Admin or Counsellor)
$usernameEmail = $_POST['username_email']; // Username or email
$password = $_POST['password']; // Password

// Prepare SQL statement
$sql = "SELECT * FROM users WHERE (username = ? OR email = ?) AND role = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sss", $usernameEmail, $usernameEmail, $userType);

// Execute the query
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Get the result
$result = $stmt->get_result();

// Check if a user was found
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verify password (assuming passwords are hashed)
    if (password_verify($password, $user['password'])) {
        // Start session and store user data
        $_SESSION = [
            'user_id' => $user['id'], // Store the user's unique ID
            'user_role' => $user['role'],
            'authenticated' => true,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        ];

        // Regenerate session ID to prevent fixation
        session_regenerate_id(true);

        // Redirect based on user role
        if ($user['role'] === 'Admin') {
            header("Location: adminn.php");
        } elseif ($user['role'] === 'Counsellor') {
            header("Location: counsilor.php");
        } else {
            header("Location: login.php?error=invalid_role");
        }
        exit();
    } else {
        // Invalid password
        header("Location: LoginAdmin&Counselor.php?error=invalid_password");
        exit();
    }
} else {
    // No user found
    header("Location: LoginAdmin&Counselor.php?error=invalid_credentials");
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>