<?php

  require_once __DIR__ . "/../app/controllers/AdvertisementController.php";
  require_once __DIR__ . "/../app/repository/AdvertisementRepository.php";
  require_once __DIR__ . "/../app/repository/AdImageRepository.php";

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE, PUT");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");

  $adRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();
  $adController = new AdvertisementController($adRepo, $adImageRepo);

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $ads = $adController->getAllAdvertisement();
    echo json_encode($ads); 
  }

?>