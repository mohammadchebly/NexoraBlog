<?php
require_once "../components/connection.php";
session_start();

$email = trim($_POST['email']) ;
$phone = trim($_POST['phone']) ;
$username = trim($_POST['username']) ;

try {
    $sql = "UPDATE users SET email = :email, phone = :phone, username = :username WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':phone',$phone);
    $stmt->bindParam(':username',$username);
    $stmt->bindParam(':id',$_SESSION['id']);
    $stmt->execute();
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
}

header("Location: ../author.php?id=" . $_SESSION['id']);