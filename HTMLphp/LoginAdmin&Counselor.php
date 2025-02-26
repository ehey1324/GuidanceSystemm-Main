<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    if ($_SESSION['user_role'] === 'Admin') {
        header("Location: adminn.php");
    } elseif ($_SESSION['user_role'] === 'Counsellor') {
        header("Location: counsilor.php");
    }
    exit();
}

// Handle error messages
$error = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'invalid_role':
        default:
            $error = "Invalid password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('../IMG/LoginBG.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }

        .blur-background {
            position: fixed;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(5px);
            z-index: -1;
        }

        .login-container {
            background: rgba(72, 153, 220, 0.67);
            padding: 40px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-section img {
            max-width: 150px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        select, input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #091c38;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #091c38;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-btn:hover {
            opacity: 0.9;
        }

        .error-message {
    color: red;
    text-align: center;
    margin-top: 10px;
    font-size: 14px;
    padding: 10px;
    background-color: #ffe6e6;
    border: 1px solid #ff9999;
    border-radius: 5px;
}
    </style>
</head>
<body>
    <div class="blur-background"></div>
    <div class="login-container">
        <div class="logo-section">
            <img src="../CSS/Guidance.png" alt="Guidance Logo">
        </div>
        
        <form id="loginForm" method="POST" action="login_handler.php">
            <div class="form-group">
                <label>User Type</label>
                <select id="userType" name="user_type" required>
                    <option value="">Select User Type</option>
                    <option value="Admin">Admin</option>
                    <option value="Counsellor">Counsellor</option>
                </select>
             

            <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="username_email" required placeholder="Enter username or email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="password-container">
                    <input type="password" id="password" name="password" required placeholder="Enter your password">
                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="fa fa-eye-slash" aria-hidden="true" style="color: #091c38;"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="login-btn">LOGIN</button>
            <?php if(isset($_GET['error'])) { ?>
                <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php } ?>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
        
    </script>
</body>
</html>