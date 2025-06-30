<?php

require_once('../models/User.php');
require_once('../db.php');

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$province = $_POST['province'];

global $mysqli;
User::updateUser($mysqli, $id, $name, $email, $province);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Updated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f4ea;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .success-container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .success-container h1 {
            color: #2d6a4f;
            margin-bottom: 20px;
        }

        .success-container a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: white;
            background-color: #2d6a4f;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .success-container a:hover {
            background-color: #1b4332;
        }
    </style>
</head>
<body>

<div class="success-container">
    <h1>User Updated Successfully</h1>
    <a href="/admin">Return to Admin</a>
</div>

</body>
</html>

