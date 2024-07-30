<?php

  require_once "./app/controllers/AdvertisementController.php";
  require_once "./app/controllers/AdImageController.php";
  require_once "./app/repository/AdvertisementRepository.php";
  require_once "./app/repository/AdImageRepository.php";

  $adRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();
  $adController = new AdvertisementController($adRepo, $adImageRepo);
  $adImageController = new AdImageController($adImageRepo);

  $title = $_POST['title'];

  $filteredAd = $adController->filterAdsByTitle($title);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Search</title>
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="./views/index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <h1 class="mb-4 text-center">Filtered Ads</h1>

    <?php if (empty($filteredAd)): ?>
      <p>No ads found matching the title.</p>
    <?php else: ?>
      <?php foreach($filteredAd as $ad): ?>
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-4">
              <?php if ($adImageController->getImageOfAd($ad['id'])): ?>
                <img src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>" alt="<?= $ad['title'] ?>" class="img-fluid rounded-start">
              <?php else: ?>
                <img src="assets/pictures/AdPictures/notFound.png" alt="Not found" class="img-fluid rounded-start">
              <?php endif; ?>
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><?= $ad['title'] ?></h5>
                <p class="card-text"><strong>Price:</strong> <?= number_format($ad['price']) ?>€</p>
                <p class="card-text"><strong>Year:</strong> <?= $ad['first_registration'] ?></p>
                <p class="card-text"><strong>Fuel type:</strong> <?= $ad['fuel_type'] ?></p>
                <p class="card-text"><?= $ad['description'] ?></p>
                <a href="processShowAd.php?advertisementId=<?= $ad['id'] ?>" class="btn btn-primary">More</a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </main>

  <footer class="bg-dark text-white py-3 text-center mt-auto">
    <div class="container">
      © 2024 Polovni Automobili
    </div>
  </footer>

</body>
</html>