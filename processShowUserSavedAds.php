<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $userId = $_SESSION['userId'];

  require_once "controllers/SavedAdsController.php";
  require_once "repository/SavedAdsRepository.php";

  $savedAdRepo = new SavedAdsRepository();
  $saveAdController = new SavedAdsController($savedAdRepo);

  $savedAds = $saveAdController->getAllSavedAdsByUser($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saved ads</title>
</head>
<body>

  <h3> Model: <?= $savedAds['title'] ?> </h3>
  <p> Price: <?= number_format($savedAds['price']) ?>€ </p>
  <p> Description: <?= $savedAds['description'] ?> </p>
  <p> First registartion: <?= $savedAds['first_registration'] ?> </p>
  <p> Fuel type: <?= $savedAds['fuel_type'] ?> </p>

</body>
</html>