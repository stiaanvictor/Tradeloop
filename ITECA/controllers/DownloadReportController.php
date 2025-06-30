<?php

require_once "models/User.php";
require_once "models/Product.php";

class DownloadReportController {
    public function downloadUsersReport() {
        global $mysqli;

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users_report.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $users = User::fetchAllUsersReport($mysqli);

        $output = fopen('php://output', 'w');

        fputcsv($output, ['Name', 'Email', 'Province', 'Number of listings'], ';');

        foreach ($users as $user) {
            fputcsv($output, [$user['name'], $user['email'], $user['province'], $user['product_count']], ';');
        }

        fclose($output);
        exit;
    }

    public function downloadProvincesReport() {
        global $mysqli;

        $sql = $mysqli->prepare("SELECT 
                                    users.province,
                                    COUNT(DISTINCT users.id) AS user_count,
                                    COUNT(products.id) AS product_count
                                FROM users
                                LEFT JOIN products ON users.id = products.user_id
                                GROUP BY users.province
                                ORDER BY user_count DESC;
                                ");
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $provinces = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $provinces = [];
        }

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="provinces_report.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['Province', 'Total Users', 'Total Products'], ';');

        foreach ($provinces as $province) {
            fputcsv($output, [$province['province'], $province['user_count'], $province['product_count']], ';');
        }

        fclose($output);
        exit;
    }

    public function downloadProductsReport() {
        global $mysqli;

        $products = Product::fetchAllProducts($mysqli);

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="products_report.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        fputcsv($output, ['ID', 'Title', 'Price', 'Item Condition', 'Date Listed'], ';');

        foreach ($products as $product) {
            fputcsv($output, [$product['id'], $product['title'], $product['price'], $product['item_condition'], $product['listed_at']], ';');
        }

        fclose($output);
        exit;
    }
}