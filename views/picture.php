<?php

// TODO:  Remember to load the comments and likes for the picture.
//        You could also determine if you liked the picture or not.

// TODO:  Remember to swap out the heart svgs based upon whether the
//        logged in user liked the picture or not.

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
        <img src="/pictures/test/image1.jpg">
        <div class="stats">
          <div class="likes">
            <p>541 Likes</p>
          </div>
          <img src="/assets/icons/heart.svg">
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
            <button type="submit">Comment</button>
          </div>
        </form>
        <div class="comment">
          <div>
            <img src="/assets/icons/user-somewhat-blue.png">
          </div>
          <div>
            <h3>xXSniper1337</h3>
            <p>This is an awesome picture bro, keep making these! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia esse ducimus libero eligendi facere eaque inventore reiciendis porro aliquam suscipit? Explicabo eos optio ea fuga nulla consequatur porro quo accusantium. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda odit dolorem fuga temporibus, ea, itaque doloribus dignissimos vero recusandae ex dolores perspiciatis, blanditiis reprehenderit aspernatur eligendi. Praesentium velit quos dicta.</p>
          </div>
        </div>
        <div class="comment">
          <div>
            <img src="/assets/icons/user-somewhat-blue.png">
          </div>
          <div>
            <h3>xXSniper1337</h3>
            <p>This is an awesome picture bro, keep making these! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia esse ducimus libero eligendi facere eaque inventore reiciendis porro aliquam suscipit? Explicabo eos optio ea fuga nulla consequatur porro quo accusantium.</p>
          </div>
        </div>
        <div class="comment">
          <div>
            <img src="/assets/icons/user-somewhat-blue.png">
          </div>
          <div>
            <h3>xXSniper1337</h3>
            <p>This is an awesome picture bro, keep making these! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia esse ducimus libero eligendi facere eaque inventore reiciendis porro aliquam suscipit? Explicabo eos optio ea fuga nulla consequatur porro quo accusantium.</p>
          </div>
        </div>
      </div>

    </section>
  </main>

  <?php
    require_once('./views/components/footer.php');
  ?>

</body>
</html>
