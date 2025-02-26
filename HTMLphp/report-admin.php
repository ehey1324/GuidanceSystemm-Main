<?php
// Include the PHP logic from VerifyUser.php
include 'VerifyUser.php'; // Handles session, authentication, and database connection

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Generate Counseling Report</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Markazi+Text:wght@400;700&family=Arsenal+SC&display=swap" rel="stylesheet">
    <!-- Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link rel="stylesheet" href="Foradmin.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family:Arial, sans-serif;
        }
    
        
        .logo-section {
            padding:20px;
        }
        
        .nav-menu a {
            display:flex;
            align-items:center;
            padding:15px 20px;
            text-decoration:none;
            color:white;
            transition: background 0.3s;
        }
        
     
        
        
        .main-content {
            margin-left:250px;
            padding:100px 20px 20px;
            min-height:100vh;
        }

        /* Report Generation Styles */
        
        .report-container {
            max-width:1400px;
            margin:0 auto;
            background:#fff;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }
        
        .report-form {
            width:100%;
            margin-bottom:30px;
            display:flex;
            flex-wrap:wrap;
            gap:20px;
        }
        
        .form-group {
            width:calc(50% - 10px);
            display:flex;
            flex-direction:column;
        }
        
        .form-group label {
            font-weight:bold;
            margin-bottom:5px;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            padding:10px;
            border:1px solid #ddd;
            border-radius:5px;
        }
        
        .form-group textarea {
            resize:vertical;
            height:100px;
        }
        
        .report-actions {
            width:100%;
            text-align:center;
        }
        
        button {
            background:#4CAF50;
            color:white;
            border:none;
            padding:10px 20px;
            border-radius:5px;
            cursor:pointer;
            font-size:16px;
            transition:background 0.3s;
        }
        
        button:hover {
            background:#45a049;
        }
        
        #report {
            margin-top:30px;
            background:#fff;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
            max-width:1200px;
            margin:0 auto;
            display:none;
        }
        
        .report-content {
            margin:20px 0;
        }
        
        .report-content h3 {
            margin:0;
            font-size:20px;
            color:#333;
        }
        
        .report-content p {
            font-size:16px;
            color:#555;
        }
        
        .btn-print {
            background:#2196F3;
            color:white;
            padding:10px 20px;
            border:none;
            border-radius:5px;
            cursor:pointer;
            font-size:16px;
            margin-top:30px;
        }
        
        .btn-print:hover {
            background:#0b7dda;
        }
        
        /* Print Styles */
        @media print {
            @page { size:landscape; margin:0; }
            body { margin:0; }
            #report { width:100%; margin:0; padding:20px; box-shadow:none; }
            .report-content { margin:10px 0; font-size:14px; }
            .btn-print { display:none; }
        }
    </style>
</head>
<body class="light-mode">
    
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
                <i class="fa fa-user-plus"></i>
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
        </div>
    </div>
    
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
    
    <div class="subheader">Counseling Report</div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="report-container">
            <h1>Generate Counseling Report:</h1>
            <div class="report-form">
                <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" id="studentName" required>
                </div>
                <div class="form-group">
                    <label>Grade/Section/Strand</label>
                    <input type="text" id="gradeSection" required>
                </div>
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" id="studentID" required>
                </div>
                <div class="form-group">
                    <label>Appointment Date</label>
                    <input type="date" id="appointmentDate" required>
                </div>
                <div class="form-group">
                    <label>Appointment Time</label>
                    <input type="time" id="appointmentTime" required>
                </div>
                <div class="form-group">
                    <label>Concern/Issue</label>
                    <textarea id="concern" required></textarea>
                </div>
                <div class="form-group">
                    <label>Counselor's Notes</label>
                    <textarea id="notes" required></textarea>
                </div>
                <div class="form-group">
                    <label>Counselor's Recommendation</label>
                    <textarea id="recommendation" required></textarea>
                </div>
                <div class="report-actions">
                    <button onclick="generateReport()">Generate Report</button>
                </div>
            </div>
            
            <div id="report">
                <div class="report-content">
                    <h3>Student Name:</h3>
                    <p id="reportStudentName"></p>
                </div>
                <div class="report-content">
                    <h3>Grade/Section/Strand:</h3>
                    <p id="reportGradeSection"></p>
                </div>
                <div class="report-content">
                    <h3>Student ID:</h3>
                    <p id="reportStudentID"></p>
                </div>
                <div class="report-content">
                    <h3>Appointment Date:</h3>
                    <p id="reportAppointmentDate"></p>
                </div>
                <div class="report-content">
                    <h3>Appointment Time:</h3>
                    <p id="reportAppointmentTime"></p>
                </div>
                <div class="report-content">
                    <h3>Concern/Issue:</h3>
                    <p id="reportConcern"></p>
                </div>
                <div class="report-content">
                    <h3>Counselor's Notes:</h3>
                    <p id="reportNotes"></p>
                </div>
                <div class="report-content">
                    <h3>Counselor's Recommendation:</h3>
                    <p id="reportRecommendation"></p>
                </div>
                <button class="btn-print" onclick="printReport()">Print Report</button>
            </div>
        </div>
    </div>

    <!-- Include the JavaScript file -->
    <script src="Toggledark.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        function generateReport() {
            const reportData = {
                studentName: document.getElementById('studentName').value,
                gradeSection: document.getElementById('gradeSection').value,
                studentID: document.getElementById('studentID').value,
                appointmentDate: document.getElementById('appointmentDate').value,
                appointmentTime: document.getElementById('appointmentTime').value,
                concern: document.getElementById('concern').value,
                notes: document.getElementById('notes').value,
                recommendation: document.getElementById('recommendation').value
            };
            
            // Populate Report
            document.getElementById('reportStudentName').textContent = reportData.studentName;
            document.getElementById('reportGradeSection').textContent = reportData.gradeSection;
            document.getElementById('reportStudentID').textContent = reportData.studentID;
            document.getElementById('reportAppointmentDate').textContent = reportData.appointmentDate;
            document.getElementById('reportAppointmentTime').textContent = reportData.appointmentTime;
            document.getElementById('reportConcern').textContent = reportData.concern;
            document.getElementById('reportNotes').textContent = reportData.notes;
            document.getElementById('reportRecommendation').textContent = reportData.recommendation;

            // Show Report
            document.getElementById('report').style.display = 'block';
        }

        function printReport() {
            const reportContent = document.getElementById('report').innerHTML;
            const printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Report Printout</title>
                        <style>
                            body { font-family:Arial; max-width:1200px; margin:20px; }
                            @media print { size:landscape; }
                        </style>
                    </head>
                    <body>
                        ${reportContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
        }

        // Logout Function
        document.querySelector('.logout-button').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to log out?')) {
                window.location.href = 'LoginAdmin&Counselor.php';
            }
        });
    </script>
</body>
</html>