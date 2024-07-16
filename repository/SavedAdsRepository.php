<?php

  require_once "database/Base.php";
  require_once "models/SavedAds.php";
  require_once "interfaces/ISavedAdsRepository.php";
  require_once "models/Advertisement.php";

  class SavedAdsRepository extends Base implements ISavedAdsRepository {
    public function saveAdvertisement($userId, $adId)
    {
      $stmt = $this->conn->prepare("INSERT INTO saved_ads (user_id, advertisement_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $userId, $adId);
      $stmt->execute();
      $stmt->close();
    }

    public function getAllSavedAdsByUser($userId) {
      $stmt = $this->conn->prepare(
        "SELECT a.* FROM ads a
        JOIN saved_ads s
        ON a.id = s.advertisement_id
        WHERE s.user_id = ?"
      );
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_assoc();
    }
  }

?>