<?php

class Product {
    public static function fetchProductById($sqli, $id) {
        $sql = $sqli->prepare("SELECT * FROM products WHERE id = '$id'");
        $sql->execute();
        $results = $sql->get_result();

        if ($results->num_rows > 0) {
            $product = $results->fetch_assoc();

            return $product;
        } else {
            return false;
        }
    }

    public static function fetchAllProducts($sqli) {
        $sql = $sqli->prepare("SELECT * FROM products");
        $sql->execute();
        $results = $sql->get_result();

        if ($results->num_rows > 0) {
            $products = $results->fetch_all(MYSQLI_ASSOC);

            return $products;
        } else {
            return [];
        }
    }

    public static function fetchProductsByCategory($sqli, $category_id) {
        $sql = $sqli->prepare("SELECT * FROM products WHERE category_id = '$category_id'");
        $sql->execute();
        $results = $sql->get_result();

        if ($results->num_rows > 0) {
            $products = $results->fetch_all(MYSQLI_ASSOC);

            return $products;
        } else {
            return [];
        }
    }

    public static function fetchProductsByUserId($sqli, $user_id) {
        $sql = $sqli->prepare("SELECT * FROM products WHERE user_id = '$user_id'");
        $sql->execute();
        $results = $sql->get_result();

        if ($results->num_rows > 0) {
            $products = $results->fetch_all(MYSQLI_ASSOC);

            return $products;
        } else {
            return [];
        }
    }

    public static function deleteProductById($sqli, $product_id) {
        $sql = $sqli->prepare("DELETE FROM products WHERE id = $product_id");
        $sql->execute();
    }

    public static function deleteProductByUserId($sqli, $userId) {
        $sql = $sqli->prepare("DELETE FROM products WHERE user_id = $userId");
        $sql->execute();
    }

    public static function save($sqli, $title, $description, $price, $image_url, $category_id, $item_condition) {
        $sql = $sqli->prepare("INSERT INTO products (user_id, title, description, price, image_url, category_id, item_condition) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param('issdsis', $_SESSION['user_id'], $title, $description, $price, $image_url, $category_id, $item_condition);
        $sql->execute();
    }

}