<?php

  require_once __DIR__ . "/database/Base.php";
  require_once __DIR__ . "/controllers/UserController.php";
  require_once __DIR__ . "/interfaces/IUserRepository.php";
  require_once __DIR__ . "/repository/UserRepository.php";

  $base = new Base();
  $userRepo = new UserRepository($base);
  $userController = new UserController($userRepo);

  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = $userController->loginUser($email, $password);

?>