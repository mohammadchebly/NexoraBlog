<?php
require_once "../components/connection.php";
session_start();

$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];

if(empty($oldPassword) || empty($newPassword)){
    die("empty data");
}

try {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id',$_SESSION['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}

if(!password_verify($oldPassword, $user['password'])){
    $_SESSION['error'] = "Wrong Password";
    header("Location: ../changePassword.php");
    die();
}else{
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    try {
    $sql = "UPDATE users SET password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':password',$hashedPassword);
    $stmt->bindParam(':id',$_SESSION['id']);
    $stmt->execute();
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
}

}

header("Location: ../author.php?id=" . $_SESSION['id']);