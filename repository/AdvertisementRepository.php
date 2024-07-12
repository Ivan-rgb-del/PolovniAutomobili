<?php

  require_once "database/Base.php";
  require_once "interfaces/IAdvertisementRepository.php";
  require_once "models/Advertisement.php";

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  class AdvertisementRepository extends Base implements IAdvertisementRepository {
    // Method for creating ads
    public function createAdvertisement(Advertisement $advertisement)
    {
      $title = $this->conn->real_escape_string($advertisement->title);
      $price = $this->conn->real_escape_string($advertisement->price);
      $description = $this->conn->real_escape_string($advertisement->description);
      $firstRegistration = $this->conn->real_escape_string($advertisement->firstRegistration);
      $fuelType = $this->conn->real_escape_string($advertisement->fuelType);

      $userId = $_SESSION['userId'];

      $categoryId = $this->conn->real_escape_string($advertisement->categoryId);
      $subCategory = $this->conn->real_escape_string($advertisement->subCategory);

      // Calling the user ad count function
      $countOfUserAds = $this->countOfCreatedAdsByUser($userId);

      if ($countOfUserAds < 3) {
        $this->conn->query(
          "INSERT INTO ads
            (title, price, description, first_registration, fuel_type, category_id, user_id, sub_category)
            VALUES ('$title', '$price', '$description', '$firstRegistration', '$fuelType', '$categoryId', '$userId', '$subCategory')
          "
        );
      } else {
        die("Sorry but are able to make just 3 advertisement!");
      }
    }

    public function getLastInsertId()
    {
      return $this->conn->insert_id;
    }

    // Method to calculate the number of posts created by a user
    public function countOfCreatedAdsByUser($userId)
    {
      $result = $this->conn->query(
        "SELECT COUNT(*)
        FROM ads
        WHERE user_id = '$userId'
      ");

      $row = mysqli_fetch_array($result);
      $count = $row['COUNT(*)'];

      return $count;
    }

    public function deleteAdvertisement($adId)
    {
      $stmt = $this->conn->prepare("DELETE FROM ads WHERE id = ?");
      $stmt->bind_param("i", $adId);
      $stmt->execute();
    }
  }

?>