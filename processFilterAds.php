<?php

  require_once "controllers/AdvertisementController.php";
  require_once "repository/AdvertisementRepository.php";
  require_once "repository/AdImageRepository.php";

  $adRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();
  $adController = new AdvertisementController($adRepo, $adImageRepo);

  $title = $_POST['title'];

  $adController->filterAdsByTitle($title);

?>