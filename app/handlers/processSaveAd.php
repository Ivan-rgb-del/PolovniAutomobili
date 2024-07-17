<?php

  require_once "../controllers/SavedAdsController.php";
  require_once "../repository/SavedAdsRepository.php";

  $savedAdsRepo = new SavedAdsRepository();
  $savedAdsController = new SavedAdsController($savedAdsRepo);

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  $userId = $_SESSION['userId'];
  $adId = $_GET['advertisementId'];

  $savedAdsController->saveAdvertisement($userId, $adId);

  header("Location: ../../processShowUserSavedAds.php");

?>