<?php

  require_once __DIR__ . "/../app/controllers/UserController.php";
  require_once __DIR__ . "/../app/repository/UserRepository.php";

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");

  header('Content-Type: application/json');

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  $data = json_decode(file_get_contents('php://input'), true);

  $email = $data['email'] ?? '';
  $password = $data['password'] ?? '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $userController->loginUser($email, $password);

    if ($user) {
      echo json_encode([
        'success' => true,
        'userId' => $user['id'],
        'userRole' => $user['role'],
        'message' => 'Login successful'
      ]);
    } else {
      echo json_encode([
        'success' => false,
        'message' => 'Invalid credentials'
      ]);
    }
  } else {
    echo json_encode([
      'success' => false,
      'message' => 'Invalid request method'
    ]);
  }

?>