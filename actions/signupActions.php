<?php
require_once "../components/connection.php";
session_start();

$email = trim($_POST['email']) ;
$phone = trim($_POST['phone']) ;
$username = trim($_POST['username']) ;
$password = trim($_POST['password']) ;
$hashedPassword = password_hash($password,PASSWORD_BCRYPT);


if(empty($email) || empty($phone) || empty($username) || empty($password)){
    die("empty data");
}

try {
    $sql = "SELECT id FROM users WHERE email = :email OR phone = :phone";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email',$email);
    $stmt->bindParam(':phone',$phone);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}

if($user){
    $_SESSION['error'] = "Email or Phone Number already exist!";
    header("Location: ../signup.php");
    die();
}else{
        try {
        $sql = "INSERT INTO users
         SET 
         email = :email, phone = :phone, username = :username, password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':phone',$phone);
        $stmt->bindParam(':username',$username);
        $stmt->bindParam(':password',$hashedPassword);
        $stmt->execute();

        try {
        $sql = "SELECT * FROM users WHERE email = :email ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Connection to database failed! Error: " . $exception->getMessage();
            die();
        }

        $_SESSION['id'] = $user['id'];
        $_SESSION['loggedIn'] = true;

        header("Location: ../index.php");
    } catch (PDOException $exception) {
        echo "Connection to database failed! Error: " . $exception->getMessage();
        die();
    }

}

