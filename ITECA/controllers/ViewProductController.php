<?php

require_once "models/Product.php";
require_once "models/User.php";
require_once "db.php";

class ViewProductController {
    public function showProduct() {
        global $mysqli;

        if (!empty($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
        } else {
            echo "Product doesn't exist";
            return;
        }

        if (Product::fetchProductById($mysqli, $product_id) == false) {
            echo "Product doesn't exist";
            return;
        } else {
            $product = Product::fetchProductById($mysqli, $product_id);
        }

        include "views/product_view.php";
    }
}