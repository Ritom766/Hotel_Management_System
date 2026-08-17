<?php
session_start();
include 'db.php'; // Database connection

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Login</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; text-align: center; border-top: 4px solid #0284c7; }
        .login-box h2 { margin-bottom: 25px; color: #1e293b; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; font-size: 13px; font-weight: bold; color: #475569; margin-bottom: 5px; }
        .login-box input { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 5px; font-size: 14px; }
        .login-box button { width: 100%; padding: 12px; background: #0284c7; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; font-weight: bold; margin-top: 10px; transition: 0.3s; }
        .login-box button:hover { background: #0369a1; }
        .error-msg { color: #ef4444; font-size: 14px; margin-bottom: 15px; font-weight: bold; }
        .extra-links { margin-top: 15px; font-size: 13px; }
        .extra-links a { color: #0284c7; text-decoration: none; font-weight: bold; }
        .extra-links a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>System Login</h2>
        
        <?php if($error != ''): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <div class="extra-links">
            <a href="register.php">Create New Account</a> | 
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </div>
</body>
</html>