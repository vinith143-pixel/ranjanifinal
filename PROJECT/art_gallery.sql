CREATE DATABASE IF NOT EXISTS art_gallery;
USE art_gallery;

-- Table for storing painting details
CREATE TABLE IF NOT EXISTS paintings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    type ENUM('Watercolor', 'Pencil Sketch', 'Oil', 'Serigraph', 'Digital') NOT NULL,
    medium VARCHAR(255),
    size VARCHAR(50),
    dimension VARCHAR(50),
    orientation ENUM('Portrait', 'Landscape', 'Square') NOT NULL,
    reference_number VARCHAR(50) UNIQUE NOT NULL,
    image_url VARCHAR(255) NOT NULL
);

-- Table for storing user details
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(255),
    phone VARCHAR(20)
);

-- Table for storing card details
CREATE TABLE IF NOT EXISTS card_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    card_number VARCHAR(16) NOT NULL,
    expiry_date VARCHAR(7) NOT NULL, -- Format MM/YYYY
    cvv VARCHAR(3) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table for storing booking details
CREATE TABLE IF NOT EXISTS booking_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    painting_id INT,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (painting_id) REFERENCES paintings(id) ON DELETE CASCADE
);

-- Table for storing bill details
CREATE TABLE IF NOT EXISTS bill (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,
    transaction_id VARCHAR(50) UNIQUE NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_status ENUM('Success', 'Failed', 'Pending') DEFAULT 'Pending',
    FOREIGN KEY (booking_id) REFERENCES booking_details(id) ON DELETE CASCADE
);

-- Table for storing admin details
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert default admin user
INSERT INTO admin (username, password) VALUES ('admin', 'admin123');
