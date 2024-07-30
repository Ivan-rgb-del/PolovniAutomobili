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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Ads</title>
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="./views/index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <h1 class="text-center mb-4">All Advertisements</h1>

    <form action="processFilterAds.php" method="POST" class="mb-4">
      <div class="input-group">
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title for ad">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>

    <div class="row">
      <?php foreach($ads as $ad): ?>
        <div class="col-md-4 mb-4">
          <div class="card">
            <?php if ($adImageController->getImageOfAd($ad['id'])): ?>
              <img src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>" class="card-img-top" alt="<?= $ad['title'] ?>" style="width: 100%; height: 200px; object-fit: cover;">
            <?php else: ?>
              <img src="assets/pictures/AdPictures/notFound.png" class="card-img-top" alt="Not found" style="width: 100%; height: 200px; object-fit: cover;">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= $ad['title'] ?></h5>
              <p class="card-text"><strong>Price:</strong> <?= number_format($ad['price']) ?>€</p>
              <p class="card-text"><strong>Year:</strong> <?= $ad['first_registration'] ?></p>
              <p class="card-text"><strong>Fuel type:</strong> <?= $ad['fuel_type'] ?></p>
              <p class="card-text"><?= $ad['description'] ?></p>
              <a href="processShowAd.php?advertisementId=<?= $ad['id'] ?>" class="btn btn-primary">More</a>
              <a href="./app/handlers/processSaveAd.php?advertisementId=<?= $ad['id'] ?>" class="btn btn-secondary ms-2">Save</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <footer class="bg-dark text-white py-3 text-center mt-auto">
    <div class="container">
      © 2024 Polovni Automobili
    </div>
  </footer>

</body>
</html>