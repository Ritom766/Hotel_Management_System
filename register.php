<?php
include 'db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Check if username already exists
    $check = $conn->query("SELECT * FROM users WHERE username='$username'");
    
    if ($check->num_rows > 0) {
        $message = "<span style='color:red;'>Username already taken! Try another.</span>";
    } else {
        // Insert new user
        $sql = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            $message = "<span style='color:green;'>Account Created Successfully! <a href='login.php'>Login Here</a></span>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Account</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { background: #f4f6f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: white; padding: 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 350px; text-align: center; border-top: 4px solid #10b981; }
        .login-box h2 { margin-bottom: 20px; color: #1e293b; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; font-size: 13px; font-weight: bold; margin-bottom: 5px; }
        .login-box input, .login-box select { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px; }
        .login-box button { width: 100%; padding: 12px; background: #10b981; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; margin-top: 10px; }
        .extra-links { margin-top: 15px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Create Account</h2>
        <div style="margin-bottom: 10px; font-weight:bold;"><?php echo $message; ?></div>
        
        <form action="" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role">
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit">Register</button>
        </form>
        <div class="extra-links">
            <a href="login.php">Back to Login</a>
        </div>
    </div>
</body>
</html>