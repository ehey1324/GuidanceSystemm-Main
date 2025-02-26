<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type");


error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "sungjinwoo";
$password = "Kaizel1324";
$dbname = "guidance_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]));
}

// Handle GET request to fetch accounts
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get') {
    try {
        $stmt = $conn->prepare("SELECT * FROM users");
        if (!$stmt) {
            throw new Exception('Prepare failed: ' . $conn->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);

        // Debugging: Log the fetched data
        error_log("Fetched users: " . print_r($users, true));

        echo json_encode($users);
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log the error
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } finally {
        $conn->close(); // Close the connection
        exit;
    }
}

// Handle POST requests (save or delete)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['action'])) {
            if ($_POST['action'] === 'save') {

                //Sanitize inputs
                $username = sanitizeInput($_POST['username']);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                 if ($email === false) {
                    throw new Exception('Invalid email format');
                 }
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $role = sanitizeInput($_POST['role']);
                // Handle profile image upload
                $profileImagePath = null;
                if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = __DIR__ . '/uploads/'; // Use absolute path
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }

                    // Generate unique filename
                    $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION,);
                    $fileName = uniqid() . '.' . $extension;
                    $targetPath = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
                        $profileImagePath = 'uploads/' . $fileName;
                    } else {
                        throw new Exception('Failed to upload image');
                    }
                }

                 // Insert or update the account
                $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, profile_image) VALUES (?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE username = ?, password = ?, role = ?, profile_image = ?");
                if (!$stmt) {
                    throw new Exception('Prepare failed: ' . $conn->error);
                }

                $stmt->bind_param("sssssssss",
                    $username,
                    $email,
                    $password,
                    $role,
                    $profileImagePath,
                    $username,
                    $password,
                    $role,
                    $profileImagePath
                );

                if (!$stmt->execute()) {
                    throw new Exception('Execute failed: ' . $stmt->error);
                }

                echo json_encode(['success' => true]);


            } elseif ($_POST['action'] === 'delete') {
                // Log incoming request
                file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Received DELETE request: " . print_r($_POST, true) . "\n", FILE_APPEND);

                if (!isset($_POST['email']) || empty($_POST['email'])) {
                    echo json_encode(['success' => false, 'error' => 'Email is required']);
                    exit;
                }

                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                if ($email === false) {
                     throw new Exception('Invalid email format');
                 }

                // Check if user exists before deletion
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 0) {
                    echo json_encode(['success' => false, 'error' => 'No account found with the provided email']);
                    exit;
                }

                // Delete the account
                $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
                if (!$stmt) {
                    throw new Exception('Prepare failed: ' . $conn->error);
                }

                $stmt->bind_param("s", $email);

                if (!$stmt->execute()) {
                    throw new Exception('Execute failed: ' . $stmt->error);
                }

                echo json_encode(['success' => true]);
            } else {
                throw new Exception('Invalid action');
            }
        } else {
            throw new Exception('Action not specified');
        }
    } catch (Exception $e) {
        error_log($e->getMessage()); // Log the error
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    } finally {
        $conn->close(); // Close the connection
    }
}

// Sanitize input data
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

?>
