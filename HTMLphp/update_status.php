<?php
// Database connection
$conn = new mysqli('localhost', 'sungjinwoo', 'kurikara1324', 'consultation_requests');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $sql = "UPDATE consultation_requests SET status = '$status' WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: ApprovedORReject.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>