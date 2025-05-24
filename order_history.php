<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GTN"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders
$sql = "SELECT orders.id, customer_name, customer_email, customer_phone, menu.name AS menu_item, quantity, total_price, status 
        FROM orders 
        JOIN menu ON orders.menu_item_id = menu.id 
        ORDER BY orders.id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Restaurant Billing System</title>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .status-pending {
            color: red;
            font-weight: bold;
        }
        .status-complete {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📜 Order History</h1>
    <table>
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Menu Item</th>
            <th>Quantity</th>
            <th>Total Price (₹)</th>
            <th>Status</th>
        </tr>
        <?php 
        if ($result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) { 
                $statusClass = ($row['status'] === "Complete") ? "status-complete" : "status-pending";
        ?>
        <tr>
            <td><?php echo $count++; ?></td>
            <td><?php echo $row["customer_name"]; ?></td>
            <td><?php echo $row["customer_email"]; ?></td>
            <td><?php echo $row["customer_phone"]; ?></td>
            <td><?php echo $row["menu_item"]; ?></td>
            <td><?php echo $row["quantity"]; ?></td>
            <td><?php echo number_format($row["total_price"], 2); ?></td>
            <td class="<?php echo $statusClass; ?>"><?php echo $row["status"]; ?></td>
        </tr>
        <?php 
            } 
        } else {
            echo "<tr><td colspan='8'>No orders found.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
