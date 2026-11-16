<?php
require_once 'core/auth.php';
requireLogin();

require_once 'core/dbConfig.php';
require_once 'core/models.php';

$brand_id = (int)($_GET['brand_id'] ?? 0);
$brand = getBrandByID($pdo, $brand_id);

$search = trim($_GET['search'] ?? '');
$guitars = $search === ''
    ? getGuitarsByBrand($pdo, $brand_id)
    : searchGuitarsByBrand($pdo, $brand_id, $search);
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

    <h2>Search Guitars</h2>
<form method="GET" action="viewprojects.php">
    <input type="hidden" name="brand_id" value="<?php echo $brand_id; ?>">
    <label for="search">Guitar name or technology</label>
    <input
        type="search"
        name="search"
        id="search"
        value="<?php echo htmlspecialchars($search); ?>"
    >
    <button type="submit">Search</button>
    <?php if ($search !== '') { ?>
        <a href="viewprojects.php?brand_id=<?php echo $brand_id; ?>">Clear</a>
    <?php } ?>
</form>

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

    <?php if (empty($guitars)) : ?>
        <p>No matching guitar found.</p>
    <?php else : ?>
        <?php foreach ($guitars as $guitar) { ?>
            <div style="border:1px solid #ccc; padding:15px; margin:10px 0;">
                <h3><?php echo htmlspecialchars($guitar['guitar_name']); ?></h3>
                <p><strong>Date Added:</strong> <?php echo htmlspecialchars($guitar['date_added'] ?? 'Not recorded'); ?></p>
                <p><strong>Last Updated:</strong> <?php echo htmlspecialchars($guitar['last_updated'] ?? 'Not recorded'); ?></p>
                <p><strong>Updated By (user ID):</strong> <?php echo htmlspecialchars((string)($guitar['updated_by'] ?? '')); ?></p>

                <a href="editguitars.php?guitar_id=<?php echo (int)$guitar['guitar_id']; ?>&amp;brand_id=<?php echo $brand_id; ?>">Edit</a> |
                <a href="deleteguitars.php?guitar_id=<?php echo (int)$guitar['guitar_id']; ?>&amp;brand_id=<?php echo $brand_id; ?>">Delete</a>
            </div>
        <?php } ?>
    <?php endif; ?>
</body>
</html>
