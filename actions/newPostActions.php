<?php
require_once "../components/connection.php";
session_start();


$subject =  trim($_POST['subject']);
$content = trim($_POST['content']);

if(empty($subject) || empty($content)){
    $_SESSION['error'] = "Please fill the empty data!";
    header("Location: ../newpost.php");
    die();
}

try {
        $sql = "INSERT INTO posts
         SET 
         subject = :subject, content = :content, user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':subject',$subject);
        $stmt->bindParam(':content',$content);
        $stmt->bindParam(':user_id',$_SESSION['id']);
        $stmt->execute();
    } catch (PDOException $exception) {
        echo "Connection to database failed! Error: " . $exception->getMessage();
        die();
    }

    header("Location: ../newpost.php");