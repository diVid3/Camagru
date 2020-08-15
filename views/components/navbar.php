<?php
  require_once('./services/AuthService.php');
  $loggedIn = AuthService::isLoggedIn();
?>

<nav class="navbar">
  <div>

    <ul>
      <li><a href="/gallery/show">Gallery</a></li>

      <?php
        if ($loggedIn) {
          echo '<li><a href="/capture/show">Capture</a></li>';
        }
      ?>

    </ul>
    <ul>

      <?php
        if(!$loggedIn) {
          echo '<li><a href="/register/show">Register</a></li>';
        }
      ?>

      <?php
        if($loggedIn) {
          echo '<li><a href="/settings/show">Settings</a></li>';
        }
      ?>

      <li>

        <?php
          if ($loggedIn) {
            echo '<a href="/login/delete">Logout</a>';
          } else {
            echo '<a href="/login/show">Login</a>';
          }
        ?>

      </li>
    </ul>

  </div>
</nav>