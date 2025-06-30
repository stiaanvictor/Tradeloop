<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/home.css">
</head>
<body>
    <?php include "includes/nav.php"; ?>

    <div class="search-container">
        <h1>Browse</h1>
        <h2>Select Category</h2>
        <form action="" method="get">
            <select name="category">
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] === $selectedCategory['id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Search">
        </form>
    </div>
    <hr>
    <h2 style="text-align: center;">Showing results for: <b><?php echo $selectedCategory['name'] ?></b></h2>

    <!-- Display Products -->
    <div class="products-container">
        <?php foreach($products as $product): ?>
            <div class="product-container">
                <img src="<?php echo $product['image_url'] ?>" alt="" class="product-img">
                <span class="product-title"><?php echo $product['title'] ?></span>
                <span class="product-price">R<?php echo $product['price'] ?></span>
                <span class="product-location">Location: <?php echo User::fetchUserById($mysqli, $product['user_id'])['province'] ?></span>
                <a href="product?product_id=<?php echo $product['id'] ?>" class="view-product-link">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>

    

</body>
</html>