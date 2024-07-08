<?php

  require_once "database/Base.php";
  require_once "repository/UserRepository.php";
  require_once "controllers/UserController.php";

  $base = new Base();
  $userRepo = new UserRepository($base);
  $userController = new UserController($userRepo);

  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = $userController->editUser($email, $password);

  header("Location: views/User/loginUserForm.php");

?>