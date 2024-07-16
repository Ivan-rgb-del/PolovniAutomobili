<?php

  $advertisementId = $_GET['advertisementId'];

  require_once "./app/repository/AdvertisementRepository.php";
  require_once "./app/repository/AdImageRepository.php";
  require_once "./app/controllers/AdvertisementController.php";
  require_once "./app/controllers/AdImageController.php";

  $adsRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();

  $adsController = new AdvertisementController($adsRepo, $adImageRepo);
  $adImageController = new AdImageController($adImageRepo);

  $adImageController->deleteAdvertisementImage($advertisementId);
  $adsController->deleteAdvertisement($advertisementId);

  header("Location: processShowUserAds.php");

?>