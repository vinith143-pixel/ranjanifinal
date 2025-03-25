<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Art Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            overflow-x: hidden;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            overflow-x: hidden;
        }

        .top-bar {
            background: linear-gradient(45deg, #222, #555);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 18px;
            animation: slideIn 1s ease-in-out;
        }

        .navbar {
            background: black;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: center;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .navbar a:hover {
            background: #e74c3c;
            border-radius: 5px;
        }


        .container {
            text-align: center;
            padding: 50px;
            max-width: 900px;
            margin: auto;
        }

        .about-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            animation: fadeIn 2s;
        }

        .content {
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.6;
        }

        .footer {
            background: black;
            color: white;
            text-align: center;
            padding: 15px;
            margin-top: 20px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="top-bar">📞 9361226032 | ✉ ranjanis617@gmail.com</div>
    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="about.php">About</a>
        <a href="gallery.html">Gallery</a>
        <a href="contact.html">Contact</a>
        <a href="">Admin</a>
        <a href="login.php">Login</a>
        <a href="user_register.php">Register</a>
    </div>
    <div class="container">
        <h1>About Our Art Gallery</h1>
        <img class="about-image" src="images/b2.jpg" alt="Art Gallery">
        <div class="content">
            <p>Welcome to our Art Gallery, a place where creativity meets expression. Our gallery showcases a diverse
                collection of paintings, sculptures, and modern artworks by renowned and emerging artists.</p>
            <p>We aim to provide art enthusiasts with a unique and immersive experience, bringing together traditional
                and contemporary styles in one place. Our platform is designed to make discovering and purchasing art
                seamless and enjoyable.</p>
            <p>Join us in celebrating the beauty of artistic expression and let your journey into the world of art begin
                here.</p>
        </div>
    </div>
    <div class="footer">Art Gallery Management System</div>
</body>

</html>