<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php'; 

$total_rooms_query = $conn->query("SELECT COUNT(*) as count FROM rooms");
$total_rooms = $total_rooms_query->fetch_assoc()['count'];

$available_rooms_query = $conn->query("SELECT COUNT(*) as count FROM rooms WHERE status='Available'");
$available_rooms = $available_rooms_query->fetch_assoc()['count'];

$total_guests_query = $conn->query("SELECT COUNT(*) as count FROM guests");
$total_guests = $total_guests_query->fetch_assoc()['count'];

$total_res_query = $conn->query("SELECT COUNT(*) as count FROM reservations");
$total_reservations = $total_res_query->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hotel Management System - Dashboard</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #f4f6f9; color: #333; }
        
        /* Sidebar Styling */
        .sidebar { width: 250px; height: 100vh; background-color: #1e293b; color: #fff; position: fixed; padding: 20px 0; }
        .sidebar h2 { text-align: center; font-size: 20px; margin-bottom: 30px; color: #38bdf8; border-bottom: 1px solid #334155; padding-bottom: 15px; }
        .sidebar ul { list-style: none; }
        .sidebar ul li a { display: block; padding: 12px 25px; color: #94a3b8; text-decoration: none; font-weight: 500; transition: 0.3s; }
        .sidebar ul li a:hover, .sidebar ul li a.active { background-color: #0f172a; color: #38bdf8; border-left: 4px solid #38bdf8; }
        
        /* Main Content */
        .main-content { margin-left: 250px; padding: 30px; width: calc(100% - 250px); }
        .header { margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;}
        .header h1 { font-size: 26px; color: #0f172a; }
        
        /* Cards Grid */
        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-top: 4px solid #38bdf8; }
        .card h3 { font-size: 14px; color: #64748b; text-transform: uppercase; }
        .card .number { font-size: 28px; font-weight: bold; color: #0f172a; margin-top: 8px; }
        
        /* Table Container */
        .container-box { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .container-box h3 { margin-bottom: 20px; color: #1e293b; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table th, table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        table th { background-color: #f8fafc; color: #475569; font-weight: 600; }
        
        .user-info { font-weight: bold; color: #0284c7; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Hotel System</h2>
        <ul>
            <li><a href="index.php" class="active">Dashboard</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="logout.php" style="color: #ef4444;">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>System Dashboard</h1>
            <div class="user-info">Welcome, <?php echo $_SESSION['name']; ?> (<?php echo ucfirst($_SESSION['role']); ?>)</div>
        </div>

        <div class="card-grid">
            <div class="card" style="border-top-color: #8b5cf6;">
                <h3>Total Rooms</h3>
                <div class="number"><?php echo $total_rooms; ?></div>
            </div>
            <div class="card" style="border-top-color: #10b981;">
                <h3>Available Rooms</h3>
                <div class="number"><?php echo $available_rooms; ?></div>
            </div>
            <div class="card" style="border-top-color: #f59e0b;">
                <h3>Registered Guests</h3>
                <div class="number"><?php echo $total_guests; ?></div>
            </div>
            <div class="card" style="border-top-color: #ef4444;">
                <h3>Total Reservations</h3>
                <div class="number"><?php echo $total_reservations; ?></div>
            </div>
        </div>

        <div class="container-box">
            <h3>Recent Bookings (Last 5)</h3>
            <table>
                <thead>
                    <tr>
                        <th>Guest Name</th>
                        <th>Room No</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    $recent_res = $conn->query("SELECT * FROM reservations ORDER BY id DESC LIMIT 5");
                    
                    if ($recent_res->num_rows > 0) {
                        while($row = $recent_res->fetch_assoc()) {
                            $status_color = ($row['status'] == 'Confirmed') ? 'blue' : 'gray';
                            echo "<tr>
                                    <td>{$row['guest_name']}</td>
                                    <td>{$row['room_number']}</td>
                                    <td>{$row['check_in']}</td>
                                    <td>{$row['check_out']}</td>
                                    <td><b style='color:{$status_color};'>{$row['status']}</b></td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No recent reservations found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>