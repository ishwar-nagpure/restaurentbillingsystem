<?php
session_start();
include 'db_connect.php'; // Ensure this file connects to your GTN database

// Check if the user is logged in (Add authentication as needed)
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Fetch user details
    $query = "SELECT * FROM user WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    
    $update_query = "UPDATE user SET name = ?, email = ?, phone = ?, role = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ssssi", $name, $email, $phone, $role, $user_id);
    
    if ($stmt->execute()) {
        echo "User updated successfully.";
    } else {
        echo "Error updating user.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
        <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
        <br>
        <label for="role">Role:</label>
        <select name="role" required>
            <option value="Customer" <?php echo ($user['role'] == 'Customer') ? 'selected' : ''; ?>>Customer</option>
            <option value="Staff" <?php echo ($user['role'] == 'Staff') ? 'selected' : ''; ?>>Staff</option>
            <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
        </select>
        <br>
        <button type="submit">Update</button>
    </form>
    <br>
    <a href="manage_users.php">Back to User Management</a>
</body>
</html>
