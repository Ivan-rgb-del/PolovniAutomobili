<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $userId = $_SESSION['userId'];

  require_once "controllers/UserController.php";
  require_once "repository/UserRepository.php";
  require_once "models/User.php";

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  $userController->getUserAds($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your cars</title>
</head>
<body>

  <h1>Your advertisement11111</h1>

</body>
</html>