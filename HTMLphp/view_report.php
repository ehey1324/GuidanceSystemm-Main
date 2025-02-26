<?php
include 'VerifyUser.php'; // Ensure user is authenticated

$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Fetch the report details
    $stmt = $conn->prepare("SELECT supporting_file FROM consultation_requests WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $report = $result->fetch_assoc();

    if ($report && !empty($report['supporting_file'])) {
        $file_path = $report['supporting_file'];
        
        // Check if the file exists
        if (file_exists($file_path)) {
            // Set headers for download
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        } else {
            die("File not found.");
        }
    } else {
        die("Invalid report ID or no file attached.");
    }
} else {
    die("No report ID specified.");
}
?>