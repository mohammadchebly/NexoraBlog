<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}

