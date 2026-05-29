<?php
require_once "../components/connection.php";
session_start();

$email = trim($_POST['email']) ;
$password = trim($_POST['password']) ;


if(empty($email) || empty($password)){
    die("empty data");
}

try {
    $sql = "SELECT * FROM users WHERE email = :email OR phone = :phone";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':phone',$email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}

if(!$user){
     $_SESSION['error'] = "Account is not exist!";
    header("Location: ../login.php");
    die();
}else{
    if(password_verify($password, $user['password'])){
         $_SESSION['id'] = $user['id'];
        $_SESSION['loggedIn'] = true;

        header("Location: ../index.php");
    }else{
        $_SESSION['error'] = "Wrong Password!";
        header("Location: ../login.php");
        die();
    }
}