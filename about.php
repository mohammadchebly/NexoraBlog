<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Nexora Blog is a simple learning blog built with PHP, MySQL, and Bootstrap.">
  <meta name="author" content="Nexora Academy">

  <title>About - Nexora Blog</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/simple-blog-template.css" rel="stylesheet">
</head>
<body>

  <?php include_once "components/navbar.php"; ?>

  <main class="container">
    <div class="row">
      <section class="col-lg-12 about-page">
        <div class="about-hero">
          <p class="eyebrow">About the project</p>
          <h1>Nexora Blog</h1>
          <p class="lead">
            Nexora Blog is a clean and simple blogging platform made for sharing ideas,
            study notes, academy updates, and beginner-friendly technical posts.
          </p>
        </div>

        <div class="about-grid">
          <article>
            <h3>What it does</h3>
            <p>
              Users can create accounts, sign in, publish posts, view authors, follow other
              writers, and join conversations through comments. The project keeps the core
              features small so the code is easy to understand and improve.
            </p>
          </article>

          <article>
            <h3>Why it was built</h3>
            <p>
              This project is designed as a practical PHP and MySQL training app. It shows how
              pages, forms, sessions, database queries, and reusable components work together in
              a real website.
            </p>
          </article>

          <article>
            <h3>Design direction</h3>
            <p>
              The interface uses a modern academy style with soft cards, rounded controls,
              strong spacing, and a Nexora-inspired purple and blue visual identity.
            </p>
          </article>
        </div>

        <div class="about-note">
          <h3>Built for learning</h3>
          <p>
            Nexora Blog is intentionally lightweight. It can be extended with categories,
            search, image uploads, post likes, admin tools, or a richer dashboard as the next
            development step.
          </p>
        </div>
      </section>
    </div>
  </main>

  <footer>
    <div class="container">
      <p>Copyright &copy; Nexora Blog @2026</p>
    </div>
  </footer>

  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>
