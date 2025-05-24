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

// Fetch menu items
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);

$message = "";

// Handle order submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST["customer_name"];
    $customer_email = $_POST["customer_email"];
    $customer_phone = $_POST["customer_phone"];
    $menu_item_id = $_POST["menu_item"];
    $quantity = $_POST["quantity"];

    // Get the price of the selected item
    $price_query = "SELECT price FROM menu WHERE id = $menu_item_id";
    $price_result = $conn->query($price_query);
    $menu_row = $price_result->fetch_assoc();
    $total_price = $menu_row["price"] * $quantity;

    // Insert order into database
    $order_sql = "INSERT INTO orders (customer_name, customer_email, customer_phone, menu_item_id, quantity, total_price) 
                  VALUES ('$customer_name', '$customer_email', '$customer_phone', $menu_item_id, $quantity, $total_price)";

    if ($conn->query($order_sql) === TRUE) {
        $message = "<div class='success-message'>✅ Order placed successfully!</div>";
    } else {
        $message = "<div class='error-message'>❌ Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order - Restaurant Billing System</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color:rgb(245, 171, 240);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background:rgb(151, 194, 229);
            padding: 30px;
            width: 40%;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: 600;
            text-align: left;
        }
        input, select {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 15px;
        }
        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🍽️ Place an Order</h1>
    <?php echo $message; ?>

    <form method="POST">
        <label for="customer_name">Full Name:</label>
        <input type="text" id="customer_name" name="customer_name" required>

        <label for="customer_email">Email:</label>
        <input type="email" id="customer_email" name="customer_email" required>

        <label for="customer_phone">Phone Number:</label>
        <input type="text" id="customer_phone" name="customer_phone" required>

        <label for="menu_item">Select Item:</label>
        <select id="menu_item" name="menu_item" required>
            <option value="">-- Select Menu Item --</option>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['name'] . " - " . number_format($row['price'], 2); ?>
                </option>
            <?php } ?>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" value="1" required>

        <input type="submit" value="🛒 Place Order">
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>
