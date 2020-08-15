<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/views/css/shared.css"/>
  <link rel="stylesheet" href="/views/css/login.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <script src="/views/js/shared.js" defer></script>
  <script src="/views/js/login.js" defer></script>
  <title>Login</title>
</head>
<body>
  <main>

    <?php
      require_once('./views/components/navbar.php');
    ?>

    <section>
      <form id="loginForm" method="POST" action="/login/create">
        <h1>Login</h1>
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
            required>
        </fieldset>
        <p id="errorBox"></p>
        <div>
          <button type="submit">Login</button>
        </div>
      </form>
    </section>

    <?php
      require_once('./views/components/footer.php');
    ?>

  </main>
</body>
</html>