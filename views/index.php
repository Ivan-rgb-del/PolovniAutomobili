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
    <?php if (isset($_SESSION['logged'])): ?>
      <a href="../processLogoutUser.php">Logout</a>
    <?php else: ?>
      <a href="./User/registerUserForm.php">Register</a>
      <br>
      <a href="./User/loginUserForm.php">Login</a>
    <?php endif; ?>
  </ul>

</body>
</html>