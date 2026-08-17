<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_number = $_POST['RoomNumber'];
    $room_type = $_POST['RoomType'];
    $price = $_POST['Price'];
    $status = $_POST['Status'];

    $sql = "INSERT INTO rooms (room_number, room_type, price, status) VALUES ('$room_number', '$room_type', '$price', '$status')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Room Added Successfully!'); window.location.href='rooms.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rooms Management</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: sans-serif; }
        body { display: flex; background: #f4f6f9; }
        .sidebar { width: 250px; height: 100vh; background: #1e293b; color: #fff; position: fixed; padding: 20px 0; }
        .sidebar h2 { text-align: center; color: #38bdf8; margin-bottom: 20px; }
        .sidebar ul { list-style: none; }
        .sidebar ul li a { display: block; padding: 15px 25px; color: #94a3b8; text-decoration: none; }
        .sidebar ul li a:hover, .sidebar ul li a.active { background: #0f172a; color: #38bdf8; border-left: 4px solid #38bdf8; }
        .main { margin-left: 250px; padding: 30px; width: 100%; }
        .box { background: #fff; padding: 20px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input, select { padding: 10px; width: 100%; margin: 5px 0 15px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 15px; background: #0284c7; color: #fff; border: none; cursor: pointer; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Hotel System</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="rooms.php" class="active">Rooms</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="logout.php" style="color: #ef4444;">Logout</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="box">
            <h3>Add New Room</h3>
            <form method="POST" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <input type="text" name="RoomNumber" placeholder="Room No (e.g. 101)" required style="width: 200px;">
                <select name="RoomType" style="width: 200px;">
                    <option value="Single">Single</option>
                    <option value="Double">Double</option>
                    <option value="Suite">Suite</option>
                </select>
                <input type="number" name="Price" placeholder="Price per night" required style="width: 150px;">
                <select name="Status" style="width: 150px;">
                    <option value="Available">Available</option>
                    <option value="Booked">Booked</option>
                </select>
                <button type="submit">Add Room</button>
            </form>
        </div>
        <div class="box">
            <h3>Room List</h3>
            <table>
                <tr><th>Room No</th><th>Type</th><th>Price</th><th>Status</th></tr>
                <?php
                $res = $conn->query("SELECT * FROM rooms");
                while($row = $res->fetch_assoc()) {
                    $color = $row['status'] == 'Available' ? 'green' : 'red';
                    echo "<tr><td>{$row['room_number']}</td><td>{$row['room_type']}</td><td>৳{$row['price']}</td><td style='color:$color; font-weight:bold;'>{$row['status']}</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>