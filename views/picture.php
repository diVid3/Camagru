<?php

$viewBag = $_SESSION['viewBag'];

$pictureRow = $viewBag['pictureRow'];
$commentRows = $viewBag['commentRows'];
$likerCountRow = $viewBag['likerCountRow'];
$didLikeArr = $viewBag['didLikeArr'];

$likerCount = $likerCountRow['likerCount'];
$didLike = $didLikeArr['didLike'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/views/css/shared.css"/>
  <link rel="stylesheet" href="/views/css/picture.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet">
  <script src="/views/js/shared.js" defer></script>
  <script src="/views/js/picture.js" defer></script>
  <title>Picture</title>
</head>
<body>

  <?php
    require_once('./views/components/navbar.php');
  ?>

  <main>
    <section>

      <h1>Picture</h1>

      <div class="picture">

        <?php
          echo "<img id='{$pictureRow['id']}' src='{$pictureRow['path']}' class='image'>";
        ?>

        <div class="stats">
          <div class="likes">
            <span id="likeCount"><?php echo "{$likerCount}" ?></span><span>&nbsp;likes</span>
          </div>

          <?php

            if ($didLike) {
              echo "<img id='likeImage' src='/assets/icons/heart.svg'>";
            }

            if (!$didLike) {
              echo "<img id='likeImage' src='/assets/icons/heart-black.svg'>";
            }

          ?>

        </div>
      </div>

      <div class="comments">
        <form id="commentForm" method="POST" action="/comments/create">
          <fieldset>
            <label for="comment">Leave a comment</label>
            <textarea
              id="comment"
              type="textarea"
              name="comment"
              placeholder="Comment here"
              required></textarea>
          </fieldset>
          <p id="errorBox"></p>
          <div>
            <button id="commentButton" type="submit">Comment</button>
          </div>
        </form>

        <?php

          foreach ($commentRows as $row) {
            echo "<div class='comment'><div><img src='/assets/icons/user-somewhat-blue.png'></div><div><h3>{$row['username']}</h3><p>{$row['text']}</p></div></div>";
          }

        ?>

      </div>
    </section>
  </main>

  <?php
    require_once('./views/components/footer.php');
  ?>

</body>
</html>
