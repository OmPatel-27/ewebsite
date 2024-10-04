CREATE DATABASE ecommerce_db;

USE ecommerce_db;

CREATE TABLE smartphones (
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
    ProductAddedBy VARCHAR(100) DEFAULT 'Om Rajendrabhai Patel' NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
