<?php
session_start();
include 'db_connect.php'; // Ensure this file contains the database connection

// Fetch total number of orders
$total_orders_query = "SELECT COUNT(*) AS total_orders FROM orders";
$total_orders_result = $conn->query($total_orders_query);
$total_orders = $total_orders_result->fetch_assoc()['total_orders'];

// Fetch total revenue
$total_revenue_query = "SELECT SUM(total_price) AS total_revenue FROM orders WHERE status = 'Complete'";
$total_revenue_result = $conn->query($total_revenue_query);
$total_revenue = $total_revenue_result->fetch_assoc()['total_revenue'];

// Fetch pending orders
$pending_orders_query = "SELECT COUNT(*) AS pending_orders FROM orders WHERE status = 'Pending'";
$pending_orders_result = $conn->query($pending_orders_query);
$pending_orders = $pending_orders_result->fetch_assoc()['pending_orders'];

// Fetch latest orders
$latest_orders_query = "SELECT * FROM orders ORDER BY order_date DESC LIMIT 5";
$latest_orders_result = $conn->query($latest_orders_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .report-box {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .report-card {
            background: #007BFF;
            color: white;
            padding: 20px;
            border-radius: 10px;
            width: 30%;
            text-align: center;
            font-size: 18px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }
        .report-card:nth-child(2) {
            background: #28a745;
        }
        .report-card:nth-child(3) {
            background: #dc3545;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Restaurant Report Overview</h2>

        <div class="report-box">
            <div class="report-card">
                <h3>Total Orders</h3>
                <p><?php echo $total_orders; ?></p>
            </div>
            <div class="report-card">
                <h3>Total Revenue</h3>
                <p>Rs.<?php echo number_format($total_revenue, 2); ?></p>
            </div>
            <div class="report-card">
                <h3>Pending Orders</h3>
                <p><?php echo $pending_orders; ?></p>
            </div>
        </div>

        <h2>Latest Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $latest_orders_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_phone']); ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td>Rs.<?php echo number_format($row['total_price'], 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

</body>
</html>
