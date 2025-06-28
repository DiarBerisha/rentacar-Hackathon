CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    confirm_password VARCHAR(255) NOT NULL,
    mbiemri VARCHAR(255) NOT NULL,
    ditlindja VARCHAR(255) NOT NULL,
    patentshoferi VARCHAR(255) NOT NULL,
    numritelefonit VARCHAR(255) NOT NULL,
    kodipostar VARCHAR(255) NOT NULL,
    qyteti VARCHAR(255) NOT NULL,
    shteti VARCHAR(255) NOT NULL,
    adresa VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    emri VARCHAR(255) NOT NULL
);
