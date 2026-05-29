<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <a class="navbar-brand" href="index.php">
        <img src="./imgs/nexora-mark.png" alt="">
        <span>Nexora Blog</span>
      </a>
    </div>

    <div class="collapse navbar-collapse" id="main-navbar">
      <ul class="nav navbar-nav navbar-right">
        <li><button type="button" id="theme-toggle" class="theme-toggle" aria-pressed="false">Dark</button></li>
        <li><a href="about.php">About</a></li>
        <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
          <li><a href="newpost.php">New Post</a></li>
          <li><a href="author.php?id=<?= $_SESSION['id'] ?>">Profile</a></li>
          <li><a href="actions/logoutActions.php">Logout</a></li>
        <?php else: ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="signup.php">Sign Up</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<script src="js/theme-toggle.js"></script>
