<?php
require_once 'core/auth.php';
requireLogin();

require_once 'core/dbConfig.php';
require_once 'core/models.php';

$guitar_id = $_GET['guitar_id'] ?? 0;
$brand_id = $_GET['brand_id'] ?? 0;

$guitar = getGuitarByID($pdo, $guitar_id);

if (!$guitar) {
    die("No guitar found for this ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Guitar</title>
</head>
<body>
    <h1>Edit Guitar</h1>

    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="guitar_id" value="<?php echo htmlspecialchars($guitar_id); ?>">
        <input type="hidden" name="brand_id" value="<?php echo htmlspecialchars($brand_id); ?>">

        <p>
            <label for="guitarName">Guitar Name</label>
            <input type="text" name="guitarName" id="guitarName"
                   value="<?php echo htmlspecialchars($guitar['guitar_name']); ?>" required>
        </p>

        <p>
            <label for="technologiesUsed">Technologies Used</label>
            <input type="text" name="technologiesUsed" id="technologiesUsed"
                   value="<?php echo htmlspecialchars($guitar['technologies_used']); ?>">
        </p>

        <p>
            <input type="submit" name="editGuitarBtn" value="Update Guitar">
        </p>
    </form>
</body>
</html>