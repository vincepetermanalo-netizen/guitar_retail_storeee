<?php
require_once 'core/auth.php';
requireLogin();

require_once 'core/dbConfig.php';
require_once 'core/models.php';

$brand_id = $_GET['brand_id'] ?? 0;
$brand = getBrandByID($pdo, $brand_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Brand</title>
</head>
<body>
    <h1>Delete Brand</h1>

    <p>Are you sure you want to delete this brand?</p>
    <p><strong><?php echo htmlspecialchars($brand['brand_name'] ?? ''); ?></strong></p>

    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="brand_id" value="<?php echo htmlspecialchars($brand_id); ?>">
        <input type="submit" name="deleteBrandBtn" value="Confirm Delete">
    </form>

    <p><a href="index.php">Cancel</a></p>
</body>
</html>