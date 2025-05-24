<?php
session_start();

// Check if the user is logged in and is an Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Restaurant Billing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #007bff;
            padding: 15px;
            text-align: center;
        }
        .navbar h1 {
            color: white;
            margin: 0;
        }
        .container {
            max-width: 90%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .menu {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .menu a {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 15px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .menu a:hover {
            background: #0056b3;
        }
        .logout {
            text-align: right;
            margin-top: 10px;
        }
        .logout a {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h1>Admin Dashboard</h1>
</div>

<div class="container">
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

    <h2>Welcome, Admin!</h2>
    <p>Manage your restaurant system efficiently.</p>

    <div class="menu">
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_orders.php">Manage Orders</a>
        <a href="view_report.php">View Reports</a>
        
    </div>
</div>

</body>
</html>
