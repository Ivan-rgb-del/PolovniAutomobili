<?php

  require_once __DIR__ . "/repository/UserRepository.php";
  require_once __DIR__ . "/controllers/UserController.php";
  require_once __DIR__ . "/interfaces/IUserRepository.php";

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $profileImage = $_POST['profileImage'];
  $phoneNumber = $_POST['phoneNumber'];

  $result = $userController->registerUser($firstName, $lastName, $email, $password, $role, $profileImage, $phoneNumber);

  header("Location: views/index.php");

?>