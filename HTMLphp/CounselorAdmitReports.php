<?php
include 'VerifyUser.php';

$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Fetch available reports
$available_reports = $conn->query("
    SELECT * FROM consultation_requests 
    WHERE status = 'approved' AND handled_by IS NULL
");

// Handle report taking
if (isset($_POST['take_report'])) {
    $report_id = $_POST['report_id'];
    $counselor_id = $_SESSION['user_id'];
    $taken_time = date('Y-m-d H:i:s');

    $update_report = $conn->prepare("
        UPDATE consultation_requests 
        SET handled_by = ?, handled_at = ? 
        WHERE id = ?
    ");
    $update_report->bind_param("isi", $counselor_id, $taken_time, $report_id);
    
    if ($update_report->execute()) {
        header("Location: record.php?report_id=$report_id");
        exit();
    } else {
        echo "Error taking report: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counselor Panel</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Markazi+Text:wght@400;700&family=Arsenal+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Foradmin.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 70px 20px 20px;
            min-height: 100vh;
        }

        .reports-container {
            max-width: 1500px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .reports-header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }

        .reports-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .reports-table th, .reports-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .reports-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #343a40;
        }

        .take-report-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .take-report-btn:hover {
            background-color: #218838;
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .no-reports {
            text-align: center;
            padding: 40px;
            color: #6c757d;
            font-size: 1.1em;
        }

        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .status-available {
            background-color: #28a745;
        }
    </style>
</head>
<body class="light-mode">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="../CSS/Guidance.png" alt="Logo" class="logo">
        </div>
        <nav class="nav-menu">
            <a href="counsilor.php" class="nav-item">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
            <a href="CounselorAdmitReports.php" class="nav-item">
                <i class="fa-solid fa-people-arrows"></i>
                <span>Counselling</span>
            </a>
            <a href="recordd.php" class="nav-item">
                <i class="fa-solid fa-book-medical"></i>
                <span>Record</span>
            </a>
        </nav>
        <div class="logout-section">
            <a href="logout.php" class="logout-button">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <div class="header-titles">
            <h1 class="main-title">Arellano University Jose Rizal Campus</h1>
            <h2 class="sub-title">Guidance Consultation System</h2>
        </div>
        <div class="user-info">
            <div class="notification-icons">
                <span>┃</span>
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>┃</span>
            </div>
            <div class="profile-container">
                <img src="<?= htmlspecialchars($current_user['profile_image']) ?>" 
                     alt="Profile" 
                     class="profile-image"
                     onerror="this.src='default-profile.jpg'">
                <div class="user-details">
                    <span><?= htmlspecialchars($current_user['username']) ?></span>
                    <div><?= htmlspecialchars($current_user['email']) ?> | <?= htmlspecialchars($current_user['role']) ?></div>
                </div>
            </div>
            <div class="display-icon" onclick="toggleThemeDropdown()">
                <i class="fa-solid fa-display"></i>
            </div>
            <div class="user-dropdown">
                <div class="user-dropdown-content" id="theme-dropdown">
                    <a href="#" onclick="toggleTheme()">
                        <i class="fa-solid fa-sun"></i> Light Mode
                        <i class="fa-solid fa-toggle-on theme-switch"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="reports-container">
            <div class="reports-header">
                <h2>Available Consultation Requests</h2>
                <p>Manage incoming student consultation requests</p>
            </div>
            
            <?php if ($available_reports->num_rows > 0): ?>
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Contact</th>
                            <th>Reason</th>
                            <th>Preferre Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $available_reports->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <span class="status-indicator status-available"></span>
                                    <?= htmlspecialchars($row['student_name']) ?>
                                </td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['reason']) ?></td>
                                <td><?= date('M d, Y h:i A', strtotime($row['preferred_time'])) ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="report_id" value="<?= $row['id'] ?>">
                                        <button type="submit" name="take_report" class="take-report-btn">
                                            <i class="fa-solid fa-hand-holding-heart"></i>
                                            Take Case
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-reports">
                    <i class="fa-regular fa-circle-check fa-2x"></i>
                    <p>All caught up! No pending consultation requests.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="Toggledark.js"></script>
</body>
</html>