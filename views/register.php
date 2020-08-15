<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/views/css/shared.css"/>
  <link rel="stylesheet" href="/views/css/register.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="/views/js/shared.js" defer></script>
  <script src="/views/js/register.js" defer></script>
  <title>Register</title>
</head>
<body>
  <main>

    <?php
      require_once('./views/components/navbar.php');
    ?>

    <section>
      <form id="registerForm" method="POST" action="/register/create">
        <h1>Register</h1>
        <fieldset>
          <label for="username">Username</label>
          <input
            id="username"
            type="text"
            name="username"
            placeholder="Enter your username"
            title="Only normal characters allowed, minimum length of 5"
            pattern="\w{5,}"
            required>
        </fieldset>
        <fieldset>
          <label for="email">Email</label>
          <input
            id="email"
            type="email"
            name="email"
            placeholder="Enter your email"
            required>
        </fieldset>
        <fieldset>
          <label for="password">Password</label>
          <input
            id="password"
            type="password"
            name="password"
            placeholder="Enter your password"
            title="Use at least uppercase, lowercase, numbers, and special characters, minimum length of 5"
            pattern="[a-zA-Z0-9!@#$%^&*]{5,}"
            required>
        </fieldset>
        <fieldset>
          <label for="confirmPassword">Confirm password</label>
          <input
            id="confirmPassword"
            type="password"
            name="confirmPassword"
            placeholder="Confirm your password"
            required>
        </fieldset>
        <p id="errorBox"></p>
        <p id="notificationBox"></p>
        <div>
          <button type="submit">Register</button>
        </div>
      </form>
    </section>

    <?php
      require_once('./views/components/footer.php');
    ?>

  </main>
</body>
</html>