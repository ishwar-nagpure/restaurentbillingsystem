<?php
session_start();
include 'db_connect.php'; // Ensure this file contains the database connection

// Handle AJAX request to update order status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];

    $update_query = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("si", $new_status, $order_id);

    if ($stmt->execute()) {
        echo "Order updated successfully!";
    } else {
        echo "Error updating order.";
    }
    exit;
}

// Handle AJAX request to delete an order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_order'])) {
    $order_id = $_POST['order_id'];

    $delete_query = "DELETE FROM orders WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $order_id);

    if ($stmt->execute()) {
        echo "Order deleted successfully!";
    } else {
        echo "Error deleting order.";
    }
    exit;
}

// Fetch orders from the database
$sql = "SELECT id, customer_name, customer_email, customer_phone, menu_item_id, quantity, status, order_date, total_price, order_details FROM orders ORDER BY order_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .container {
            width: 100%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            color: #333;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Button Styles */
        .btn {
            padding: 8px 12px;
            margin: 5px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn-refresh {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            border: none;
            font-size: 16px;
        }

        .btn-refresh:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #a71d2a;
        }

        /* Order Status Dropdown */
        select.order-status {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: white;
            font-size: 14px;
        }

        select.order-status:focus {
            border-color: #007BFF;
            outline: none;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }

            th {
                text-align: center;
            }

            td {
                text-align: center;
                border: none;
                border-bottom: 1px solid #ddd;
            }

            tr {
                margin-bottom: 15px;
                display: block;
                border-bottom: 2px solid #ddd;
                padding-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Manage Orders</h2>
        <button class="btn-refresh" onclick="location.reload();">Refresh Orders</button>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Menu Item ID</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Order Details</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr id="order-<?php echo $row['id']; ?>">
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['customer_phone']); ?></td>
                    <td><?php echo $row['menu_item_id']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>Rs.<?php echo number_format($row['total_price'], 2); ?></td>
                    <td><?php echo htmlspecialchars($row['order_details']); ?></td>
                    <td>
                        <select class="order-status" data-id="<?php echo $row['id']; ?>">
                            <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Complete" <?php echo ($row['status'] == 'Complete') ? 'selected' : ''; ?>>Complete</option>
                        </select>
                    </td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td>
                        <button class="btn btn-delete" data-id="<?php echo $row['id']; ?>">Delete</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        // Update order status using AJAX
        $(document).on("change", ".order-status", function () {
            var order_id = $(this).data("id");
            var new_status = $(this).val();

            $.post("manage_orders.php", { update_order: 1, order_id: order_id, new_status: new_status }, function (response) {
                alert(response);
            });
        });

        // Delete order using AJAX
        $(document).on("click", ".btn-delete", function () {
            if (confirm("Are you sure you want to delete this order?")) {
                var order_id = $(this).data("id");  

                $.post("manage_orders.php", { delete_order: 1, order_id: order_id }, function (response) {
                    alert(response);
                    $("#order-" + order_id).fadeOut();
                });
            }
        });
    </script>
</body>
</html>
