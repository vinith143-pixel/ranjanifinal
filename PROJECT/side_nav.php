<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }
        
        .sidebar {
            width: 250px;
            height: 100vh;
            background: pink;
            color: black;
            position: fixed;
            padding-top: 20px;
            transition: all 0.3s;
        }
        .sidebar a {
            display: block;
            color: black;
            padding: 15px;
            text-decoration: none;
            transition: background 0.3s;
        }
        .sidebar a:hover {
            background: #555;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            width: calc(100% - 250px);
        }
        .painting-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .painting-card {
            width: 18rem;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            background: white;
        }
        .painting-card img {
            width: 100%;
            height: auto;
            cursor: pointer;
        }
        .painting-card p {
    margin: 5px 0;
    font-size: 14px;
    color: #555;
}

        .book-now {
            background: #e74c3c;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        .book-now:hover {
            background: #c0392b;
        }
        .booking-container {
            text-align: center;
        }
        .booking-form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .booking-form label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        .booking-form input, .booking-form select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .booking-form button {
            background: #27ae60;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            border-radius: 4px;
        }
        .booking-form button:hover {
            background: #219150;
        }
        .bill-container h2 {
    color: #27ae60;
    font-size: 24px;
}

.bill-container p {
    font-size: 16px;
    color: #333;
    margin: 8px 0;
}

.bill-container .highlight {
    font-weight: bold;
    color: #e74c3c;
}

.bill-container .success {
    color: #2ecc71;
    font-size: 20px;
    margin-top: 10px;
}

.bill-container .bill-details {
    background: #f8f8f8;
    padding: 15px;
    margin-top: 10px;
    border-radius: 8px;
    text-align: left;
}

.bill-container .bill-details p {
    margin: 5px 0;
}

.bill-container .transaction-id {
    font-weight: bold;
    color: #2980b9;
    margin-top: 10px;
}

.bill-container .home-button {
    display: inline-block;
    background: #27ae60;
    color: white;
    padding: 10px 15px;
    margin-top: 15px;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}

.bill-container .home-button:hover {
    background: #219150;
}
/* Bill Page Styles */
.bill-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    font-family: 'Arial', sans-serif;
}

.bill-header {
    text-align: center;
    border-bottom: 2px solid #333;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.bill-header h2 {
    color: #333;
    font-size: 24px;
}

.bill-details {
    text-align: left;
    font-size: 16px;
    color: #555;
}

