<?php

require_once "models/Category.php";
require_once "models/Product.php";
require_once "models/User.php";
require_once "db.php";

class ManageListingsController {
    function showListings() {
        global $mysqli;

        $user = User::fetchUserById($mysqli, $_SESSION['user_id']);
        $products = Product::fetchProductsByUserId($mysqli, $_SESSION['user_id']);

        include "views/manage_listings_view.php";
    }

    function deleteProduct() {
        global $mysqli;

        if ($_SESSION['user_id'] != Product::fetchProductById($mysqli, $_GET['product_id'])['user_id']) {
            echo "You don't have a product with that ID";
            return;
        }

        Product::deleteProductById($mysqli, $_GET['product_id']);

        header("Location: manage-listings");
    }

}