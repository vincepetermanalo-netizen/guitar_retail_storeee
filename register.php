<?php require_once 'core/auth.php'; ?>
<?php if (isLoggedIn()) { header("Location: index.php"); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    <?php flashMessage(); ?>

    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </p>

        <p>
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" id="first_name" required>
        </p>

        <p>
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" id="last_name" required>
        </p>

        <p>
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>
        </p>

        <p>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" min="1" required>
        </p>

        <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </p>

        <p>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
        </p>

        <p>
            <input type="submit" name="registerBtn" value="Register">
        </p>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>