<?php

  require_once __DIR__ . "/repository/UserRepository.php";
  require_once __DIR__ . "/controllers/UserController.php";
  require_once __DIR__ . "/interfaces/IUserRepository.php";

  $userRepo = new UserRepository();
  $userController = new UserController($userRepo);

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $phoneNumber = $_POST['phoneNumber'];

  $target_dir = "assets/pictures/UserPictures/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  if ($_FILES["fileToUpload"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  $profileImage = $_FILES["fileToUpload"]["name"];

  $result = $userController->registerUser($firstName, $lastName, $email, $password, $role, $profileImage, $phoneNumber);

  header("Location: views/index.php");

?>