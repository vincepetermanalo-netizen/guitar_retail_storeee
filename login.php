<?php require_once 'core/auth.php'; ?>
<?php if (isLoggedIn()) { header("Location: index.php"); exit; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php flashMessage(); ?>

    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </p>

        <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </p>

        <p>
            <input type="submit" name="loginBtn" value="Login">
        </p>
    </form>

    <p>No account yet? <a href="register.php">Register</a></p>
</body>
</html>