<?php
require_once "../components/connection.php";
session_start();
$content = $_POST['content'];
$parent_id = $_POST['parent_id'];




try {
        $sql = "INSERT INTO comments
         SET 
         content = :content, user_id = :user_id, post_id = :post_id, parent_id = :parent_id ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':content',$content);
        $stmt->bindParam(':user_id',$_SESSION['id']);
        $stmt->bindParam(':post_id',$_GET['id']);
        $stmt->bindParam(':parent_id',$parent_id);
        $stmt->execute();
    } catch (PDOException $exception) {
        echo "Connection to database failed! Error: " . $exception->getMessage();
        die();
    }

    header("Location: ../post.php?id=" . $_GET['id']);