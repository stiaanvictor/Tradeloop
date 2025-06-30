<?php

require_once "models/Category.php";
require_once "models/Product.php";
require_once "models/User.php";
require_once "db.php";

class HomeController {
    function showItems() {
        global $mysqli;

        $categories = Category::fetchCategories($mysqli);
        $selectedCategory = "";

        if (!empty($_GET['category'])) {
            foreach ($categories as $category) {
                if ($category['id'] == $_GET['category']) {
                    $selectedCategory = $category;
                }
            }
        } else {
            $selectedCategory = $categories[0];
        }

        $products = Product::fetchProductsByCategory($mysqli, $selectedCategory['id']);

        include "views/home_view.php";
    }
}