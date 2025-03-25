<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery</title>
    <style>
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
    flex-wrap: wrap;
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

.carousel {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
}

.carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 1s ease-in-out;
}

.carousel:hover img {
    transform: scale(1.05);
}

.carousel-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 2.5em;
    font-weight: bold;
    background: rgba(0, 0, 0, 0.6);
    padding: 20px;
    border-radius: 10px;
    animation: fadeIn 2s;
    text-align: center;
}

.grid {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    padding: 50px 0;
}

.item {
    margin: 20px;
    text-align: center;
    transition: transform 0.5s;
}

.item img {
    width: 220px;
    height: 220px;
    object-fit: cover;
    border-radius: 10px;
    transition: transform 0.3s;
}

.item:hover img {
    transform: scale(1.1);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
}

.new-arrivals {
    background: linear-gradient(45deg, #27ae60, #2ecc71);
    color: white;
    padding: 20px 0;
    overflow: hidden;
    white-space: nowrap;
}

.scrolling-wrapper {
    display: flex;
    animation: scroll-left 15s linear infinite;
}

.scrolling-wrapper .item {
    flex: 0 0 auto;
    margin: 15px;
    text-align: center;
}

.enquiry-btn {
    background: #e74c3c;
    color: white;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    margin-top: 10px;
    border-radius: 5px;
    transition: background 0.3s ease;
}

.enquiry-btn:hover {
    background: #c0392b;
}

.footer {
    background: black;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: 20px;
    animation: slideUp 1.5s;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .carousel-text {
        font-size: 2em;
        padding: 15px;
    }
    .item img {
        width: 180px;
        height: 180px;
    }
}

@media (max-width: 768px) {
    .navbar {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }
    .navbar a {
        display: none;
    }
    .navbar:hover a {
        display: block;
    }
    .carousel {
        height: 350px;
    }
    .carousel-text {
        font-size: 1.8em;
    }
    .item img {
        width: 150px;
        height: 150px;
    }
    .new-arrivals{
        display: flex;
        flex-direction:row;
        flex-wrap:wrap;
    }
    .scrolling-wrapper{
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
    }
}

@media (max-width: 500px) {
    .navbar {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
    }
    .navbar a {
        display: none;
    }
    .navbar:hover a {
        display: block;
    }
    .carousel {
        height: 250px;
    }
    .carousel-text {
        font-size: 1.5em;
        padding: 10px;
    }
    .item img {
        width: 120px;
        height: 120px;
    }
    .footer {
        padding: 10px;
    }
    .new-arrivals{
        display: flex;
        flex-direction:row;
        flex-wrap:wrap;
    }
    .scrolling-wrapper{
        display:flex;
        flex-direction:row;
        flex-wrap:wrap;
    }
    h2{
        text-align:center;
    }
}

    </style>
</head>

<body>
    <h1 style="text-align: center;">Art Gallery</h1>
    <div class="top-bar">📞 9361226032 | ✉ ranjanis617@gmail.com</div>
    <div class="navbar">
        <a href="./home.php">Home</a>
        <a href="./about.php">About</a>
        <a href="./side_nav.php">Art Type</a>
        <a href="./contact.php">Contact</a>
        <a href="./admin_login.php">Admin</a>
        <a href="./login.php">Login</a>
        <a href="./user_register.php">Register</a>
    </div>
    <div class="carousel">
        <img id="carousel-image" src="images/b1.jpg" alt="Gallery Image">
        <div class="carousel-text">Explore the Beauty of Art</div>
    </div>
    <h3 style="text-align: center;">Best Products</h3>
    <div class="grid">
        <div class="item"><img src="images/a1.jpg" alt="Sculpture">

        </div>
        <div class="item"><img src="images/a2.jpg" alt="Serigraph">

        </div>
        <div class="item"><img src="images/a3.jpg" alt="Print">

        </div>
        <div class="item"><img src="images/cc2.jpg" alt="Print">

        </div>
    </div>
    <div class="new-arrivals">
        <h2 style="text-align: center;">New Arrivals</h2>
        <div class="scrolling-wrapper">
            <div class="item"><img src="images/51-x-Z8772L.jpg" alt="Modern Art">
                <p>Painting</p><button class="enquiry-btn">Enquiry</button>
            </div>
            <div class="item"><img src="images/81PaiYiohaL._SY679_.jpg" alt="Modern Art">
                <p>Painting</p><button class="enquiry-btn">Enquiry</button>
            </div>
            <div class="item"><img src="images/a5.jpg" alt="Modern Art">
                <p>Prints</p><button class="enquiry-btn">Enquiry</button>
            </div>
            <div class="item"><img src="images/a6.jpg" alt="Modern Art">
                <p>Serigraph</p><button class="enquiry-btn">Enquiry</button>
            </div>
            <div class="item"><img src="images/cc1.jpg" alt="Modern Art">
                <p>Modern Art</p><button class="enquiry-btn">Enquiry</button>
            </div>
            <div class="item"><img src="images/a4.jpg" alt="Modern Art">
                <p>Modern Art</p><button class="enquiry-btn">Enquiry</button>
            </div>
        </div>
    </div>
    <div class="footer">Art Gallery Management System</div>
</body>
<script>
    let images = ["images/b1.jpg", "images/b2.jpg", "images/b3.jpg"];
    let index = 0;
    function changeImage() {
        document.getElementById("carousel-image").src = images[index];
        index = (index + 1) % images.length;
    }
    setInterval(changeImage, 3000);
</script>

</html>