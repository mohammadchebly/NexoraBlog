<?php
  session_start();
  require_once "components/!loggedIn.php";
  
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="This is demo page made for Nexora Academy's programming courses">
  <meta name="author" content="Nexora Academy">

  <title>Login - Nexora Blog</title>

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

      <div class="col-lg-2"></div>

      <!-- Login content  -->
      <div class="col-lg-8 login">

        <!-- Title -->
        <h1>Login</h1>

        <!-- Login form -->
        <form action="actions/loginActions.php" method="POST" class="login-form">
          <div class="form-group">
            <label for="username">Email or Phone</label>
            <input type="text" id="email" name="email" class="form-control">
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control">
          </div>

          <?php
              if(isset($_SESSION['error'])){
                echo "<p id='error'>" . $_SESSION['error'] . "</p>";
                $_SESSION['error'] = "";
              }
          ?>

          <button type="submit" class="btn btn-primary">Log in</button>
          <p>Don't have an account? <a href="signup.php">Sign Up Now</a></p>
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