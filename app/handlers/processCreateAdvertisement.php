<?php

  require_once "../repository/AdvertisementRepository.php";
  require_once "../repository/AdImageRepository.php";
  require_once "../controllers/AdvertisementController.php";

  $adsRepo = new AdvertisementRepository();
  $adImageRepo = new AdImageRepository();
  $adsController = new AdvertisementController($adsRepo, $adImageRepo);

  $title = $_POST['title'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $firstRegistration = $_POST['firstRegistration'];
  $fuelType = $_POST['fuelType'];
  $categoryId = $_POST['categories'];
  $userId = $_POST['userId'];
  $subCategoryId = $_POST['vehicleType'];

  $target_dir = "../../assets/pictures/AdPictures/";
  $target_file = $target_dir . basename($_FILES["adImageToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["adImageToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  if ($_FILES["adImageToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    echo "Sorry, only JPG, JPEG and PNG files are allowed.";
    $uploadOk = 0;
  }

  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    if (move_uploaded_file($_FILES["adImageToUpload"]["tmp_name"], $target_file)) {
      header("Location: ../../views/index.php");
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  $adImage = $_FILES["adImageToUpload"]["name"];

  $result = $adsController->createAdvertisement($title, $price, $description, $firstRegistration, $fuelType, $categoryId, $userId, $subCategoryId, $adImage);

?>