.bill-details p {
    margin: 8px 0;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.total-amount {
    font-size: 20px;
    font-weight: bold;
    color: #27ae60;
    margin-top: 15px;
}

.bill-footer {
    text-align: center;
    margin-top: 20px;
}

.bill-footer p {
    font-size: 14px;
    color: #888;
}

.print-btn {
    display: inline-block;
    margin-top: 15px;
    padding: 10px 20px;
    font-size: 16px;
    color: #fff;
    background: #007bff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.print-btn:hover {
    background: #0056b3;
}
.bottom-link{
background-color:blue;
width: 40%;

}


.bottom-link {
    margin-top: auto; /* Push to the bottom */
    background: #007bff; /* Blue button */
    color: white;
    padding: 12px;
    text-align: center;
    border-radius: 5px;
    font-weight: bold;
    position: absolute;
    bottom: 20px;
    left: 50%;
    width: 80%; /* Responsive width */
    transform: translateX(-50%);
}

.bottom-link:hover {
    background: #0056b3; /* Darker on hover */
}

/* ✅ Responsive Design for Small Screens */
@media (max-width: 768px) {
    .sidebar {
        width: 200px; /* Smaller sidebar on small screens */
    }
    .bottom-link {
        width: 90%; /* Make button wider */
        font-size: 14px; /* Adjust text size */
    }
}
/* Print Styles */
@media print {
    .print-btn {
        display: none;
    }
    .bill-container {
        box-shadow: none;
        border: none;
    }
    
}



    </style>
</head>
<body>
    <div class="sidebar">
        <h3 style="text-align:center">Art Types</h3>
        <a href="#" onclick="showContent('pencil')">Pencil</a>
        <a href="#" onclick="showContent('watercolor')">Watercolor</a>
        <a href="#" onclick="showContent('oil')">Oil</a>
        <a href="#" onclick="showContent('serigraph')">Serigraph</a>
        <a href="home.php" class="bottom-link">Home</a>

    </div>
    <div class="content" id="content">
        <h2>Welcome</h2>
        <p>Click a menu item to see the content.</p>
    </div>
    
    <script>
        // Load the saved page from localStorage on page load
    window.onload = function () {
        let savedPage = localStorage.getItem("selectedPage");
        if (savedPage) {
            showContent(savedPage);
        } else {
            document.getElementById("content").innerHTML = `
                <h2>Welcome</h2>
                <p>Click a menu item to see the content.</p>
            `;
        }
    };
        function showContent(page) {
            let content = document.getElementById("content");
            let pages = {
                pencil: `
                    <h2>pencil</h2>
                    <div class="painting-container">
                        <div class="painting-card">
                            <img src="images/pencil img1.jpg" alt="Painting 1" onclick="bookPainting('images/pencil img1.jpg', 'Annabelle', '1800')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/pencil img1.jpg', 'Annabelle', '1800')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/pencil img4.jpg" alt="Painting 2" onclick="bookPainting('images/pencil img4.jpg', 'Girl', '2000')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/pencil img4.jpg', 'Girl', '2000')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/pencil img5.jpg" alt="painting 3" onclick="bookPainting('images/pencil img5.jpg', 'Cat', '1800')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/pencil img5.jpg', 'Cat', '1800')">Book Now</button>
                        </div>
                    </div>
                `,
                watercolor: `
                    <h2>Watercolor</h2>
                    <div class="painting-container">
                        <div class="painting-card">
                            <img src="images/wc imgg4.jpg" alt="Painting 1" onclick="bookPainting('images/wc imgg4.jpg', 'Shiv Parvathi', '200')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/wc imgg4.jpg', 'Sunset Bliss', '200')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/wc img5.jpg" alt="Painting 2" onclick="bookPainting('images/wc img5.jpg', 'Ocean Waves', '250')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/wc img5.jpg', 'Ocean Waves', '250')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/wc img2.jpeg" alt="Painting 3" onclick="bookPainting('images/wc img2.jpeg', 'Golden Fields', '180')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/wc img2.jpeg', 'Golden Fields', '180')">Book Now</button>
                        </div>
                    </div>
                `,
                oil: `
                    <h2>oil</h2>
                    <div class="painting-container">
                        <div class="painting-card">
                            <img src="images/oil img7.jpg" alt="Painting 1" onclick="bookPainting('images/oil img7.jpg', 'ShivParvathi', '900')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/oil img7.jpg', 'ShivParvathi', '900')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/oil img6.jpg" alt="Painting 2" onclick="bookPainting('images/oil img6.jpg', 'Bird', '750')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/oil img6.jpg', 'Bird', '750')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/oil img3.jpg" alt="Painting 3" onclick="bookPainting('images/oil img3.jpg', 'Golden Fields', '180')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/oil img3.jpg', 'Golden Fields', '180')">Book Now</button>
                        </div>
                    </div>
                `,
                serigraph: `
                    <h2>serigraph</h2>
                    <div class="painting-container">
                        <div class="painting-card">
                            <img src="images/serigraph img8.jpg" alt="Painting 1" onclick="bookPainting('images/serigraph img8.jpg', 'Girl', '200')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/serigraph img8.jpg', 'Girl', '200')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/serigraph img4.webp" alt="Painting 2" onclick="bookPainting('images/serigraph img4.webp', 'basketball', '250')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/serigraph img4.webp', 'basketball', '250')">Book Now</button>
                        </div>
                        <div class="painting-card">
                            <img src="images/serigraph img6.jpg" alt="Painting 3" onclick="bookPainting('images/serigraph img6.jpg', 'Woodblock thrift find', '1000')">
                            <p><strong>Artist:</strong> John Doe</p>
                            <button class="book-now" onclick="bookPainting('images/serigraph img6.jpg', 'Woodblock thrift find', '1000')">Book Now</button>
                        </div>
                    </div>
                `,
            };

            content.innerHTML = pages[page];
        
        // Save the selected page to localStorage
        localStorage.setItem("selectedPage", page);
        }

        function bookPainting(image, title, price) {
            document.getElementById("content").innerHTML = `
                <div class="booking-container">
                    <h2>Book Your Painting</h2>
                    <img src="${image}" alt="${title}" style="display: block; margin: 0 auto; width: 100%; height: auto; max-height: 50vh; object-fit: contain;">
                    <h3>${title}</h3>
                    <p>Price: $${price}</p>
                    <form class="booking-form" id="bookingForm" onsubmit="processPayment(event, '${title}', ${price})">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required>
                        
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="card">Card Number:</label>
                        <input type="text" id="card" name="card" required maxlength="19" placeholder="XXXX XXXX XXXX XXXX" oninput="formatCardNumber(this)">

                        <label for="expiry">Expiry Date:</label>
                        <input type="month" id="expiry" name="expiry" required>

                       <label for="cvv">CVV:</label>
                       <input type="number" id="cvv" name="cvv" required pattern="\d{3,4}" maxlength="4" title="CVV must be 3 or 4 digits only">

                        <button type="submit">Proceed to Payment</button>
                    </form>
                </div>
            `;
        }


        // Function to handle card formatting
function formatCardNumber(input) {
    let value = input.value.replace(/\D/g, "").substring(0, 16);
    value = value.replace(/(\d{4})/g, "$1 ").trim();
    input.value = value;
}

// Function to validate form and process payment
function processPayment(event, title, price) {
    event.preventDefault();
    
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let card = document.getElementById("card").value.replace(/\s/g, "");
    let expiry = document.getElementById("expiry").value;
    let cvv = document.getElementById("cvv").value;
    
    let currentDate = new Date();
    let inputDate = new Date(expiry + "-01");
    
    // Validations
    if (card.length !== 16 || isNaN(card)) {
        alert("Invalid Card Number. Must be 16 digits.");
        return;
    }
    if (inputDate <= currentDate) {
        alert("Invalid Expiry Date. Must be a future date.");
        return;
    }
    if (!/^\d{3,4}$/.test(cvv)) {
        alert("Invalid CVV. Must be 3 or 4 digits.");
        return;
    }
    
    // Process payment (Mocked for now, should integrate a payment gateway in real use)
    alert("Payment Successful!");
    
    // Save to database via AJAX
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "store_bill.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("content").innerHTML = xhr.responseText;
        }
    };
    
    let data = `name=${name}&email=${email}&title=${title}&price=${price}&card=${card}&expiry=${expiry}&cvv=${cvv}`;
    xhr.send(data);
}

    </script>
</body>
</html>
