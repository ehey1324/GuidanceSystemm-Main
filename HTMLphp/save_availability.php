<?php
$conn = new mysqli('localhost', 'username', 'password', 'calendar_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST['date'];
$slots = $_POST['slots'];

$sql = "INSERT INTO available_days (date, available_slots) VALUES ('$date', '$slots') ON DUPLICATE KEY UPDATE available_slots = '$slots'";

if ($conn->query($sql) === TRUE) {
    echo "Availability saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
