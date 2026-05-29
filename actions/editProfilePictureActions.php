<?php
require_once "../components/connection.php";
session_start();

if(empty($_FILES['profile']['name'])){
    die("empty data");
}

$fileType = strtolower(pathinfo($_FILES['profile']['name'],PATHINFO_EXTENSION));

if($fileType != 'png' && $fileType != 'jpg' && $fileType != 'jpeg'){
    $_SESSION['error'] = "wrong format";
    header("Location: ../editProfilePicture.php");
    die();
}

if(!getimagesize($_FILES['profile']['tmp_name'])){
    die('not a real image');
};

if($_FILES['profile']['size'] > 5000000){
    $_SESSION['error'] = "image is too large";
    header("Location: ../editProfilePicture.php");
    die();
}

$imgName = "IMG_" . bin2hex(random_bytes(10)) . "." . $fileType ;

move_uploaded_file($_FILES['profile']['tmp_name'],"../imgs/" . $imgName);

try {
    $sql = "UPDATE users SET profile = :profile WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':profile',$imgName);
    $stmt->bindParam(':id',$_SESSION['id']);
    $stmt->execute();
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
}

header("Location: ../author.php?id=" . $_SESSION['id']);