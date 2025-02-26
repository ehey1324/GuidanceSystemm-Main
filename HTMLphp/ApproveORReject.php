<?php
// Include the PHP logic from VerifyUser.php
include 'VerifyUser.php'; // This will load the database connection, session handling, and user authentication logic
// Fetch pending requests

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Markazi+Text:wght@400;700&family=Arsenal+SC&display=swap" rel="stylesheet">
    <!-- Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <title>Interactive Sidebar</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Markazi+Text:wght@400;700&family=Arsenal+SC&display=swap" rel="stylesheet">
    <!-- Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link rel="stylesheet" href="Foradmin.css">
</head>
<body class="light-mode">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="../CSS/Guidance.png" alt="Logo" class="logo">
        </div>
        <a href="adminn.php" class="nav-item">
    <i class="fa-solid fa-gauge-high"></i>
    <span>Dashboard</span>
</a>
            <a href="counseling.php" class="nav-item">
                <i class="fa-solid fa-calendar-days"></i>
                <span>Counselling & Appointments</span>
            </a>
            <a href="report-admin.php" class="nav-item">
                <i class="fa-solid fa-flag"></i>
                <span>Report</span>
            </a>
            <a href="record.php" class="nav-item">
                <i class="fa-solid fa-book-medical"></i>
                <span>Record</span>
            </a>
            <a href="ApproveORReject.php" class="nav-item">
            </i><i class="fa-solid fa-people-arrows"></i>
            <span>Consultation Request</span>
            </a>
            
            <a href="Admin_and_Counselor_Accounts.php" class="nav-item" onclick="showAccountManagement()">
            </i><i class="fa fa-user-plus"><aria-hidden="true"></i>
            <span>Add Admin & Counsellor</span>
          
            <a href="Follow_Up_Sessionon.php" class="nav-item">
             </i><i class="fa-solid fa-envelope-open-text"></i>
                 <span>Follow-Up Session</i><span>
            </a>
        </nav>
        
        <div class="logout-section">
        <a href="logout.php" class="logout-button">
    <i class="fa fa-sign-out" aria-hidden="true"></i>
    <span>Logout</span>
</a>
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
                <!-- Updated Profile Section -->
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


    
    <title>Consultation Requests</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #ffebcd;
            color: #1b1b1b;
        }

        .sidebar {
            background: rgba(9, 28, 56, 0.9);
            backdrop-filter: blur(10px);
            width: 250px;
            height: 100vh;
            padding: 20px;
            position: fixed;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .nav-item {
            color: rgb(255, 255, 255);
            text-decoration: none;
            padding: 15px;
            margin: 8px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            background-color: #008cff;
            color: white;
        }

        .nav-item.active {
            background-color: #091c38;
            color: white;
            border-left: 4px solid rgb(255, 255, 255);
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            margin-top: 120px;
        }

        .requests-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .requests-table th,
        .requests-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .requests-table th {
            background-color: #1a3c80;
            color: white;
        }

        .requests-table tr:hover {
            background-color: #f5f5f5;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .approve-btn, .reject-btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .approve-btn {
            background-color: #4CAF50;
        }

        .reject-btn {
            background-color: #f44336;
        }

        .file-preview {
            max-width: 100px;
            max-height: 100px;
            cursor: pointer;
        }

        .scrollable-table {
            overflow-x: auto;
        }
    </style>
</head>
<body>

    <!-- Main Content -->
    <div class="main-content">
        <div class="scrollable-table">
            <table class="requests-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student Number</th>
                        <th>LRN</th>
                        <th>Grade Level</th>
                        <th>Strand & Section</th>
                        <th>Email Address</th>
                        <th>Reason</th>
                        <th>Date Prepared</th>
                        <th>Time</th>
                        <th>Additional Info</th>
                        <th>Supporting Files</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM consultation_requests WHERE status = 'pending'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['student_name']}</td>
                                <td>{$row['student_number']}</td>
                                <td>{$row['lrn']}</td>
                                <td>{$row['grade_level']}</td>
                                <td>{$row['strand']} - {$row['section']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['reason']}</td>
                                <td>{$row['preferred_date']}</td>
                                <td>{$row['preferred_time']}</td>
                                <td>{$row['additional_info']}</td>
                                <td>";
                            if (!empty($row['supporting_file'])) {
                                $file_ext = pathinfo($row['supporting_file'], PATHINFO_EXTENSION);
                                if (in_array($file_ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                                    echo '<img src="../uploads/' . $row['supporting_file'] . '" class="file-preview">';
                                } else {
                                    echo '<a href="../uploads/' . $row['supporting_file'] . '" target="_blank">View File</a>';
                                }
                            }
                            echo "</td>
                                <td class='action-buttons'>
                                    <form action='update_status.php' method='post'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <button type='submit' name='status' value='approved' class='approve-btn'>Approve</button>
                                        <button type='submit' name='status' value='rejected' class='reject-btn'>Reject</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='12'>No pending requests</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Include the JavaScript file -->
    <script src="Toggledark.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
</body>
</html>
