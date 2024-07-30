<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome to Polovni Automobili</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Polovni Automobili</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <?php if (isset($_SESSION['logged']) && $_SESSION['userRole'] == "seller"): ?>
            <li class="nav-item">
              <a class="nav-link" href="../app/handlers/processLogoutUser.php">Logout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./Ads/createAdForm.php">Add new car</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../processShowUserAds.php">My advertisement</a>
            </li>
          <?php elseif (isset($_SESSION['logged']) && $_SESSION['userRole'] == "user"): ?>
            <li class="nav-item">
              <a class="nav-link" href="../app/handlers/processLogoutUser.php">Logout</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../processShowAllAds.php">Look for new car</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../processShowUserSavedAds.php">Saved ads</a>
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="./User/registerUserForm.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./User/loginUserForm.php">Login</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <header class="bg-light py-5 text-center">
    <div class="container">
      <h1 class="display-4">Welcome to Polovni Automobili</h1>
      <p class="lead text-muted">Your one-stop destination for buying and selling used cars</p>
    </div>
  </header>

  <footer class="bg-dark text-white py-3 text-center mt-auto">
    <div class="container">
      © 2024 Polovni Automobili
    </div>
  </footer>

</body>
</html>