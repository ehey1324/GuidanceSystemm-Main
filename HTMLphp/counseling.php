<?php
include 'VerifyUser.php';

$conn = new mysqli('localhost', 'sungjinwoo', 'kaizel1324', 'consultation_requests');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Create tables if not exists
$conn->query("CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    reason TEXT NOT NULL,
    concern TEXT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    meeting_link VARCHAR(255) NOT NULL,
    status ENUM('pending','confirmed','completed') DEFAULT 'pending'
)");

$conn->query("CREATE TABLE IF NOT EXISTS available_days (
    date DATE PRIMARY KEY,
    available_slots INT DEFAULT 5
)");

$conn->query("CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    event_date DATE NOT NULL,
    available_for_consultation BOOLEAN DEFAULT FALSE,
    description TEXT
)");

$conn->query("CREATE TABLE IF NOT EXISTS consultation_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    request_details TEXT,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'
)");

// Fetch reservations for the table
$reservations = $conn->query("SELECT * FROM reservations");

// Fetch appointment details for the selected date
$selected_date = isset($_GET['date']) ? $_GET['date'] : null;
$appointment_details = [];
if ($selected_date) {
    $stmt = $conn->prepare("SELECT * FROM reservations WHERE date = ?");
    $stmt->bind_param("s", $selected_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment_details = $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch available days
$available_days = $conn->query("SELECT date FROM available_days");
$available_days_array = [];
while ($row = $available_days->fetch_assoc()) {
    $available_days_array[] = $row['date'];
}

// Fetch events
$events = $conn->query("SELECT event_date FROM events");
$events_array = [];
while ($row = $events->fetch_assoc()) {
    $events_array[] = $row['event_date'];
}

// Fetch Consultation Requests
$consultation_requests = $conn->query("SELECT * FROM consultation_requests WHERE status = 'pending'");

// Handle Approve/Reject actions
if (isset($_POST['approve_request'])) {
    $request_id = $_POST['request_id'];
    $sql = "UPDATE consultation_requests SET status = 'approved' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    if ($stmt->execute()) {
        header("Location: CounselorAdmitReports.php");
        exit();
    } else {
        echo "Error approving request: " . $stmt->error;
    }
} elseif (isset($_POST['reject_request'])) {
    $request_id = $_POST['request_id'];
    $sql = "UPDATE consultation_requests SET status = 'rejected' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $request_id);
    if ($stmt->execute()) {
        header("Location: Archieve.php");
        exit();
    } else {
        echo "Error rejecting request: " . $stmt->error;
    }
}

// Handle adding a reservation
if (isset($_POST['add_reservation'])) {
    $student_name = $_POST['student_name'];
    $reason = $_POST['reason'];
    $concern = $_POST['concern'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $meeting_link = $_POST['meeting_link'];

    $sql = "INSERT INTO reservations (student_name, reason, concern, date, time, meeting_link) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $student_name, $reason, $concern, $date, $time, $meeting_link);

    if ($stmt->execute()) {
        header("Location: counseling.php?date=" . $date);
        exit();
    } else {
        echo "Error adding reservation: " . $stmt->error;
    }
}

// Handle adding an event
if (isset($_POST['add_event'])) {
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $description = $_POST['description'];
    $available_for_consultation = isset($_POST['available_for_consultation']) ? 1 : 0;

    $sql = "INSERT INTO events (event_name, event_date, description, available_for_consultation) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $event_name, $event_date, $description, $available_for_consultation);

    if ($stmt->execute()) {
        header("Location: counseling.php?date=" . $event_date);
        exit();
    } else {
        echo "Error adding event: " . $stmt->error;
    }
}

// Handle adding an available day
if (isset($_POST['add_available_day'])) {
    $available_day_date = $_POST['available_day_date'];
    $available_slots = $_POST['available_slots'];

    if ($conn->query("SELECT * FROM available_days WHERE date='$available_day_date'")->num_rows > 0) {
        echo "This date is already added.";
    } else {
        $sql = "INSERT INTO available_days (date, available_slots) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $available_day_date, $available_slots);

        if ($stmt->execute()) {
            header("Location: counseling.php?date=" . $available_day_date);
            exit();
        } else {
            echo "Error adding available day: " . $stmt->error;
        }
    }
}
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
    <link rel="stylesheet" href="NoLandpageAdmin.css">
    <!-- FullCalendar CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css">
    <style>
        .main-content {
            margin-left: 250px;
            padding: 140px 20px 20px 20px;
            min-height: 100vh;
        }

        .appointment-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .top-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .calendar-container, .appointment-info {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            height: 500px;
        }

        #calendar {
            height: 400px;
            font-size: 14px;
        }

        .fc-day-today {
            background-color: rgba(255, 217, 4, 0.74) !important;
        }

        /* Appointment Details Box */
        .appointment-details {
            flex-grow: 1;
            display: grid;
            grid-template-rows: auto auto 1fr;
        }

        .detail-item {
            margin: 15px 0;
            padding: 15px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .detail-item h4 {
            margin: 0 0 10px 0;
            color: #343a40;
            font-size: 18px;
        }

        .detail-item p {
            margin: 5px 0;
            font-size: 16px;
            color: #495057;
        }

        .session-list {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
        }

        .reservation-list {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .add-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .reservation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .reservation-table th,
        .reservation-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .input-field {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Approval Dropdown Styles */
        .status {
            padding: 5px;
            border-radius: 5px;
            width: 100%;
            border: 1px solid #ccc;
            background-color:rgb(16, 76, 136);
        }

        .approved {
            background-color: #28a745;
            color: white;
        }

        .ongoing {
            background-color: #ffc107;
            color: black;
        }

        .canceled {
            background-color: #dc3545;
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        /* Add legend styles */
        .calendar-legend {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        .modal-content {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .highlight-reservation { background-color: #dc3545 !important; }
        .highlight-event { background-color: #28a745 !important; }
        .highlight-available { background-color: rgb(16, 76, 136) !important; color: white; }

        /* Consultation Request Styles */
        .consultation-requests {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }

        .consultation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .consultation-table th,
        .consultation-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        .action-buttons form {
            display: inline;
        }
        .action-buttons button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            margin-right: 5px;
        }

        .action-buttons button.reject {
            background-color: #dc3545;
        }

        /* Add custom styles for the form */
        .add-reservation-form,
        .add-event-form,
        .add-available-day-form {
            margin-top: 20px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }

        .add-reservation-form label,
        .add-event-form label,
        .add-available-day-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .add-reservation-form input,
        .add-reservation-form textarea,
        .add-event-form input,
        .add-event-form textarea,
        .add-available-day-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .add-reservation-form button,
        .add-event-form button,
        .add-available-day-form button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
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
                
            <a href="Admin_and_Counselor_Accounts.php" class="nav-item" onclick="showAccountManagement()">
                <i class="fa fa-user-plus"></i>
                <span>Add Admin & Counsellor</span>
            </a>

            <a href="Archieve.php"class="nav-item">
                <i class="fa-solid fa-box-archive"></i>
                <span>Archieve</span>
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

    <!-- Subheader -->
    <div class="subheader"> Counseling And Appointment</div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="appointment-container">
            <div class="top-section">
                <div class="calendar-container">
                    <h3 style="margin-top: 0; color: #343a40;">Calendar</h3>
                    <div id="calendar"></div>
                </div>
                <div class="appointment-info">
                    <h3 style="margin-top: 0; color: #343a40;">Appointment Details</h3>
                    <div class="appointment-details">
                        <div class="detail-item">
                            <h4>Selected Date</h4>
                            <p id="selected-date" style="font-size: 20px; font-weight: 600; color: #343a40;"><?= $selected_date ?? 'None' ?></p>
                        </div>
                        <div class="detail-item">
                            <h4>Availability</h4>
                            <p>Available Slots: <span id="slots" style="font-weight: 600;"><?= $selected_date ? $conn->query("SELECT available_slots FROM available_days WHERE date = '$selected_date'")->fetch_assoc()['available_slots'] ?? 0 : 0 ?></span></p>
                            <p>Reservations: <span id="reserved" style="font-weight: 600;"><?= count($appointment_details) ?></span></p>
                        </div>
                        <div class="session-list">
                            <h4>Scheduled Sessions</h4>
                            <ul id="session-list" style="list-style: none; padding: 0;">
                                <?php if (empty($appointment_details)): ?>
                                    <li style="padding: 8px 0; border-bottom: 1px solid #eee;">No sessions scheduled</li>
                                <?php else: ?>
                                    <?php foreach ($appointment_details as $appointment): ?>
                                        <li style="padding: 8px 0; border-bottom: 1px solid #eee;">
                                            <strong><?= $appointment['time'] ?></strong> - <?= $appointment['student_name'] ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Reservation Form -->
            <div class="add-reservation-form">
                <h3>Add New Reservation</h3>
                <form method="post">
                    <label for="student_name">Student Name:</label>
                    <input type="text" id="student_name" name="student_name" required>

                    <label for="reason">Reason:</label>
                    <input type="text" id="reason" name="reason" required>

                    <label for="concern">Concern:</label>
                    <textarea id="concern" name="concern" required></textarea>

                    <label for="date">Date:</label>
                    <input type="date" id="date" name="date" required>

                    <label for="time">Time:</label>
                    <input type="time" id="time" name="time" required>

                    <label for="meeting_link">Meeting Link:</label>
                    <input type="url" id="meeting_link" name="meeting_link" required>

                    <button type="submit" name="add_reservation">Add Reservation</button>
                </form>
            </div>

            <!-- Add Available Day Form -->
            <div class="add-available-day-form">
                <h3>Add Available Day</h3>
                <form method="post">
                    <label for="available_day_date">Date:</label>
                    <input type="date" id="available_day_date" name="available_day_date" required>

                    <label for="available_slots">Available Slots:</label>
                    <input type="number" id="available_slots" name="available_slots" required min="1">

                    <button type="submit" name="add_available_day">Add Available Day</button>
                </form>
            </div>

            <!-- Consultation Requests Section -->
            <div class="consultation-requests">
                <h3>Pending Consultation Requests</h3>
                <table class="consultation-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Email</th>
                            <th>Reason</th>
                            <th>Preferred Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($consultation_requests->num_rows > 0) {
                            while ($row = $consultation_requests->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['reason']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['preferred_time']) . "</td>";
                                echo "<td class='action-buttons'>";
                                echo "<form method='post'>";
                                echo "<input type='hidden' name='request_id' value='" . $row['id'] . "'>";
                                echo "<button type='submit' name='approve_request'>Approve</button>";
                                echo "</form>";
                                echo "<form method='post'>";
                                echo "<input type='hidden' name='request_id' value='" . $row['id'] . "'>";
                                echo "<button type='submit' name='reject_request' class='reject'>Reject</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No pending consultation requests.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                select: function(info) {
                    window.location.href = '?date=' + info.startStr;
                },
                dayRender: function(info) {
                    var dateStr = info.dateStr;
                    if (availableDays.includes(dateStr)) {
                        info.el.classList.add('highlight-available');
                        info.el.title = 'Available for reservation';
                    }
                    if (reservations.includes(dateStr)) {
                        info.el.classList.add('highlight-reservation');
                        info.el.title = 'Has reservations';
                    }
                    if (events.includes(dateStr)) {
                        info.el.classList.add('highlight-event');
                        info.el.title = 'Has events';
                    }
                }
            });
            calendar.render();

            // Calendar Highlights from PHP arrays
            var availableDays = <?php echo json_encode($available_days_array); ?>;
            var reservations = <?php echo json_encode(array_column($reservations->fetch_all(MYSQLI_ASSOC), 'date')); ?>;
            var events = <?php echo json_encode($events_array); ?>;
        });
    </script>
</body>
</html>