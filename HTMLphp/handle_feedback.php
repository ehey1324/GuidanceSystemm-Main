<?php
// handle_feedback.php
include 'VerifyUser.php'; // Ensure user is authenticated

$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Validate input
    if (empty($data['request_id']) || empty($data['feedback']) || empty($data['follow_up'])) {
        http_response_code(400);
        die("Invalid input.");
    }

    // Update consultation request status to "completed"
    $stmt = $conn->prepare("UPDATE consultation_requests SET status = 'completed' WHERE id = ?");
    $stmt->bind_param("i", $data['request_id']);
    $stmt->execute();

    // Save feedback and remarks
    $stmt = $conn->prepare("INSERT INTO feedback_remarks (request_id, feedback, follow_up) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $data['request_id'], $data['feedback'], $data['follow_up']);
    $stmt->execute();

    echo json_encode(['status' => 'success']);
} else {
    http_response_code(405);
    die("Method not allowed.");
}
?>