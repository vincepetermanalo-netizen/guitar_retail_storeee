<?php

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/dbConfig.php';
require_once __DIR__ . '/models.php';

// ---------- User registration and login ----------

if (isset($_POST['registerBtn'])) {
    $username = trim($_POST['username']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $address = trim($_POST['address']);
    $age = trim($_POST['age']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($username === '' || $firstName === '' || $lastName === '' || $address === '' || $age === '' || $password === '') {
        $_SESSION['message'] = "Make sure no fields are empty.";
    } elseif (!ctype_digit($age)) {
        $_SESSION['message'] = "Age must be a number.";
    } elseif (strlen($password) < 8) {
        $_SESSION['message'] = "Password must be at least 8 characters.";
    } elseif ($password !== $confirmPassword) {
        $_SESSION['message'] = "Passwords do not match.";
    } elseif (getUserByUsername($pdo, $username)) {
        $_SESSION['message'] = "Username is already taken.";
    } elseif (insertUser($pdo, $username, $firstName, $lastName, $address, (int)$age, $password)) {
        $_SESSION['message'] = "Registration successful. You can now log in.";
        header("Location: ../login.php");
        exit;
    } else {
        $_SESSION['message'] = "Registration failed.";
    }

    header("Location: ../register.php");
    exit;
}

if (isset($_POST['loginBtn'])) {
    $user = getUserByUsername($pdo, trim($_POST['username']));

    if ($user && password_verify($_POST['password'], $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../index.php");
        exit;
    }

    $_SESSION['message'] = "Invalid username or password.";
    header("Location: ../login.php");
    exit;
}

// ---------- Only logged in users can use the rest ----------

if (!isLoggedIn()) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// ---------- Brands ----------

if (isset($_POST['insertBrandBtn'])) {
    $brandName = trim($_POST['brandName']);
    $countryOfOrigin = trim($_POST['countryOfOrigin']);
    $founder = trim($_POST['founder']);
    $establishedYear = trim($_POST['establishedYear']);

    if ($brandName === '') {
        $_SESSION['message'] = "Brand name is required.";
        header("Location: ../index.php");
        exit;
    }

    $query = insertBrand($pdo, $brandName, $countryOfOrigin, $founder, $establishedYear, $user_id);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['message'] = "Brand insertion failed.";
        header("Location: ../index.php");
        exit;
    }
}

if (isset($_POST['editBrandBtn'])) {
    $brand_id = $_POST['brand_id'];
    $brandName = trim($_POST['brandName']);
    $countryOfOrigin = trim($_POST['countryOfOrigin']);
    $founder = trim($_POST['founder']);
    $establishedYear = trim($_POST['establishedYear']);

    if ($brandName === '') {
        $_SESSION['message'] = "Brand name is required.";
        header("Location: ../editbrands.php?brand_id=" . $brand_id);
        exit;
    }

    $query = updateBrandByID($pdo, $brandName, $countryOfOrigin, $founder, $establishedYear, $brand_id, $user_id);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['message'] = "Brand update failed.";
        header("Location: ../editbrands.php?brand_id=" . $brand_id);
        exit;
    }
}

if (isset($_POST['deleteBrandBtn'])) {
    $brand_id = $_POST['brand_id'];
    $query = deleteBrandByID($pdo, $brand_id);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        $_SESSION['message'] = "Brand deletion failed.";
        header("Location: ../index.php");
        exit;
    }
}

// ---------- Guitars ----------

if (isset($_POST['insertGuitarBtn'])) {
    $brand_id = (int)($_POST['brand_id'] ?? 0);

    if ($brand_id <= 0) {
        die("Invalid brand selected.");
    }

    $guitarName = trim($_POST['guitarName']);
    $technologiesUsed = trim($_POST['technologiesUsed']);

    if ($guitarName === '') {
        $_SESSION['message'] = "Guitar name is required.";
        header("Location: ../viewprojects.php?brand_id=" . $brand_id);
        exit;
    }

    $query = insertGuitar($pdo, $guitarName, $technologiesUsed, $brand_id, $user_id);

    if ($query) {
        header("Location: ../viewprojects.php?brand_id=" . $brand_id);
        exit;
    } else {
        $_SESSION['message'] = "Guitar insertion failed.";
        header("Location: ../viewprojects.php?brand_id=" . $brand_id);
        exit;
    }
}

if (isset($_POST['editGuitarBtn'])) {
    $guitar_id = $_POST['guitar_id'];
    $brand_id = $_POST['brand_id'];
    $guitarName = trim($_POST['guitarName']);
    $technologiesUsed = trim($_POST['technologiesUsed']);

    if ($guitarName === '') {
        $_SESSION['message'] = "Guitar name is required.";
        header("Location: ../editguitars.php?guitar_id=" . $guitar_id . "&brand_id=" . $brand_id);
        exit;
    }

    $query = updateGuitarByID($pdo, $guitarName, $technologiesUsed, $guitar_id, $user_id);

    if ($query) {
        header("Location: ../viewprojects.php?brand_id=" . $brand_id);
        exit;
    } else {
        $_SESSION['message'] = "Guitar update failed.";
        header("Location: ../editguitars.php?guitar_id=" . $guitar_id . "&brand_id=" . $brand_id);
        exit;
    }
}

if (isset($_POST['deleteGuitarBtn'])) {
    $guitar_id = $_POST['guitar_id'];
    $brand_id = $_POST['brand_id'];

    $query = deleteGuitarByID($pdo, $guitar_id);

    if ($query) {
        header("Location: ../viewprojects.php?brand_id=" . $brand_id);
        exit;
    } else {
        $_SESSION['message'] = "Guitar deletion failed.";
        header("Location: ../viewprojects.php?brand_id=" . $brand_id);
        exit;
    }
}