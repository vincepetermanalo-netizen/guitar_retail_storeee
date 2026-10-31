<?php
require_once 'core/auth.php';
requireLogin();

require_once 'core/dbConfig.php';
require_once 'core/models.php';

$brand_id = $_GET['brand_id'] ?? 0;
$brand = getBrandByID($pdo, $brand_id);
$guitars = getGuitarsByBrand($pdo, $brand_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitars</title>
</head>
<body>
    <a href="index.php">Back to Brands</a>

    <h1><?php echo htmlspecialchars($brand['brand_name'] ?? 'Brand'); ?></h1>

    <h2>Add Guitar</h2>

    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="brand_id" value="<?php echo (int)$brand_id; ?>">

        <p>
            <label for="guitarName">Guitar Name</label>
            <input type="text" name="guitarName" id="guitarName" required>
        </p>

        <p>
            <label for="technologiesUsed">Technologies Used</label>
            <input type="text" name="technologiesUsed" id="technologiesUsed">
        </p>

        <p>
            <input type="submit" name="insertGuitarBtn" value="Add Guitar">
        </p>
    </form>

    <hr>

    <h2>Guitars</h2>

    <?php foreach ($guitars as $guitar) { ?>
        <div style="border:1px solid #ccc; padding:15px; margin:10px 0;">
            <h3><?php echo htmlspecialchars($guitar['guitar_name']); ?></h3>
            <p>Technologies: <?php echo htmlspecialchars($guitar['technologies_used']); ?></p>
            <p>Added By: <?php echo htmlspecialchars($guitar['added_by_name'] ?? 'unknown'); ?></p>
            <p>Updated By: <?php echo htmlspecialchars($guitar['updated_by_name'] ?? 'unknown'); ?></p>

            <a href="editguitars.php?guitar_id=<?php echo $guitar['guitar_id']; ?>&brand_id=<?php echo $brand_id; ?>">Edit</a> |
            <a href="deleteguitars.php?guitar_id=<?php echo $guitar['guitar_id']; ?>&brand_id=<?php echo $brand_id; ?>">Delete</a>
        </div>
    <?php } ?>
</body>
</html>