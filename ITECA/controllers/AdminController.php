<?php

require_once "models/User.php";
require_once "models/Product.php";
require_once "db.php";

class AdminController {
    public function showLoginForm() {

        if (isset($_POST['username']) && isset($_POST['password'])) {
            if ($_POST['username'] === 'admin' && $_POST['password'] === 'admin123') {
                $_SESSION['admin'] = 'logged in';
                $this->showAdminPanel();
                return;
            } else {
                include "views/admin_login_view.php";
                echo "<p style='color: red;'>Invalid username or password</p>";
                return;
            }          
        }

        include "views/admin_login_view.php";       
    }

    public function showAdminPanel() {
        global $mysqli;
        $users = User::fetchAllUsers($mysqli);
        $products = Product::fetchAllProducts($mysqli);

        $provinces = [
        "Gauteng", "Western Cape", "KwaZulu-Natal", "Eastern Cape",
        "Free State", "Limpopo", "Mpumalanga", "North West", "Northern Cape"
        ];

        include "views/admin_view.php";
    }
}