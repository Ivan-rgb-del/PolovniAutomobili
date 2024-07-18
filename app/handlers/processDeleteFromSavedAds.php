<?php

  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  $userId = $_SESSION['userId'];
  $adId = $_GET['adId'];

  require_once __DIR__ . "/../repository/SavedAdsRepository.php";
  require_once __DIR__ . "/../controllers/SavedAdsController.php";

  $savedAdRepo = new SavedAdsRepository();
  $savedAdController = new SavedAdsController($savedAdRepo);

  $result = $savedAdController->deleteSavedAd($userId, $adId);

  header("Location: ../../views/index.php");

?>