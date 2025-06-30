<?php
session_start();

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$rootFolder = "/iteca/";

require "controllers/AuthenticationController.php";
require "controllers/HomeController.php";
require "controllers/ViewProductController.php";
require "controllers/ManageListingsController.php";
require "controllers/ListProductController.php";
require "controllers/AdminController.php";
require "controllers/DownloadReportController.php";

$authenticationController = new AuthenticationController();
$homeController = new HomeController();
$viewProductController = new ViewProductController();
$manageListingsController = new ManageListingsController();
$listProductController = new ListProductController();
$adminController = new AdminController();
$downloadReportController = new DownloadReportController();

switch ($uri) {
    case $rootFolder:
        if (empty($_SESSION['user_id'])) {
            header("Location: {$rootFolder}login-signup");
        } else {
            $homeController->showItems();
        }
        break;
    case $rootFolder . 'login-signup':
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            $authenticationController->signout();
        }

        if (empty($_SESSION['user_id'])) {
            if (isset($_GET['action']) && $_GET['action'] == 'login') {
                $authenticationController->login();
            } elseif (isset($_GET['action']) && $_GET['action'] == 'signup') {
                $authenticationController->signup();
            } else {
                $authenticationController->showForm();
            }
        } else {
            header("Location: {$rootFolder}");
        }

        break;
    case $rootFolder . "product":
        if (empty($_SESSION['user_id'])) {
            header("Location: {$rootFolder}login-signup");
        }

        $viewProductController->showProduct();

        break;
    case $rootFolder . "manage-listings":
        if (empty($_SESSION['user_id'])) {
            header("Location: {$rootFolder}login-signup");
        }

        if (isset($_GET['action']) && $_GET['action'] = "delete") {
            $manageListingsController->deleteProduct();
        } else {
            $manageListingsController->showListings();
        }

        break;
    case $rootFolder . "list-product":
        if (empty($_SESSION['user_id'])) {
            header("Location: {$rootFolder}login-signup");
        }

        if (isset($_GET['action']) && $_GET['action'] == 'list-product') {
            $listProductController->listNewProduct();
        } else {
            $listProductController->showProductForm();
        }
        break;
    
    case $rootFolder . "admin":
        if (!empty($_SESSION['admin']) && $_SESSION['admin'] == "logged in") {
            $adminController->showAdminPanel();
        } else {
            $adminController->showLoginForm();
        }

        break;
    
    case $rootFolder . "download-report":
        if (empty($_SESSION['admin']) || $_SESSION['admin'] != 'logged in') {
            $adminController->showLoginForm();
            return;
        }

        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'user-report') {
                $downloadReportController->downloadUsersReport();
            } elseif ($_GET['action'] == 'provinces-report') {
                $downloadReportController->downloadProvincesReport();
            } elseif ($_GET['action'] == 'products-report') {
                $downloadReportController->downloadProductsReport();
            } else {
                echo "404 Not Found";
            }
        } else {
            echo "404 Not Found";
        }

        break;
    default:
        echo "404 NOT FOUND";
        break;
}
