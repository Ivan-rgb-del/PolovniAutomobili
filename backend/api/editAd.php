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

  if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
      http_response_code(400);
      echo json_encode(["message" => "Bad Request. Invalid JSON."]);
      exit;
    }

    $title = $data['title'] ?? null;
    $price = isset($data['price']) ? (int)$data['price'] : null;
    $description = $data['description'] ?? null;
    $first_registration = isset($data['first_registration']) ? (int)$data['first_registration'] : null;
    $fuel_type = $data['fuel_type'] ?? null;
    $category_id = isset($data['category_id']) ? (int)$data['category_id'] : null;
    $sub_category = isset($data['sub_category']) ? (int)$data['sub_category'] : null;
    $imageUrl = "image.jpg";

    if (!$title || !$price || !$description || !$first_registration || !$fuel_type || !$category_id || !$sub_category) {
      http_response_code(400);
      echo json_encode(["message" => "Bad Request. Missing required fields."]);
      exit;
    }

    $createAd = $adController->editAdvertisement(
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

    if ($createAd) {
      echo json_encode(['message' => 'Ad updated successfully']);
    } else {
      http_response_code(500);
      echo json_encode(['message' => 'Failed to update ad']);
    }
  } else {
    http_response_code(405);
    echo json_encode(['message' => 'Method not allowed']);
  }

?>