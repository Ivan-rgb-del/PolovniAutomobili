<?php

  require_once __DIR__ . '/../models/SavedAds.php';
  require_once __DIR__ . '/../models/Advertisement.php';
  require_once __DIR__ . '/../database/Base.php';
  require_once __DIR__ . '/../interfaces/ISavedAdsRepository.php';

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
        "SELECT 
          ads.id,
          ads.title,
          ads.price,
          ads.description,
          ads.first_registration,
          ads.fuel_type,
          ads.category_id,
          ads.user_id,
          ads.sub_category
        FROM 
          saved_ads
        JOIN 
          ads ON saved_ads.advertisement_id = ads.id
        JOIN 
          users ON ads.user_id = users.id
        WHERE 
          saved_ads.user_id = ?"
      );
      $stmt->bind_param("i", $userId);
      $stmt->execute();
      $result = $stmt->get_result();

      return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteSavedAd($userId, $adId) {
      $stmt = $this->conn->prepare(
        "DELETE FROM saved_ads
        WHERE user_id = ?
        AND advertisement_id = ?"
      );
      $stmt->bind_param("ii", $userId, $adId);
      $stmt->execute();
    }
  }

?>