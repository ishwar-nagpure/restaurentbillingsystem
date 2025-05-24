<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Exquisite Dining</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            color: #d35400;
            font-size: 36px;
        }
        .intro {
            font-size: 18px;
            color: #444;
            margin-bottom: 25px;
        }
        .facilities {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .facility {
            width: 45%;
            background: rgba(255, 236, 210, 0.8);
            padding: 20px;
            margin: 15px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .facility:hover {
            transform: scale(1.05);
        }
        .facility img {
            width: 100px;
            height: 100px;
        }
        .facility h3 {
            color: #c0392b;
            margin: 15px 0;
        }
        .menu-section {
            margin-top: 40px;
            font-size: 24px;
            color: #2c3e50;
        }
        .menu-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .menu-images img {
            width: 180px;
            height: 130px;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .menu-images img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Exquisite Dining 🍽️</h1>
    <p class="intro">
        Indulge in a luxurious dining experience with a blend of exquisite flavors, ambient atmosphere, and world-class service. Our restaurant is dedicated to providing the finest gourmet meals and an unforgettable experience.
    </p>

    <h2>🌟 Why Choose Us?</h2>
    <div class="facilities">
        <div class="facility">
            <img src="images/dining.jpg" alt="Dining Area">
            <h3>Elegant Dining</h3>
            <p>Immerse yourself in a refined and intimate dining environment, perfect for every occasion.</p>
        </div>
        <div class="facility">
            <img src="images/chef.jpeg" alt="Expert Chefs">
            <h3>Expert Chefs</h3>
            <p>Our world-class chefs bring culinary excellence to your plate with a touch of artistry.</p>
        </div>
        <div class="facility">
            <img src="images/wine.jpeg" alt="Exclusive Wines">
            <h3>Exclusive Wines</h3>
            <p>A curated selection of fine wines to perfectly complement your meal.</p>
        </div>
        <div class="facility">
            <img src="images/music.jpg" alt="Live Music">
            <h3>Live Music</h3>
            <p>Enhance your dining experience with soothing live performances.</p>
        </div>
    </div>

    <h2 class="menu-section">🍛 Signature Dishes</h2>
    <div class="menu-images">
    <img src="images\bbq_chicken.jpg" alt="Menu Item 1">
        <img src="images\plain dosa.jpeg" alt="Menu Item 2">
        <img src="images\veggie_burger.jpg" alt="Menu Item 3">
        <img src="images\bbq_chicken.jpg" alt="Menu Item 4">
        <img src="images\gobi manchurian.jpg" alt="Menu Item 5">
        <img src="images\ditalini pasta.png" alt="Menu Item 6">
        <img src="images\soba-noodles.webp" alt="Menu Item 7">
        <img src="images\paneer manchurian.jpg" alt="Menu Item 8">
        <img src="images\rasgulla.jpg" alt="Menu Item 9">
        <img src="images\samosa.webp" alt="Menu Item 10">
</div>

</body>
</html>
