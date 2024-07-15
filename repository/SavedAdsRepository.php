<?php

  require_once "database/Base.php";
  require_once "models/SavedAds.php";
  require_once "interfaces/ISavedAdsRepository.php";

  class SavedAdsRepository extends Base implements ISavedAdsRepository {
    public function saveAdvertisement($userId, $adId)
    {
      $stmt = $this->conn->prepare("INSERT INTO saved_ads (user_id, advertisement_id) VALUES (?, ?)");
      $stmt->bind_param("ii", $userId, $adId);
      $stmt->execute();
      $stmt->close();
    }

    public function showAllSavedAdsByUser($userId) {
      $stmt = $this->conn->prepare("SELECT * FROM saved_ads WHERE user_id = ?");
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows === 0) {
        return "You do not have any saved ad!";
      }

      var_dump($result->fetch_all(MYSQLI_ASSOC));
      return $result->fetch_all(MYSQLI_ASSOC);
    }
  }

?>