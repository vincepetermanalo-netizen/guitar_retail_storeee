<?php
require_once 'core/auth.php';
requireLogin();

require_once 'core/dbConfig.php';
require_once 'core/models.php';

$deletedGuitars = getDeletedGuitars($pdo);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport", content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
</head>
<body>
    <h1> Recycle Bin</h1>

    <p>
        <a href="index.php">Back to Brands</a>
    </p>

    <?php if (!empty($_SESSION['message'])) {
        echo '<p>' . htmlspecialchars($_SESSION['message']) . '</p>';
        unset($_SESSION['message']);
    } ?>

    <?php if (empty($deletedGuitars)) : ?>
        <p>No deleted guitars.</p>
    <?php else : ?>
        <?php foreach ($deletedGuitars as $guitar) : ?>
            <div style="border:1px solid #ccc; padding:15px; margin:10px 0;">
                <h3><?php echo htmlspecialchars($guitar['guitar_name']); ?></h3>
                <p><strong>Brand:</strong> <?php echo htmlspecialchars($guitar['brand_name']); ?></p>
                <p><strong>Deleted By:</strong>
                    <?php echo htmlspecialchars($guitar['deleted_by_name'] ?? 'Unknown user'); ?>
                </p>
                <p><strong>Deleted At:</strong>
                    <?php echo htmlspecialchars($guitar['deleted_at'] ?? 'Unknown time'); ?>
                </p>

                <form action="core/handleForms.php" method="POST">
                    <input type="hidden" name="guitar_id"
                           value="<?php echo (int)$guitar['guitar_id']; ?>">
                    <input type="hidden" name="brand_id"
                           value="<?php echo (int)$guitar['brand_id']; ?>">
                    <button type="submit" name="restoreGuitarBtn">
                        Restore
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>