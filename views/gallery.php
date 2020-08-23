<?php

$viewBag = array_key_exists('viewBag', $_SESSION)
  ? $_SESSION['viewBag']
  : [];

$rows = array_key_exists('rows', $viewBag)
  ? $viewBag['rows']
  : null;

$columns = [
  [],
  [],
  []
];

foreach ($rows as $index=>$row) {

  $index %= 3;
  array_push($columns[$index], $row);
}

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
          <?php

            foreach ($columns[0] as $row) {
              echo "<img id='{$row['id']}' src='{$row['path']}'>";
            }

          ?>
        </div>
        <div>
          <?php

            foreach ($columns[1] as $row) {
              echo "<img id='{$row['id']}' src='{$row['path']}'>";
            }

          ?>
        </div>
        <div>
          <?php

            foreach ($columns[2] as $row) {
              echo "<img id='{$row['id']}' src='{$row['path']}'>";
            }

          ?>
        </div>
        <div>
      </div>

    </section>
  </main>

  <?php
    require_once('./views/components/footer.php');
  ?>

</body>
</html>