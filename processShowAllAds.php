<?php

  require_once "./app/controllers/AdvertisementController.php";
  require_once "./app/controllers/AdImageController.php";
  require_once "./app/repository/AdImageRepository.php";
  require_once "./app/repository/AdvertisementRepository.php";

  $adImageRepo = new AdImageRepository();
  $adRepo = new AdvertisementRepository();
  $adController = new AdvertisementController($adRepo, $adImageRepo);
  $adImageController = new AdImageController($adImageRepo);

  $ads = $adController->getAllAdvertisement();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ads</title>
</head>
<body>

  <h1>All Advertisement</h1>

  <form action="processFilterAds.php" method="POST">
    <label for="title">Enter title for ad</label><br>
    <input type="text" name="title" id="title">
    <button>Search</button>
  </form><br><br>

  <?php foreach($ads as $ad): ?>
    <h3> <?= $ad['title'] ?> </h3>

    <?php if ($adImageController->getImageOfAd($ad['id'])): ?>
      <img
        src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>"
        alt="<?= $ad['title'] ?>"
        style="width: 250px;"
      >
    <?php else: ?>
      <img
        src="assets/pictures/AdPictures/notFound.png"
        alt="Not found"
        style="width: 250px;"
      >
    <?php endif; ?>

    <p>Price: <?= number_format($ad['price']) ?>€ </p>
    <p>Year: <?= $ad['first_registration'] ?> </p>
    <p>Fuel type: <?= $ad['fuel_type'] ?> </p>
    <p>Description: <?= $ad['description'] ?> </p>

    <a href="processShowAd.php?advertisementId=<?= $ad['id'] ?>">
      More
    </a>
    <a href="processSaveAd.php?advertisementId=<?= $ad['id'] ?>" style="margin-left: 10px;">
      Save
    </a>
    <br><br>
  <?php endforeach; ?>

</body>
</html>