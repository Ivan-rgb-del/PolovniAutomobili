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
        return null;
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
      $stmt->close();
    }

    public function editAdvertisement(Advertisement $advertisement)
    {
      $stmt = $this->conn->prepare(
        "UPDATE ads
        SET title=?, price=?, description=?, first_registration=?, fuel_type=?, category_id=?, sub_category=?
        WHERE id=?"
      );
      $stmt->bind_param(
        "sisisiii",
        $advertisement->title,
        $advertisement->price,
        $advertisement->description,
        $advertisement->firstRegistration,
        $advertisement->fuelType,
        $advertisement->categoryId,
        $advertisement->subCategory,
        $advertisement->id
      );
      $stmt->execute();
      $stmt->close();
    }

    public function getAdvertisementId($adId)
    {
      $stmt = $this->conn->prepare("SELECT * FROM ads WHERE id=?");
      $stmt->bind_param("i", $adId);
      $stmt->execute();
      $stmt->close();
    }
  }

?>