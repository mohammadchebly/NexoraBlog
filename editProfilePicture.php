<?php
  require_once "components/connection.php";
  session_start();

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


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for Nexora Academy's programming courses">
  <meta name="author" content="Nexora Academy">

  <title>Edit Profile</title>

  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="css/simple-blog-template.css" rel="stylesheet">
    <style>
        #error{
            color: red;
            font-size: 17px;
        }
    </style>
</head>

<body>

  <!-- Navigation -->
  <?php
    include_once "components/navbar.php";
  ?>


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-2"></div>

      <!-- Signup content  -->
      <div class="col-lg-8 signup">

        <!-- Title -->
        <h1>Edit Profile Picture</h1>

        <!-- Login form -->
        <form action="actions/editProfilePictureActions.php" method="POST" class="signup-form" enctype="multipart/form-data">
          <div class="form-group">
            <label for="username">Edit Profile Picture</label>
            <input type="file" id="email" name="profile" class="form-control" required value="<?= $user['email'] ?>"> 
          </div>
           

           <?php if(isset($_SESSION['error'])): ?>
                <p id="error"><?= $_SESSION['error'] ?></p>
                <?= $_SESSION['error'] = "" ?>
            <?php endif; ?>

          <button type="submit" class="btn btn-primary">Edit Profile Picture</button>
        </form>
        <!-- /form -->
      </div>

      <div class="col-lg-2"></div>

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