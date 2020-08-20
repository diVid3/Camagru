<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/views/css/shared.css"/>
  <link rel="stylesheet" href="/views/css/capture.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&display=swap" rel="stylesheet">
  <script src="/views/js/shared.js" defer></script>
  <script src="/views/js/capture.js" defer></script>
  <title>Capture</title>
</head>
<body>

  <?php
    require_once('./views/components/navbar.php');
  ?>

  <aside>

  </aside>

  <main>

      <section>

        <h1>Capture</h1>

        <div class="container">
          <div class="video-container">
            <video id="video">
              <p>Stream not active</p>
            </video>
            <canvas id="canvas"></canvas>
            <img id="flowers" src="/assets/stickers/flowers.png">
            <img id="unicorn" src="/assets/stickers/unicorn.png">
            <img id="sun" src="/assets/stickers/sun.png">
          </div>
          <aside>
            <div class="stickers">
              <h3>Stickers</h3>
              <div class="sticker">
                <label for="sun-checkbox">Sun</label>
                <input id="sun-checkbox" type="checkbox">
              </div>
              <div class="sticker">
                <label for="flowers-checkbox">Flowers</label>
                <input id="flowers-checkbox" type="checkbox">
              </div>
              <div class="sticker">
                <label for="unicorn-checkbox">Unicorn</label>
                <input id="unicorn-checkbox" type="checkbox">
              </div>
            </div>
            <div class="buttons">
              <button id="capture">Capture</button>
              <button id="upload">Upload</button>
              <button id="clear">Clear</button>
              <button id="save">Save</button>
            </div>
          </aside>
        </div>
        
      </section>

      <aside>

      </aside>
  </main>

  <?php
    require_once('./views/components/footer.php');
  ?>

</body>
</html>