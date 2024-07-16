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

  <?php foreach ($savedAds as $ad): ?>
    <h3>Model: <?= $ad['title'] ?></h3>
    <p> Price: <?= number_format($ad['price']) ?>€ </p>
    <p> Description: <?= $ad['description'] ?> </p>
    <p> First registartion: <?= $ad['first_registration'] ?> </p>
    <p> Fuel type: <?= $ad['fuel_type'] ?> </p>
  <?php endforeach; ?>

</body>
</html>