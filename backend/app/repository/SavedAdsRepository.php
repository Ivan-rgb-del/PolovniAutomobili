<?php

  require_once __DIR__ . '/../models/SavedAds.php';
  require_once __DIR__ . '/../models/Advertisement.php';
  require_once __DIR__ . '/../database/Base.php';
  require_once __DIR__ . '/../contracts/SavedAdsContract.php';

  class SavedAdsRepository extends Base implements SavedAdsContract {
    public function saveAdvertisement(int $userId, int $adId)
    {
      try {
        $stmt = $this->conn->prepare("INSERT INTO saved_ads (user_id, advertisement_id) VALUES (?, ?)");
        if ($stmt === false) {
          throw new Exception('Prepare failed: ' . $this->conn->error);
        }

        $stmt->bind_param("ii", $userId, $adId);
        $success = $stmt->execute();

        if ($success === false) {
          throw new Exception('Execute failed: ' . $stmt->error);
        }

        $stmt->close();
        return $success;
      } catch (Exception $e) {
        error_log('Save Advertisement Error: ' . $e->getMessage());
        return false;
      }
    }

    public function getAllSavedAdsByUser(int $userId) {
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

    public function deleteSavedAd(int $userId, int $adId) {
      $stmt = $this->conn->prepare(
        "DELETE FROM saved_ads
        WHERE user_id = ?
        AND advertisement_id = ?"
      );
      $stmt->bind_param("ii", $userId, $adId);
      $stmt->execute();
    }

    public function getUserWhoSavedAd(int $adId) {
      $result = $this->conn->query("SELECT user_id FROM saved_ads WHERE advertisement_id = '$adId'");
      $userIds = [];
      if ($result) {
        while ($row = $result->fetch_assoc()) {
          $userIds[] = $row['user_id'];
        }
      }
      return $userIds;
    }
  }

?>