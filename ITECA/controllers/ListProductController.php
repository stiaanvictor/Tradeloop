<?php

require_once "models/Category.php";
require_once "models/Product.php";
require_once "models/User.php";
require_once "db.php";

class ListProductController {
    function showProductForm() {
        global $mysqli;

        $categories = Category::fetchCategories($mysqli);

        include "views/list_product_view.php";
    }

    function listNewProduct() {
        global $mysqli;

        if (empty($_POST['product_title']) && empty($_POST['product_description']) && empty($_POST['product_price']) && empty($_POST['product_image_url']) && empty($_POST['category_id']) && empty($_POST['product_condition'])) {
            echo "Not all fields are filled in";
            return;
        }

        $title = $_POST['product_title'];
        $description = $_POST['product_description'];
        $price = $_POST['product_price'];
        $image_url = $_POST['product_image_url'];
        $category_id = $_POST['category_id'];
        $item_condition = $_POST['product_condition'];

        Product::save($mysqli, $title, $description, $price, $image_url, $category_id, $item_condition);

        echo "<h1>Product added!</h1>";
        echo "<a href='/iteca/'>Return Home</a>";
    }
}