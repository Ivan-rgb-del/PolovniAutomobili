<?php

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
  }

  require_once __DIR__ . "/../app/controllers/AdvertisementController.php";
  require_once __DIR__ . "/../app/repository/AdvertisementRepository.php";
  require_once __DIR__ . "/../app/repository/AdImageRepository.php";

  $adRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();
  $adController = new AdvertisementController($adRepo, $adImageRepo);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $title = $data['title'];
    $price = (int)$data['price'];
    $description = $data['description'];
    $first_registration = (int)$data['first_registration'];
    $fuel_type = $data['fuel_type'];
    $category_id = (int)$data['category_id'];
    $user_id = (int)$data['user_id'];
    $sub_category = (int)$data['sub_category'];
    $imageUrl = "image.jpg";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $createAd = $adController->createAdvertisement(
        $title,
        $price,
        $description,
        $first_registration,
        $fuel_type,
        $category_id,
        $user_id,
        $sub_category,
        $imageUrl
      );
      echo json_encode(['message' => 'Ad created successfully']);
    }
  }

?>