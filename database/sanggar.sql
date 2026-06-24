-- =========================================
-- DATABASE RESET: sanggar
-- =========================================

CREATE DATABASE IF NOT EXISTS sanggar;
USE sanggar;

-- =========================================
-- USERS (AUTH CORE)
-- =========================================
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('superadmin','admin') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- seed superadmin (password: admin007)
INSERT INTO users (username, password, full_name, role)
VALUES (
    'superadmin',
    '$2y$10$QwZcQ3Qm8m8v6X9yQz7n8uG8xvQqv0QZl8v1cY7QxQmQwZcQ3Qm8m',
    'Super Administrator',
    'superadmin'
);

-- NOTE:
-- password di atas HARUS digenerate ulang via PHP bcrypt (lihat bawah)

-- =========================================
-- HERO SLIDES
-- =========================================
DROP TABLE IF EXISTS hero_slides;

CREATE TABLE hero_slides (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    subtitle TEXT,
    image VARCHAR(255),
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1
);

-- =========================================
-- ABOUT
-- =========================================
DROP TABLE IF EXISTS about;

CREATE TABLE about (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    statistics JSON NULL
);

-- =========================================
-- VISI MISI
-- =========================================
DROP TABLE IF EXISTS visi_misi;

CREATE TABLE visi_misi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    vision_title VARCHAR(255),
    visi TEXT,
    mission_title VARCHAR(255),
    misi TEXT
);

-- =========================================
-- TIMELINE / SEJARAH
-- =========================================
DROP TABLE IF EXISTS timeline;

CREATE TABLE timeline (
    id INT AUTO_INCREMENT PRIMARY KEY,
    year VARCHAR(10),
    title VARCHAR(255),
    description TEXT,
    image VARCHAR(255),
    sort_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1
);

-- =========================================
-- GALERI (CMS READY FUTURE)
-- =========================================
DROP TABLE IF EXISTS galeri;

CREATE TABLE galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    image VARCHAR(255),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- SETTINGS (GLOBAL CMS CONFIG)
-- =========================================
DROP TABLE IF EXISTS settings;

CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) UNIQUE,
    `value` TEXT
);

-- seed basic settings
INSERT INTO settings (`key`, `value`) VALUES
('site_name', 'Sanggar Nampani'),
('cms_version', '1.0.0');