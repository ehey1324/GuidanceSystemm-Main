<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'consultation_requests');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $student_name = $conn->real_escape_string($_POST['name']);
    $student_number = $conn->real_escape_string($_POST['student_no']);
    $lrn = $conn->real_escape_string($_POST['lrn']);
    $grade_level = $conn->real_escape_string($_POST['grade_level']);
    $strand = $conn->real_escape_string($_POST['strand']);
    $section = $conn->real_escape_string($_POST['section']);
    $email = $conn->real_escape_string($_POST['email']);
    $reason = $conn->real_escape_string($_POST['reason_for_consultation']);
    $other_reason = isset($_POST['other_reason']) ? $conn->real_escape_string($_POST['other_reason']) : '';
    $preferred_date = $conn->real_escape_string($_POST['preferred_date']);
    $preferred_time = $conn->real_escape_string($_POST['preferred_time']);
    $additional_info = $conn->real_escape_string($_POST['additional_info']);

    // Handle file upload
    $supporting_file = '';
    if (isset($_FILES['supporting_file']) && $_FILES['supporting_file']['error'] == 0) {
        $file_name = basename($_FILES['supporting_file']['name']);
        $file_tmp = $_FILES['supporting_file']['tmp_name'];
        $upload_dir = '../uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
            $supporting_file = $file_name;
        }
    }

    // Insert data into the database
    $sql = "INSERT INTO consultation_requests (
        student_name, student_number, lrn, grade_level, strand, section, email, reason, preferred_date, preferred_time, additional_info, supporting_file, status
    ) VALUES (
        '$student_name', '$student_number', '$lrn', '$grade_level', '$strand', '$section', '$email', '$reason', '$preferred_date', '$preferred_time', '$additional_info', '$supporting_file', 'pending'
    )";

    if ($conn->query($sql)) { // Fixed syntax error here
        echo "<script>alert('Consultation request submitted successfully!'); window.location.href = 'RMain.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "'); window.location.href = 'RMain.php';</script>";
    }
}

$conn->close();
?>