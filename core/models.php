<?php

require_once __DIR__ . '/dbConfig.php';

// ---------- Users ----------

function insertUser($pdo, $username, $firstName, $lastName, $address, $age, $password) {
    $sql = "INSERT INTO users (username, first_name, last_name, address, age, password_hash)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        $username,
        $firstName,
        $lastName,
        $address,
        $age,
        password_hash($password, PASSWORD_DEFAULT)
    ]);
}

function getUserByUsername($pdo, $username) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    return $stmt->fetch();
}

// ---------- Brands ----------

function insertBrand($pdo, $brandName, $countryOfOrigin, $founder, $establishedYear, $user_id) {
    $sql = "INSERT INTO brands (brand_name, country_of_origin, founder, established_year, added_by, updated_by, last_updated, date_added)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$brandName, $countryOfOrigin, $founder, $establishedYear, $user_id, $user_id]);
}

function getAllBrands($pdo) {
    $sql = "SELECT b.*, a.username AS added_by_name, u.username AS updated_by_name
            FROM brands b
            LEFT JOIN users a ON b.added_by = a.user_id
            LEFT JOIN users u ON b.updated_by = u.user_id
            ORDER BY b.brand_id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getBrandByID($pdo, $brand_id) {
    $sql = "SELECT * FROM brands WHERE brand_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$brand_id]);
    return $stmt->fetch();
}

function updateBrandByID($pdo, $brandName, $countryOfOrigin, $founder, $establishedYear, $brand_id, $user_id) {
    $sql = "UPDATE brands
            SET brand_name = ?,
                country_of_origin = ?,
                founder = ?,
                established_year = ?,
                updated_by = ?,
                last_updated = NOW()
            WHERE brand_id = ?";

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$brandName, $countryOfOrigin, $founder, $establishedYear, $user_id, $brand_id]);
}

function deleteBrandByID($pdo, $brand_id) {
    $sql = "DELETE FROM brands WHERE brand_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$brand_id]);
}

// ---------- Guitars ----------

function insertGuitar($pdo, $guitarName, $technologiesUsed, $brand_id, $user_id) {
    $sql = "INSERT INTO guitars (guitar_name, technologies_used, brand_id, added_by, updated_by, last_updated, date_added)
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())";

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$guitarName, $technologiesUsed, $brand_id, $user_id, $user_id]);
}

function getGuitarsByBrand($pdo, $brand_id) {
    $sql = "SELECT g.*, a.username AS added_by_name, u.username AS updated_by_name
            FROM guitars g
            LEFT JOIN users a ON g.added_by = a.user_id
            LEFT JOIN users u ON g.updated_by = u.user_id
            WHERE g.brand_id = ?
            ORDER BY g.guitar_id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$brand_id]);
    return $stmt->fetchAll();
}

function getGuitarByID($pdo, $guitar_id) {
    $sql = "SELECT * FROM guitars WHERE guitar_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$guitar_id]);
    return $stmt->fetch();
}

function updateGuitarByID($pdo, $guitarName, $technologiesUsed, $guitar_id, $user_id) {
    $sql = "UPDATE guitars
            SET guitar_name = ?,
                technologies_used = ?,
                updated_by = ?,
                last_updated = NOW()
            WHERE guitar_id = ?";

    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$guitarName, $technologiesUsed, $user_id, $guitar_id]);
}

function deleteGuitarByID($pdo, $guitar_id) {
    $sql = "DELETE FROM guitars WHERE guitar_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$guitar_id]);
}