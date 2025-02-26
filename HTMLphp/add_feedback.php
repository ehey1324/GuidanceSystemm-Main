<?php
include 'VerifyUser.php';
$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');

$request_id = $_POST['request_id'];
$feedback = $_POST['feedback'];

$conn->query("UPDATE consultation_requests 
             SET status = 'completed', feedback = '$feedback' 
             WHERE id = $request_id");
?>