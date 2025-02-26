<?php
// Include the PHP logic from VerifyUser.php
include 'VerifyUser.php'; // This will load the database connection, session handling, and user authentication logic
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin And Counselor</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Markazi+Text:wght@400;700&family=Arsenal+SC&display=swap" rel="stylesheet">
    <!-- Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <link rel="stylesheet" href="Foradmin.css">
</head>
<style>

.header {
    margin-left: 250px;
    padding: 20px;
    background: rgb(30, 88, 175);
    backdrop-filter: blur(10px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.header-titles {
    text-align: left;
}

.main-title {
    font-family: "Akaya Kanadaka", serif;
    font-size: 50px;
    color: #ffffff;
    margin: 0;
}

.sub-title {
    font-family: "Markazi Text", serif;
    font-size: 35px;
    color: #ffffff;
    margin: 5px 0 0 0;
}
        .main-content {
            margin-left: 250px;
            margin-top: 40px;
            padding: 20px;
            flex: 1;
        }
        .role-container {
            margin-bottom: 20px;
        }
        .add-btn, .action-btn, .save-btn {
            margin: 10px 0;
        }
        .accounts-table {
            width: 100%;
            border-collapse: collapse;
        }
        .accounts-table th, .accounts-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .save-column {
            text-align: center;
        }
    

        .main-content {
    margin-left: 250px;
    padding: 80px;
    padding-top: 1px; 
    min-height: 100vh;
}



/* Role Containers (Admin/Counsellor) */
.role-container {
    background: #ffffff;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: relative;
    text-align: left;
    margin-top: 1px;
}

/* Container Headings */
.role-container h3 {
    margin-bottom: 5px;
    color:rgb(255, 255, 255);
    font-family: 'Walter Turncoat', cursive;
    text-align: center; 
}

/* Add Account Buttons */
.add-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    padding: 8px 15px;
    background: #1e58af;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

/* Table Styles */
.accounts-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
/* Table Styles */
.accounts-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.accounts-table th,
.accounts-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 3px solid rgb(255, 255, 255);
}

body.light-mode .role-container {
    background-color:rgb(163, 131, 33);
    color:rgba(255, 255, 255, 0.94);
}

body.light-mode .role-container h3 {
    color:rgba(255, 255, 255, 0.94);
}

/* Light Mode Styles */
body.light-mode .role-container {
    background-color: rgb(90, 143, 179);
    color: rgb(237, 238, 236);
}

/* Dark Mode Styles */
body.dark-mode .role-container {
    background-color:rgb(26, 65, 105);
    color:rgb(255, 255, 255);
}

.accounts-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 40px;
}


.accounts-table th,
.accounts-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid rgb(255, 255, 255);
}

.accounts-table th {
    background:rgba(31, 78, 165, 0.63);
    font-weight: 600;
}

.input-style {
    width: 100%;
    padding: 6px;
    border: 5px  solid  rgba(255, 255, 255, 0.82);
    border-radius: 4px;
}

.action-btn {
    background: none;
    border: none;
    cursor: pointer;
    margin: 0 5px;
    color:rgb(255, 255, 255);
    transition: color 0.3s ease;
    align-items: center;
}

.save-btn {
    background: #28a745;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.password-container {
    position: relative;
    display: flex;
    align-items: center;
}

