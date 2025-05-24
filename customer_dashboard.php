<?php
session_start();

// Check if user is logged in and is a Customer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Customer') {
    header("Location: login.php");
    exit();
}

$customer_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Customer';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard - Restaurant Billing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('black image.jpg') no-repeat center center/cover;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: pink;
            padding: 10px;
            text-align: center;
        }
        .navbar h1, .navbar h2 {
            color: white;
            margin: 0;
        }
        .container {
            max-width: 100%;
            margin: 10px auto;
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .menu {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 10px;
            padding: 10px;
        }
        .menu a {
            text-decoration: none;
            color: white;
            background: #ff9800;
            padding: 15px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .menu a:hover {
            background: #e68900;
        }
        .logout {
            text-align: right;
            padding: 10px;
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
    <h1>Customer Dashboard</h1>
</div>

<div class="logout">
    <a href="logout.php">Logout</a>
</div>



<div class="menu">
    <a href="home.php">Home</a>
    <a href="about.php">About</a>
    <a href="view_menu.php">View Menu</a>
    <a href="place_order.php">Place Order</a>
    <a href="order_history.php">Order History</a>
    
</div>

</body>
</html>
