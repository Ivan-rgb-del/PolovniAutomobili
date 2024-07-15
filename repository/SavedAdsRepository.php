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
  }

?>