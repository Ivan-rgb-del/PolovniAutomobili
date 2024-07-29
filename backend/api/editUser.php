<?php

  require_once __DIR__ . "/../app/controllers/UserController.php";
  require_once __DIR__ . "/../app/repository/UserRepository.php";

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, PUT, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit;
  }

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  header('Content-Type: application/json');

  $data = json_decode(file_get_contents('php://input'), true);

  $email = $data['email'] ?? '';
  $password = $data['password'] ?? '';

  password_hash($password, PASSWORD_BCRYPT);

  if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $registerUser = $userController->editUser($email, $password);
    echo json_encode(['message' => 'User updated successfully']);
  }

?>