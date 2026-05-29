<?php
  session_start();
  require_once "components/loggedIn.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Create a new post on Nexora Blog">
  <meta name="author" content="Nexora Academy">
  <title>New post - Nexora Blog</title>

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

      <!-- Newpost content  -->
      <div class="col-lg-12 newpost">

        <!-- Title -->
        <h1>New post</h1>

        <!-- Newpost form -->
        <form action="actions/newPostActions.php" method="POST" class="newpost-form">
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" class="form-control">
          </div>

          <div class="form-group">
            <label for="content">Content</label>
            <textarea rows="5" id="content" name="content" class="form-control"></textarea>
          </div>

          <?php if (!empty($_SESSION['error'])): ?>
            <p id="error"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
          <?php endif; ?>

          <button type="submit" class="btn btn-primary">Post</button>
        </form>
        <!-- /form -->
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