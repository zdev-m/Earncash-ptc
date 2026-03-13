CREATE DATABASE ptc_site;
USE ptc_site;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) UNIQUE,
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    balance DECIMAL(10,2) DEFAULT 0.00,
    total_earned DECIMAL(10,2) DEFAULT 0.00,
    referral_code VARCHAR(50) UNIQUE,
    referred_by INT DEFAULT 0,
    package_id INT DEFAULT 1,
    package_expiry DATETIME,
    is_active TINYINT DEFAULT 1,
    is_admin TINYINT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    price DECIMAL(10,2),
    daily_ads INT DEFAULT 10,
    referral_bonus DECIMAL(5,2) DEFAULT 10.00,
    withdraw_min DECIMAL(10,2) DEFAULT 500.00
);

CREATE TABLE ads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    image_url TEXT,
    target_url TEXT,
    reward DECIMAL(10,2),
    timer INT DEFAULT 30,
    category VARCHAR(100),
    status TINYINT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ad_views (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    ad_id INT,
    reward DECIMAL(10,2),
    ip_address VARCHAR(50),
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE withdrawals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    amount DECIMAL(10,2),
    method ENUM('easypaisa','jazzcash','bank'),
    account_details TEXT,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    requested_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO packages (name, price, daily_ads, referral_bonus, withdraw_min) VALUES
('Free Package', 0, 5, 5.00, 500),
('Silver Package', 500, 15, 10.00, 300),
('Gold Package', 1000, 30, 15.00, 200),
('Diamond Package', 2000, 50, 20.00, 100);