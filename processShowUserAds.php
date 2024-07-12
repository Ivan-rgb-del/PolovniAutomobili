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

  <?php foreach($advertisement as $ad): ?>
    <h3> Model: <?= $ad['title'] ?> </h3>
    <img src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>" alt="Not found" style="width: 250px;">
    <p> Price: <?= $ad['price'] ?> </p>
    <p> Description: <?= $ad['description'] ?> </p>
    <p> First registartion: <?= $ad['first_registration'] ?> </p>
    <p> Fuel type: <?= $ad['fuel_type'] ?> </p>

    <?php if ($ad['category_id'] == 1): ?>
      <p> Type: Car </p>
    <?php else: ?>
      <p> Type: Van</p>
    <?php endif; ?>
  <?php endforeach; ?>

</body>
</html>