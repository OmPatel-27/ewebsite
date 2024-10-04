<?php

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "ecommerce_db";


$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS smartphones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    model_name VARCHAR(100) NOT NULL,
    brand VARCHAR(50) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    storage_capacity VARCHAR(20),
    camera_resolution VARCHAR(20),
    battery_capacity VARCHAR(20),
    release_date DATE,
    stock_quantity INT,
    description TEXT,
    image_url VARCHAR(255),
    ProductAddedBy VARCHAR(100) DEFAULT 'Om Rajendrabhai Patel' NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'smartphones' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}


$conn->close();
?>
