<?php

  $advertisementId = $_GET['advertisementId'];

  require_once __DIR__ . '/../repository/AdvertisementRepository.php';
  require_once __DIR__ . '/../repository/AdImageRepository.php';
  require_once __DIR__ . '/../repository/SavedAdsRepository.php';

  require_once __DIR__ . '/../controllers/AdvertisementController.php';
  require_once __DIR__ . '/../controllers/AdImageController.php';
  require_once __DIR__ . '/../controllers/SavedAdsController.php';

  $adsRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();
  $savedAdRepo = new SavedAdsRepository();

  $adsController = new AdvertisementController($adsRepo, $adImageRepo);
  $adImageController = new AdImageController($adImageRepo);
  $savedAdController = new SavedAdsController($savedAdRepo);

  $savedAdController->deleteSavedAd($advertisementId);
  $adImageController->deleteAdvertisementImage($advertisementId);
  $adsController->deleteAdvertisement($advertisementId);

  header("Location: ../../views/index.php");

?>