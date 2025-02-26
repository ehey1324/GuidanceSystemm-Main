<?php
include 'VerifyUser.php';
$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');

$data = json_decode(file_get_contents('php://input'), true);
$request_id = $data['request_id'];
$user_id = $data['user_id'];

$conn->query("UPDATE consultation_requests 
             SET status = 'completed', handled_by = $user_id 
             WHERE id = $request_id");
?>