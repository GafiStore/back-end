CREATE DATABASE IF NOT EXISTS db_back_end;

USE db_back_end;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nilai DECIMAL(10, 2)
);