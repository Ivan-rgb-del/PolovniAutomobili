<?php

  require_once "database/Base.php";
  require_once "interfaces/IAdvertisementRepository.php";
  require_once "models/Advertisement.php";

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  class AdvertisementRepository implements IAdvertisementRepository {
    private Base $conn;

    public function __construct(Base $base)
    {
      $this->conn = $base;
    }

    public function createAdvertisement(Advertisement $advertisement)
    {
      $title = $this->conn->realEscapeString($advertisement->title);
      $price = $this->conn->realEscapeString($advertisement->price);
      $description = $this->conn->realEscapeString($advertisement->description);
      $firstRegistration = $this->conn->realEscapeString($advertisement->firstRegistration);
      $fuelType = $this->conn->realEscapeString($advertisement->fuelType);

      $userId = $_SESSION['userId'];

      $categoryId = $this->conn->realEscapeString($advertisement->categoryId);
      $subCategory = $this->conn->realEscapeString($advertisement->subCategory);

      $this->conn->query(
        "INSERT INTO ads
          (title, price, description, first_registration, fuel_type, category_id, user_id, sub_category)
          VALUES ('$title', '$price', '$description', '$firstRegistration', '$fuelType', '$categoryId', '$userId', '$subCategory')
        "
      );
    }
  }

?>