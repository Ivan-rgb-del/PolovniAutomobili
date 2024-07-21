<?php

  require_once __DIR__ . "/../app/controllers/UserController.php";
  require_once __DIR__ . "/../app/repository/UserRepository.php";

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type");

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  header('Content-Type: application/json');

  $data = json_decode(file_get_contents('php://input'), true);

  $email = $data['email'] ?? '';
  $password = $data['password'] ?? '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $registerUser = $userController->loginUser($email, $password);
    echo json_encode(['message' => 'User logged successfully']);
  }

?>