CREATE DATABASE admin_panel;
USE admin_panel;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    coins INT DEFAULT 100
);

-- إدخال مستخدم إداري (Admin)
INSERT INTO users (username, password, coins) VALUES ('Admin', 'AdminYsf', 1000);
