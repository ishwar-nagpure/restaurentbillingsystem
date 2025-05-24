<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GTN";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu items from the database
$sql = "SELECT id, name, price, image FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 90%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #007bff;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .menu-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .menu-item img {
            width: 100%;
            height: 180px;
            border-radius: 10px;
            object-fit: cover;
        }
        .menu-item h3 {
            margin: 10px 0;
            color: #333;
        }
        .menu-item p {
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            cursor: pointer;
        }
        .menu-item p:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Our Menu</h1>

    <div class="menu-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='menu-item'>";
                echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p onclick=\"window.location.href='place_order.php?menu_id=" . $row['id'] . "'\">₹ " . number_format($row['price'], 2) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No menu items available.</p>";
        }
        ?>
    </div>
</div>

</body>
</html>

<?php $conn->close(); ?>
