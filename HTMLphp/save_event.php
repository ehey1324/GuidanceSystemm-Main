<?php
$conn = new mysqli('localhost', 'username', 'password', 'calendar_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$eventDate = $_POST['eventDate'];
$eventName = $_POST['eventName'];
$availableForConsultations = $_POST['availableForConsultations'];

$sql = "INSERT INTO events (event_date, event_name, available_for_consultation) VALUES ('$eventDate', '$eventName', '$availableForConsultations')";

if ($conn->query($sql) === TRUE) {
    echo "Event saved successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
