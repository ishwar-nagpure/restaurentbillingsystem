<?php
session_start();
include 'db_connect.php'; // Ensure this file contains the database connection

// Fetch current settings
$settings_query = "SELECT * FROM settings LIMIT 1";
$settings_result = $conn->query($settings_query);
$settings = $settings_result->fetch_assoc();

// Handle Update Settings
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_settings'])) {
    $restaurant_name = $_POST['restaurant_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $update_query = "UPDATE settings SET restaurant_name=?, email=?, phone=? WHERE id=1";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sss", $restaurant_name, $email, $phone);

    if ($stmt->execute()) {
        $message = "Settings updated successfully!";
    } else {
        $message = "Error updating settings.";
    }
}

// Handle Password Change
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    // Verify Old Password
    $admin_query = "SELECT password FROM admin WHERE id=1";
    $admin_result = $conn->query($admin_query);
    $admin = $admin_result->fetch_assoc();

    if (password_verify($old_password, $admin['password'])) {
        $update_password_query = "UPDATE admin SET password=? WHERE id=1";
        $stmt = $conn->prepare($update_password_query);
        $stmt->bind_param("s", $new_password);

        if ($stmt->execute()) {
            $message = "Password updated successfully!";
        } else {
            $message = "Error updating password.";
        }
    } else {
        $message = "Incorrect old password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .message {
            text-align: center;
            color: green;
            margin-bottom: 10px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
        }
        input {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            margin-top: 15px;
            background: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Restaurant Settings</h2>
        
        <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>

        <form method="post">
            <label>Restaurant Name:</label>
            <input type="text" name="restaurant_name" value="<?php echo $settings['restaurant_name']; ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $settings['email']; ?>" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?php echo $settings['phone']; ?>" required>

            <button type="submit" name="update_settings">Update Settings</button>
        </form>

        <h2>Change Password</h2>

        <form method="post">
            <label>Old Password:</label>
            <input type="password" name="old_password" required>

            <label>New Password:</label>
            <input type="password" name="new_password" required>

            <button type="submit" name="change_password">Change Password</button>
        </form>
    </div>

</body>
</html>
