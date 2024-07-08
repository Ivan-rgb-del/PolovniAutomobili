<?php

  require_once __DIR__ . "/database/Base.php";
  require_once __DIR__ . "/controllers/UserController.php";
  require_once __DIR__ . "/interfaces/IUserRepository.php";
  require_once __DIR__ . "/repository/UserRepository.php";

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  $base = new Base();
  $userRepo = new UserRepository($base);
  $userController = new UserController($userRepo);

  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = $userController->loginUser($email, $password);

  if ($user) {
    $_SESSION['logged'] = true;
    $_SESSION['userId'] = $user['id'];

    header("Location: views/index.php");
    exit();
  } else {
    die("Invalid email or password!");
  }

?>