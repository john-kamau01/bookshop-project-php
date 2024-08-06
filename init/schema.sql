-- SQL script to create the sales table

CREATE TABLE IF NOT EXISTS sales(
    sale_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_mail VARCHAR(255) NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_price DECIMAL(10, 2) NOT NULL,
    sale_date DATETIME NOT NULL
);