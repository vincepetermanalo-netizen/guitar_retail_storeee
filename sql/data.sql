CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    date_registered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE brands (
    brand_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(100) NOT NULL,
    country_of_origin VARCHAR(100),
    founder VARCHAR(100),
    established_year YEAR,
    added_by INT NULL,
    updated_by INT NULL,
    last_updated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (added_by) REFERENCES users(user_id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by) REFERENCES users(user_id) ON DELETE SET NULL
);

CREATE TABLE guitars (
    guitar_id INT AUTO_INCREMENT PRIMARY KEY,
    guitar_name VARCHAR(100) NOT NULL,
    technologies_used TEXT,
    brand_id INT NOT NULL,
    added_by INT NULL,
    updated_by INT NULL,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);