<?php

  require_once __DIR__ . "/../app/controllers/UserController.php";
  require_once __DIR__ . "/../app/repository/UserRepository.php";

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data);

  $data = json_decode(file_get_contents('php://input'), true);

  $firstName = $data['first_name'] ?? '';
  $lastName = $data['last_name'] ?? '';
  $email = $data['email'] ?? '';
  $password = $data['password'] ?? '';
  $role = $data['role'] ?? '';
  $imageUrl = $data['profile_image'] ?? '';
  $phoneNumber = $data['phone_number'] ?? 0;

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