<?php

  require_once __DIR__ . "/../app/controllers/UserController.php";
  require_once __DIR__ . "/../app/repository/UserRepository.php";

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  header('Content-Type: application/json');

  $data = json_decode(file_get_contents('php://input'), true);
  $firstName = $data['firstName'] ?? '';
  $lastName = $data['lastName'] ?? '';
  $email = $data['email'] ?? '';
  $password = $data['password'] ?? '';
  $role = $data['role'] ?? '';
  $imageUrl = $data['imageUrl'] ?? '';
  $phoneNumber = $data['phoneNumber'] ?? '';

  password_hash($password, PASSWORD_BCRYPT);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registerUser = $userController->registerUser(
      $firstName,
      $lastName,
      $email,
      $password,
      $role,
      $imageUrl,
      $phoneNumber
    );
    echo json_encode(['message' => 'User registered successfully']);
  }

?>