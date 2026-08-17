<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Management</title>
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
        .form-group input, .form-group select { padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px; font-size: 14px; }
        .btn { grid-column: 1 / -1; padding: 12px; background-color: #0284c7; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn:hover { background-color: #0369a1; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table th, table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        table th { background-color: #f8fafc; color: #475569; font-weight: 600; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Hotel System</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="hotels.php">Hotels</a></li>
            <li><a href="rooms.php" class="active">Rooms</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="reservations.php">Reservations</a></li>
            <li><a href="login.php" style="color: #ef4444;">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Manage Rooms</h1>
        </div>

        <div class="container-box">
            <h3>Add New Room</h3>
            <form action="#" method="POST" class="form-grid">
                <div class="form-group">
                    <label>Room ID (e.g. R0000001)</label>
                    <input type="text" name="RoomID" maxlength="8" required>
                </div>
                <div class="form-group">
                    <label>Select Hotel</label>
                    <select name="HotelID" required>
                        <option value="H0001">Grand Palace Hotel (H0001)</option>
                        <option value="H0002">Sylhet Resort (H0002)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Room Number</label>
                    <input type="text" name="RoomNumber" required>
                </div>
                <div class="form-group">
                    <label>Room Type</label>
                    <select name="RoomType" required>
                        <option value="Single">Single</option>
                        <option value="Double">Double</option>
                        <option value="Suite">Suite</option>
                        <option value="Deluxe">Deluxe</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Floor Number</label>
                    <input type="number" name="FloorNumber" required>
                </div>
                <div class="form-group">
                    <label>Capacity</label>
                    <input type="number" name="Capacity" min="1" max="10" required>
                </div>
                <div class="form-group">
                    <label>Nightly Rate (BDT)</label>
                    <input type="number" step="0.01" name="NightlyRate" required>
                </div>
                <div class="form-group">
                    <label>Availability Status</label>
                    <select name="AvailabilityStatus" required>
                        <option value="Available">Available</option>
                        <option value="Occupied">Occupied</option>
                        <option value="Maintenance">Maintenance</option>
                    </select>
                </div>
                <button type="button" class="btn" onclick="alert('Room Added Successfully!')">Save Room</button>
            </form>
        </div>

        <div class="container-box">
            <h3>Room Inventory</h3>
            <table>
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Hotel</th>
                        <th>Room No</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Rate/Night</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>R0000001</td>
                        <td>Grand Palace Hotel</td>
                        <td>101</td>
                        <td>Deluxe</td>
                        <td>2 Persons</td>
                        <td>৳5000.00</td>
                        <td><span class="badge badge-success">Available</span></td>
                    </tr>
                    <tr>
                        <td>R0000002</td>
                        <td>Sylhet Resort</td>
                        <td>205</td>
                        <td>Double</td>
                        <td>2 Persons</td>
                        <td>৳3500.00</td>
                        <td><span class="badge badge-danger">Occupied</span></td>
                    </tr>
                    <tr>
                        <td>R0000003</td>
                        <td>Grand Palace Hotel</td>
                        <td>301</td>
                        <td>Suite</td>
                        <td>4 Persons</td>
                        <td>৳12000.00</td>
                        <td><span class="badge badge-warning">Maintenance</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>