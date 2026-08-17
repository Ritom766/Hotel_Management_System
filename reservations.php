<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guest_name = $_POST['GuestName'];
    $room_number = $_POST['RoomNumber'];
    $check_in = $_POST['CheckIn'];
    $check_out = $_POST['CheckOut'];

    $sql = "INSERT INTO reservations (guest_name, room_number, check_in, check_out) VALUES ('$guest_name', '$room_number', '$check_in', '$check_out')";
    
    
    $update_room = "UPDATE rooms SET status='Booked' WHERE room_number='$room_number'";

    if ($conn->query($sql) === TRUE && $conn->query($update_room) === TRUE) {
        echo "<script>alert('Room Booked Successfully!'); window.location.href='reservations.php';</script>";
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'checkout') {
    $res_id = $_GET['id'];
    $room_no = $_GET['room'];

    $update_res = "UPDATE reservations SET status='Checked Out' WHERE id='$res_id'";
    
    $update_room = "UPDATE rooms SET status='Available' WHERE room_number='$room_no'";

    if ($conn->query($update_res) === TRUE && $conn->query($update_room) === TRUE) {
        echo "<script>alert('Guest Checked Out! Room is now available.'); window.location.href='reservations.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservations</title>
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
        
        /* Check-Out Button Styles */
        .btn-checkout { background: #ef4444; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 13px; font-weight: bold; transition: 0.3s; }
        .btn-checkout:hover { background: #dc2626; }
        .badge-done { background: #e5e7eb; color: #6b7280; padding: 6px 12px; border-radius: 4px; font-size: 13px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Hotel System</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="reservations.php" class="active">Reservations</a></li>
            <li><a href="logout.php" style="color: #ef4444;">Logout</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="box">
            <h3>Book a Room</h3>
            <form method="POST" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                <input type="text" name="GuestName" placeholder="Guest Name" required style="width: 200px;">
                <select name="RoomNumber" required style="width: 150px;">
                    <option value="">Select Room</option>
                    <?php
                    
                    $rooms = $conn->query("SELECT room_number FROM rooms WHERE status='Available'");
                    while($r = $rooms->fetch_assoc()){ echo "<option value='{$r['room_number']}'>{$r['room_number']}</option>"; }
                    ?>
                </select>
                <input type="date" name="CheckIn" required style="width: 150px;">
                <input type="date" name="CheckOut" required style="width: 150px;">
                <button type="submit">Book Now</button>
            </form>
        </div>
        <div class="box">
            <h3>Reservation List</h3>
            <table>
                <tr>
                    <th>Guest Name</th>
                    <th>Room No</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $res = $conn->query("SELECT * FROM reservations ORDER BY id DESC");
                while($row = $res->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['guest_name']}</td>
                            <td>{$row['room_number']}</td>
                            <td>{$row['check_in']}</td>
                            <td>{$row['check_out']}</td>
                            <td><b style='color:" . ($row['status'] == 'Confirmed' ? 'blue' : 'gray') . ";'>{$row['status']}</b></td>
                            <td>";
                    
                
                    if ($row['status'] == 'Confirmed') {
                        echo "<a href='reservations.php?action=checkout&id={$row['id']}&room={$row['room_number']}' class='btn-checkout' onclick=\"return confirm('Are you sure you want to Check-Out this guest?');\">Check-Out</a>";
                    } else {
                        echo "<span class='badge-done'>Checked Out</span>";
                    }

                    echo "  </td>
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>