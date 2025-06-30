<?php
$mysqli = new mysqli('localhost', 'root', '', 'tradeloop');

if ($mysqli->connect_errno) {
    die("Connection failed: " . $mysqli->connect_error);
}