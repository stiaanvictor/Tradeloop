<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Listings</title>
    <link rel="stylesheet" href="assets/css/manage_products.css">
</head>
<body>
    <?php include "includes/nav.php"; ?>

    <h1>Hi, <?php echo $user['name'] ?></h1>
    <h2>Your Listings:</h2>
    <a href="list-product" class="new-item-btn">List new product</a>

    <?php if (count($products) > 0): ?>
        <?php foreach($products as $product): ?>

            <div class="product-container">
                <div>
                    <img src="<?php echo $product['image_url'] ?>" class="product-image">
                    <h3 class="product-title"><?php echo $product['title'] ?> | Price: R<?php echo $product['price'] ?></h3>
                </div>
                <div>
                    <a href="?action=delete&product_id=<?php echo $product['id'] ?>" class="delete-btn" onclick="return confirmDelete()">Delete</a>
                </div>
                
            </div>

        <?php endforeach; ?>
    <?php else: ?>
        <p style="margin-top: 20px;">No listings found</p>
    <?php endif; ?>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item?");
        }
    </script>
</body>
</html>