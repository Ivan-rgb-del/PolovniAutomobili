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

    $title = $data['title'];
    $price = (int)$data['price'];
    $description = $data['description'];
    $first_registration = (int)$data['first_registration'];
    $fuel_type = $data['fuel_type'];
    $category_id = (int)$data['category_id'];
    $sub_category = (int)$data['sub_category'];
    $imageUrl = "image.jpg";

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
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

      echo json_encode(['message' => 'Ad updated successfully']);
    }
  }

?>