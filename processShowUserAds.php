<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $userId = $_SESSION['userId'];

  require_once "controllers/UserController.php";
  require_once "repository/UserRepository.php";
  require_once "controllers/AdImageController.php";
  require_once "repository/AdImageRepository.php";

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  $adImageRepo = new AdImageRepository();
  $adImageController = new AdImageController($adImageRepo);

  $advertisement = $userController->getUserAds($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your cars</title>
</head>
<body>

  <h1>Your advertisements</h1><br>

  <?php if ($advertisement === null): ?>
    <p>Sorry, but you do not have any advertisement.</p>
    <p>Please visit page for posting new ad!</p>
    <a href="./views/Ads/createAdForm.php">Make new ad</a>
  <?php else: ?>
    <?php foreach($advertisement as $ad): ?>
      <h3> Model: <?= $ad['title'] ?> </h3>

      <?php if ($adImageController->getImageOfAd($ad['id'])): ?>
        <img src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>" alt="Ad picture" style="width: 250px;">
      <?php else: ?>
        <img src="assets/pictures/AdPictures/notFound.png" alt="Not found" style="width: 250px;">
      <?php endif; ?>

      <p> Price: <?= number_format($ad['price']) ?>€ </p>
      <p> Description: <?= $ad['description'] ?> </p>
      <p> First registartion: <?= $ad['first_registration'] ?> </p>
      <p> Fuel type: <?= $ad['fuel_type'] ?> </p>

      <?php if ($ad['category_id'] == 1): ?>
        <p> Type: Car </p>
      <?php else: ?>
        <p> Type: Van</p>
      <?php endif; ?>

      <a href="processDeleteAdvertisement.php?advertisementId=<?= $ad['id'] ?>">Delete</a><br>
      <a href="views/Ads/editSellerAdForm.php?advertisementId=<?= $ad['id'] ?>">Edit</a><br><br>
    <?php endforeach; ?>
  <?php endif; ?>

</body>
</html>