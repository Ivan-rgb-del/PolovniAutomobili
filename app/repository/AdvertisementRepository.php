<?php

  require_once __DIR__ . '/../database/Base.php';
  require_once __DIR__ . '/../contracts/AdvertisementContract.php';
  require_once __DIR__ . '/../models/Advertisement.php';

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  class AdvertisementRepository extends Base implements AdvertisementContract {
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

    public function countOfCreatedAdsByUser(int $userId)
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

    public function deleteAdvertisement(int $adId)
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

    public function getAdvertisementId(int $adId)
    {
      $stmt = $this->conn->prepare("SELECT * FROM ads WHERE id=?");
      $stmt->bind_param("i", $adId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 0) {
        return null;
      }

      return $result->fetch_assoc();
    }

    public function getAllAdvertisement() {
      $result = $this->conn->query("SELECT * FROM ads");

      if ($result->num_rows == 0) {
        return null;
      }

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function filterAdsByTitle(string $input)
    {
      $input = '%' . $input . '%';
      $stmt = $this->conn->prepare("SELECT * FROM ads WHERE title LIKE ?");
      $stmt->bind_param("s", $input);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 0) {
        return null;
      }

      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }

?>