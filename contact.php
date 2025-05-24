<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        header {
            background: #2c3e50;
            color: #fff;
            padding: 20px;
            width: 100%;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        main {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 50%;
            text-align: center;
        }
        h2 {
            color: #2c3e50;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        footer {
            margin-top: 20px;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        Contact Admin
    </header>
    
    <main>
        <h2>Admin Contact Information</h2>
        <p><strong>Name:</strong> Gajendra Nagpure</p>
        <p><strong>Email:</strong> nagpuregajendra704@gmail.com</p>
        <p><strong>Phone:</strong> +91-7030759936</p>
        <p><strong>Address:</strong> Near Krishna Palace Gondia 441601</p>
    </main>
    
    <footer>
        &copy; 2025 Restaurant Billing System. All rights reserved.
    </footer>
</body>
</html>
