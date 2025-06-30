<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="../assets/css/payment.css">
</head>
<body>

<?php
    require_once('../models/Product.php');
    require_once('../db.php');

    global $mysqli;

    $item = Product::fetchProductById($mysqli, $_GET['id'])['title'];
    $total = Product::fetchProductById($mysqli, $_GET['id'])['price'] * $_GET['quantity'];
?>

<div class="payment-container">
    <h2>Card Payment</h2>

    <p><strong>Item:</strong> <?php echo $item; ?></p>
    <p><strong>Total:</strong> R<?php echo $total; ?></p>

    <form action="paymentsuccess.php" method="post">
        <input type="hidden" name="item" value="<?php echo $item; ?>">
        <input type="hidden" name="total" value="<?php echo $total; ?>">

        <label for="card-name">Cardholder Name</label>
        <input type="text" id="card-name" name="card_name" required>

        <label for="card-number">Card Number</label>
        <input type="text" id="card-number" name="card_number" maxlength="19" required>

        <label for="expiry">Expiry Date (MM/YY)</label>
        <input type="text" id="expiry" name="expiry" maxlength="5" required>

        <label for="cvv">CVV</label>
        <input type="number" id="cvv" name="cvv" maxlength="4" required>

        <input type="submit" value="Pay">
    </form>
</div>

</body>
</html>
