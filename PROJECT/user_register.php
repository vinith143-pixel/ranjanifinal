<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #8e44ad, #3498db);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            text-align: center;
            width: 400px;
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        .register-btn {
            background: #27ae60;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            width: 100%;
            font-size: 18px;
            transition: background 0.3s ease;
        }
        .register-btn:hover {
            background: #219150;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>User Registration</h2>
        <form action="user_register.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="register" class="register-btn">Register</button>
            <a href="login.php">Already Have An Account ?</a>
        </form>
    </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "art_gallery";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS art_gallery";
$conn->query($sql);
$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS user_register (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    password VARCHAR(50) NOT NULL
)";
$conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($password === $confirm_password) {
        $stmt = $conn->prepare("INSERT INTO user_register (username, email, mobile, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $mobile, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Passwords do not match.";
    }
}
$conn->close();
?>
