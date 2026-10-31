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
    <title>Delete Guitar</title>
</head>
<body>
    <h1>Delete Guitar</h1>

    <p>Are you sure you want to delete this guitar?</p>
    <p><strong><?php echo htmlspecialchars($guitar['guitar_name']); ?></strong></p>

    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="guitar_id" value="<?php echo htmlspecialchars($guitar_id); ?>">
        <input type="hidden" name="brand_id" value="<?php echo htmlspecialchars($brand_id); ?>">
        <input type="submit" name="deleteGuitarBtn" value="Confirm Delete">
    </form>

    <p><a href="viewprojects.php?brand_id=<?php echo htmlspecialchars($brand_id); ?>">Cancel</a></p>
</body>
</html>