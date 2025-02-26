<?php
include 'VerifyUser.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $stmt = $conn->prepare("INSERT INTO feedback (request_id, feedback_text, follow_up) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $data['request_id'], $data['feedback'], $data['follow_up']);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}
?>