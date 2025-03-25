<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "art_gallery";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if values exist before accessing
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$price = isset($_POST['price']) ? $_POST['price'] : '';

$transaction_date = date("Y-m-d H:i:s");

// Check if card details exist
$card_number = isset($_POST['card']) ? $_POST['card'] : '';
$expiry_date = isset($_POST['expiry']) ? $_POST['expiry'] : '';
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';

if (empty($card_number) || empty($expiry_date) || empty($cvv)) {
    die("Error: Missing card details.");
}

// Encrypt the card number (For security)
$encrypted_card = base64_encode($card_number);

// Insert booking details into the `bill` table
$sql1 = "INSERT INTO bill (name, email, painting_title, price, transaction_date) 
         VALUES ('$name', '$email', '$title', '$price', '$transaction_date')";

// Insert card details into `cards_details` table
$sql2 = "INSERT INTO cards_details (name, email, card_number, expiry_date, cvv, transaction_date) 
         VALUES ('$name', '$email', '$encrypted_card', '$expiry_date', '$cvv', '$transaction_date')";

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
    echo "<h2>Booking Confirmed</h2>";
    echo "<p>Name: $name</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Painting: $title</p>";
    echo "<p>Price: $$price</p>";
    echo "<p>Transaction Date: $transaction_date</p>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
