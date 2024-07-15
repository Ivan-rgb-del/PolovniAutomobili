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
  <title>Welcome</title>
</head>
<body>

  <h1>Welcome</h1>

  <ul>
    <?php if (isset($_SESSION['logged']) && $_SESSION['userRole'] == "seller"): ?>
      <a href="../processLogoutUser.php">Logout</a><br>
      <a href="./Ads/createAdForm.php">Add new car</a><br>
      <a href="../processShowUserAds.php">My advertisement</a>
    <?php elseif (isset($_SESSION['logged']) && $_SESSION['userRole'] == "user"): ?>
      <a href="../processLogoutUser.php">Logout</a><br>
      <a href="../processShowAllAds.php">Look for new car</a><br>
      <a href="../processShowUserSavedAds.php">Saved ads</a>
    <?php else: ?>
      <a href="./User/registerUserForm.php">Register</a>
      <br>
      <a href="./User/loginUserForm.php">Login</a>
    <?php endif; ?>
  </ul>

</body>
</html>