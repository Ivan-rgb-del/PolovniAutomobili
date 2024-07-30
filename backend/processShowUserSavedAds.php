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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Saved ads</title>
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="./views/index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <h1 class="text-center mb-4">Saved Ads</h1>

    <?php if (!$savedAds): ?>
      <div class="alert alert-info text-center">
        <h2>You do not have any saved ads.</h2>
        <p>
          Please visit <a href="processShowAllAds.php" class="alert-link">Ads</a> and save your favourite ads!
        </p>
      </div>
    <?php else: ?>
      <div class="row">
        <?php foreach ($savedAds as $ad): ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <?php if($adImageController->getImageOfAd($ad['id'])): ?>
                <img src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>" class="card-img-top" alt="<?= $ad['title'] ?>">
              <?php else: ?>
                <img src="assets/pictures/AdPictures/notFound.png" class="card-img-top" alt="Not Found">
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title"><?= $ad['title'] ?></h5>
                <p class="card-text">First registration: <?= $ad['first_registration'] ?></p>
                <p class="card-text">Price: <?= number_format($ad['price']) ?>€</p>
                <p class="card-text">Fuel type: <?= $ad['fuel_type'] ?></p>
                <p class="card-text">Type: <?= $ad['category_id'] == 1 ? 'Car' : 'Van' ?></p>
                <p class="card-text">Description: <?= $ad['description'] ?></p>
                <a href="./app/handlers/processDeleteFromSavedAds.php?adId=<?= $ad['id'] ?>" class="btn btn-danger">Remove</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </main>

  <footer class="bg-dark text-white py-3 text-center mt-auto">
    <div class="container">
      © 2024 Polovni Automobili
    </div>
  </footer>

</body>
</html>