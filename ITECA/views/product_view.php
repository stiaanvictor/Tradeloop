<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['title'] ?></title>
    <link rel="stylesheet" href="assets/css/product.css">
</head>
<body>
    <?php include "includes/nav.php"; ?>

    <div class="product-container">
        <h1 class="title"><?php echo $product['title'] ?></h1>
        <img src="<?php echo $product['image_url'] ?>" alt="" class="product-img">
        <p class="price">Price: R<?php echo $product['price'] ?></p>
        <p class="condition">Item Condition: <b><?php echo $product['item_condition'] ?></b> <br> Location: <b><?php echo User::fetchUserById($mysqli, $product['user_id'])['province'] ?></b></p>
        <p class="description-title">Description:</p>
        <p class="description"><?php echo $product['description'] ?></p>
        <p class="user-and-time">Listed by <?php echo User::fetchUserById($mysqli, $product['user_id'])['name']?> at <?php echo $product['listed_at'] ?></p>
    </div>

    
    <div class="order-container">
        <form action="controllers/payment.php" method="get" class="order-form">
            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
            <h3 class="form-heading">Order online:</h3>
            
            <label class="quantity-label">Quantity:</label>
            <input type="number" name="quantity" class="quantity-select quantity-input" value="1" onchange="updatePrice()" id="quantity-input">
            
            <br>
            <h4 class="total-display">Total: R<span id="total-amount" class="total-amount"></span></h4>
            
            <input type="submit" value="Order" class="submit-button">
        </form>
    </div>

    <script>
        let totalAmount = document.getElementById('total-amount');
        totalAmount.innerHTML = <?php echo $product['price'] ?>;

        function updatePrice() {
            totalAmount.innerHTML = Math.round(<?php echo $product['price'] ?> * document.getElementById('quantity-input').value * 100) / 100;
        }
    </script>
</body>
</html>