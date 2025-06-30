<?php

class User {
    private string $name;
    private string $email;
    private string $hashedPassword;
    private string $province;

    public function __construct($name, $email, $password, $province)
    {
        $this->name = $name;
        $this->email = $email;
        $this->hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->province = $province;
    }

    public static function fetchId($sqli, $email) {
        $sql = $sqli->prepare("SELECT id FROM users WHERE email = '$email'");
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();
        
        return $row["id"];
    }

    public static function fetchUserById($sqli, $id) {
        $sql = $sqli->prepare("SELECT * FROM users WHERE id = $id");
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return;
        }
    }

    public static function fetchAllUsers($sqli) {
        $sql = $sqli->prepare("SELECT * FROM users");
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_all(MYSQLI_ASSOC);
            return $user;
        } else {
            return;
        }
    }

    public static function fetchAllUsersReport($sqli) {
        $sql = $sqli->prepare("SELECT users.name, users.email, users.province, COUNT(products.user_id) AS product_count FROM users LEFT JOIN products ON users.id = products.user_id GROUP BY users.id, users.name, users.email, users.province");
        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            $users = $result->fetch_all(MYSQLI_ASSOC);
            return $users;
        } else {
            return [];
        }
    }

    public function save($sqli) {
        $sql = $sqli->prepare("INSERT INTO users (name, email, password_hash, province) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $this->name, $this->email, $this->hashedPassword, $this->province);
        $sql->execute();
    }

    public static function updateUser($sqli, $id, $name, $email, $province) {
        $stmt = $sqli->prepare("UPDATE users SET name = ?, email = ?, province = ? WHERE id = ?");
        if (!$stmt) {
            // Optional: handle error
            return false;
        }

        $stmt->bind_param("sssi", $name, $email, $province, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteUser($sqli, $id) {
        $stmt = $sqli->prepare("DELETE FROM users WHERE id = ?");
        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}