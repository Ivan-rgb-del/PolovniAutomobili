<?php

  require_once "repository/UserRepository.php";
  require_once "controllers/UserController.php";

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = $userController->editUser($email, $password);

  header("Location: views/User/loginUserForm.php");

?>