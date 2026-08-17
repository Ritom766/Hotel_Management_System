<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_id = $_POST['GuestID'];
    $full_name = $_POST['FullName'];
    $phone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $nationality = $_POST['Nationality'];
    $nid_passport = $_POST['IdentificationNumber'];
    $address = $_POST['Address'];

    $sql = "INSERT INTO guests (guest_id, full_name, phone, email, nationality, nid_passport, address) 
            VALUES ('$guest_id', '$full_name', '$phone', '$email', '$nationality', '$nid_passport', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Guest Registered Successfully!'); window.location.href='guests.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest Management</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #f4f6f9; color: #333; }
        .sidebar { width: 250px; height: 100vh; background-color: #1e293b; color: #fff; position: fixed; padding: 20px 0; }
        .sidebar h2 { text-align: center; font-size: 20px; margin-bottom: 30px; color: #38bdf8; border-bottom: 1px solid #334155; padding-bottom: 15px; }
        .sidebar ul { list-style: none; }
        .sidebar ul li a { display: block; padding: 12px 25px; color: #94a3b8; text-decoration: none; font-weight: 500; transition: 0.3s; }
        .sidebar ul li a:hover, .sidebar ul li a.active { background-color: #0f172a; color: #38bdf8; border-left: 4px solid #38bdf8; }
        .main-content { margin-left: 250px; padding: 30px; width: calc(100% - 250px); }
        .header { margin-bottom: 25px; }
        .header h1 { font-size: 26px; color: #0f172a; }
        .container-box { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
        .container-box h3 { margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 15px; }
        .form-group { display: flex; flex-direction: column; }
        .form-group label { font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #475569; }
        .form-group input { padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px; font-size: 14px; }
        .btn { grid-column: 1 / -1; padding: 12px; background-color: #0284c7; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn:hover { background-color: #0369a1; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table th, table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        table th { background-color: #f8fafc; color: #475569; font-weight: 600; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Hotel System</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="hotels.php">Hotels</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="guests.php" class="active">Guests</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="logout.php" style="color: #ef4444;">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Guest Management</h1>
        </div>

        <div class="container-box">
            <h3>Register New Guest</h3>
            <form action="guests.php" method="POST" class="form-grid">
                <div class="form-group">
                    <label>Guest ID (e.g. G0001)</label>
                    <input type="text" name="GuestID" required>
                </div>
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="FullName" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="PhoneNumber" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="Email" required>
                </div>
                <div class="form-group">
                    <label>Nationality</label>
                    <input type="text" name="Nationality" required>
                </div>
                <div class="form-group">
                    <label>NID / Passport Number</label>
                    <input type="text" name="IdentificationNumber" required>
                </div>
                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Address</label>
                    <input type="text" name="Address" required>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn">Register Guest</button>
            </form>
        </div>

        <div class="container-box">
            <h3>Registered Guest List</h3>
            <table>
                <thead>
                    <tr>
                        <th>Guest ID</th>
                        <th>Full Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>NID/Passport</th>
                        <th>Nationality</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            
                    $result = $conn->query("SELECT * FROM guests ORDER BY id DESC");
                    
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['guest_id']}</td>
                                    <td>{$row['full_name']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['nid_passport']}</td>
                                    <td>{$row['nationality']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>No guests registered yet.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>