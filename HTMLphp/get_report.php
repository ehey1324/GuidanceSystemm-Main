<?php
include 'VerifyUser.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT supporting_file FROM consultation_requests WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();

    if ($file && $file['supporting_file']) {
        echo json_encode(['file_url' => $file['supporting_file']]);
    } else {
        echo json_encode(['error' => 'File not found']);
    }
}
?>