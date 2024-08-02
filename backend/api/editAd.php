<?php

  require_once __DIR__ . '/../app/repository/AdvertisementRepository.php';
  require_once __DIR__ . '/../app/repository/AdImageRepository.php';
  require_once __DIR__ . '/../app/controllers/AdvertisementController.php';

  $adImageRepo = new AdImageRepository(); 
  $adRepo = new AdvertisementRepository();  
  $adController = new AdvertisementController($adRepo, $adImageRepo);

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, PUT, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit;
  }

  $adId = $_GET['adId'] ?? null;

  if ($adId === null) {
    http_response_code(400);
    echo json_encode(["message" => "Bad Request. Missing ad ID."]);
    exit;
  }

  $data = json_decode(file_get_contents('php://input'), true);
  error_log("Received data: " . print_r($data, true));

  if (!$data) {
    http_response_code(400);
    echo json_encode(["message" => "Bad Request. Missing or invalid JSON data."]);
    exit;
  }

  $title = $data['title'] ?? '';
  $price = $data['price'] ?? 0;
  $description = $data['description'] ?? '';
  $first_registration = $data['first_registration'] ?? 0;
  $fuel_type = $data['fuel_type'] ?? '';
  $category_id = $data['category_id'] ?? 1;
  $sub_category = $data['sub_category'] ?? 1;
  $imageUrl = "image.jpg";

  if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $result = $adController->editAdvertisement(
      $adId,
      $title,
      $price,
      $description,
      $first_registration,
      $fuel_type,
      $category_id,
      $sub_category,
      $imageUrl
    );
    if ($result) {
      echo json_encode(['message' => 'Ad updated successfully']);
    } else {
      http_response_code(500);
      echo json_encode(['message' => 'Failed to update ad']);
    }
  } else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
  }

?>