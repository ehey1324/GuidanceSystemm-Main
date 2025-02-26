<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'calendar_system');

// Get reservations
$reservations = $conn->query("SELECT date AS start, 'reservation' AS type FROM reservations");
// Get available days
$availableDays = $conn->query("SELECT date AS start, 'availableDay' AS type FROM available_days");
// Get events
$events = $conn->query("SELECT event_date AS start, event_name AS title, description, 'event' AS type FROM events");

$output = [];
while($row = $reservations->fetch_assoc()) $output[] = $row;
while($row = $availableDays->fetch_assoc()) $output[] = $row;
while($row = $events->fetch_assoc()) $output[] = $row;

echo json_encode($output);
?>