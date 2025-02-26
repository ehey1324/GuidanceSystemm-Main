<?php
// Include the PHP logic from VerifyUser.php
include 'VerifyUser.php'; // This will load the database connection, session handling, and user authentication logic
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
    <!-- Landing Page Animation -->
    <div class="landing-page">
        <h1>Welcome To Admin Panel</h1>
        <p>Manage student profiles ┃ counseling sessions ┃ referrals ┃ analytical efficiency</p>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="../CSS/Guidance.png" alt="Logo" class="logo">
        </div>

        <nav class="nav-menu">
           
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
            
        
            <a href="Admin_and_Counselor_Accounts.php" class="nav-item" onclick="showAccountManagement()">
            </i><i class="fa fa-user-plus"><aria-hidden="true"></i>
            <span>Add Admin & Counsellor</span>
          
            <a href="Archieve.php"class="nav-item">
            </i><i class="fa-solid fa-box-archive"></i>
                 <span>Archieve</i><span>
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

    <!-- Subheader -->
    <div class="subheader">Home / Dashboard</div>

    <!-- Include the JavaScript file -->
    <script src="Toggledark.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
</body>
</html>