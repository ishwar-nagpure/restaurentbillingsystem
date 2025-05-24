<?php
session_start();

// Check if user is logged in and is a Staff
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Staff') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - Restaurant Billing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #28a745;
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
            background: #28a745;
            padding: 15px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .menu a:hover {
            background: #218838;
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
    <h1>Staff Dashboard</h1>
</div>

<div class="container">
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>

    <h2>Welcome, Staff Member!</h2>
    <p>Manage daily operations efficiently.</p>

    <div class="menu">
        <a href="view_orders.php">View Orders</a>
        <a href="manage_tables.php">Manage Tables</a>
        <a href="update_menu.php">Update Menu</a>
        <a href="billing.php">Generate Bills</a>
    </div>
</div>

</body>
</html>
