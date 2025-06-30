<?php

require_once "models/User.php";
require_once "db.php";

class AuthenticationController {
    function showForm() {
        include('views/login_signup_view.php');
    }

    function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        global $mysqli;
        $sql = $mysqli->prepare("SELECT * FROM users WHERE email = '$email'");
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password_hash'])) {
                $_SESSION['user_id'] = User::fetchId($mysqli, $email);
                header("Location: /iteca/");
            } else {
                $error = "Invalid password";
                include('views/login_signup_view.php');
                return;
            }
            
        } else {
            $error = "Invalid email";
            include('views/login_signup_view.php');
            return;
        }
        
    }

    function signup() {
        $username = $_POST['username'];
        $email = strtolower($_POST['email']);
        $password = $_POST['password'];
        $province = $_POST['province'];

        $user = new User($username, $email, $password, $province);
        global $mysqli;

        $error = ""; 

        if (strlen($username) < 3) {
            $error = "Name must be at least 3 characters long";
            include('views/login_signup_view.php');
            return;
        }

        if (strlen($password) < 8) {
            $error = "Password must be at least 8 characters long";
            include('views/login_signup_view.php');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Enter a valid email";
            include('views/login_signup_view.php');
            return;
        }

        // Check if username or email is taken
        $sql = $mysqli->prepare("SELECT * FROM users WHERE name = '$username'");
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $error = "Username is taken";
            include('views/login_signup_view.php');
            return;
        }

        $sql = $mysqli->prepare("SELECT * FROM users WHERE email = '$email'");
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $error = "Email is already in use";
            include('views/login_signup_view.php');
            return;
        }

        $user->save($mysqli);
        $_SESSION['user_id'] = User::fetchId($mysqli, $email);
        header("Location: /iteca/");
    }

    function signout() {
        unset($_SESSION['user_id']);
    }
}