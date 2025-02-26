<?php
include 'VerifyUser.php';
$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');

$request_id = $_POST['request_id'];
$consultation_date = $_POST['consultation_date'];

$conn->query("UPDATE consultation_requests 
             SET status = 'approved', consultation_date = '$consultation_date' 
             WHERE id = $request_id");
?>