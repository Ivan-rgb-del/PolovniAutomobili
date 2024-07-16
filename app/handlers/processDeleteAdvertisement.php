<?php

  $advertisementId = $_GET['advertisementId'];

  require_once "../repository/AdvertisementRepository.php";
  require_once "../repository/AdImageRepository.php";
  require_once "../controllers/AdvertisementController.php";
  require_once "../controllers/AdImageController.php";

  $adsRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();

  $adsController = new AdvertisementController($adsRepo, $adImageRepo);
  $adImageController = new AdImageController($adImageRepo);

  $adImageController->deleteAdvertisementImage($advertisementId);
  $adsController->deleteAdvertisement($advertisementId);

  header("Location: processShowUserAds.php");

?>