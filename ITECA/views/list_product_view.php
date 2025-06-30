<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List New Product</title>
    <link rel="stylesheet" href="assets/css/list_product.css">
</head>
<body>
    <?php include "includes/nav.php"; ?>

    <h1>List New Product</h1><br>

    <form id="productForm" action="?action=list-product" method="post" autocomplete="off">
        <label>Title:</label><br>
        <input type="text" name="product_title" id="product_title"><br><br>

        <label>Description:</label><br>
        <textarea name="product_description" rows="4" cols="50" id="product_description"></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" name="product_price" step="0.01" id="price"><br><br>

        <label>Image URL:</label><br>
        <input type="text" name="product_image_url" id="product_image_url"><br><br>

        <label>Product category:</label><br>
        <select name="category_id">
            <?php foreach($categories as $category): ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label>Condition:</label><br>
        <select name="product_condition">
            <option value="new">New</option>
            <option value="used">Used</option>
        </select>
        <br><br>

        <input type="submit" value="Add new product">
    </form>

    <script>
    function limitDecimal(el) {
        const val = el.value;
        if (val.includes('.')) {
            const [intPart, decPart] = val.split('.');
            if (decPart.length > 2) {
            el.value = parseFloat(val).toFixed(2);
            }
        }
    }

    document.getElementById("productForm").addEventListener("submit", function(e) {
        const title = document.getElementById("product_title").value.trim();
        const desc = document.getElementById("product_description").value.trim();
        const price = document.getElementById("price").value.trim();
        const image = document.getElementById("product_image_url").value.trim();

        if (!title || !desc || !price || !image) {
            alert("All fields are required: Title, Description, Price, and Image URL.");
            e.preventDefault();
        }
    });
    </script>
</body>
</html>