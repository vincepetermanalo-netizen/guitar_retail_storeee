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
    <title>Edit Brand</title>
</head>
<body>
    <a href="index.php">Back to Brands</a>

    <h1>Edit Brand</h1>

    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="brand_id" value="<?php echo htmlspecialchars($brand_id); ?>">

        <p>
            <label for="brandName">Brand Name</label>
            <input type="text" name="brandName" id="brandName"
                   value="<?php echo htmlspecialchars($brand['brand_name'] ?? ''); ?>" required>
        </p>

        <p>
            <label for="countryOfOrigin">Country of Origin</label>
            <input type="text" name="countryOfOrigin" id="countryOfOrigin"
                   value="<?php echo htmlspecialchars($brand['country_of_origin'] ?? ''); ?>">
        </p>

        <p>
            <label for="founder">Founder</label>
            <input type="text" name="founder" id="founder"
                   value="<?php echo htmlspecialchars($brand['founder'] ?? ''); ?>">
        </p>

        <p>
            <label for="establishedYear">Established Year</label>
            <input type="number" name="establishedYear" id="establishedYear"
                   value="<?php echo htmlspecialchars($brand['established_year'] ?? ''); ?>">
        </p>

        <input type="submit" name="editBrandBtn" value="Update Brand">
    </form>
</body>
</html>