<?php

class Category {
    private string $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public static function fetchCategories($sqli) {
        $sql = $sqli->prepare("SELECT * FROM categories");
        $sql->execute();
        $results = $sql->get_result();

        if ($results->num_rows > 0) {
            $categories = $results->fetch_all(MYSQLI_ASSOC);

            return $categories;
        } else {
            return [];
        }
    }
}