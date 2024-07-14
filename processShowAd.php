<?php

  require_once "repository/AdvertisementRepository.php";
  require_once "repository/AdImageRepository.php";
  require_once "controllers/AdvertisementController.php";
  require_once "controllers/AdImageController.php";

  $adImageRepo = new AdImageRepository();
  $adRepo = new AdvertisementRepository();
  $adController = new AdvertisementController($adRepo, $adImageRepo);
  $adImageController = new AdImageController($adImageRepo);

  $adId = $_GET['advertisementId'];

  $ad = $adController->getAdId($adId);
  $adImage = $adImageController->getImageOfAd($ad['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ime oglasa</title>
</head>
<body>

  <h2>Model: <?= $ad['title'] ?></h2>

  <?php if ($adImage): ?>
    <img
      src="assets/pictures/AdPictures/<?= $adImage ?>"
      alt="<?= $ad['title'] ?>"
      style="width: 250px;"
    >
  <?php else: ?>
    <img
      src="assets/pictures/AdPictures/notFound.png"
      alt="Not Found"
      style="width: 250px;"
    >
  <?php endif; ?>

  <p>Year: <?= $ad['first_registration'] ?></p>
  <p>Price: <?= number_format($ad['price']) ?>€</p>
  <p>Fuel type: <?= $ad['fuel_type'] ?></p>

  <?php if ($ad['category_id'] === 1): ?>
    <p>Type: Car</p>
  <?php else: ?>
    <p>Type: Van</p>
  <?php endif; ?>

  <p>Description: <?= $ad['description'] ?></p>

</body>
</html>