<?php
require_once "../components/connection.php";
session_start();

try {
        $sql = "SELECT * FROM follows WHERE follower_id = :follower_id AND following_id = :following_id ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':follower_id',$_SESSION['id']);
        $stmt->bindParam(':following_id',$_GET['id']);
        $stmt->execute();
        $follow = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            echo "Connection to database failed! Error: " . $exception->getMessage();
            die();
        }

        

if($follow){
    try {
        $sql = "DELETE FROM follows
         WHERE 
         follower_id = :follower_id AND following_id = :following_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':follower_id',$_SESSION['id']);
        $stmt->bindParam(':following_id',$_GET['id']);
        $stmt->execute();
    } catch (PDOException $exception) {
        echo "Connection to database failed! Error: " . $exception->getMessage();
        die();
    }
}else{
     try {
        $sql = "INSERT INTO follows
         SET 
         follower_id = :follower_id, following_id = :following_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':follower_id',$_SESSION['id']);
        $stmt->bindParam(':following_id',$_GET['id']);
        $stmt->execute();

        
    } catch (PDOException $exception) {
        echo "Connection to database failed! Error: " . $exception->getMessage();
        die();
    }
}





    header("Location: ../author.php?id=" . $_GET['id'] );