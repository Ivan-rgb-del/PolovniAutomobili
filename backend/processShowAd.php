<?php

  require_once "./app/repository/AdvertisementRepository.php";
  require_once "./app/repository/AdImageRepository.php";
  require_once "./app/controllers/AdvertisementController.php";
  require_once "./app/controllers/AdImageController.php";

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>
    <?= $ad['title'] ?>
  </title>
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="./views/index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <h2 class="text-center mb-4">Model: <?= $ad['title'] ?></h2>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <?php if ($adImage): ?>
            <img src="assets/pictures/AdPictures/<?= $adImage ?>" class="card-img-top" alt="<?= $ad['title'] ?>">
          <?php else: ?>
            <img src="assets/pictures/AdPictures/notFound.png" class="card-img-top" alt="Not Found">
          <?php endif; ?>
          <div class="card-body">
            <p class="card-text"><strong>Year:</strong> <?= $ad['first_registration'] ?></p>
            <p class="card-text"><strong>Price:</strong> <?= number_format($ad['price']) ?>€</p>
            <p class="card-text"><strong>Fuel type:</strong> <?= $ad['fuel_type'] ?></p>
            <p class="card-text">
              <strong>Type:</strong> <?= $ad['category_id'] === 1 ? 'Car' : 'Van' ?>
            </p>
            <p class="card-text"><strong>Description:</strong> <?= $ad['description'] ?></p>
            <a 
              href="./app/handlers/processSaveAd.php?advertisementId=<?= $ad['id'] ?>" 
              class="btn btn-secondary">
              Save
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-dark text-white py-3 text-center mt-auto">
    <div class="container">
      © 2024 Polovni Automobili
    </div>
  </footer>

</body>
</html>