<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation Management</title>
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
        .badge-dark { background: #e2e8f0; color: #475569; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Hotel System</h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="hotels.php">Hotels</a></li>
            <li><a href="rooms.php">Rooms</a></li>
            <li><a href="guests.php">Guests</a></li>
            <li><a href="reservations.php" class="active">Reservations</a></li>
            <li><a href="login.php" style="color: #ef4444;">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>Reservations & Bookings</h1>
        </div>

        <div class="container-box">
            <h3>New Booking</h3>
            <form action="#" method="POST" class="form-grid">
                <div class="form-group">
                    <label>Reservation ID (e.g. RES0000001)</label>
                    <input type="text" name="ReservationID" maxlength="10" required>
                </div>
                <div class="form-group">
                    <label>Select Guest</label>
                    <select name="GuestID" required>
                        <option value="G0000001">Arik Rahman (G0000001)</option>
                        <option value="G0000002">John Doe (G0000002)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Check-In Date</label>
                    <input type="date" name="CheckInDate" required>
                </div>
                <div class="form-group">
                    <label>Check-Out Date</label>
                    <input type="date" name="CheckOutDate" required>
                </div>
                <div class="form-group">
                    <label>Number of Guests</label>
                    <input type="number" name="NumberOfGuests" min="1" value="1" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="ReservationStatus" required>
                        <option value="Confirmed">Confirmed</option>
                        <option value="CheckedIn">CheckedIn</option>
                        <option value="CheckedOut">CheckedOut</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
                <button type="button" class="btn" onclick="alert('Reservation Created Successfully!')">Confirm Booking</button>
            </form>
        </div>

        <div class="container-box">
            <h3>All Reservations</h3>
            <table>
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Guest Name</th>
                        <th>Booking Date</th>
                        <th>Check-In</th>
                        <th>Check-Out</th>
                        <th>Guests</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>RES0000001</td>
                        <td>Arik Rahman</td>
                        <td>2026-08-18</td>
                        <td>2026-08-20</td>
                        <td>2026-08-22</td>
                        <td>2 Person(s)</td>
                        <td><span class="badge badge-success">Confirmed</span></td>
                    </tr>
                    <tr>
                        <td>RES0000002</td>
                        <td>John Doe</td>
                        <td>2026-08-15</td>
                        <td>2026-08-16</td>
                        <td>2026-08-18</td>
                        <td>1 Person(s)</td>
                        <td><span class="badge badge-warning">CheckedIn</span></td>
                    </tr>
                    <tr>
                        <td>RES0000003</td>
                        <td>Jane Smith</td>
                        <td>2026-08-10</td>
                        <td>2026-08-11</td>
                        <td>2026-08-13</td>
                        <td>3 Person(s)</td>
                        <td><span class="badge badge-dark">CheckedOut</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>