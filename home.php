<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Billing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background:rgb(249, 215, 247);
            text-align: center;
        }

        header {
            background: #ff5733;
            padding: 10px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .auth-buttons {
            margin-right: 20px;
        }

        .btn {
            background: white;
            color: #ff5733;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-left: 10px;
            transition: background 0.3s, color 0.3s;
        }

        .btn:hover {
            background: #e64a19;
            color: white;
        }

        .container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 50px auto;
            width: 80%;
            flex-wrap: wrap;
        }

        .content {
            width: 40%;
            background:rgb(245, 138, 190);
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .images {
            width: 45%;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .images img {
            width: 48%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: #222;
            color: white;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Our Restaurant</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <a href="register.php" class="btn">Register</a>
            <a href="login.php" class="btn">Login</a>
        </div>
    </header>
    
    <main>
        <div class="container">
            <section class="content">
                <h2>Experience the Best Dining with Us</h2>
                <p>Enjoy our delicious meals and excellent services. We ensure the best experience for you and your family.</p>
            </section>
            <div class="images">
                <img src="images\image1.jpg" alt="Delicious Food">
                <img src="images\image2.jpg" alt="Beautiful Restaurant">
                <img src="images\image3.jpg" alt="Chef Special">
                <img src="images\image4.jpg" alt="Fine Dining">
                <img src="images\image1.jpg" alt="Delicious Food">
                <img src="images\image2.jpg" alt="Beautiful Restaurant">
                <img src="images\image3.jpg" alt="Chef Special">
                <img src="images\image4.jpg" alt="Fine Dining">
            </div>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2025 Restaurant Billing System. All rights reserved.</p>
    </footer>
</body>
</html>
