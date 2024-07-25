<?php

  require_once __DIR__ . '/../app/repository/AdImageRepository.php';
  require_once __DIR__ . '/../app/repository/AdvertisementRepository.php';
  require_once __DIR__ . '/../app/repository/UserRepository.php';
  require_once __DIR__ . '/../app/controllers/AdvertisementController.php';
  require_once __DIR__ . '/../app/controllers/UserController.php';

  $adImageRepo = new AdImageRepository();
  $adRepo = new AdvertisementRepository();
  $adController = new AdvertisementController($adRepo, $adImageRepo);
  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit;
  }

  $userId = $_GET['user_id'] ?? null;

  if ($userId === null) {
    http_response_code(400);
    echo json_encode(["message" => "Invalid input."]);
    exit;
  }

  try {
    $ads = $userController->getUserAds($userId);
    echo json_encode($ads);
  } catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["message" => "Unable to fetch ads. Error: " . $e->getMessage()]);
  }

?>