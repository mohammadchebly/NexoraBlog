<?php
  session_start();
  require_once "components/loggedIn.php";
  require_once "components/connection.php";

  if(!$_GET['id']){
    header("Location: index.php");
    die();
  }

  try {
    $sql = "SELECT posts.id as post_id,
     users.id as user_id,
      posts.subject,
       posts.content,
        users.username,
        posts.date_created
            FROM posts
                INNER JOIN users
                 ON
                  posts.user_id = users.id
                  WHERE posts.id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id',$_GET['id']);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}

if(!$post){
  header("Location: index.php");
  die();
}

 try {
    $sql = "SELECT 
    comments.id as comment_id,
    comments.content,
    comments.user_id,
    comments.post_id,
    comments.parent_id,
    comments.date_created,
    users.profile,
    users.username
     FROM comments
      INNER JOIN
       users ON comments.user_id = users.id 
        WHERE 
        comments.post_id = :post_id AND comments.parent_id is NULL";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':post_id',$_GET['id']);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

  <title>Post - Nexora Blog</title>

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

      <!-- Blog Post Content Column -->
      <div class="col-lg-12">

        <!-- Blog Post -->

        <!-- Title -->
        <h1 class="post-title"><?= $post['subject'] ?></h1>

        <!-- Author -->
        <a href="author.php?id=<?= $post['user_id'] ?>" class="lead">
          by <?= $post['username'] ?>
        </a>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?= $post['date_created'] ?></p>

        <hr>

        <!-- Post Content -->
        <p><?= $post['content'] ?></p>

        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->
        <div class="well">
          <h4>Leave a Comment:</h4>
          <form role="form" action="actions/commentActions.php?id=<?= $_GET['id'] ?>" method="POST">
            <div class="form-group">
              <textarea class="form-control" rows="3" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

        <hr>

        <!-- Posted Comments -->

        <?php foreach($comments as $comment):?>

        <!-- Comment -->
        <div class="media">
          <a class="pull-left" href="#">
            <img class="media-object" src="imgs/<?= $comment['profile']?>" width="64px" height="64px" alt="">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><?= $comment['username'] ?>
              <small><?= $comment['date_created'] ?></small>
            </h4>
            <?= $comment['content'] ?>

            <form action="actions/commentActions.php?id=<?= $_GET['id'] ?>" method="POST">
              <input class="form-control" type="text" name="content" placeholder="Write your reply">
              <input type="text" name="parent_id" value="<?= $comment['comment_id'] ?>" hidden>
              <input class="btn btn-default" type="submit" value="Reply">
            </form>

            <?php
                try {
                  $sql = "SELECT 
                  comments.id as comment_id,
                  comments.content,
                  comments.user_id,
                  comments.post_id,
                  comments.parent_id,
                  comments.date_created,
                  users.username,
                  users.profile
                  FROM comments
                    INNER JOIN
                    users ON comments.user_id = users.id 
                      WHERE 
                      comments.parent_id = :parent_id";
                  $stmt = $pdo->prepare($sql);
                  $stmt->bindParam(':parent_id',$comment['comment_id']);
                  $stmt->execute();
                  $replies = $stmt->fetchAll(PDO::FETCH_ASSOC);
              } catch (PDOException $exception) {
                  echo "Connection to database failed! Error: " . $exception->getMessage();
                  die();
            }

           
            ?>

          <?php foreach($replies as $reply):?>
          
            <!-- Nested Comment -->
            <div class="media">
              <a class="pull-left" href="#">
                <img class="media-object" src="imgs/<?= $reply['profile']?>" width="64px" height="64px" alt="">
              </a>
              <div class="media-body">
                <h4 class="media-heading"><?= $reply['username'] ?>
                  <small><?= $reply['date_created'] ?></small>
                </h4>
                <?= $reply['content'] ?>
              </div>
            </div>
            <!-- End Nested Comment -->
              <?php endforeach; ?>
          </div>
        </div>

        <?php endforeach; ?>
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