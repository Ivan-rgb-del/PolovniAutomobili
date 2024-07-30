<?php

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $userId = $_SESSION['userId'];

  require_once "app/controllers/UserController.php";
  require_once "app/repository/UserRepository.php";
  require_once "app/controllers/AdImageController.php";
  require_once "app/repository/AdImageRepository.php";

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Your cars</title>
</head>
<body class="d-flex flex-column min-vh-100">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="./views/index.php">Polovni Automobili</a>
    </div>
  </nav>

  <main class="container flex-grow-1">
    <h1 class="text-center mb-4">Your Advertisements</h1>

    <?php if ($advertisement === null): ?>
      <div class="alert alert-info text-center" role="alert">
        Sorry, but you do not have any advertisements.
        <br>
        Please <a href="./views/Ads/createAdForm.php" class="alert-link">make a new ad</a>.
      </div>
    <?php else: ?>
      <div class="row">
        <?php foreach($advertisement as $ad): ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <?php if ($adImageController->getImageOfAd($ad['id'])): ?>
                <img src="assets/pictures/AdPictures/<?= $adImageController->getImageOfAd($ad['id']) ?>" class="card-img-top" alt="Ad picture">
              <?php else: ?>
                <img src="assets/pictures/AdPictures/notFound.png" class="card-img-top" alt="Not found">
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title"><?= $ad['title'] ?></h5>
                <p class="card-text">Price: <?= number_format($ad['price']) ?>€</p>
                <p class="card-text">Description: <?= $ad['description'] ?></p>
                <p class="card-text">First Registration: <?= $ad['first_registration'] ?></p>
                <p class="card-text">Fuel Type: <?= $ad['fuel_type'] ?></p>
                <p class="card-text">Type: <?= $ad['category_id'] == 1 ? 'Car' : 'Van' ?></p>
                <a href="./app/handlers/processDeleteAdvertisement.php?advertisementId=<?= $ad['id'] ?>" class="btn btn-danger">Delete</a>
                <a href="views/Ads/editSellerAdForm.php?advertisementId=<?= $ad['id'] ?>" class="btn btn-primary">Edit</a>
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