<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "GTN";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $phone = $_POST["phone"];
    
    // Check if passwords match
    if ($password !== $cpassword) {
        $message = "<div class='error-message'>Passwords do not match!</div>";
    } else {
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Determine user role (default is "Customer" for public registrations)
        $role = isset($_POST["role"]) ? $_POST["role"] : "Customer";

        // Insert user data into the database
        $sql = "INSERT INTO user (name, email, password, phone, role) 
                VALUES ('$name', '$email', '$hashed_password', '$phone', '$role')";

        if ($conn->query($sql) === TRUE) {
            if ($role === "Admin") {
                header("Location: admin_dashboard.php");
            } elseif ($role === "Staff") {
                header("Location: staff_dashboard.php");
            } else {
                header("Location: customer_dashboard.php");
            }
            exit();
        }else {
            $message = "<div class='error-message'>Error: " . $conn->error . "</div>";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Restaurant Billing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 40%;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #007bff;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input, select {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
            width: 85%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .success-message {
            color: green;
            margin-top: 10px;
        }
        .login-link {
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Sign-Up</h1>
    <?php echo $message; ?>

    <form method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="cpassword">Confirm Password:</label>
        <input type="password" id="cpassword" name="cpassword" required>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required>

        <label for="role">User Role:</label>
        <select id="role" name="role" required>
            <option value="Customer">Customer</option>
            
            
            
        </select>

        <input type="submit" value="Sign-Up">
    </form>

    <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
</div>

</body>
</html>
