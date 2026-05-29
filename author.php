<?php
  session_start();
  require_once "components/loggedIn.php";
  require_once "components/connection.php";

  if(!$_GET['id']){
    header("Location: index.php ");
    die();
  }

  try {
    $sql = "SELECT * FROM posts WHERE user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id',$_GET['id']);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}

  try {
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id',$_GET['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}


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

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for Nexora Academy's programming courses">
  <meta name="author" content="Nexora Academy">

  <title>Home - Nexora Blog</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">


</head>

<body>

  <!-- Navigation -->
  <?php
    include_once "components/navbar.php";
  ?>


  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <!-- Page Title -->
      <div class="col-md-12">
        <a class="pull-left" href="#">
          <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="profile-head">
          <img class="media-object" src="imgs/<?= $user['profile']?>" width="64px" height="64px" alt="">
          <h2>Posts by <?= $user['username'] ?> (<?= count($posts) ?> Posts)</h2>
          
        </div>
      </div>

      <?php
        if($_GET['id'] == $_SESSION['id']){
            echo "<a class='btn btn-default' href='editProfile.php'>Edit profile</a>";
            echo "<a class='btn btn-default' href='changePassword.php'>Change Password</a>";
            echo "<a class='btn btn-default' href='editProfilePicture.php'>Edit Profile Picture</a>";
        }else{
           if($follow){
              echo "<a class='btn btn-default' href='actions/followActions.php?id=" . $_GET['id'] ."'>Unfollow</a>";
           }else{
            echo "<a class='btn btn-default' href='actions/followActions.php?id=" . $_GET['id'] ."'>Follow</a>";
           }
        }
      ?>
      
      <br><br>

      <!-- Blog Entries Column -->
      <div class="col-md-12">

        <!-- First Blog Post -->
        <?php foreach($posts as $post): ?>

          <article class="post-card">
          <h2 class="post-title">
          <a href="post.php?id=<?= $post['id'] ?>"><?= $post['subject'] ?></a>
        </h2>
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post['date_created'] ?></p>
        <p><?= $post['content'] ?></p>
        <a class="btn btn-default" href="post.php?id=<?= $post['post_id'] ?? $post['id'] ?>">Read More</a>

        </article>

          <?php endforeach; ?>

        

       

        <!-- Pager -->
        <ul class="pager">
          <li class="previous">
            <a href="#">Prev</a>
          </li>
          <li class="next">
            <a href="#">Next</a>
          </li>
        </ul>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright &copy; Nexora Blog @2026</p>
        </div>
        <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
    </div>
  </footer>

  <!-- jQuery -->
  <script src="js/jquery.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="js/bootstrap.min.js"></script>




</body>

</html>