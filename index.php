<?php
  session_start();
  require_once "components/loggedIn.php";
  require_once "components/connection.php";

  try {
    $sql = "SELECT posts.id as post_id,
               users.id as user_id,
               posts.subject,
               posts.content,
               users.username,
               posts.date_created
        FROM posts
        INNER JOIN users ON posts.user_id = users.id
        ORDER BY posts.date_created DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo "Connection to database failed! Error: " . $exception->getMessage();
    die();
}
$demoPosts = [
  [
    'post_id' => 0,
    'user_id' => 0,
    'subject' => 'Welcome to Nexora Blog',
    'username' => 'Nexora Team',
    'date_created' => '2026-05-29',
    'content' => 'A fresh space for academy news, study notes, coding tips, and student stories. This sample post appears when there are no posts to show yet.'
  ],
  [
    'post_id' => 0,
    'user_id' => 0,
    'subject' => 'How to Start Learning Web Development',
    'username' => 'Nexora Mentor',
    'date_created' => '2026-05-28',
    'content' => 'Start with small pages, learn how forms work, connect them to a database, and keep improving one feature at a time.'
  ],
  [
    'post_id' => 0,
    'user_id' => 0,
    'subject' => 'Project Update: Cleaner Design System',
    'username' => 'Design Desk',
    'date_created' => '2026-05-27',
    'content' => 'Nexora Blog now has a cleaner layout, rounded cards, better spacing, and a more modern academy-style identity.'
  ]
];

if (empty($posts)) {
  $posts = $demoPosts;
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

      <!-- Blog Entries Column -->
      <div class="col-md-12">

      <?php foreach($posts as $post): ?>

        <article class="post-card">
          <h2 class="post-title">
            <?php if (!empty($post['post_id'])): ?>
              <a href="post.php?id=<?= $post['post_id'] ?>"><?= htmlspecialchars($post['subject']) ?></a>
            <?php else: ?>
              <?= htmlspecialchars($post['subject']) ?>
            <?php endif; ?>
          </h2>

          <p class="post-meta">
            <span class="glyphicon glyphicon-time"></span>
            Posted on <?= htmlspecialchars($post['date_created']) ?> by
            <?php if (!empty($post['user_id'])): ?>
              <a href="author.php?id=<?= $post['user_id'] ?>"><?= htmlspecialchars($post['username']) ?></a>
            <?php else: ?>
              <?= htmlspecialchars($post['username']) ?>
            <?php endif; ?>
          </p>

          <p><?= htmlspecialchars($post['content']) ?></p>

          <?php if (!empty($post['post_id'])): ?>
            <a class="btn btn-default" href="post.php?id=<?= $post['post_id'] ?>">Read More</a>
            <a class="btn btn-default" href="post.php?id=<?= $post['post_id'] ?>">Like</a>
          <?php else: ?>
            <span class="sample-badge">Sample post</span>
          <?php endif; ?>
        </article>
        <?php endforeach; ?>
       

        <!-- Pager -->
        <!-- <ul class="pager">
          <li class="previous">
            <a href="#">Prev</a>
          </li>
          <li class="next">
            <a href="#">Next</a>
          </li>
        </ul> -->

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