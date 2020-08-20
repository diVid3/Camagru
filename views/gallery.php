<?php

// TODO:  When accessing the viewBag for the images, you could take their
//        position in the array and modulate by 4 to populate the grid.

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/views/css/shared.css"/>
  <link rel="stylesheet" href="/views/css/gallery.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet">
  <script src="/views/js/shared.js" defer></script>
  <script src="/views/js/gallery.js" defer></script>
  <title>Gallery</title>
</head>
<body>

  <?php
    require_once('./views/components/navbar.php');
  ?>

  <main>
    <section>

      <h1>Gallery</h1>

      <div class="masonry-container">
        <div>
          <img src="/images/test/image1.jpg">
          <img src="/images/test/image2.jpg">
          <img src="/images/test/image3.jpg">
          <img src="/images/test/image4.jpg">
          <img src="/images/test/image5.jpeg">
          <img src="/images/test/image6.jpg">
          <img src="/images/test/image7.jpg">
          <img src="/images/test/image8.jpg">
          <img src="/images/test/image9.jpg">
          <img src="/images/test/image10.jpeg">
        </div>
        <div>
          <img src="/images/test/image9.jpg">
          <img src="/images/test/image1.jpg">
          <img src="/images/test/image6.jpg">
          <img src="/images/test/image4.jpg">
          <img src="/images/test/image7.jpg">
          <img src="/images/test/image2.jpg">
          <img src="/images/test/image3.jpg">
          <img src="/images/test/image5.jpeg">
          <img src="/images/test/image10.jpeg">
          <img src="/images/test/image8.jpg">
        </div>
        <div>
          <img src="/images/test/image1.jpg">
          <img src="/images/test/image3.jpg">
          <img src="/images/test/image4.jpg">
          <img src="/images/test/image2.jpg">
          <img src="/images/test/image10.jpeg">
          <img src="/images/test/image8.jpg">
          <img src="/images/test/image9.jpg">
          <img src="/images/test/image5.jpeg">
          <img src="/images/test/image7.jpg">
          <img src="/images/test/image6.jpg">
        </div>
        <div>
          <img src="/images/test/image3.jpg">
          <img src="/images/test/image2.jpg">
          <img src="/images/test/image7.jpg">
          <img src="/images/test/image10.jpeg">
          <img src="/images/test/image1.jpg">
          <img src="/images/test/image9.jpg">
          <img src="/images/test/image6.jpg">
          <img src="/images/test/image8.jpg">
          <img src="/images/test/image5.jpeg">
          <img src="/images/test/image4.jpg">
        </div>
      </div>

    </section>
  </main>

  <?php
    require_once('./views/components/footer.php');
  ?>

</body>
</html>