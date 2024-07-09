<?php

  require_once __DIR__ . "/repository/AdvertisementRepository.php";
  require_once __DIR__ . "/controllers/AdvertisementController.php";
  require_once __DIR__ . "/interfaces/IAdvertisementRepository.php";

  $adsRepo = new AdvertisementRepository();
  $adsController = new AdvertisementController($adsRepo);

  $title = $_POST['title'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $firstRegistration = $_POST['firstRegistration'];
  $fuelType = $_POST['fuelType'];
  $categoryId = $_POST['categories'];
  $userId = $_POST['userId'];
  $subCategoryId = $_POST['vehicleType'];

  $result = $adsController->createAdvertisement($title, $price, $description, $firstRegistration, $fuelType, $categoryId, $userId, $subCategoryId);

?>