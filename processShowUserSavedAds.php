<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $userId = $_SESSION['userId'];

  require_once "controllers/SavedAdsController.php";
  require_once "repository/SavedAdsRepository.php";

  $savedAdRepo = new SavedAdsRepository();
  $saveAdController = new SavedAdsController($savedAdRepo);

  try {
    $savedAds = $saveAdController->getAllSavedAdsByUser($userId);
  } catch (Exception $e) {
    die("Error fetching saved ads: " . $e->getMessage());
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saved ads</title>
</head>
<body>

  <?php foreach($savedAds as $ad): ?>
    <h3> Model: <?= $ad['title'] ?> </h3>
  <?php endforeach; ?>

</body>
</html>