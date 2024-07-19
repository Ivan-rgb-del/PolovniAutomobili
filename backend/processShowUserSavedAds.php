<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $userId = $_SESSION['userId'];

  require_once "./app/controllers/SavedAdsController.php";
  require_once "./app/repository/SavedAdsRepository.php";
  require_once "./app/repository/AdImageRepository.php";
  require_once "./app/controllers/AdImageController.php";

  $adImageRepo = new AdImageRepository();
  $adImageController = new AdImageController($adImageRepo);

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

  <a href="./views/index.php">Home</a>

  <?php if (!$savedAds): ?>
    <h1>You do not have any saved ad.</h1>
    <h1>
      Please visit <a href="processShowAllAds.php">Ads</a> and save your favourite ads!
    </h1>
  <?php endif; ?>

  <?php foreach ($savedAds as $ad): ?>
    <h3>Model: <?= $ad['title'] ?></h3>

    <?php if($adImageController->getImageOfAd($ad['id'])): ?>
      <img
        src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>"
        alt="<?= $ad['title'] ?>"
        style="width: 250px"
      >
    <?php else: ?>
      <img
        src="assets/pictures/AdPictures/notFound.png"
        alt="<?= $ad['title'] ?>"
        style="width: 250px;"
      >
    <?php endif; ?>

    <p> First registartion: <?= $ad['first_registration'] ?> </p>
    <p> Price: <?= number_format($ad['price']) ?>€ </p>
    <p> Fuel type: <?= $ad['fuel_type'] ?> </p>

    <?php if ($ad['category_id'] == 1): ?>
      <p>Type: Car</p>
    <?php else: ?>
      <p>Type: Van</p>
    <?php endif; ?>

    <p> Description: <?= $ad['description'] ?> </p>
    <a
      href="./app/handlers/processDeleteFromSavedAds.php?adId=<?= $ad['id'] ?>"
    >Remove
    </a><br>
  <?php endforeach; ?>

</body>
</html>