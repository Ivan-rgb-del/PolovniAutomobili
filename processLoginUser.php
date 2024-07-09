<?php

  require_once __DIR__ . "/controllers/UserController.php";
  require_once __DIR__ . "/interfaces/IUserRepository.php";
  require_once __DIR__ . "/repository/UserRepository.php";

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = $userController->loginUser($email, $password);

  if (!$user) {
    return null;
  }

  $_SESSION['logged'] = true;
  $_SESSION['userId'] = $user['id'];
  $_SESSION['userRole'] = $user['role'];

  header("Location: views/index.php");

?>