.toggle-password {
    position: absolute;
    right: 5px;
    background: none;
    border: none;
    cursor: pointer;
}
    </style>
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
                <i class="fa fa-user-plus" aria-hidden="true"></i>
                <span>Add Admin & Counsellor</span>
              
                <a href="Archieve.php"class="nav-item">
            </i><i class="fa-solid fa-box-archive"></i>
                 <span>Archieve</i><span>
            </a>
        </nav>

        <div class="logout-section">
            <a href="#" class="logout-button">
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
        <img src="<?= htmlspecialchars($current_user['profile_image']) ?>" 
                 alt="Profile" 
                 class="profile-image"
                 onerror="this.src='default-profile.jpg'">
            <div class="user-details">
                <span><?= htmlspecialchars($current_user['username']) ?></span>
                <div><?= htmlspecialchars($current_user['email']) ?> | <?= htmlspecialchars($current_user['role']) ?></div>
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
    <div class="subheader">Admin And Counselor Accounts</div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="account-management">
            <h2>Account Management</h2>

            <div class="role-container">
                <h3>Admin Accounts</h3>
                <button class="add-btn" onclick="addAccount('Admin')">
                    <i class="fa fa-user-plus"></i> Add Admin
                </button>
                <table class="accounts-table" id="adminAccounts">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>User Profile</th>
                            <th>Actions</th>
                            <th>Save</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="role-container">
                <h3>Counsellor Accounts</h3>
                <button class="add-btn" onclick="addAccount('Counsellor')">
                    <i class="fa fa-user-plus"></i> Add Counsellor
                </button>
                <table class="accounts-table" id="counsellorAccounts">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>User Profile</th>
                            <th>Actions</th>
                            <th>Save</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include the JavaScript file -->
    <script src="Toggledark.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        // Logout button functionality
        document.querySelector('.logout-button').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = 'LoginAdmin&Counselor.php'; 
            }
        });

        // Account Management Functions
        function addAccount(role) {
            const table = document.getElementById(`${role.toLowerCase()}Accounts`).getElementsByTagName('tbody')[0];
            const row = table.insertRow();
            row.innerHTML = `
                <td><input type="text" class="input-style" placeholder="Username" oninput="validateInputs(this)" required></td>
                <td><input type="email" class="input-style" placeholder="Email" oninput="validateInputs(this)" required></td>
                <td>
                    <div class="password-container">
                        <input type="password" class="input-style" placeholder="Password" oninput="validateInputs(this)" required>
                        <button type="button" class="toggle-password" onclick="togglePassword(this)">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </td>
                <td>
                    <div class="profile-image-container">
                        <input type="file" class="input-style" name="profile_image" onchange="handleProfileImage(this)" accept="image/*">
                        <img src="" alt="Profile Image" class="profile-image" style="display: none;">
                    </div>
                </td>
                <td>
                    <button class="action-btn" onclick="enableEditing(this)">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                    <button class="action-btn" onclick="deleteAccount(this)">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
                <td class="save-column">
                    <button class="save-btn" onclick="saveAccount(this, '${role}')" disabled>
                        <i class="fa fa-floppy-o"></i> Save
                    </button>
                </td>
            `;
        }

        function handleProfileImage(input) {
            const row = input.closest('tr');
            const img = row.querySelector('.profile-image');
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function validateInputs(input) {
            const row = input.closest('tr');
            const inputs = row.querySelectorAll('input[required]');
            const saveBtn = row.querySelector('.save-btn');
            const emailInput = row.querySelector('input[type="email"]');
            const isEmailValid = emailInput.value.includes('@');
            const isAllFilled = [...inputs].every(i => i.value.trim() !== '');

            saveBtn.disabled = !(isAllFilled && isEmailValid);
        }

        function togglePassword(btn) {
            const passwordInput = btn.closest('.password-container').querySelector('input');
            const icon = btn.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function enableEditing(btn) {
            const row = btn.closest('tr');
            const inputs = row.querySelectorAll('input');
            const saveBtn = row.querySelector('.save-btn');

            inputs.forEach(input => {
                input.readOnly = false;
                input.style.backgroundColor = '#fff';
            });

            saveBtn.disabled = false;

            inputs.forEach(input => {
                input.addEventListener('input', () => validateInputs(input));
            });
        }

        async function saveAccount(btn, role) {
            const row = btn.closest('tr');
            const inputs = row.querySelectorAll('input');
            const [usernameInput, emailInput, passwordInput, fileInput] = [...inputs];
            const username = usernameInput.value;
            const email = emailInput.value;
            const password = passwordInput.value;
            const file = fileInput.files[0];

            if (!username || !email || !password) {
                alert('Please fill all fields');
                return;
            }

            if (!email.includes('@')) {
                alert('Please enter a valid email address');
                return;
            }

            if (confirm('Are you sure you want to save this account?')) {
                const formData = new FormData();
                formData.append('action', 'save');
                formData.append('role', role);
                formData.append('username', username);
                formData.append('email', email);
                formData.append('password', password);
                if (file) formData.append('profile_image', file);

                try {
                    const response = await fetch('manage_account.php', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await response.json();
                    if (result.success) {
                        alert('Account saved successfully');
                        loadAccounts(); // Reload accounts after saving
                    } else {
                        alert('Failed to save account: ' + (result.error || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while saving the account');
                }
            }
        }

        async function deleteAccount(btn) {
            const row = btn.closest('tr');
            const email = row.querySelector('input[type="email"]').value;

            if (confirm('Do you want to delete this account?')) {
                try {
                    const response = await fetch('manage_account.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action: 'delete',
                            email: email
                        })
                    });

                    const result = await response.json();
                    if (result.success) {
                        row.remove();
                        alert('Account deleted successfully');
                    } else {
                        alert('Failed to delete account: ' + (result.error || 'Unknown error'));
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the account');
                }
            }
        }

        // Load accounts when page loads
        document.addEventListener('DOMContentLoaded', loadAccounts);

        async function loadAccounts() {
            try {
                const response = await fetch('manage_account.php?action=get');
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const accounts = await response.json();

                document.querySelectorAll('.accounts-table tbody').forEach(tbody => {
                    while (tbody.firstChild) {
                        tbody.removeChild(tbody.firstChild);
                    }
                });

                accounts.forEach(account => {
                    const table = document.getElementById(`${account.role.toLowerCase()}Accounts`).getElementsByTagName('tbody')[0];
                    const row = table.insertRow();
                    row.innerHTML = `
                        <td><input type="text" class="input-style" value="${account.username}" readonly></td>
                        <td><input type="email" class="input-style" value="${account.email}" readonly></td>
                        <td>
                            <div class="password-container">
                                <input type="password" class="input-style" value="${account.password}" readonly>
                                <button type="button" class="toggle-password" onclick="togglePassword(this)">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                        <td>
                            <div class="profile-image-container">
                                <input type="file" class="input-style" name="profile_image" onchange="handleProfileImage(this)" accept="image/*">
                                <img src="${account.profile_image || 'default.png'}" alt="Profile Image" class="profile-image" ${account.profile_image ? '' : 'style="display: none;"'}>
                            </div>
                        </td>
                        <td>
                            <button class="action-btn" onclick="enableEditing(this)">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="action-btn" onclick="deleteAccount(this)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <td class="save-column">
                            <button class="save-btn" onclick="saveAccount(this, '${account.role}')" disabled>
                                <i class="fa fa-floppy-o"></i> Save
                            </button>
                        </td>
                    `;
                });
            } catch (error) {
                console.error('Error loading accounts:', error);
            }
        }
    </script>
</body>
</html>