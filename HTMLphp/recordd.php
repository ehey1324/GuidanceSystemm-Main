
<?php
include 'VerifyUser.php';

// Database connection
$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Get current counselor ID
$counselor_id = $_SESSION['user_id'];
$current_counselor = $current_user['username'];

// Get report ID from URL
$report_id = isset($_GET['report_id']) ? intval($_GET['report_id']) : 0;

// Fetch report details
$report = [];
if ($report_id) {
    $stmt = $conn->prepare("SELECT * FROM consultation_requests WHERE id = ?");
    $stmt->bind_param("i", $report_id);
    $stmt->execute();
    $report = $stmt->get_result()->fetch_assoc();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = $_POST['feedback'];
    $status = $_POST['status'];
    $follow_up = $_POST['follow_up'];
    
    $update_stmt = $conn->prepare("
        UPDATE consultation_requests 
        SET feedback = ?, status = ?, need_follow_up = ?, handled_by = ?
        WHERE id = ?
    ");
    $update_stmt->bind_param("sssii", $feedback, $status, $follow_up, $counselor_id, $report_id);
    
    if ($update_stmt->execute()) {
        echo "<script>alert('Submission successful!');</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counseling Record</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Markazi+Text:wght@400;700&family=Arsenal+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Foradmin.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 140px 20px 20px;
        }

        .record-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            max-width: 1200px;
            margin: 0 auto;
        }

        .record-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .record-table th, .record-table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .record-table th {
            background: #007bff;
            color: white;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
        }

        .status-select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .submit-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .submit-btn {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body class="light-mode">
    <!-- Sidebar and Header (same as provided) -->
    <!-- Keep the same sidebar and header structure from the original code -->

    <div class="main-content">
        <div class="record-container">
            <h2>Counseling Session Record</h2>
            
            <form method="POST">
                <table class="record-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Student Number</th>
                            <th>Strand</th>
                            <th>Grade & Section</th>
                            <th>Concern</th>
                            <th>Counselor</th>
                            <th>Feedback & Remarks</th>
                            <th>Status</th>
                            <th>Follow Up Needed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($report) : ?>
                        <tr>
                            <td><?= htmlspecialchars($report['student_name']) ?></td>
                            <td><?= htmlspecialchars($report['student_number']) ?></td>
                            <td><?= htmlspecialchars($report['strand']) ?></td>
                            <td><?= htmlspecialchars($report['grade_level']) ?></td>
                            <td><?= htmlspecialchars($report['reason']) ?></td>
                            <td><?= htmlspecialchars($current_counselor) ?></td>
                            <td>
                                <textarea name="feedback" rows="3" required><?= 
                                    htmlspecialchars($report['feedback'] ?? '') ?></textarea>
                            </td>
                            <td>
                                <select name="status" class="status-select" required>
                                    <option value="Completed" <?= ($report['status'] ?? '') === 'Completed' ? 'selected' : '' ?>>Completed</option>
                                    <option value="Ongoing" <?= ($report['status'] ?? '') === 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>
                                    <option value="Cancelled" <?= ($report['status'] ?? '') === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                </select>
                            </td>
                            <td>
                                <div class="submit-group">
                                    <label>
                                        <input type="radio" name="follow_up" value="Yes" 
                                            <?= ($report['need_follow_up'] ?? '') === 'Yes' ? 'checked' : '' ?> required> Yes
                                    </label>
                                    <label>
                                        <input type="radio" name="follow_up" value="No"
                                            <?= ($report['need_follow_up'] ?? '') === 'No' ? 'checked' : '' ?>> No
                                    </label>
                                    <button type="submit" class="submit-btn">
                                        <i class="fa-solid fa-check"></i> Submit
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php else : ?>
                        <tr>
                            <td colspan="9" style="text-align: center;">No report selected</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <script src="Toggledark.js"></script>
</body>
</html>