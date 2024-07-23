<?php

  require_once __DIR__ . '/../app/repository/AdvertisementRepository.php';
  require_once __DIR__ . '/../app/repository/AdImageRepository.php';
  require_once __DIR__ . '/../app/controllers/AdvertisementController.php';

  $adImageRepo = new AdImageRepository(); 
  $adRepo = new AdvertisementRepository();  
  $adController = new AdvertisementController($adRepo, $adImageRepo)  ;

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");

  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    http_response_code(200);
    exit;
  }

  $adId = $_GET['id'] ?? null;

  if ($adId === null) {
    http_response_code(400);
    echo json_encode(["message" => "Bad Request. Missing ad ID."]);
    exit;
  }

  $adDetails = $adController->getAdId($adId);

  if ($adDetails) {
    echo json_encode($adDetails);
  } else {
    http_response_code(404);
    echo json_encode(["message" => "Ad not found."]);
  }
?>