<?php
require_once 'core/auth.php';
requireLogin();

require_once 'core/dbConfig.php';
require_once 'core/models.php';

$brands = getAllBrands($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Management</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
    <a href="logout.php">Logout</a>

    <h2>Add Brand</h2>

    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="brandName">Brand Name</label>
            <input type="text" name="brandName" id="brandName" required>
        </p>

        <p>
            <label for="countryOfOrigin">Country of Origin</label>
            <input type="text" name="countryOfOrigin" id="countryOfOrigin">
        </p>

        <p>
            <label for="founder">Founder</label>
            <input type="text" name="founder" id="founder">
        </p>

        <p>
            <label for="establishedYear">Established Year</label>
            <input type="number" name="establishedYear" id="establishedYear">
        </p>

        <p>
            <input type="submit" name="insertBrandBtn" value="Add Brand">
        </p>
    </form>

    <hr>

    <h2>Brands</h2>

    <?php foreach ($brands as $brand) { ?>
        <div style="border:1px solid #ccc; padding:15px; margin:10px 0;">
            <h3><?php echo htmlspecialchars($brand['brand_name']); ?></h3>
            <p>Country: <?php echo htmlspecialchars($brand['country_of_origin']); ?></p>
            <p>Founder: <?php echo htmlspecialchars($brand['founder']); ?></p>
            <p>Established Year: <?php echo htmlspecialchars($brand['established_year']); ?></p>
            <p>Added By: <?php echo htmlspecialchars($brand['added_by_name'] ?? 'unknown'); ?></p>
            <p>Updated By: <?php echo htmlspecialchars($brand['updated_by_name'] ?? 'unknown'); ?></p>

            <a href="viewprojects.php?brand_id=<?php echo $brand['brand_id']; ?>">View Guitars</a> |
            <a href="editbrands.php?brand_id=<?php echo $brand['brand_id']; ?>">Edit</a> |
            <a href="deletebrands.php?brand_id=<?php echo $brand['brand_id']; ?>">Delete</a>
        </div>
    <?php } ?>
</body>
</html>